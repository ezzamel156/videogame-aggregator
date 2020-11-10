<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';
    public $searchResults = [];

    public function render()
    {
        if($this->search) {
            $this->searchResults = $this->formatForView(
                Http::withHeaders(config('services.igdb'))
                    ->withBody("
                        search \"{$this->search}\";
                        fields name, cover.url, slug;
                        limit 6;
                    ", 'raw')
                    ->post('https://api.igdb.com/v4/games')
                    ->json()
            );        
        }

        return view('livewire.search-dropdown');
    }

    private function formatForView($games)
    {
        return collect($games)->map(function($game) {
            return collect($game)->merge([
                'coverImageUrl' => isset($game['cover']) ? Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) : 'https://http://via.placeholder.com/264x352',                
            ]);
        })->toArray();
    }
}
