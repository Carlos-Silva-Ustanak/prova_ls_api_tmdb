<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}" class="mt-1 block w-full bg-gray-200 text-black dark:bg-gray-700 dark:text-black" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}" class="mt-1 block w-full bg-gray-200 text-black dark:bg-gray-700 dark:text-black" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Password</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full bg-gray-200 text-black dark:bg-gray-700 dark:text-black">
                        </div>

                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Role</label>
                            <select name="role" id="role" class="mt-1 block w-full bg-gray-200 text-black dark:bg-gray-700 dark:text-black">
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
