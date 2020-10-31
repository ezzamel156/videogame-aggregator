<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PopularGames extends Component
{
    public $popularGames = [];

    public function loadPopularGames()
    {     
        $this->popularGames = Cache::remember('popular-games', 30, function() {
            $before = Carbon::now()->subMonth(2)->timestamp;
            $after = Carbon::now()->addMonth(2)->timestamp;
            return Http::withHeaders(config('services.igdb'))
                ->withBody("
                    fields name, first_release_date, rating, total_rating_count, cover.url, platforms.abbreviation;
                    where platforms = (48,49,130,6)
                    & ( first_release_date > {$before} 
                    & first_release_date < {$after} 
                    & total_rating_count > 5 );
                    sort total_rating_count desc;
                    limit 12;
                ", 'raw')
                ->post('https://api.igdb.com/v4/games')
                ->json();
        });
    }

    public function render()
    {
        return view('livewire.popular-games');
    }
}