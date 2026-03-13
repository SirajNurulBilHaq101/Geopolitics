<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Geopolitics') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-200 text-base-content font-sans antialiased min-h-screen flex text-sm">

    <!-- Sidebar -->
    <aside class="w-64 bg-base-100 flex-shrink-0 border-r border-base-300 hidden md:flex flex-col">
        <div class="h-16 flex items-center px-6 border-b border-base-300">
            <h1 class="text-xl font-bold text-primary tracking-wide">GeoBase</h1>
        </div>
        <nav class="flex-1 py-4 px-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="btn btn-ghost w-full justify-start {{ request()->routeIs('dashboard') ? 'btn-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                Dashboard
            </a>
            <a href="{{ route('news.index') }}" class="btn btn-ghost w-full justify-start {{ request()->routeIs('news.*') ? 'btn-active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                News Feed
            </a>
        </nav>
        <div class="p-4 border-t border-base-300">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline btn-error btn-sm w-full">Logout</button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Topbar (Mobile) -->
        <header class="h-16 bg-base-100 border-b border-base-300 flex items-center justify-between px-4 md:hidden">
            <h1 class="text-xl font-bold text-primary">GeoBase</h1>
            <!-- Add mobile menu literal here if needed -->
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-base-200 p-4 md:p-8">
            <div class="max-w-7xl mx-auto space-y-6">
                <!-- Header Title slot -->
                @if (isset($header))
                    <header class="mb-6">
                        {{ $header }}
                    </header>
                @endif
                
                {{ $slot }}
            </div>
        </main>
    </div>

</body>
</html>
