<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        // Return a settings view (create resources/views/admin/settings.blade.php if needed)
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        // Handle settings update logic here
        // Example: $settings = $request->all();
        // Save settings to DB or config
        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
