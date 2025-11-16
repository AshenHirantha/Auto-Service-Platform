<?php

namespace app\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\Part;
use App\Models\PartImage;
use App\Models\PartsInventory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $vendorId = optional($request->user()->partsVendor)->id;
        $query = Part::query();

        if (Schema::hasTable('part_images')) {
            $query->selectSub(
                \App\Models\PartImage::select('image_url')
                    ->whereColumn('part_images.part_id', 'parts.id')
                    ->orderBy('id')
                    ->limit(1),
                'thumb_url'
            );
        }

        if (Schema::hasTable('parts_inventories')) {
            $query->leftJoin('parts_inventories as pi', function ($join) use ($vendorId) {
                $join->on('parts.id', '=', 'pi.part_id');
                if ($vendorId) {
                    $join->where('pi.vendor_id', '=', $vendorId);
                }
            })->addSelect(
                'parts.*',
                'pi.price as vendor_price',
                'pi.quantity as vendor_qty',
                'pi.condition as vendor_condition',
                'pi.availability as vendor_availability'
            );
        } else {
            $query->select('parts.*');
        }

        $parts = $query->latest('parts.created_at')->paginate(15);

        return view('vendor.catalog.index', compact('parts'));
    }

    public function create()
    {
        return view('vendor.catalog.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:100'],
            'category' => ['required','string','max:50'],
            'manufacturer' => ['nullable','string','max:100'],
            'model_compatibility' => ['nullable','string'],
            'specifications' => ['nullable','string'],
            'is_genuine' => ['nullable','boolean'],
            'warranty' => ['nullable','string','max:100'],

            // Vendor inventory fields (optional)
            'quantity' => ['nullable','integer','min:0'],
            'price' => ['nullable','numeric','min:0'],
            'condition' => ['nullable','string','max:20'],
            'availability' => ['nullable','string','max:20'],

            // Image fields (optional)
            'image' => ['nullable','image','max:2048'],
            'image_description' => ['nullable','string','max:255'],
        ]);

        DB::transaction(function () use ($request, $data) {
            $part = Part::create([
                'name' => $data['name'],
                'category' => $data['category'],
                'manufacturer' => $data['manufacturer'] ?? null,
                'model_compatibility' => $data['model_compatibility'] ?? null,
                'specifications' => $data['specifications'] ?? null,
                'is_genuine' => (bool)($data['is_genuine'] ?? false),
                'warranty' => $data['warranty'] ?? null,
            ]);

            // Optional vendor-specific inventory
            $vendorId = optional($request->user()->partsVendor)->id;
            $hasInventoryInput = $request->filled('quantity') || $request->filled('price') || $request->filled('condition') || $request->filled('availability');
            if ($vendorId && $hasInventoryInput && Schema::hasTable('parts_inventories')) {
                $request->validate([
                    'price' => ['required','numeric','min:0'],
                    'condition' => ['required','string','max:20'],
                    'availability' => ['required','string','max:20'],
                ]);

                PartsInventory::updateOrCreate(
                    ['part_id' => $part->id, 'vendor_id' => $vendorId],
                    [
                        'quantity' => (int)($request->input('quantity', 0)),
                        'price' => $request->input('price'),
                        'condition' => $request->input('condition'),
                        'availability' => $request->input('availability'),
                    ]
                );
            }

            // Optional image upload
            
            $request -> validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8192',
                ]);
                
            if ($request->hasFile('image') && Schema::hasTable('part_images')) {
                $path = $this->storeResizedImage($request->file('image'));
                $url = Storage::url($path);
                PartImage::create([
                    'part_id' => $part->id,
                    'image_url' => $url,
                    'description' => $request->input('image_description'),
                    'captured_at' => Carbon::now(),
                ]);
            }
        });

        return redirect()->route('vendor.catalog.index')->with('success', 'Part created.');
    }

    public function edit(Request $request, Part $product)
    {
        $user = $request->user();
        if (! $user) {
            return redirect()->route('login');
        }

        $vendorId = optional($request->user()->partsVendor)->id;
        $inv = null;
        if ($vendorId && Schema::hasTable('parts_inventories')) {
            $inv = PartsInventory::where('part_id', $product->id)
                ->where('vendor_id', $vendorId)
                ->first();
        }
        // Provide both 'part' and legacy 'parts' keys in case a partial expects $parts
        return view('vendor.catalog.edit', ['part' => $product, 'parts' => $product, 'inv' => $inv]);
    }

    public function update(Request $request, Part $product)
    {
        $user = $request->user();
        if (! $user) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'name' => ['required','string','max:100'],
            'category' => ['required','string','max:50'],
            'manufacturer' => ['nullable','string','max:100'],
            'model_compatibility' => ['nullable','string'],
            'specifications' => ['nullable','string'],
            'is_genuine' => ['nullable','boolean'],
            'warranty' => ['nullable','string','max:100'],

            // Vendor inventory fields (optional)
            'quantity' => ['nullable','integer','min:0'],
            'price' => ['nullable','numeric','min:0'],
            'condition' => ['nullable','string','max:20'],
            'availability' => ['nullable','string','max:20'],

            // Image fields (optional)
            'image' => ['nullable','image','max:2048'],
            'image_description' => ['nullable','string','max:255'],
        ]);

        DB::transaction(function () use ($request, $data, $product) {
            $product->update([
            'name' => $data['name'],
            'category' => $data['category'],
            'manufacturer' => $data['manufacturer'] ?? null,
            'model_compatibility' => $data['model_compatibility'] ?? null,
            'specifications' => $data['specifications'] ?? null,
            'is_genuine' => (bool)($data['is_genuine'] ?? false),
            'warranty' => $data['warranty'] ?? null,
            ]);

        // Vendor inventory update
        $vendorId = optional($request->user()->partsVendor)->id;
        $hasInventoryInput = $request->filled('quantity') || $request->filled('price') || $request->filled('condition') || $request->filled('availability');
        if ($vendorId && $hasInventoryInput && Schema::hasTable('parts_inventories')) {
            $request->validate([
                'price' => ['required','numeric','min:0'],
                'condition' => ['required','string','max:20'],
                'availability' => ['required','string','max:20'],
            ]);

            PartsInventory::updateOrCreate(
                ['part_id' => $product->id, 'vendor_id' => $vendorId],
                [
                    'quantity' => (int)($request->input('quantity', 0)),
                    'price' => $request->input('price'),
                    'condition' => $request->input('condition'),
                    'availability' => $request->input('availability'),
                ]
            );
        }

        // Optional image upload (append)
        if ($request->hasFile('image') && Schema::hasTable('part_images')) {
            $path = $this->storeResizedImage($request->file('image'));
            $url = Storage::url($path);
            PartImage::create([
                'part_id' => $product->id,
                'image_url' => $url,
                'description' => $request->input('image_description'),
                'captured_at' => Carbon::now(),
            ]);
        }
        });

        return redirect()->route('vendor.catalog.index')->with('success', 'Part updated.');
    }

    /**
     * Store a resized image to the public disk and return the storage path.
     * Falls back to original storage if GD is not available or on failure.
     */
    protected function storeResizedImage(UploadedFile $file, string $dir = 'parts', int $maxDim = 1200): string
    {
        try {
            if (! function_exists('imagecreatetruecolor')) {
                return $file->store($dir, 'public');
            }

            $mime = $file->getMimeType();
            $src = null;
            if (in_array($mime, ['image/jpeg', 'image/jpg'])) {
                $src = @imagecreatefromjpeg($file->getPathname());
                $ext = 'jpg';
            } elseif ($mime === 'image/png') {
                $src = @imagecreatefrompng($file->getPathname());
                $ext = 'png';
            } elseif ($mime === 'image/gif') {
                $src = @imagecreatefromgif($file->getPathname());
                $ext = 'gif';
            } else {
                return $file->store($dir, 'public');
            }

            if (! $src) {
                return $file->store($dir, 'public');
            }

            $width = imagesx($src);
            $height = imagesy($src);
            $scale = min(1.0, $maxDim / max($width, $height));

            if ($scale >= 1.0) {
                // No resize needed
                imagedestroy($src);
                return $file->store($dir, 'public');
            }

            $newW = (int) floor($width * $scale);
            $newH = (int) floor($height * $scale);
            $dst = imagecreatetruecolor($newW, $newH);

            if ($mime === 'image/png' || $mime === 'image/gif') {
                imagealphablending($dst, false);
                imagesavealpha($dst, true);
                $transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
                imagefilledrectangle($dst, 0, 0, $newW, $newH, $transparent);
            }

            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newW, $newH, $width, $height);
            imagedestroy($src);

            ob_start();
            if ($mime === 'image/png') {
                imagepng($dst, null, 6);
            } elseif ($mime === 'image/gif') {
                imagegif($dst);
            } else {
                imagejpeg($dst, null, 85);
            }
            imagedestroy($dst);
            $data = ob_get_clean();

            $filename = trim($dir, '/').'/'.uniqid('img_', true).'.'.$ext;
            Storage::disk('public')->put($filename, $data);
            return $filename;
        } catch (\Throwable $e) {
            return $file->store($dir, 'public');
        }
    }
}