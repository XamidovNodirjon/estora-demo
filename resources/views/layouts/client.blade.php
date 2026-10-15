<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kabinet') - Estora Real Estate</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Vite Assets (Tailwind v4 via @tailwindcss/vite plugin) -->
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <!-- Sayt footeri (partials/footer) stillari -->
    <link rel="stylesheet" href="{{ asset('css/estora-footer.css') }}?v={{ filemtime(public_path('css/estora-footer.css')) }}">

    <style>
        :root {
            --primary-blue: #0077FE;
            --primary-dark: #08172E;
            --bg-canvas: #FFFFFF;
            --font-main: 'Plus Jakarta Sans', 'Inter', sans-serif;
        }

        html, body {
            width: 100% !important;
            max-width: 100vw !important;
            overflow-x: hidden !important;
            position: relative;
            margin: 0;
            padding: 0;
            background-color: var(--bg-canvas);
            font-family: var(--font-main);
            color: #0F172A;
            -webkit-text-size-adjust: 100%;
        }

        /* Prevent any flex item from breaking parent bounds */
        main, aside, section, div {
            min-width: 0;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #F1F5F9;
        }
        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* ===== Kabinet paneli (kartalar) ===== */
        .cabinet-panel {
            background: #FFFFFF;
            border: 1px solid #CBD5E1;
            border-radius: 16px;
        }

        /* ===== Kabinet menyusi ===== */
        .cabinet-nav-home {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 16px;
            margin-bottom: 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 800;
            color: #0F172A;
            transition: all .2s;
        }
        .cabinet-nav-home i { font-size: 18px; color: var(--primary-blue); }
        .cabinet-nav-home:hover { background: #F1F6FF; }
        .cabinet-nav-home.is-active {
            background: var(--primary-blue);
            color: #FFFFFF;
            box-shadow: 0 6px 16px -6px rgba(0, 119, 254, .6);
        }
        .cabinet-nav-home.is-active i { color: #FFFFFF; }

        .cabinet-nav-group + .cabinet-nav-group {
            margin-top: 34px;
        }

        .cabinet-nav-item {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 6px;
            border-bottom: 1px solid #CBD5E1;
            font-size: 12.5px;
            font-weight: 700;
            color: #1E293B;
            text-align: left;
            cursor: pointer;
            transition: color .2s, background .2s;
        }
        .cabinet-nav-item:hover { color: var(--primary-blue); }
        .cabinet-nav-item.is-active { color: var(--primary-blue); }
        .cabinet-nav-item.is-active .cabinet-nav-icon { color: var(--primary-blue); }
        .cabinet-nav-item.is-soon { cursor: default; }
        .cabinet-nav-item.is-soon:hover { color: #1E293B; }
        .cabinet-nav-icon {
            width: 16px;
            text-align: center;
            font-size: 14px;
            color: #334155;
        }
        .cabinet-nav-label { flex: 1; min-width: 0; }

        .cabinet-nav-badge {
            min-width: 18px;
            height: 18px;
            padding: 0 5px;
            border-radius: 9999px;
            background: var(--primary-blue);
            color: #FFFFFF;
            font-size: 10px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .cabinet-soon-pill {
            padding: 2px 8px;
            border-radius: 9999px;
            background: #E6F1FF;
            border: 1px solid #B9D8FF;
            color: var(--primary-blue);
            font-size: 9.5px;
            font-weight: 800;
            white-space: nowrap;
        }

        /* Profil menyusi */
        .profile-menu { display: none; }
        .profile-menu.is-open { display: block; }

        /* Sayt footeri kabinetda yuqoridan bo'shliq bilan */
        .footer-container-exact { margin-top: 48px; }
    </style>
    @yield('styles')
</head>
<body class="min-h-screen flex flex-col bg-white text-slate-800 antialiased">

    @php
        $headerUser = Auth::user();
        $unreadMessagesCount = $headerUser->unreadNotifications->count();
        $headerRole = $headerUser->role?->name ?? $headerUser->type ?? 'client';
        $roleLabels = ['makler' => 'Makler', 'client' => 'Jismoniy shaxs', 'owner' => 'Uy egasi', 'hotel' => 'Mehmonxona', 'builder' => 'Quruvchi'];
        $headerRoleLabel = $roleLabels[$headerRole] ?? ucfirst($headerRole);
        $headerFirstName = $headerUser->first_name ?: ($headerUser->name ?? 'Foydalanuvchi');
        $headerPublicUrl = route('users.show', $headerUser->username ?? $headerUser->id);
    @endphp

    <!-- Header Navigation -->
    <header class="bg-white sticky top-0 z-40">
        <div class="max-w-[1240px] mx-auto px-4 sm:px-6 h-[72px] flex items-center justify-between gap-4 border-b border-slate-300">

            <!-- Left Side: Hamburger & Logo -->
            <div class="flex items-center gap-3 min-w-0">
                <button type="button" onclick="toggleMobileNavDrawer()" class="p-2 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-xl transition-all focus:outline-none flex items-center justify-center border border-slate-300 lg:hidden" title="Menyu">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>

                <a href="{{ route('maniDashboard') }}" class="flex items-center flex-shrink-0 hover:opacity-90 transition-opacity" title="ESTORA Real Estate">
                    <img src="/images/logo.svg" alt="ESTORA Real Estate" class="h-9 sm:h-10 w-auto object-contain">
                </a>
            </div>

            <!-- Middle: Search Bar -->
            <form action="{{ route('maniDashboard') }}" method="GET" class="flex-1 max-w-[290px] hidden lg:block">
                <div class="relative">
                    <input type="text" name="product_id" inputmode="numeric"
                           placeholder="E'lon ID bo'yicha qidirish..."
                           class="w-full bg-white border border-slate-300 rounded-full py-1.5 pl-4 pr-10 text-xs text-slate-700 placeholder-slate-400 focus:outline-none focus:border-[#0077FE] transition-all">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-[#0077FE] cursor-pointer" title="Qidirish">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </button>
                </div>
            </form>

            <!-- Right Side Actions & Profile -->
            <div class="flex items-center gap-2 sm:gap-4 flex-shrink-0">

                <!-- Estora AI Agent (tez orada) -->
                <span class="relative hidden sm:inline-flex items-center gap-1.5 bg-[#0077FE] text-white text-[11px] font-bold px-3.5 py-1.5 rounded-full cursor-default" title="Tez orada">
                    <i class="fa-solid fa-robot text-xs"></i>
                    <span>Estora AI Agent</span>
                    <span class="absolute -top-1 -right-1 w-3 h-3 rounded-full bg-red-500 ring-2 ring-white"></span>
                </span>

                <!-- Chatlar -->
                <a href="{{ route('client.dashboard', ['section' => 'chats']) }}" class="relative hidden sm:flex items-center gap-1 text-[11px] font-semibold text-slate-600 hover:text-[#0077FE] transition-colors" title="Chatlar">
                    <i class="fa-regular fa-comments text-sm text-[#0077FE]"></i>
                    <span>Chatlar</span>
                </a>

                <!-- Yangiliklar -->
                <a href="{{ route('client.dashboard', ['section' => 'news']) }}" class="relative flex items-center gap-1 text-[11px] font-semibold text-slate-600 hover:text-[#0077FE] transition-colors" title="Yangiliklar">
                    <span class="relative">
                        <i class="fa-regular fa-bell text-sm text-[#0077FE]"></i>
                        @if($unreadMessagesCount > 0)
                            <span class="absolute -top-1.5 -right-2 bg-red-500 text-white text-[9px] font-black min-w-[15px] h-[15px] px-1 rounded-full flex items-center justify-center">{{ $unreadMessagesCount }}</span>
                        @endif
                    </span>
                    <span class="hidden md:inline">Yangiliklar</span>
                </a>

                <!-- User Profile Pill + Dropdown -->
                <div class="relative pl-3 sm:pl-4 border-l border-slate-300">
                    <button type="button" onclick="toggleProfileMenu(event)" class="flex items-center gap-2 cursor-pointer">
                        <span class="relative w-8 h-8 rounded-full bg-[#0077FE] text-white flex items-center justify-center overflow-hidden flex-shrink-0">
                            @if($headerUser->avatar)
                                <img src="{{ $headerUser->avatar }}" alt="" class="w-full h-full object-cover">
                            @else
                                <i class="fa-solid fa-user text-sm"></i>
                            @endif
                        </span>
                        <span class="hidden md:block text-left leading-tight">
                            <span class="flex items-center gap-1">
                                <span class="font-extrabold text-sm text-slate-900">{{ $headerFirstName }}</span>
                                <i class="fa-solid fa-chevron-down text-[9px] text-amber-500"></i>
                            </span>
                            <span class="block text-[10px] font-semibold text-slate-500">{{ $headerRoleLabel }}</span>
                        </span>
                    </button>

                    <div id="profileMenu" class="profile-menu absolute right-0 top-full mt-3 w-56 bg-white border border-slate-300 rounded-2xl shadow-xl p-2 z-50">
                        <a href="{{ $headerPublicUrl }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold text-slate-700 hover:bg-slate-50">
                            <i class="fa-regular fa-circle-user w-4 text-[#0077FE]"></i> Mening sahifam
                        </a>
                        <a href="{{ route('client.dashboard', ['section' => 'account']) }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold text-slate-700 hover:bg-slate-50">
                            <i class="fa-regular fa-id-card w-4 text-[#0077FE]"></i> Hisob ma'lumotlari
                        </a>
                        <a href="{{ route('client.dashboard', ['section' => 'subscription']) }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold text-slate-700 hover:bg-slate-50">
                            <i class="fa-solid fa-crown w-4 text-[#0077FE]"></i> Tariflar
                        </a>
                        <div class="border-t border-slate-300 my-1"></div>
                        <button type="button" onclick="openLogoutConfirmModal()" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-bold text-red-600 hover:bg-red-50 cursor-pointer text-left">
                            <i class="fa-solid fa-arrow-right-from-bracket w-4"></i> Chiqish
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- Mobile Drawer Menu Modal with Smooth Slide Animation -->
    <div id="mobileNavDrawer" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 transition-opacity duration-300 opacity-0 pointer-events-none lg:hidden" onclick="toggleMobileNavDrawer()">
        <div id="mobileNavContent" class="w-72 max-w-[85vw] bg-white h-full shadow-2xl p-5 overflow-y-auto space-y-5 transform -translate-x-full transition-transform duration-300 ease-in-out" onclick="event.stopPropagation()">
            <div class="flex items-center justify-between border-b border-slate-300 pb-3">
                <img src="/images/logo.svg" alt="Estora" class="h-8 w-auto">
                <button type="button" onclick="toggleMobileNavDrawer()" class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center text-lg hover:bg-slate-200 transition-all">
                    &times;
                </button>
            </div>

            <!-- User Info Card in Drawer -->
            <div class="bg-blue-50/70 border border-blue-100 rounded-2xl p-3.5 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-[#0077FE] text-white flex items-center justify-center text-sm flex-shrink-0">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <h4 class="font-extrabold text-xs text-slate-900 truncate">{{ $headerUser->name ?? 'Foydalanuvchi' }}</h4>
                    <p class="text-[11px] text-slate-500">{{ $headerRoleLabel }}</p>
                </div>
            </div>

            @include('client.partials.nav')

            <div class="pt-3 border-t border-slate-300">
                <button type="button" onclick="openLogoutConfirmModal()" class="w-full text-red-600 hover:bg-red-50 font-bold rounded-xl p-3 flex items-center gap-3 text-xs text-left transition-colors cursor-pointer">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Profildan chiqish</span>
                </button>
            </div>
        </div>
    </div>


    <script>
        function toggleMobileNavDrawer() {
            const drawer = document.getElementById('mobileNavDrawer');
            const content = document.getElementById('mobileNavContent');
            if (drawer && content) {
                const isOpen = !drawer.classList.contains('pointer-events-none');
                if (isOpen) {
                    content.classList.add('-translate-x-full');
                    drawer.classList.add('opacity-0');
                    setTimeout(() => {
                        drawer.classList.add('pointer-events-none');
                    }, 300);
                } else {
                    drawer.classList.remove('pointer-events-none');
                    drawer.classList.remove('opacity-0');
                    content.classList.remove('-translate-x-full');
                }
            }
        }

        function toggleProfileMenu(event) {
            event.stopPropagation();
            document.getElementById('profileMenu').classList.toggle('is-open');
        }

        document.addEventListener('click', function (e) {
            const menu = document.getElementById('profileMenu');
            if (menu && !menu.contains(e.target)) menu.classList.remove('is-open');
        });

        function openLogoutConfirmModal() {
            const modal = document.getElementById('logoutConfirmModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.style.display = 'flex';
            }
        }

        function closeLogoutConfirmModal() {
            const modal = document.getElementById('logoutConfirmModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.style.display = 'none';
            }
        }
    </script>

    <!-- Logout Confirmation Modal -->
    <div id="logoutConfirmModal" class="hidden" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(8px); z-index: 99999; align-items: center; justify-content: center; padding: 20px;">
        <div style="background: white; border-radius: 24px; max-width: 400px; width: 100%; padding: 28px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); text-align: center; position: relative;">
            <button type="button" onclick="closeLogoutConfirmModal()" style="position: absolute; top: 16px; right: 16px; background: #f3f4f6; border: none; width: 32px; height: 32px; border-radius: 50%; font-size: 16px; color: #6b7280; cursor: pointer; display: flex; align-items: center; justify-content: center;">&times;</button>

            <div style="width: 68px; height: 68px; background: #fef2f2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; border: 4px solid #fee2e2;">
                <i class="fa-solid fa-arrow-right-from-bracket" style="font-size: 26px; color: #ef4444;"></i>
            </div>

            <h3 style="font-size: 19px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">Profildan chiqish</h3>
            <p style="font-size: 13.5px; color: #64748b; line-height: 1.5; margin-bottom: 24px;">
                Haqiqatan ham profildan chiqmoqchimisiz?
            </p>

            <div style="display: flex; gap: 12px;">
                <button type="button" onclick="closeLogoutConfirmModal()" style="flex: 1; padding: 12px; border-radius: 12px; font-weight: 700; font-size: 13px; background: #f1f5f9; color: #334155; border: none; cursor: pointer;">
                    Yo'q, qolaman
                </button>

                <form method="POST" action="{{ route('logout') }}" style="flex: 1; margin: 0;">
                    @csrf
                    <button type="submit" style="width: 100%; padding: 12px; border-radius: 12px; font-weight: 800; font-size: 13px; background: #ef4444; color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Chiqish
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Container Layout -->
    <div class="max-w-[1240px] mx-auto px-4 sm:px-6 py-5 sm:py-6 flex-1 w-full min-w-0 box-border">

        <!-- Toast Notifications -->
        @if(session('success'))
            <div class="mb-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 shadow-xs text-xs sm:text-sm animate-fade-in">
                <i class="fa-solid fa-circle-check text-lg text-emerald-500 flex-shrink-0"></i>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-5 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-800 flex items-start gap-3 shadow-xs text-xs sm:text-sm animate-fade-in">
                <i class="fa-solid fa-circle-exclamation text-lg text-red-500 flex-shrink-0 mt-0.5"></i>
                <div class="space-y-1">
                    <h5 class="font-bold">Iltimos, kiritilgan ma'lumotlarni tekshiring:</h5>
                    <ul class="list-disc list-inside text-xs text-red-700 space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Sayt footeri (yordam vidjeti bilan) -->
    @include('partials.footer')

    @include('partials.favorite-toggle-script')

    @stack('cabinet-scripts')

</body>
</html>
