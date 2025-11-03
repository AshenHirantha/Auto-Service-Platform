<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'phone'     => 'nullable|string|max:20',
            'password'  => 'required|string|min:8|confirmed',
            'user_type' => 'required|in:customer,service_station,vendor,admin',
            'is_active' => 'boolean',
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'phone'     => 'nullable|string|max:20',
            'password'  => 'nullable|string|min:8|confirmed',
            'user_type' => 'required|in:customer,service_station,vendor,admin',
            'is_active' => 'boolean',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    // ---- Extra Admin Management Methods ----
    public function pending()
    {
        $users = User::where('is_active', false)->paginate(10);

        return view('admin.users.pending', compact('users'));
    }

    public function approve(User $user)
    {
        $user->update(['is_active' => true]);

        return redirect()->route('admin.users.pending')->with('success', 'User approved successfully.');
    }

    public function stations()
    {
        $users = User::where('user_type', 'service_station')->paginate(10);
        return view('admin.users.stations', compact('users'));
    }

    public function vendors()
    {
        $users = User::where('user_type', 'vendor')->paginate(10);
        return view('admin.users.vendors', compact('users'));
    }
}
