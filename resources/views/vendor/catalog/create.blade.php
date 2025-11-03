@extends('layouts.vendor')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800">Add Part</h2>
@endsection

@section('content')
<div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
    <form method="POST" action="{{ route('vendor.catalog.store') }}" enctype="multipart/form-data" class="bg-white p-6 shadow rounded-lg space-y-6">
        @csrf
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <x-input-label>Name</x-input-label>
                <x-text-input name="name" class="w-full" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div>
                <x-input-label>Category</x-input-label>
                <x-text-input name="category" class="w-full" required />
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>
            <div>
                <x-input-label>Manufacturer</x-input-label>
                <x-text-input name="manufacturer" class="w-full" />
                <x-input-error :messages="$errors->get('manufacturer')" class="mt-2" />
            </div>
            <div>
                <x-input-label>Warranty</x-input-label>
                <x-text-input name="warranty" class="w-full" />
                <x-input-error :messages="$errors->get('warranty')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <x-input-label>Model Compatibility</x-input-label>
                <textarea name="model_compatibility" rows="3" class="input-focus block w-full pl-3 pr-3 py-3 border border-gray-300 rounded-xl placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                <x-input-error :messages="$errors->get('model_compatibility')" class="mt-2" />
            </div>
            <div class="sm:col-span-2">
                <x-input-label>Specifications</x-input-label>
                <textarea name="specifications" rows="4" class="input-focus block w-full pl-3 pr-3 py-3 border border-gray-300 rounded-xl placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                <x-input-error :messages="$errors->get('specifications')" class="mt-2" />
            </div>
            <div>
                <label class="inline-flex items-center space-x-2">
                    <input type="checkbox" name="is_genuine" value="1" class="h-4 w-4 border-gray-300 rounded">
                    <span>Genuine Part</span>
                </label>
            </div>
        </div>

        <div class="border-t pt-4">
            <h3 class="text-lg font-medium text-gray-900 mb-2">Vendor Inventory (optional)</h3>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                <div>
                    <x-input-label>Quantity</x-input-label>
                    <x-text-input name="quantity" type="number" min="0" class="w-full" />
                    <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                </div>
                <div>
                    <x-input-label>Price</x-input-label>
                    <x-text-input name="price" type="number" step="0.01" min="0" class="w-full" />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
                <div>
                    <x-input-label>Condition</x-input-label>
                    <select name="condition" class="input-focus block w-full pl-3 pr-3 py-3 border border-gray-300 rounded-xl">
                        <option value="">Select...</option>
                        <option value="new">New</option>
                        <option value="used">Used</option>
                        <option value="refurbished">Refurbished</option>
                    </select>
                    <x-input-error :messages="$errors->get('condition')" class="mt-2" />
                </div>
                <div>
                    <x-input-label>Availability</x-input-label>
                    <select name="availability" class="input-focus block w-full pl-3 pr-3 py-3 border border-gray-300 rounded-xl">
                        <option value="">Select...</option>
                        <option value="in_stock">In Stock</option>
                        <option value="backorder">Backorder</option>
                        <option value="out_of_stock">Out of Stock</option>
                    </select>
                    <x-input-error :messages="$errors->get('availability')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="border-t pt-4">
            <h3 class="text-lg font-medium text-gray-900 mb-2">Images</h3>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <x-input-label>Upload Image</x-input-label>
                    <input type="file" name="image" accept="image/*" class="block w-full text-sm text-gray-700" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
                <div>
                    <x-input-label>Image Description</x-input-label>
                    <x-text-input name="image_description" class="w-full" />
                    <x-input-error :messages="$errors->get('image_description')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="pt-2 flex justify-end">
            <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">Save</button>
        </div>
    </form>
</div>
@endsection

