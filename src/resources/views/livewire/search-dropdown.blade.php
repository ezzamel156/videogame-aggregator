<div class="relative" x-data="{ isVisible: true }" @click.away="isVisible = false">
    <input 
        wire:model.debounce.300ms="search"
        type="text" 
        class="text-sm bg-gray-800 rounded-full focus:outline-none focus:shadow-outline px-3 py-1 pl-8 w-64"
        placeholder="Search (Press '/' to focus)"
        x-ref="search"
        @keydown.window="
            if(event.keyCode === 191) {
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus="isVisible = true"
        @keydown="isVisible = true"
        @keydown.escape.window="isVisible = false"
        @keydown.shift.tab="isVisible = false"
    >
    <div class="absolute top-0 flex items-center h-full ml-2">
        <svg class="w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3" style="position: absolute"></div>

    @if ($search)
        <div class="absolute z-50 bg-gray-800 text-xs rounded w-64 mt-3" x-show.transition.opacity.duration.200="isVisible">
            <ul>
                @forelse ($searchResults as $game)
                    <li class="border-b border-gray-700">
                        <a 
                            href="{{ route('games.show', $game['slug']) }}" 
                            class="hover:bg-gray-700 flex items-center transition ease-in-out duration-150 px-3 py-3"
                            @if ($loop->last)
                                @keydown.tab="isVisible = false"                                
                            @endif
                        >
                            @isset($game['cover'])
                                <img class="w-10 " src="{{ $game['coverImageUrl'] }}" alt="cover">                            
                            @endisset
                            <span class="ml-3">{{ $game['name'] }}</span>
                        </a>
                    </li>
                @empty
                    <li class="px-3 py-3">
                        No results found for "{{ $search }}"
                    </li>
                @endforelse
            </ul>            
        </div>
    @endif
</div>