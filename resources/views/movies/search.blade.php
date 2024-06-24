<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <div class="bg-gray-800 rounded-lg shadow-lg p-6">
            <form action="{{ route('movie.search') }}" method="GET" class="mb-8">
                <input type="text" name="query" placeholder="Buscar filmes..." class="p-3 border rounded-lg w-full text-gray-800 bg-white">
            </form>
            <h1 class="text-5xl font-bold mb-4 text-center text-white">Resultados da Busca por "{{ $query }}"</h1>
           <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @foreach ($results as $movie)
        <div class="bg-white rounded-lg shadow-lg">
            <a href="{{ route('movie.show', $movie['id']) }}">
                @if(isset($movie['poster_path']) && $movie['poster_path'])
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ isset($movie['title']) ? $movie['title'] : $movie['name'] }}" class="rounded-t-lg">
                @else
                    <div class="bg-gray-200 h-64 flex items-center justify-center rounded-t-lg">
                        <span>No Image Found</span>
                    </div>
                @endif
                <h2 class="text-xl text-black font-bold mt-2 px-4">
                    @if(isset($movie['title']))
                        {{ $movie['title'] }}
                    @elseif(isset($movie['name']))
                        {{ $movie['name'] }}
                    @else
                        Title or Name Missing
                    @endif
                </h2>
            </a>
        </div>
    @endforeach
</div>

            
            <div class="mt-8">
                {{ $results->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
