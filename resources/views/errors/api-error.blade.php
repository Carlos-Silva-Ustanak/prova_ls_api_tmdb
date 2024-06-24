<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('API Error') }}
        </h2>
    </x-slot>

    <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        @isset($error)
            <p class="text-red-600 text-lg font-bold">Error: {{ $error }}</p>
        @endisset

        @isset($errorMessage)
            <p class="text-red-600 text-lg font-bold">Error: {{ $errorMessage }}</p>
        @endisset

        <p class="mt-4 text-gray-600">Please try again later or contact support.</p>
    </div>
</x-app-layout>
