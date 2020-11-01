<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class MostAnticipated extends Component
{
    public $mostAnticipated = [];

    public function loadMostAnticipated()
    {
        $this->mostAnticipated = $this->formatForView(
            Cache::remember('most-anticipated', 30, function() {
                $afterFourMonths = Carbon::now()->addMonth(4)->timestamp;
                $current = Carbon::now()->timestamp;                          
                return Http::withHeaders(config('services.igdb'))
                    ->withBody("
                        fields name, first_release_date, rating, hypes, total_rating_count, cover.url, platforms.abbreviation, slug;
                        where platforms = (48,49,130,6)
                        & ( first_release_date > {$current} 
                        & first_release_date < {$afterFourMonths} 
                        & hypes > 5);
                        sort hypes desc;
                        limit 4;
                    ", 'raw')
                    ->post('https://api.igdb.com/v4/games')
                    ->json();
            })        
        );
    }

    public function render()
    {
        return view('livewire.most-anticipated');
    }

    private function formatForView($games)
    {
        return collect($games)->map(function($game) {
            return collect($game)->merge([
                'coverImageUrl' => isset($game['cover']) ? Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']) : '/jeng',
                'releaseDate' => isset($game['first_release_date']) ? Carbon::parse($game['first_release_date'])->format('M d, Y') : null,
            ]);
        })->toArray();
    }
}
