<!-- Extend your layout -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            TV Shows
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <h1 class="text-5xl font-bold mt-8 mb-4 text-center text-white">Programas de TV Populares</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($tvShows as $show)
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <a href="{{ route('tv.show', $show['id']) }}">
                        @if($show['poster_path'])
                            <img src="https://image.tmdb.org/t/p/w500{{ $show['poster_path'] }}" alt="{{ $show['name'] }}" class="rounded-t-lg">
                        @else
                            <div class="bg-gray-200 h-64 flex items-center justify-center rounded-t-lg">
                                <span>No Image Found</span>
                            </div>
                        @endif
                        <h2 class="text-xl font-bold mt-2">{{ $show['name'] }}</h2>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            {{ $tvShows->links() }}
        </div>
    </div>
</x-app-layout>
