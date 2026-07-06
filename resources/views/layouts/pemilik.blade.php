<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pemilik - {{ config('app.name') }} | @yield('title')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="font-sans antialiased bg-gray-100" x-data="{ sidebarOpen: true }">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-indigo-900 text-white transition-all duration-300 fixed inset-y-0 left-0 z-40 flex flex-col">
            <div class="flex items-center justify-between p-4 border-b border-indigo-800">
                <a href="{{ route('pemilik.dashboard') }}" class="flex items-center space-x-2" x-show="sidebarOpen">
                    <img src="{{ asset('image/logo.png') }}" class="h-8 object-contain" alt="Getse Elektronik Logo">
                    <span class="font-bold text-lg">Pemilik</span>
                </a>
                <button @click="sidebarOpen = !sidebarOpen" class="text-indigo-300 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>

            <nav class="flex-1 overflow-y-auto py-4 space-y-1 px-3">
                <a href="{{ route('pemilik.dashboard') }}"
                   class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('pemilik.dashboard') ? 'bg-indigo-600 text-white' : 'text-indigo-300 hover:bg-indigo-800 hover:text-white' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    <span x-show="sidebarOpen" class="text-sm font-medium">Dashboard Laporan</span>
                </a>
            </nav>

            <div class="p-4 border-t border-indigo-800">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 text-indigo-300 hover:text-white transition" x-show="sidebarOpen">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span class="text-sm">Lihat Toko</span>
                </a>
            </div>
        </aside>

        {{-- Main Content --}}
        <div :class="sidebarOpen ? 'ml-64' : 'ml-20'" class="flex-1 transition-all duration-300">
            {{-- Top Bar --}}
            <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between sticky top-0 z-30">
                <h1 class="text-xl font-bold text-gray-800">@yield('title', 'Dashboard')</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">{{ Auth::user()->name }} (Pemilik)</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-medium">Keluar</button>
                    </form>
                </div>
            </header>

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
