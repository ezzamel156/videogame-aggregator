<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $before = Carbon::now()->subMonth(2)->timestamp;
        $after = Carbon::now()->addMonth(2)->timestamp;
        $afterFourMonths = Carbon::now()->addMonth(4)->timestamp;
        $current = Carbon::now()->timestamp;

        $popularGames = Http::withHeaders(config('services.igdb'))
            ->withBody("
                fields *, cover.url, platforms.abbreviation;
                where platforms = (48,49,130,6)
                & ( first_release_date > {$before} 
                & first_release_date < {$after} 
                & total_rating_count > 5 );
                sort total_rating_count desc;
                limit 12;
            ", 'raw')
            ->post('https://api.igdb.com/v4/games')
            ->json();

        $recentlyReviewed = Http::withHeaders(config('services.igdb'))
            ->withBody("
                fields *, cover.url, platforms.abbreviation;
                where platforms = (48,49,130,6)
                & ( first_release_date > {$before} 
                & first_release_date < {$current} 
                & total_rating_count > 5);
                sort total_rating_count desc;
                limit 3;
            ", 'raw')
            ->post('https://api.igdb.com/v4/games')
            ->json();

        $mostAnticipated = Http::withHeaders(config('services.igdb'))
            ->withBody("
                fields *, cover.url, platforms.abbreviation;
                where platforms = (48,49,130,6)
                & ( first_release_date > {$current} 
                & first_release_date < {$afterFourMonths} 
                & hypes > 5);
                sort hypes desc;
                limit 4;
            ", 'raw')
            ->post('https://api.igdb.com/v4/games')
            ->json();
        
        $comingSoon = Http::withHeaders(config('services.igdb'))
            ->withBody("
                fields *, cover.url, platforms.abbreviation;
                where platforms = (48,49,130,6)
                & (first_release_date > {$current}
                & hypes > 5);
                sort first_release_date asc;
                limit 4;
            ", 'raw')
            ->post('https://api.igdb.com/v4/games')
            ->json();

            // dd(compact('mostAnticipated'));
        return view('index', compact('popularGames', 'recentlyReviewed', 'mostAnticipated', 'comingSoon'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
