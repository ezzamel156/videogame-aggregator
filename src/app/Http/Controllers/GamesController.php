<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $game = Http::withHeaders(config('services.igdb'))
            ->withBody("
                fields name, total_rating_count, rating, slug, summary, aggregated_rating, first_release_date,
                cover.url, genres.name, platforms.abbreviation, involved_companies.company.name,
                similar_games.name, similar_games.slug, similar_games.rating, similar_games.cover.url, similar_games.platforms.abbreviation,
                websites.*, videos.*, screenshots.*;
                where slug=\"{$slug}\";
            ", 'raw')
            ->post('https://api.igdb.com/v4/games')
            ->json();

        abort_if(!$game, 404);
        
        return view('show', [
            'game' => $this->formatGameForView($game[0])
        ]);
    }

    private function formatGameForView($game) 
    {                
        return collect($game)->merge([
            'coverImageUrl' => isset($game['cover']) ? Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) : 'https://http://via.placeholder.com/264x352',
            'genres' => isset($game['genres']) ? collect($game['genres'])->pluck('name')->implode(', ') : null,
            'involvedCompanies' => isset($game['involved_companies']) ? $game['involved_companies'][0]['company']['name'] : null,
            'memberRating' => isset($game['rating']) ? round($game['rating']) : '0',
            'criticRating' => isset($game['aggregated_rating']) ? round($game['aggregated_rating']) : '0',
            'platforms' => isset($game['platforms']) ? collect($game['platforms'])->pluck('abbreviation')->implode(', ') : null,
            'trailer' => isset($game['videos']) ? "https://youtube.com/watch/{$game['videos'][0]['video_id']}" : '#',
            'screenshots' => isset($game['screenshots']) ? collect($game['screenshots'])
                ->map(function($screenshot) {
                    return [
                        'huge' => Str::replaceFirst('thumb', 'screenshot_huge', $screenshot['url']),
                        'big' => Str::replaceFirst('thumb', 'screenshot_big', $screenshot['url']),
                    ];
                })->take(9) : null,
            'similarGames' => isset($game['similar_games']) ? collect($game['similar_games'])
                ->map(function($similarGame) {
                    return collect($similarGame)->merge([
                        'coverImageUrl' => isset($similarGame['cover']) ? Str::replaceFirst('thumb', 'cover_small', $similarGame['cover']['url']) : 'https://http://via.placeholder.com/264x352',
                        'platforms' => isset($similarGame['platforms']) ? collect($similarGame['platforms'])->pluck('abbreviation')->implode(', ') : null,
                        'rating' => isset($similarGame['rating']) ? round($similarGame['rating']) : '0',
                    ]);
                })->take(6) : null,
            'social' => [
                'website' => collect($game['websites'])->pluck('url')->first(),
                'facebook' => collect($game['websites'])->filter(function($website) {
                    return Str::contains($website['url'], 'facebook');
                })->pluck('url')->first(),
                'instagram' => collect($game['websites'])->filter(function($website) {
                    return Str::contains($website['url'], 'instagram');
                })->pluck('url')->first(),
                'twitter' => collect($game['websites'])->filter(function($website) {
                    return Str::contains($website['url'], 'twitter');
                })->pluck('url')->first(),
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
