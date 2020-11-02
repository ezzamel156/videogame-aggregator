<?php

namespace Tests\Feature;

use App\Http\Livewire\PopularGames;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class PopularGamesTest extends TestCase
{
    /** @test */
    public function the_main_page_shows_popular_games()
    {
        Http::fake([
            'https://api.igdb.com/v4/games' => Http::response($this->fakePopularGames(), 200),
        ]);

        Livewire::test(PopularGames::class)
            ->assertSet('popularGames', [])
            ->call('loadPopularGames')
            ->assertSee('Fake Hades')
            ->assertSee('Genshin Impact')
            ->assertSee('PC, Android, iOS, PS4, Switch')
            ->assertSee('Mafia: Definitive Edition');
    }

    private function fakePopularGames()
    {
        return json_decode(Storage::disk('fakes')->get('FakePopularGames.json'));
    }
}
