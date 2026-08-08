<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Developer Console') - Estora</title>
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
<body class="h-screen w-screen flex overflow-hidden bg-gray-50">

    <!-- Sidebar Backdrop (Mobile only) -->
    <div id="sidebar-backdrop" class="fixed inset-0 z-30 bg-black/40 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300 md:hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-[#061c3f] text-white flex flex-col transform -translate-x-full md:translate-x-0 md:relative md:inset-auto transition-transform duration-300 shadow-xl flex-shrink-0">
        <!-- Logo -->
        <div class="h-16 flex items-center justify-between px-5 border-b border-navy-800 bg-[#0B2240] flex-shrink-0">
            <a href="/" class="flex items-center gap-2 hover:opacity-90 transition-opacity" title="Bosh sahifa">
                <img src="/images/logo-white.svg" alt="ESTORA Real Estate" class="h-9 w-auto object-contain">
                <span class="text-amber-400 text-[10px] font-black uppercase tracking-wider bg-amber-500/20 px-2 py-0.5 rounded border border-amber-500/30">DEV</span>
            </a>
            <!-- Close Button (Mobile only) -->
            <button id="close-sidebar" class="md:hidden text-gray-400 hover:text-white transition-colors" title="Menyuni yopish">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('developer.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-all {{ request()->routeIs('developer.dashboard') ? 'bg-[#0084ff]/20 text-[#0084ff] border-l-4 border-[#0084ff]' : '' }}">
                <i class="fa-solid fa-chart-line text-lg"></i>
                <span>Boshqaruv Paneli</span>
            </a>

            <a href="{{ route('developer.users') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-all {{ request()->routeIs('developer.users*') ? 'bg-[#0084ff]/20 text-[#0084ff] border-l-4 border-[#0084ff]' : '' }}">
                <i class="fa-solid fa-users text-lg"></i>
                <span>Foydalanuvchilar</span>
            </a>

            <a href="{{ route('developer.roles') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-all {{ request()->routeIs('developer.roles*') ? 'bg-[#0084ff]/20 text-[#0084ff] border-l-4 border-[#0084ff]' : '' }}">
                <i class="fa-solid fa-user-shield text-lg"></i>
                <span>Rollar</span>
            </a>

            <a href="{{ route('developer.categories') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-all {{ request()->routeIs('developer.categories*') || request()->routeIs('developer.subcategories*') ? 'bg-[#0084ff]/20 text-[#0084ff] border-l-4 border-[#0084ff]' : '' }}">
                <i class="fa-solid fa-list text-lg"></i>
                <span>Kategoriyalar</span>
            </a>

            <a href="{{ route('developer.infrastructure') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-all {{ request()->routeIs('developer.infrastructure*') ? 'bg-[#0084ff]/20 text-[#0084ff] border-l-4 border-[#0084ff]' : '' }}">
                <i class="fa-solid fa-city text-lg"></i>
                <span>Infratuzilma</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-all">
                <i class="fa-solid fa-key text-lg"></i>
                <span>API Kalitlar</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-all">
                <i class="fa-solid fa-terminal text-lg"></i>
                <span>Tizim loglari</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-all">
                <i class="fa-solid fa-gears text-lg"></i>
                <span>Sozlamalar</span>
            </a>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-navy-800 bg-[#0B2240] flex-shrink-0">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-[#0084ff] flex items-center justify-center font-bold text-white text-lg shadow-md font-display">
                    {{ strtoupper(substr(Auth::user()->name ?? 'D', 0, 1)) }}
                </div>
                <div>
                    <h4 class="font-semibold text-sm truncate max-w-[140px]">{{ Auth::user()->name ?? 'Developer' }}</h4>
                    <span class="text-xs text-gray-400">Tizim Yaratuvchisi</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 px-4 rounded-lg bg-red-600 hover:bg-red-700 text-white font-medium transition-all shadow-md">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Chiqish</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col h-full min-w-0 overflow-hidden">
        <!-- Header -->
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6 md:px-8 flex-shrink-0 z-10 backdrop-blur-md bg-white/80">
            <div class="flex items-center gap-3">
                <!-- Hamburger Button (Mobile only) -->
                <button id="toggle-sidebar" class="md:hidden p-2 -ml-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors" title="Menyuni ochish">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <h1 class="font-display font-bold text-lg md:text-xl text-[#061c3f]">@yield('header_title', 'Developer Dashboard')</h1>
            </div>
            
            <div class="flex items-center gap-4">
                <!-- Notifications -->
                <button class="w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center text-gray-500 transition-all relative">
                    <i class="fa-regular fa-bell text-lg"></i>
                    <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-[#ff9e0d] rounded-full border-2 border-white"></span>
                </button>

                <!-- Current Environment -->
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                    <span>Local Env</span>
                </div>
            </div>
        </header>

        <!-- Main Body (Scrollable container) -->
        <div class="flex-1 overflow-y-auto flex flex-col">
            <main class="flex-1 p-6 md:p-8">
                <!-- Toast Notifications -->
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 shadow-sm animate-fade-in">
                        <i class="fa-solid fa-circle-check text-lg text-emerald-500"></i>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-800 flex items-center gap-3 shadow-sm animate-fade-in">
                        <i class="fa-solid fa-circle-xmark text-lg text-red-500"></i>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="py-4 px-8 bg-white border-t border-gray-100 text-center text-xs text-gray-400 font-medium flex-shrink-0">
                &copy; {{ date('Y') }} Estora Real Estate. Hamma huquqlar himoyalangan.
            </footer>
        </div>
    </div>

    <!-- Sidebar Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('toggle-sidebar');
            const closeBtn = document.getElementById('close-sidebar');
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');

            if (toggleBtn && sidebar && backdrop) {
                toggleBtn.addEventListener('click', function () {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0');
                    backdrop.classList.remove('hidden');
                    setTimeout(() => {
                        backdrop.classList.remove('opacity-0');
                        backdrop.classList.add('opacity-100');
                    }, 10);
                });
            }

            function closeSidebar() {
                if (sidebar && backdrop) {
                    sidebar.classList.remove('translate-x-0');
                    sidebar.classList.add('-translate-x-full');
                    backdrop.classList.remove('opacity-100');
                    backdrop.classList.add('opacity-0');
                    setTimeout(() => {
                        backdrop.classList.add('hidden');
                    }, 300);
                }
            }

            if (closeBtn) {
                closeBtn.addEventListener('click', closeSidebar);
            }

            if (backdrop) {
                backdrop.addEventListener('click', closeSidebar);
            }
        });
    </script>

</body>
</html>
