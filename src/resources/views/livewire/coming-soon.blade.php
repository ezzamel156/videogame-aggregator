<div wire:init="loadComingSoon" class="coming-soon-container space-y-10 mt-8">
    @forelse ($comingSoon as $game)
        <div class="game flex">
            <a href="{{ route('games.show', $game['slug']) }}">
                <img src="{{ isset($game['cover']) ? Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']) : '/jeng' }}" alt="game cover" 
                    class="w-16 hover:opacity-75 transition ease-in-out duration-150">
            </a>
            <div class="ml-4">
                <a href="#" class="hover:text-gray-300"> {{ $game['name'] }} </a>
                <div class="text-gray-400 text-sm mt-1"> {{ Carbon\Carbon::parse($game['first_release_date'])->format('M d, Y') }} </div>
            </div>
        </div>     
    @empty
        @foreach (range(1,4) as $item)
            <div class="game flex">
                <div class="w-16 h-20 bg-gray-800"></div>
                <div class="ml-4">
                    <div class="bg-gray-700 text-transparent rounded leading-tight">Title goes here lol</div>
                    <div class="inline-block bg-gray-700 rounded text-sm text-transparent mt-2"> Jan 01, 2020</div>
                </div>
            </div>  
        @endforeach    
    @endforelse
</div>