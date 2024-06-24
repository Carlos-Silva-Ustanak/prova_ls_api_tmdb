<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $movie['title'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-800 text-white">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-gray-900 rounded-lg shadow-lg">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/3">
                    @if (!empty($movie['poster_path']))
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}" class="rounded-lg">
                    @else
                    <div class="bg-gray-500 h-96 flex items-center justify-center rounded-lg">
                        <span class="text-gray-300 text-xl">No image available</span>
                    </div>
                    @endif
                </div>
                <div class="md:w-2/3 p-6">
                    <h1 class="text-4xl font-bold mb-4">{{ $movie['title'] }}</h1>
                    <p class="text-gray-300 text-lg mb-4">{{ $movie['overview'] }}</p>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <div>
                            <h2 class="text-xl font-bold mb-2">Genres</h2>
                            <ul class="list-disc list-inside">
                                @foreach ($movie['genres'] as $genre)
                                <li>{{ $genre['name'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold mb-2">Release Date</h2>
                            <p>{{ $movie['release_date'] }}</p>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold mb-2">Runtime</h2>
                            <p>{{ $movie['runtime'] }} minutes</p>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold mb-2">Production Countries</h2>
                            <ul class="list-disc list-inside">
                                @foreach ($movie['production_countries'] as $country)
                                <li>{{ $country['name'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold mb-2">Vote Average</h2>
                            <p>{{ $movie['vote_average'] }}</p>
                        </div>
                        @if (!empty($movie['homepage']))
                        <div>
                            <h2 class="text-xl font-bold mb-2">Official Website</h2>
                            <a href="{{ $movie['homepage'] }}" target="_blank" class="text-blue-500 hover:text-blue-700">{{ $movie['homepage'] }}</a>
                        </div>
                        @endif
                        @if (!empty($movie['credits']['crew']))
                        <div class="col-span-2 md:col-span-3 lg:col-span-2">
                            <h2 class="text-xl font-bold mb-2">Director</h2>
                            <p>{{ collect($movie['credits']['crew'])->firstWhere('job', 'Director')['name'] ?? 'Information not available' }}</p>
                        </div>
                        @endif
                        @if (!empty($movie['credits']['cast']))
                        <div class="col-span-2 md:col-span-3 lg:col-span-2">
                            <h2 class="text-xl font-bold mb-2">Main Cast</h2>
                            <ul class="list-disc list-inside">
                                @foreach ($movie['credits']['cast'] as $castMember)
                                <li>{{ $castMember['name'] }} ({{ $castMember['character'] }})</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if (!empty($movie['videos']['results']))
                        <div class="col-span-2 md:col-span-3 lg:col-span-4">
                            <h2 class="text-xl font-bold mb-2">Trailer</h2>
                            <div class="aspect-w-16 aspect-h-9">
                                <iframe src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}" frameborder="0" allowfullscreen class="rounded-lg"></iframe>
                            </div>
                        </div>
                        @endif
                        @if (!empty($similarMovies))
                        <div class="col-span-2 md:col-span-3 lg:col-span-4">
                            <h2 class="text-xl font-bold mb-2">Similar Movies</h2>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach ($similarMovies as $similarMovie)
                                <div>
                                    <a href="{{ route('movie.show', ['id' => $similarMovie['id']]) }}">
                                        @if (!empty($similarMovie['poster_path']))
                                        <img src="https://image.tmdb.org/t/p/w500{{ $similarMovie['poster_path'] }}" alt="{{ $similarMovie['title'] }}" class="rounded-lg">
                                        @else
                                        <div class="bg-gray-500 h-64 flex items-center justify-center rounded-lg">
                                            <span class="text-gray-300 text-xl">No image available</span>
                                        </div>
                                        @endif
                                        <h3 class="text-lg font-semibold mt-2">{{ $similarMovie['title'] }}</h3>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
