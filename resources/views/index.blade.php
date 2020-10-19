@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h2 class="text-blue-500 uppercase tracking-wide font-semibold">
            Popular Games
        </h2>
        <div class="popular-games text-sm grid grid-cols-6 gap-12 border-b border-gray-800 pb-16">
            <div class="game mt-8">
                <div class="relative inline-block">
                    <a href="#">
                        <img src="/jeng" alt="game cover" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                    <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full" style="right:-20px; bottom:-20px">
                        <div class="font-semibold text-xs flex justify-center items-center h-full">
                            80%
                        </div>
                    </div>
                </div>
                <a href="#" class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">
                    Final Fantasy                    
                </a>
                <div class="text-gray-400 mt-1">
                    Playstation 4 
                </div>
            </div> {{-- games end --}}
        </div> {{-- popular games end --}}
        <div class="flex my-10">
            <div class="recently-reviewed mr-32 w-3/4">
                <h2 class="text-blue-500 uppercase tracking-wide font-semibold">
                    Recently Reviewed
                </h2>
                <div class="space-y-12 mt-8">
                    <div class="game bg-gray-800 rounded-lg shadow-md flex px-6 py-6">
                        <div class="relative flex-none">
                            <a href="#">
                                <img src="/jeng" alt="game cover" 
                                    class="w-48 hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                            <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-900 rounded-full" style="right:-20px; bottom:-20px">
                                <div class="font-semibold text-xs flex justify-center items-center h-full">
                                    80%
                                </div>
                            </div>
                        </div>
                        <div class="ml-12">
                            <a href="#" class="block text-lg font-semibold leading-tight hover:text-gray-400 mt-4">
                                Final Fantasy                    
                            </a>
                            <div class="text-gray-400 mt-1">
                                Playstation 4 
                            </div>
                            <div class="mt-6 text-gray-400">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente laboriosam labore mollitia vero ratione alias aliquid amet aspernatur facilis, reiciendis!
                            </div>
                        </div>
                    </div> {{-- games end --}}
                </div>
            </div>
            <div class="w-1/4 space-y-8">
                <div class="most-anticipated">
                    <h2 class="text-blue-500 uppercase tracking-wide font-semibold">
                        Most Anticipated
                    </h2>
                    <div class="most-anticipated-container space-y-10 mt-8">
                        <div class="game flex">
                            <a href="#">
                                <img src="/jeng" alt="game cover" 
                                    class="w-16 hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                            <div class="ml-4">
                                <a href="#" class="hover:text-gray-300">Cyberpunk 2077</a>
                                <div class="text-gray-400 text-sm mt-1">Nov 17, 2020</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="coming-soon">
                    <h2 class="text-blue-500 uppercase tracking-wide font-semibold">
                        Coming Soon
                    </h2>
                    <div class="coming-soon-container space-y-10 mt-8">
                        <div class="game flex">
                            <a href="#">
                                <img src="/jeng" alt="game cover" 
                                    class="w-16 hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                            <div class="ml-4">
                                <a href="#" class="hover:text-gray-300">Cyberpunk 2077</a>
                                <div class="text-gray-400 text-sm mt-1">Nov 17, 2020</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> {{-- container end --}}
@endsection