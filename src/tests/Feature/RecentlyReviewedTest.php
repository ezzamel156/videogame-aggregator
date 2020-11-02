<?php

namespace Tests\Feature;

use App\Http\Livewire\RecentlyReviewed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class RecentlyReviewedTest extends TestCase
{
    /** @test */
    public function the_main_page_shows_recently_reviewed()
    {
        Http::fake([
            'https://api.igdb.com/v4/games' => Http::response($this->fakeRecentlyReviewed(), 200),
        ]);

        Livewire::test(RecentlyReviewed::class)
            ->assertSet('recentlyReviewed', [])
            ->call('loadRecentlyReviewed')
            ->assertSee('Fake Hades')
            ->assertSee('92');
    }

    private function fakeRecentlyReviewed()
    {
        return json_decode(Storage::disk('fakes')->get('FakeRecentlyReviewed.json'));
    }
}
