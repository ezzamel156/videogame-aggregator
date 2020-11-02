<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ViewGameTest extends TestCase
{
    /** @test */
    public function game_page_shows_correct_game_info()
    {
        Http::fake([
            'https://api.igdb.com/v4/games' => Http::response($this->fakeSinglegame(), 200),
        ]);

        $response = $this->get(route('games.show', 'fake-animal-crossing-new-horizons'));

        $response->assertSuccessful();
        $response->assertSee('Fake Animal Crossing: New Horizons');
        $response->assertSee('Simulator');
        $response->assertSee('Nintendo');
        $response->assertSee('Switch');
        $response->assertSee('86');
        $response->assertSee('90');
        $response->assertSee('twitter.com/animalcrossing');
        $response->assertSee('Escape to a deserted island');
        $response->assertSee('images.igdb.com/igdb/image/upload/t_screenshot_big/sc6lt7.jpg');
        $response->assertSee('The Last Journey');
    }

    private function fakeSinglegame() {
        return json_decode(Storage::disk('fakes')->get('FakeSingleGame.json'));
    }
}
