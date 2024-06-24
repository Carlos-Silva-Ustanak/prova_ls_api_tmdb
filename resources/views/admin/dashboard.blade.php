<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Flash Messages --}}
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p class="font-bold">Success</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <p class="font-bold">Error</p>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    {{-- Users Table --}}
                    <h3 class="text-lg font-semibold mb-4">Manage Users</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700">
                                    <th class="border px-4 py-2">Name</th>
                                    <th class="border px-4 py-2">Email</th>
                                    <th class="border px-4 py-2">Role</th>
                                    <th class="border px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <td class="border px-4 py-2">{{ $user->name }}</td>
                                        <td class="border px-4 py-2">{{ $user->email }}</td>
                                        <td class="border px-4 py-2">{{ ucfirst($user->role) }}</td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 px-2 py-1 hover:underline">Edit</a>
                                            @if ($user->id !== auth()->id() && $user->role !== 'admin')
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 px-2 py-1 hover:underline" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            No users found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Create User Link --}}
                    <div class="mt-4">
                        <a href="{{ route('users.create') }}" class="text-blue-500 px-4 py-2 rounded-lg border border-blue-500 hover:bg-blue-500 hover:text-white">Create New User</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
