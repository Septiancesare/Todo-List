<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    <div class="flex min-h-screen">
        <!-- Mobile sidebar toggle -->
        <div class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 lg:hidden" id="sidebarBackdrop" style="display: none;"></div>
        
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed z-50 w-64 h-screen bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out">
            <div class="p-4">
                <div class="flex items-center justify-between gap-5">
                    <div class="flex items-center gap-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/1254/1254121.png" alt="Logo" class="w-10 h-10">
                        <h2 class="text-lg font-bold">
                            <span class="text-accent">Mantab</span>
                            Task
                        </h2>
                    </div>
                    <button id="sidebarClose" class="lg:hidden p-1 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <nav class="mt-8 flex flex-col space-y-1">
                    <a href="{{ route('task.index') }}" 
                    class="flex items-center gap-3 p-3 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('task.index') ? 'bg-gray-200 dark:bg-gray-700 font-medium' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    @role('admin')
                    <a href="{{ route('users.index') }}" 
                    class="flex items-center gap-3 p-3 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors {{ request()->routeIs('users.*') ? 'bg-gray-200 dark:bg-gray-700 font-medium' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span>Users</span>
                    </a>
                    @endrole
                    <a href="{{ route('profile.edit') }}" 
                    class="flex lg:hidden items-center gap-3 p-3 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                        <span>Profile</span>
                    </a>
                    <a href="{{ route('logout') }}" 
                    class="flex lg:hidden items-center gap-3 p-3 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-error">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                        <span>Logout</span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Mobile header -->
            <header class="lg:hidden bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 p-4">
                <div class="flex items-center justify-between">
                    <button id="sidebarToggle" class="p-1 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    
                    <!-- Mobile logo -->
                    <div class="flex items-center gap-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/1254/1254121.png" alt="Logo" class="w-8 h-8">
                        <h2 class="text-lg font-bold">
                            <span class="text-accent">Mantab</span>
                            Task
                        </h2>
                    </div>
                    
                    <!-- Mobile profile dropdown trigger -->
                    <div class="relative" x-data="{ mobileMenuOpen: false }">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-1 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700">
                            <div class="avatar">
                                <div class="w-8 rounded-full ring-2 ring-primary ring-offset-base-100 ring-offset-2">
                                    <img src="https://img.daisyui.com/images/profile/demo/spiderperson@192.webp" alt="User avatar" />
                                </div>
                            </div>
                        </button>
                        
                        <!-- Mobile dropdown menu -->
                        <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50 border border-gray-200 dark:border-gray-700">
                            <div class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 border-b border-gray-100 dark:border-gray-700">
                                {{ Auth::user()->name }}
                            </div>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Main content -->
            <main class="flex-1 lg:ml-64 overflow-y-auto">
                <!-- Optional header slot -->
                @isset($header)
                    <header class="lg:mb-6 flex justify-between items-center lg:fixed lg:top-0 lg:right-0 lg:left-0 bg-gray-100 dark:bg-gray-900 p-4 lg:ml-64 lg:border-b lg:border-gray-200 lg:dark:border-gray-700">
                        <div class="lg:block hidden">{{ $header }}</div>

                        <!-- Desktop profile dropdown -->
                        <div class="hidden lg:flex lg:items-center lg:ms-6">
                            <div class="relative" x-data="{ desktopMenuOpen: false }">
                                <button @click="desktopMenuOpen = !desktopMenuOpen" class="inline-flex items-center gap-2">
                                    <div class="avatar">
                                        <div class="w-8 rounded-full ring-2 ring-primary ring-offset-base-100 ring-offset-2">
                                            <img src="https://img.daisyui.com/images/profile/demo/spiderperson@192.webp" alt="User avatar" />
                                        </div>
                                    </div>
                                    <div class="text-sm">{{ Auth::user()->name }}</div>
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                                
                                <div x-show="desktopMenuOpen" @click.away="desktopMenuOpen = false" 
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50 border border-gray-200 dark:border-gray-700">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Profile
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Log Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </header>
                @endisset
                
                <!-- Main content slot -->
                <div class="lg:mt-20">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarClose = document.getElementById('sidebarClose');
            const sidebarBackdrop = document.getElementById('sidebarBackdrop');
            
            function showSidebar() {
                sidebar.classList.remove('-translate-x-full');
                sidebarBackdrop.style.display = 'block';
                document.body.style.overflow = 'hidden';
            }
            
            function hideSidebar() {
                sidebar.classList.add('-translate-x-full');
                sidebarBackdrop.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
            
            sidebarToggle.addEventListener('click', showSidebar);
            sidebarClose.addEventListener('click', hideSidebar);
            sidebarBackdrop.addEventListener('click', hideSidebar);
            
            document.querySelectorAll('#sidebar nav a').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1024) {
                        hideSidebar();
                    }
                });
            });
            
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebarBackdrop.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
        });
    </script>
    
</body>
</html>