<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class TvShowController extends Controller
{
    /**
     * Display the specified TV show details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            // Fetch TV show details from TMDB API
            $response = Http::get("https://api.themoviedb.org/3/tv/{$id}", [
                'api_key' => config('services.tmdb.token'),
                'language' => 'pt-BR',
            ]);
    
            if ($response->successful()) {
                $show = $response->json();
    
                // Ensure the response has necessary details
                if (isset($show['name']) && isset($show['poster_path'])) {
                    return view('tv.show', compact('show'));
                } else {
                    $error = 'TV show details not found or incomplete.';
                    return view('errors.api-error', compact('error'));
                }
            } else {
                $error = $response->json()['status_message'] ?? 'TV show not found.';
                return view('errors.api-error', compact('error'));
            }
        } catch (\Exception $e) {
            $errorMessage = 'Error fetching TV show details: ' . $e->getMessage();
            return view('errors.api-error', compact('errorMessage'));
        }
    }
    
    
    

    /**
     * Display a listing of the most popular TV shows.
     *
     * @return \Illuminate\Http\Response
     */
    public function more()
    {
        try {
            // Fetch most popular TV shows from TMDB API
            $response = Http::get('https://api.themoviedb.org/3/tv/popular', [
                'api_key' => config('services.tmdb.token'),
                'language' => 'pt-BR',
            ]);
    
            if ($response->successful()) {
                $tvShows = $response->json()['results'];
    
                // Paginate manually using LengthAwarePaginator
                $perPage = 12; // Number of TV shows per page
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
                $currentItems = array_slice($tvShows, ($currentPage - 1) * $perPage, $perPage);
                $tvShows = new LengthAwarePaginator($currentItems, count($tvShows), $perPage, $currentPage, [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => 'page',
                ]);
    
                return view('tv.more', compact('tvShows'));
            } else {
                $error = $response->json()['status_message'] ?? 'Failed to fetch TV shows.';
                return view('errors.api-error', compact('error'));
            }
        } catch (\Exception $e) {
            $errorMessage = 'Error fetching popular TV shows: ' . $e->getMessage();
            return view('errors.api-error', compact('errorMessage'));
        }
    }

    
    public function index($id)
    {
        // Fetch TV show details from TMDB API
        $response = Http::get("https://api.themoviedb.org/3/tv/{$id}", [
            'api_key' => config('services.tmdb.token'),
            'language' => 'pt-BR',
        ]);
    
        if ($response->successful()) {
            $show = $response->json();
    
            // Ensure 'name' and 'poster_path' are available before passing to the view
            if (isset($show['name']) && isset($show['poster_path'])) {
                return view('tv.show', compact('show'));
            } else {
                $error = 'TV show details not found or incomplete.';
                return view('errors.api-error', compact('error'));
            }
        } else {
            $error = $response->json()['status_message'] ?? 'TV show not found.';
            return view('errors.api-error', compact('error'));
        }
    }
}
