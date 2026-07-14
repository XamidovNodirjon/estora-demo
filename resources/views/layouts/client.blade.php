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

        body {
            font-family: var(--font-sans);
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        .font-display {
            font-family: var(--font-display);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-gray-50">

    <!-- Header Navigation -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-30 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="/" class="flex items-center gap-2">
                    <i class="fa-solid fa-house-chimney text-[#0084ff] text-2xl"></i>
                    <span class="font-display font-extrabold text-xl tracking-wider text-[#061c3f]">ESTORA</span>
                </a>
                
                <nav class="hidden md:flex space-x-1">
                    <a href="{{ route('client.dashboard') }}" class="px-3 py-2 rounded-lg text-[#0084ff] bg-[#0084ff]/5 font-medium transition-all">
                        <i class="fa-solid fa-gauge-high mr-1"></i> Bosh sahifa
                    </a>
                    <a href="#" class="px-3 py-2 rounded-lg text-gray-600 hover:text-[#0084ff] hover:bg-gray-50 font-medium transition-all">
                        <i class="fa-regular fa-square-plus mr-1"></i> E'lon berish
                    </a>
                    <a href="#" class="px-3 py-2 rounded-lg text-gray-600 hover:text-[#0084ff] hover:bg-gray-50 font-medium transition-all">
                        <i class="fa-regular fa-heart mr-1"></i> Saralanganlar
                    </a>
                </nav>
            </div>

            <div class="flex items-center gap-4">
                <!-- Points / Balance badge -->
                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-sm font-semibold">
                    <i class="fa-solid fa-coins text-amber-500"></i>
                    <span>{{ Auth::user()->balls ?? 0 }} ball</span>
                </div>

                <!-- User Dropdown & Profile -->
                <div class="relative flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <span class="block text-sm font-bold text-[#061c3f]">{{ Auth::user()->name ?? 'Mijoz' }}</span>
                        <span class="block text-xs text-gray-400">Mijoz kabineti</span>
                    </div>

                    <div class="w-10 h-10 rounded-full bg-[#061c3f] text-white flex items-center justify-center font-bold text-lg shadow-md font-display">
                        {{ strtoupper(substr(Auth::user()->name ?? 'C', 0, 1)) }}
                    </div>

                    <!-- Log Out Action -->
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="p-2 rounded-lg bg-gray-50 hover:bg-red-50 text-gray-400 hover:text-red-600 transition-all" title="Tizimdan chiqish">
                            <i class="fa-solid fa-right-from-bracket text-lg"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-1 flex flex-col md:flex-row gap-8 w-full">
        <!-- Sidebar Navigation (Responsive) -->
        <aside class="w-full md:w-64 flex-shrink-0">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm sticky top-24">
                <div class="flex flex-col items-center text-center pb-6 border-b border-gray-100">
                    <div class="w-16 h-16 rounded-full bg-[#0084ff]/10 text-[#0084ff] flex items-center justify-center font-bold text-2xl mb-3 font-display">
                        {{ strtoupper(substr(Auth::user()->name ?? 'C', 0, 1)) }}
                    </div>
                    <h3 class="font-display font-bold text-lg text-[#061c3f]">{{ Auth::user()->name ?? 'Client' }}</h3>
                    <p class="text-xs text-gray-400">{{ Auth::user()->email ?? '' }}</p>
                </div>

                <nav class="mt-6 space-y-1">
                    <a href="{{ route('client.dashboard') }}" class="flex items-center justify-between px-4 py-3 rounded-xl bg-[#0084ff]/5 text-[#0084ff] font-medium transition-all">
                        <span class="flex items-center gap-3">
                            <i class="fa-solid fa-chart-pie"></i> Kabinet holati
                        </span>
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </a>
                    
                    <a href="#" class="flex items-center justify-between px-4 py-3 rounded-xl text-gray-600 hover:bg-gray-50 hover:text-[#061c3f] font-medium transition-all">
                        <span class="flex items-center gap-3">
                            <i class="fa-solid fa-folder-open"></i> Mening e'lonlarim
                        </span>
                        <span class="text-xs bg-gray-100 px-2 py-0.5 rounded-full">0</span>
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
        </aside>

        <!-- Page Content -->
        <main class="flex-1 min-w-0">
            <!-- Toast Notifications -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 shadow-sm animate-fade-in">
                    <i class="fa-solid fa-circle-check text-lg text-emerald-500"></i>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-[#061c3f] text-white py-6 border-t border-navy-950 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-400">
            &copy; {{ date('Y') }} Estora Real Estate. Barcha huquqlar himoyalangan.
        </div>
    </footer>

</body>
</html>
