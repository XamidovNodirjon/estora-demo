<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mening Kabinetim') - Estora</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-navy: #061c3f;
            --secondary-navy: #0B2240;
            --accent-blue: #0084ff;
            --accent-blue-hover: #0076e5;
            --accent-orange: #ff9e0d;
            --accent-orange-hover: #e58d05;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
            --bg-light: #f8f9fa;
            --bg-card: #ffffff;
            --border-color: #e5e7eb;
            --font-sans: 'Inter', sans-serif;
            --font-display: 'Outfit', sans-serif;
        }

        html, body {
            max-width: 100vw !important;
            overflow-x: hidden !important;
            margin: 0;
            padding: 0;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        img, video, iframe, canvas, svg {
            max-width: 100%;
            height: auto;
        }

        p, span, h1, h2, h3, h4, h5, h6, div {
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        body {
            font-family: var(--font-sans);
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        .font-display {
            font-family: var(--font-display);
        }

        /* Custom scrollbar for mobile tab navigation */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-gray-50">

    <!-- Header Navigation -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-30 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-2">
            <div class="flex items-center gap-4 sm:gap-8 min-w-0">
                <a href="/" class="flex items-center gap-2 flex-shrink-0">
                    <i class="fa-solid fa-house-chimney text-[#0084ff] text-2xl"></i>
                    <span class="font-display font-extrabold text-xl tracking-wider text-[#061c3f]">ESTORA</span>
                </a>
                
                <nav class="hidden md:flex space-x-1">
                    <a href="{{ route('client.dashboard', ['section' => 'my_products']) }}" class="px-3 py-2 rounded-lg {{ request('section', 'my_products') == 'my_products' ? 'text-[#0084ff] bg-[#0084ff]/5' : 'text-gray-600 hover:text-[#0084ff] hover:bg-gray-50' }} font-medium transition-all">
                        <i class="fa-solid fa-gauge-high mr-1"></i> Bosh sahifa
                    </a>
                    <a href="{{ route('client.products.create') }}" class="px-3 py-2 rounded-lg text-gray-600 hover:text-[#0084ff] hover:bg-gray-50 font-medium transition-all">
                        <i class="fa-regular fa-square-plus mr-1"></i> E'lon berish
                    </a>
                    <a href="{{ route('client.dashboard', ['section' => 'favorites']) }}" class="px-3 py-2 rounded-lg {{ request('section') == 'favorites' ? 'text-[#0084ff] bg-[#0084ff]/5' : 'text-gray-600 hover:text-[#0084ff] hover:bg-gray-50' }} font-medium transition-all">
                        <i class="fa-regular fa-heart mr-1 text-red-500"></i> Saralanganlar
                    </a>
                </nav>
            </div>

            <div class="flex items-center gap-2 sm:gap-4 flex-shrink-0">
                @auth
                    <!-- Points / Balance badge -->
                    <div class="flex items-center gap-1.5 px-2.5 sm:px-3 py-1.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-xs sm:text-sm font-semibold">
                        <i class="fa-solid fa-coins text-amber-500"></i>
                        <span>{{ Auth::user()->balls ?? 0 }} ball</span>
                    </div>

                    <!-- User Profile Avatar & Actions -->
                    <div class="relative flex items-center gap-2 sm:gap-3">
                        <div class="text-right hidden sm:block">
                            <span class="block text-sm font-bold text-[#061c3f]">{{ Auth::user()->name }}</span>
                            <span class="inline-block text-xs font-semibold px-2 py-0.5 rounded-full {{ (Auth::user()->role?->name ?? Auth::user()->type) === 'makler' ? 'bg-amber-100 text-amber-800 border border-amber-300' : 'bg-blue-100 text-blue-800 border border-blue-200' }}">
                                {{ (Auth::user()->role?->name ?? Auth::user()->type) === 'makler' ? 'Makler' : 'Uy egasi' }}
                            </span>
                        </div>

                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#061c3f] text-white flex items-center justify-center font-bold text-base sm:text-lg shadow-md font-display">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <!-- Log Out Action -->
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="p-2 rounded-lg bg-gray-50 hover:bg-red-50 text-gray-400 hover:text-red-600 transition-all" title="Tizimdan chiqish">
                                <i class="fa-solid fa-right-from-bracket text-base sm:text-lg"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-3 sm:px-4 py-2 rounded-xl bg-[#0084ff] text-white font-semibold text-xs sm:text-sm hover:bg-[#0076e5] transition-all">
                        <i class="fa-solid fa-right-to-bracket mr-1"></i> Kirish
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-4 sm:py-8 flex-1 flex flex-col md:flex-row gap-4 sm:gap-8 w-full min-w-0">
        @auth
            <!-- Sidebar Navigation (Responsive) -->
            <aside class="w-full md:w-64 flex-shrink-0">
                <!-- Desktop Sidebar -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm sticky top-24 hidden md:block">
                    <div class="flex flex-col items-center text-center pb-6 border-b border-gray-100">
                        <div class="w-16 h-16 rounded-full bg-[#0084ff]/10 text-[#0084ff] flex items-center justify-center font-bold text-2xl mb-3 font-display">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <h3 class="font-display font-bold text-lg text-[#061c3f]">{{ Auth::user()->name }}</h3>
                        <span class="inline-block mt-1 text-xs font-semibold px-2.5 py-0.5 rounded-full {{ (Auth::user()->role?->name ?? Auth::user()->type) === 'makler' ? 'bg-amber-100 text-amber-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ (Auth::user()->role?->name ?? Auth::user()->type) === 'makler' ? 'Makler' : 'Uy egasi' }}
                        </span>
                        <p class="text-xs text-gray-400 mt-2">{{ Auth::user()->email ?? '' }}</p>
                    </div>

                    <nav class="mt-6 space-y-1">
                        <a href="{{ route('client.dashboard', ['section' => 'my_products']) }}" class="flex items-center justify-between px-4 py-3 rounded-xl {{ request('section', 'my_products') == 'my_products' ? 'bg-[#0084ff]/5 text-[#0084ff]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#061c3f]' }} font-medium transition-all">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-chart-pie"></i> Kabinet holati
                            </span>
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </a>
                        
                        <a href="{{ route('client.dashboard', ['section' => 'my_products']) }}" class="flex items-center justify-between px-4 py-3 rounded-xl {{ request('section', 'my_products') == 'my_products' ? 'bg-[#0084ff]/10 text-[#0084ff]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#061c3f]' }} font-medium transition-all">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-folder-open"></i> Mening e'lonlarim
                            </span>
                            <span class="text-xs bg-blue-100 text-blue-700 font-bold px-2.5 py-0.5 rounded-full">
                                {{ Auth::user()->products()->count() }}
                            </span>
                        </a>

                        <a href="{{ route('client.dashboard', ['section' => 'favorites']) }}" class="flex items-center justify-between px-4 py-3 rounded-xl {{ request('section') == 'favorites' ? 'bg-[#0084ff]/10 text-[#0084ff]' : 'text-gray-600 hover:bg-gray-50 hover:text-[#061c3f]' }} font-medium transition-all">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-heart text-red-500"></i> Saralanganlar
                            </span>
                            <span class="text-xs bg-red-100 text-red-700 font-bold px-2.5 py-0.5 rounded-full">
                                {{ Auth::user()->favorites()->count() }}
                            </span>
                        </a>

                        <a href="#" class="flex items-center justify-between px-4 py-3 rounded-xl text-gray-600 hover:bg-gray-50 hover:text-[#061c3f] font-medium transition-all">
                            <span class="flex items-center gap-3">
                                <i class="fa-regular fa-comment-dots"></i> Xabarlar
                            </span>
                            <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>
                        </a>

                        <a href="#" class="flex items-center justify-between px-4 py-3 rounded-xl text-gray-600 hover:bg-gray-50 hover:text-[#061c3f] font-medium transition-all">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-credit-card"></i> Balans tarixi
                            </span>
                            <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>
                        </a>

                        <a href="#" class="flex items-center justify-between px-4 py-3 rounded-xl text-gray-600 hover:bg-gray-50 hover:text-[#061c3f] font-medium transition-all">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-user-gear"></i> Sozlamalar
                            </span>
                            <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>
                        </a>
                    </nav>
                </div>

                <!-- Mobile Scrollable Horizontal Navigation Bar -->
                <div class="block md:hidden bg-white rounded-2xl border border-gray-200 p-2 shadow-sm">
                    <div class="flex items-center gap-2 overflow-x-auto no-scrollbar py-0.5">
                        <a href="{{ route('client.dashboard', ['section' => 'my_products']) }}" class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition-all {{ request('section', 'my_products') == 'my_products' ? 'bg-[#0084ff] text-white shadow-sm' : 'bg-gray-100 text-gray-700' }}">
                            <i class="fa-solid fa-folder-open"></i> Mening e'lonlarim ({{ Auth::user()->products()->count() }})
                        </a>
                        <a href="{{ route('client.dashboard', ['section' => 'favorites']) }}" class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition-all {{ request('section') == 'favorites' ? 'bg-red-500 text-white shadow-sm' : 'bg-gray-100 text-gray-700' }}">
                            <i class="fa-solid fa-heart"></i> Saralanganlar ({{ Auth::user()->favorites()->count() }})
                        </a>
                        <a href="{{ route('client.products.create') }}" class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold whitespace-nowrap bg-emerald-500 text-white shadow-sm">
                            <i class="fa-solid fa-plus-circle"></i> E'lon berish
                        </a>
                    </div>
                </div>
            </aside>
        @endauth

        <!-- Page Content -->
        <main class="flex-1 min-w-0">
            <!-- Toast Notifications -->
            @if(session('success'))
                <div class="mb-4 sm:mb-6 p-3.5 sm:p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 shadow-sm animate-fade-in text-xs sm:text-sm">
                    <i class="fa-solid fa-circle-check text-base sm:text-lg text-emerald-500 flex-shrink-0"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-[#061c3f] text-white py-6 border-t border-navy-950 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-xs sm:text-sm text-gray-400">
            &copy; {{ date('Y') }} Estora Real Estate. Barcha huquqlar himoyalangan.
        </div>
    </footer>

</body>
</html>
