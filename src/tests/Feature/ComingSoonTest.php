<?php

namespace Tests\Feature;

use App\Http\Livewire\ComingSoon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class ComingSoonTest extends TestCase
{
    /** @test */
    public function the_main_page_shows_coming_soon()
    {
        Http::fake([
            'https://api.igdb.com/v4/games' => Http::response($this->fakeComingSoon(), 200),
        ]);

        Livewire::test(ComingSoon::class)
            ->assertSet('comingSoon', [])
            ->call('loadComingSoon')
            ->assertSee('Fake Sakuna: Of Rice and Ruin')
            ->assertSee('Nov 10, 2020')
            ->assertSee('XIII');
    }

    private function fakeComingSoon()
    {
        return json_decode(Storage::disk('fakes')->get('FakeComingSoon.json'));
    }
}
