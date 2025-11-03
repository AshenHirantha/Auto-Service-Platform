@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Users</h1>
            <a href="{{ route('admin.users.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 transition">
                + Add User
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="w-full text-left text-sm text-gray-700">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-4 py-3 border-b">ID</th>
                        <th class="px-4 py-3 border-b">Name</th>
                        <th class="px-4 py-3 border-b">Email</th>
                        <th class="px-4 py-3 border-b">Status</th>
                        <th class="px-4 py-3 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $user->id }}</td>
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                @if($user->is_active)
                                    <span class="inline-block px-2 py-1 rounded-full bg-green-100 text-green-700 font-semibold text-xs shadow">Active</span>
                                @else
                                    <span class="inline-block px-2 py-1 rounded-full bg-red-100 text-red-700 font-semibold text-xs shadow">Pending</span>
                                @endif
                            <td class="px-4 py-3 text-center space-x-2">
                                {{-- Edit Button --}}
                                @include('admin.partials._edit_button', [
                                    'route' => route('admin.users.edit', $user),
                                ])

                                {{-- Delete Modal --}}
                                @include('admin.partials._delete_modal', [
                                    'itemName' => $user->name,
                                    'route' => route('admin.users.destroy', $user),
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
@endsection
