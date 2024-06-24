<!-- Extend your layout -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $show['name'] ?? 'Unknown Title' }}
        </h2>
    </x-slot>
 
    <div class="container mx-auto p-4">
        <div class="flex">
            <div class="w-1/3">
                @if(isset($show['poster_path']) && $show['poster_path'])
                    <img src="https://image.tmdb.org/t/p/w500{{ $show['poster_path'] }}" alt="{{ $show['name'] }}" class="rounded-lg">
                @else
                    <div class="bg-gray-200 h-64 flex items-center justify-center rounded-lg">
                        <span>No Image Found</span>
                    </div>
                @endif
            </div>
            <div class="w-2/3">
                <h2 class="text-xl font-bold mt-2">{{ $show['name'] ?? 'Unknown Title' }}</h2>
                <!-- Add more details as needed -->
            </div>
        </div>
    </div>
</x-app-layout>
