@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Service Stations</h2>
        </div>

        @if($users->count())
            <!-- Table -->
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="w-full text-left text-sm text-gray-700">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-4 py-3 border-b">Name</th>
                            <th class="px-4 py-3 border-b">Email</th>
                            <th class="px-4 py-3 border-b">Status</th>
                            <th class="px-4 py-3 border-b text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 inline-flex text-xs font-medium rounded-full 
                                        {{ $user->is_active ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ $user->is_active ? 'Active' : 'Pending' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="inline-flex items-center px-3 py-1.5 text-sm font-medium bg-blue-500 text-white rounded-md shadow hover:bg-blue-600 transition">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex justify-end mt-6">
                {{ $users->links() }}
            </div>
        @else
            <div class="py-12 text-center text-gray-500">
                <p class="text-lg">No service stations found 🚫</p>
            </div>
        @endif
    </div>
@endsection
