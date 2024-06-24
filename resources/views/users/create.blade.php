<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full bg-gray-200 text-black dark:bg-gray-700 dark:text-black" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                            <input type="email" name="email" id="email" class="mt-1 block w-full bg-gray-200 text-black dark:bg-gray-700 dark:text-black" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Password</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full bg-gray-200 text-black dark:bg-gray-700 dark:text-black" required>
                        </div>


                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Create</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
