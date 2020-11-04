<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name')}}</title>
    <link rel="stylesheet" href="/css/main.css">
    @livewireStyles
</head>
<body class="bg-gray-900 text-white">
    <header class="border-b border-gray-800">
        <nav class="container mx-auto flex flex-col lg:flex-row justify-between items-center px-4 py-6">
            <div class="flex flex-col lg:flex-row items-center">
                <a href="/" class="ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg"  class="w-8 flex-none"  viewBox="0 0 27 27">
                        <g fill="none" fill-rule="evenodd">
                            <g fill="#FFF">
                            <path d="M4.608 6.721l3.798 3.799a1.948 1.948 0 0 1-2.754 2.754L1.853 9.476A1.948 1.948 0 0 1 4.608 6.72zM12.631 14.745l8.086 8.085a1.948 1.948 0 1 1-2.755 2.754L9.877 17.5a1.948 1.948 0 0 1 2.754-2.754z"></path> 
                                <path d="M2.755 6.22L24.105.836a2.057 2.057 0 0 1 2.483 1.433 1.94 1.94 0 0 1-1.392 2.411l-21.35 5.385a2.057 2.057 0 0 1-2.483-1.434 1.94 1.94 0 0 1 1.392-2.41z"></path> 
                                <path d="M17.384 23.604l5.385-21.35A1.94 1.94 0 0 1 25.179.86a2.057 2.057 0 0 1 1.434 2.483l-5.384 21.35a1.94 1.94 0 0 1-2.411 1.392 2.057 2.057 0 0 1-1.434-2.482z"></path>
                            </g> 
                            <path d="M16.541 13.778l-7.63 7.631a2.015 2.015 0 1 1-2.85-2.849l7.631-7.63a2.015 2.015 0 1 1 2.85 2.848zM5.111 25.208l-1.108 1.109a2.015 2.015 0 1 1-2.85-2.85l1.11-1.108a2.015 2.015 0 1 1 2.848 2.85z" class="text-blue-500 fill-current"></path>
                        </g>
                    </svg>
                </a>
                <ul class="flex ml-0 lg:ml-8 space-x-8 mt-6 lg:mt-0">
                    <li><a href="/" class="hover:text-gray-400">Games</a></li>
                    <li><a href="#" class="hover:text-gray-400">Reviews</a></li>
                    <li><a href="#" class="hover:text-gray-400">Coming Soon</a></li>
                </ul>
            </div>
            <div class="flex items-center mt-6 lg:mt-0">
                <div class="relative">
                    <input type="text" class="text-sm bg-gray-800 rounded-full focus:outline-none focus:shadow-outline px-3 py-1 w-64">
                    <div class="absolute top-0 flex items-center h-full ml-2">
                        <svg class="w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-6">
                    <a href="#">
                        <img alt="@ezzamel156" src="https://avatars3.githubusercontent.com/u/19977029?s=60&amp;v=4" class="rounded-full w-8">                        
                    </a>
                </div>
            </div>
        </nav>
    </header>    
    <main class="py-8">
        @yield('content')
    </main>
    <footer class="border-t border-gray-800">
        <div class="container mx-auto px-4 py-6">
            Powered by <a href="#" class="underline hover:text-gray-400">IGDB API</a>
        </div>
    </footer>

    @livewireScripts
    <script src="/js/app.js"></script>
    @stack('scripts')
</body>
</html>