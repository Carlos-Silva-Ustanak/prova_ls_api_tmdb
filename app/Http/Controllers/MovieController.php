<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;



class MovieController extends Controller
{
    /**
     * Display a listing of the most recent movies.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $recentResponse = Http::get('https://api.themoviedb.org/3/movie/now_playing', [
                'api_key' => config('services.tmdb.token'),
                'language' => 'pt-BR',
                'page' => 1,
            ]);

            $popularResponse = Http::get('https://api.themoviedb.org/3/movie/popular', [
                'api_key' => config('services.tmdb.token'),
                'language' => 'pt-BR',
                'page' => 1,
            ]);

            $topRatedResponse = Http::get('https://api.themoviedb.org/3/movie/top_rated', [
                'api_key' => config('services.tmdb.token'),
                'language' => 'pt-BR',
                'page' => 1,
            ]);

            $upcomingResponse = Http::get('https://api.themoviedb.org/3/movie/upcoming', [
                'api_key' => config('services.tmdb.token'),
                'language' => 'pt-BR',
                'page' => 1,
            ]);

            if ($recentResponse->successful() && $popularResponse->successful() && $topRatedResponse->successful() && $upcomingResponse->successful()) {
                $recentMovies = $recentResponse->json()['results'];
                $popularMovies = $popularResponse->json()['results'];
                $topRatedMovies = $topRatedResponse->json()['results'];
                $upcomingMovies = $upcomingResponse->json()['results'];

                return view('dashboard', compact('recentMovies', 'popularMovies', 'topRatedMovies', 'upcomingMovies'));
            } else {
                $error = $recentResponse->json()['status_message'] ?? 'Failed to fetch movies.';
                return view('errors.api-error', compact('error'));
            }
        } catch (\Exception $e) {
            $errorMessage = 'An error occurred: ' . $e->getMessage();
            return view('errors.api-error', compact('errorMessage'));
        }
    }



    
  
    public function more($category)
    {
        $apiEndpoint = '';
        $categoryName = '';

        switch ($category) {
            case 'recent':
                $apiEndpoint = 'now_playing';
                $categoryName = 'Filmes Recentes';
                break;
            case 'popular':
                $apiEndpoint = 'popular';
                $categoryName = 'Filmes Populares';
                break;
            case 'top-rated':
                $apiEndpoint = 'top_rated';
                $categoryName = 'Filmes Mais Bem Avaliados';
                break;
            case 'upcoming':
                $apiEndpoint = 'upcoming';
                $categoryName = 'Próximos Lançamentos';
                break;
            default:
                return redirect()->route('dashboard');
        }

        $response = Http::get("https://api.themoviedb.org/3/movie/{$apiEndpoint}", [
            'api_key' => config('services.tmdb.token'),
            'language' => 'pt-BR',
        ]);

        if ($response->successful()) {
            $movies = $response->json()['results'];

            // Paginação usando LengthAwarePaginator
            $perPage = 12; // Número de itens por página
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $currentItems = array_slice($movies, ($currentPage - 1) * $perPage, $perPage);
            $movies = new LengthAwarePaginator($currentItems, count($movies), $perPage, $currentPage, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]);

            return view('movies.more', compact('movies', 'categoryName', 'category'));
        } else {
            $error = $response->json()['status_message'] ?? 'Falha ao buscar filmes.';
            return view('errors.api-error', compact('error'));
        }
    }
    


    /**
     * Display the specified movie details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Fetch movie details from TMDB API
        $response = Http::get("https://api.themoviedb.org/3/movie/{$id}", [
            'api_key' => config('services.tmdb.token'),
            'language' => 'pt-BR',
        ]);

        if ($response->successful()) {
            $movie = $response->json();
            return view('movies.show', compact('movie'));
        } else {
            $error = $response->json()['status_message'] ?? 'Movie not found.';
            return view('errors.api-error', compact('error'));
        }
    }

    /**
     * Search for movies based on a query string.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Perform search using TMDB API
        $response = Http::get('https://api.themoviedb.org/3/search/movie', [
            'api_key' => config('services.tmdb.token'),
            'language' => 'pt-BR',
            'query' => $query,
            'page' => 1, // Assuming you want the first page
        ]);

        if ($response->successful()) {
            $results = $response->json()['results'];

            // Paginate manually if API doesn't provide pagination
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 12; // Number of items per page
            $currentItems = array_slice($results, ($currentPage - 1) * $perPage, $perPage);
            $results = new LengthAwarePaginator($currentItems, count($results), $perPage, $currentPage, [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]);

            $results->appends(['query' => $query]); // Append the query parameter to pagination links

            return view('movies.search', compact('results', 'query'));
        } else {
            $error = $response->json()['status_message'] ?? 'Search failed.';
            return view('errors.api-error', compact('error'));
        }
    }



    public function moreRecent(Request $request)
    {
        $pageNumber = $request->query('page', 1); // Obter o número da página da query string

        $response = Http::get("https://api.themoviedb.org/3/movie/now_playing", [
            'api_key' => config('services.tmdb.token'),
            'language' => 'pt-BR',
            'page' => $pageNumber,
        ]);

        if ($response->successful()) {
            $movies = $response->json()['results'];

            // Paginação manual
            $perPage = 12; // Número de filmes por página
            $totalMovies = count($movies);
            $totalPages = ceil($totalMovies / $perPage);

            // Pegar os filmes para a página específica
            $startIndex = ($pageNumber - 1) * $perPage;
            $movies = array_slice($movies, $startIndex, $perPage);

            return view('movies.more', compact('movies', 'pageNumber', 'totalPages'));
        } else {
            $error = $response->json()['status_message'] ?? 'Failed to fetch movies.';
            return view('errors.api-error', compact('error'));
        }
    }


    public function morePopular($page = 2)
    {
        $response = Http::get('https://api.themoviedb.org/3/movie/popular', [
            'api_key' => config('services.tmdb.token'),
            'language' => 'pt-BR',
            'page' => $page,
        ]);

        if ($response->successful()) {
            $movies = $response->json()['results'];
            $category = 'Filmes Populares';
            return view('movies.more', compact('movies', 'category', 'page'));
        } else {
            $error = $response->json()['status_message'] ?? 'Failed to fetch movies.';
            return view('errors.api-error', compact('error'));
        }
    }

    public function moreTopRated($page = 2)
    {
        $response = Http::get('https://api.themoviedb.org/3/movie/top_rated', [
            'api_key' => config('services.tmdb.token'),
            'language' => 'pt-BR',
            'page' => $page,
        ]);

        if ($response->successful()) {
            $movies = $response->json()['results'];
            $category = 'Filmes Mais Bem Avaliados';
            return view('movies.more', compact('movies', 'category', 'page'));
        } else {
            $error = $response->json()['status_message'] ?? 'Failed to fetch movies.';
            return view('errors.api-error', compact('error'));
        }
    }

    public function moreUpcoming($page = 2)
    {
        $response = Http::get('https://api.themoviedb.org/3/movie/upcoming', [
            'api_key' => config('services.tmdb.token'),
            'language' => 'pt-BR',
            'page' => $page,
        ]);

        if ($response->successful()) {
            $movies = $response->json()['results'];
            $category = 'Próximos Lançamentos';
            return view('movies.more', compact('movies', 'category', 'page'));
        } else {
            $error = $response->json()['status_message'] ?? 'Failed to fetch movies.';
            return view('errors.api-error', compact('error'));
        }
    }
}
