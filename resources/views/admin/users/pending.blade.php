@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Pending User Approvals</h2>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if($users->count())
            <!-- Table -->
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="w-full text-left text-sm text-gray-700">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-4 py-3 border-b">Name</th>
                            <th class="px-4 py-3 border-b">Email</th>
                            <th class="px-4 py-3 border-b">Type</th>
                            <th class="px-4 py-3 border-b text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3 capitalize">
                                    {{ \App\Models\User::getUserTypes()[$user->user_type] ?? $user->user_type }}
                                </td>
                                <td class="px-4 py-3 text-center space-x-2">
                                    <!-- Approve Button -->
                                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                            class="inline-flex items-center px-3 py-1.5 text-sm font-medium bg-green-500 text-white rounded-md shadow hover:bg-green-600 transition">
                                            Approve
                                        </button>
                                    </form>

                                    <!-- Delete Modal -->
                                    @include('admin.partials._delete_modal', [
                                        'route' => route('admin.users.destroy', $user->id),
                                        'itemName' => $user->name
                                    ])
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
                <p class="text-lg">No pending users 🎉</p>
            </div>
        @endif
    </div>
@endsection
