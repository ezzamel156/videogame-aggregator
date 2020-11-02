<?php

namespace Tests\Feature;

use App\Http\Livewire\MostAnticipated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class MostAnticipatedTest extends TestCase
{
    /** @test */
    public function the_main_page_shows_most_anticipated()
    {
        Http::fake([
            'https://api.igdb.com/v4/games' => Http::response($this->fakeMostAnticipated(), 200),
        ]);

        Livewire::test(MostAnticipated::class)
            ->assertSet('mostAnticipated', [])
            ->call('loadMostAnticipated')
            ->assertSee('Fake Cyberpunk 2077')
            ->assertSee('Dec 10, 2020')
            ->assertSee('Biomutant');
    }

    private function fakeMostAnticipated()
    {
        return json_decode(Storage::disk('fakes')->get('FakeMostAnticipated.json'));
    }
}
