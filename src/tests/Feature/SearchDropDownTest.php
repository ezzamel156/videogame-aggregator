<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Livewire\SearchDropdown;
use Livewire\Livewire;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SearchDropDownTest extends TestCase
{
    /** @test */
    public function the_search_dropdown_searches_for_games()
    {
        Http::fake([
            'https://api.igdb.com/v4/games' => Http::response($this->fakeSearchGames(), 200),
        ]);

        Livewire::test(SearchDropdown::class)
            ->assertDontSee('zelda')
            ->set('search', 'zelda')
            ->assertSee('Fake Zelda II: The Adventure of Link')
            ->assertSee('The Legend of Zelda: Majora\'s Mask');
    }

    private function fakeSearchGames()
    {
        return json_decode(Storage::disk('fakes')->get('FakeSearchedGames.json'));
    }
}
