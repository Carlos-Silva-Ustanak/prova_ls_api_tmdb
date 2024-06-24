<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <form action="{{ route('movie.search') }}" method="GET" class="mb-8">
            <input type="text" name="query" placeholder="Buscar filmes..." class="p-3 border rounded-lg w-full">
        </form>

        <h1 class="text-5xl font-bold mb-4 text-center text-white">Filmes Recentes</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($recentMovies as $movie)
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <a href="{{ route('movie.show', $movie['id']) }}">
                        @if($movie['poster_path'])
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
            <a href="{{ route('movies.more', ['category' => 'recent']) }}" class="text-blue-500 py-2 px-4 rounded-lg border border-blue-500 hover:bg-blue-500 hover:text-white">Ver Mais Filmes Recentes</a>
        </div>

        <h1 class="text-5xl font-bold mt-8 mb-4 text-center text-white">Filmes Populares</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($popularMovies as $movie)
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <a href="{{ route('movie.show', $movie['id']) }}">
                        @if($movie['poster_path'])
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
            <a href="{{ route('movies.more', ['category' => 'popular']) }}" class="text-blue-500 py-2 px-4 rounded-lg border border-blue-500 hover:bg-blue-500 hover:text-white">Ver Mais Filmes Populares</a>
        </div>

        <h1 class="text-5xl font-bold mt-8 mb-4 text-center text-white">Melhor Avaliados</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($topRatedMovies as $movie)
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <a href="{{ route('movie.show', $movie['id']) }}">
                        @if($movie['poster_path'])
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
            <a href="{{ route('movies.more', ['category' => 'top-rated']) }}" class="text-blue-500 py-2 px-4 rounded-lg border border-blue-500 hover:bg-blue-500 hover:text-white">Ver Mais Melhor Avaliados</a>
        </div>

        <h1 class="text-5xl font-bold mt-8 mb-4 text-center text-white">Próximos Lançamentos</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($upcomingMovies as $movie)
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <a href="{{ route('movie.show', $movie['id']) }}">
                        @if($movie['poster_path'])
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
            <a href="{{ route('movies.more', ['category' => 'upcoming']) }}" class="text-blue-500 py-2 px-4 rounded-lg border border-blue-500 hover:bg-blue-500 hover:text-white">Ver Mais Próximos Lançamentos</a>
        </div>

       
    </div>
</x-app-layout>
