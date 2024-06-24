<!-- movies.more.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $categoryName }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($movies as $movie)
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <a href="{{ route('movie.show', $movie['id']) }}">
                        @if(isset($movie['poster_path']))
                            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="rounded-t-lg">
                        @else
                            <div class="bg-gray-200 h-64 flex items-center justify-center rounded-t-lg">
                                <span>No Image Found</span>
                            </div>
                        @endif
                        <h2 class="text-xl font-bold mt-2">{{ $movie['title'] }}</h2>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            {{ $movies->links() }}
        </div>
    </div>
</x-app-layout>
