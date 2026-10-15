<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $user->name }} - Estora Real Estate</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Vite Assets with fallback -->
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <!-- Sayt footeri stillari -->
    <link rel="stylesheet" href="{{ asset('css/estora-footer.css') }}?v={{ filemtime(public_path('css/estora-footer.css')) }}">

    <style>
        html, body {
            max-width: 100vw;
            overflow-x: hidden;
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #FFFFFF;
            color: #0F172A;
        }

        .dropdown-menu { display: none; }
        .dropdown-menu.is-open { display: block; }
        .footer-container-exact { margin-top: 48px; }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased">

    @php
        $isOwner = Auth::id() === $user->id;
        $roleLabels = ['makler' => 'Makler (Rieltor)', 'client' => 'Jismoniy shaxs', 'owner' => 'Uy egasi', 'hotel' => 'Mehmonxona', 'builder' => 'Quruvchi'];
        $roleLabel = $roleLabels[$userRole] ?? ucfirst((string) $userRole);
        $pageUrl = route('users.show', $user->username ?? $user->id);
        $shortNumber = function (int $n): string {
            if ($n >= 1000000) return rtrim(rtrim(number_format($n / 1000000, 1, '.', ''), '0'), '.') . 'M';
            if ($n >= 1000) return rtrim(rtrim(number_format($n / 1000, 1, '.', ''), '0'), '.') . 'K';
            return (string) $n;
        };
    @endphp

    <!-- Header -->
    <header class="bg-white sticky top-0 z-30">
        <div class="max-w-[1240px] mx-auto px-4 sm:px-6 h-[68px] flex items-center justify-between gap-3 border-b border-slate-300">
            <a href="{{ route('maniDashboard') }}" class="flex items-center hover:opacity-90 transition-opacity" title="ESTORA Real Estate">
                <img src="/images/logo.svg" alt="ESTORA Real Estate" class="h-9 sm:h-10 w-auto object-contain">
            </a>

            <div class="flex items-center gap-2 sm:gap-4 text-[11px] font-semibold text-slate-600">
                <span class="hidden sm:inline-flex items-center gap-1.5 bg-[#0077FE] text-white font-bold px-3.5 py-1.5 rounded-full cursor-default" title="Tez orada">
                    <i class="fa-solid fa-robot text-xs"></i> Estora AI Agent
                </span>

                @auth
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-1.5 hover:text-[#0077FE] transition-colors">
                        <i class="fa-solid fa-reply text-[#0077FE]"></i> <span class="hidden sm:inline">Mening kabinetim</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="flex items-center gap-1.5 hover:text-[#0077FE] transition-colors">
                        <i class="fa-solid fa-right-to-bracket text-[#0077FE]"></i> Kirish
                    </a>
                @endauth

                <span class="w-px h-5 bg-slate-300"></span>
                <button type="button" onclick="sharePage(this)" class="flex items-center gap-1.5 hover:text-[#0077FE] transition-colors cursor-pointer">
                    <span data-share-label>Ulashish</span> <i class="fa-solid fa-arrow-up-from-bracket text-[#0077FE]"></i>
                </button>

                @if($isOwner)
                    <span class="w-px h-5 bg-slate-300"></span>
                    <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Haqiqatan ham profildan chiqmoqchimisiz?');">
                        @csrf
                        <button type="submit" class="flex items-center gap-1.5 hover:text-red-600 transition-colors cursor-pointer">
                            <span class="hidden sm:inline">Chiqish</span>
                            <span class="w-6 h-6 rounded-full bg-[#0077FE] text-white flex items-center justify-center text-[10px]"><i class="fa-solid fa-power-off"></i></span>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </header>

    <main class="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-[90px] py-6 flex-1 w-full">

        <!-- Muqova -->
        <div class="relative h-36 sm:h-44 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 text-4xl">
            <i class="fa-regular fa-image"></i>
            <div class="absolute top-3 right-4">
                <button type="button" onclick="toggleDropdown('coverMenu', event)" class="text-[#0077FE] text-lg cursor-pointer px-1" title="Yana">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>
                <div id="coverMenu" class="dropdown-menu absolute right-0 mt-1 w-48 bg-white border border-slate-300 rounded-xl shadow-lg p-1.5 z-20 text-xs">
                    <button type="button" onclick="sharePage()" class="w-full text-left px-3 py-2 rounded-lg font-semibold text-slate-700 hover:bg-slate-50 cursor-pointer">
                        <i class="fa-regular fa-copy w-4 text-[#0077FE]"></i> Havolani nusxalash
                    </button>
                    @if($isOwner)
                        <a href="{{ route('client.dashboard', ['section' => 'account']) }}" class="block px-3 py-2 rounded-lg font-semibold text-slate-700 hover:bg-slate-50">
                            <i class="fa-regular fa-pen-to-square w-4 text-[#0077FE]"></i> Profilni tahrirlash
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Profil -->
        <div class="flex flex-col md:flex-row md:items-start gap-5 mt-4 sm:mt-5">
            <div class="flex items-start gap-4 sm:gap-5 flex-1 min-w-0">
                <div class="w-24 h-24 sm:w-[150px] sm:h-[150px] -mt-14 sm:-mt-20 rounded-full bg-slate-100 border-4 border-white flex items-center justify-center text-slate-400 text-3xl overflow-hidden flex-shrink-0 relative">
                    @if($user->avatar)
                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        <i class="fa-regular fa-image"></i>
                    @endif
                </div>

                <div class="min-w-0 pt-1">
                    <h1 class="font-black text-lg sm:text-xl text-slate-900 leading-tight">{{ $user->name }}</h1>
                    <button type="button" onclick="sharePage()" class="text-[11px] text-slate-500 font-semibold flex items-center gap-1 hover:text-[#0077FE] cursor-pointer" title="Havolani nusxalash">
                        &#64;{{ $user->username ?? 'user' . $user->id }} <i class="fa-regular fa-copy text-[10px]"></i>
                    </button>
                    <div class="text-[11px] text-slate-700 leading-relaxed mt-2">
                        <div>{{ $roleLabel }}</div>
                        <div>Tizimda: {{ $user->created_at?->format('d.m.Y') }}</div>
                        <div>ID: {{ 2000000 + $user->id }}</div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-stretch md:items-end gap-4">
                <div class="grid grid-cols-3 gap-6 sm:gap-10 text-center">
                    <div>
                        <div class="text-xl font-black text-slate-900">{{ $shortNumber($totalCount) }}</div>
                        <div class="text-[10px] font-semibold text-slate-500">E'lonlar</div>
                    </div>
                    <div>
                        <div class="text-xl font-black text-slate-900">{{ $shortNumber($totalViews) }}</div>
                        <div class="text-[10px] font-semibold text-slate-500">Ko'rishlar</div>
                    </div>
                    <div>
                        <div class="text-xl font-black text-slate-900">{{ $trust }}%</div>
                        <div class="text-[10px] font-semibold text-slate-500">Ishonch</div>
                    </div>
                </div>

                <div class="flex items-center gap-2 flex-wrap md:justify-end">
                    @if($user->phone)
                        <div class="relative">
                            <button type="button" onclick="toggleDropdown('contactMenu', event)" class="bg-[#0077FE] hover:bg-blue-600 text-white text-xs font-bold px-4 py-2 rounded-md flex items-center gap-2 cursor-pointer transition-colors">
                                <i class="fa-solid fa-phone"></i> Aloqa <i class="fa-solid fa-chevron-down text-[9px]"></i>
                            </button>
                            <div id="contactMenu" class="dropdown-menu absolute right-0 mt-1 w-52 bg-white border border-slate-300 rounded-xl shadow-lg p-1.5 z-20 text-xs">
                                <a href="tel:{{ preg_replace('/[^\d+]/', '', $user->phone) }}" class="block px-3 py-2 rounded-lg font-semibold text-slate-700 hover:bg-slate-50">
                                    <i class="fa-solid fa-phone w-4 text-[#0077FE]"></i> {{ $user->phone }}
                                </a>
                            </div>
                        </div>
                    @endif

                    <button type="button" onclick="sharePage(this)" class="bg-[#0077FE] hover:bg-blue-600 text-white text-xs font-bold px-4 py-2 rounded-md flex items-center gap-2 cursor-pointer transition-colors">
                        <i class="fa-solid fa-share-nodes"></i> <span data-share-label>Ulashish</span>
                    </button>

                    @if($isOwner)
                        <a href="{{ route('client.dashboard', ['section' => 'account']) }}" class="bg-[#0077FE] hover:bg-blue-600 text-white text-xs font-bold px-3 py-2 rounded-md flex items-center gap-2 transition-colors" title="Profilni tahrirlash">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tablar va filtrlar -->
        <form method="GET" action="{{ $pageUrl }}" class="flex flex-col lg:flex-row lg:items-center gap-3 mt-8 border-b border-slate-300 pb-2">
            <div class="flex items-center gap-8 lg:w-[220px] text-sm font-extrabold">
                <span class="text-[#0077FE] border-b-2 border-[#0077FE] pb-1.5">E'lonlar</span>
                <span class="text-slate-900 pb-1.5 cursor-default" title="Tez orada">Videos</span>
            </div>

            <div class="relative flex-1 lg:max-w-[280px]">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="E'lon nomi yoki ID bo'yicha qidirish..."
                       class="w-full bg-white border border-slate-300 rounded-full py-2 pl-4 pr-10 text-xs text-slate-700 placeholder-slate-400 focus:outline-none focus:border-[#0077FE]">
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-[#0077FE] cursor-pointer" title="Qidirish">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

            <div class="flex items-center gap-2 lg:ml-auto">
                <select name="category_id" onchange="this.form.submit()" class="bg-white border border-slate-300 rounded-full px-3 py-1.5 text-xs font-semibold text-slate-700 focus:outline-none cursor-pointer">
                    <option value="">Barcha tur</option>
                    @foreach($categories as $id => $name)
                        <option value="{{ $id }}" @selected((string) request('category_id') === (string) $id)>{{ $name }}</option>
                    @endforeach
                </select>

                <label class="relative bg-white border border-slate-300 rounded-full pl-3 pr-2.5 py-1.5 text-xs font-semibold text-slate-700 flex items-center gap-1.5 cursor-pointer">
                    <span>Filtrlar</span> <i class="fa-solid fa-sliders text-[10px]"></i>
                    <select name="sort" onchange="this.form.submit()" class="absolute inset-0 opacity-0 cursor-pointer" title="Saralash">
                        <option value="" @selected(!request('sort'))>Avval yangilari</option>
                        <option value="oldest" @selected(request('sort') === 'oldest')>Avval eskilari</option>
                        <option value="price_asc" @selected(request('sort') === 'price_asc')>Narx: arzonidan</option>
                        <option value="price_desc" @selected(request('sort') === 'price_desc')>Narx: qimmatidan</option>
                    </select>
                </label>
            </div>
        </form>

        <!-- E'lonlar -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 min-[480px]:grid-cols-2 lg:grid-cols-4 gap-5 mt-8">
                @foreach($products as $product)
                    @include('partials.product-grid-card', ['product' => $product])
                @endforeach
            </div>

            @if($products->hasPages())
                <nav class="flex items-center justify-center gap-2 mt-8" aria-label="Sahifalar">
                    @if($products->onFirstPage())
                        <span class="w-8 h-8 flex items-center justify-center text-slate-300"><i class="fa-solid fa-chevron-left"></i></span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center text-[#0077FE]"><i class="fa-solid fa-chevron-left"></i></a>
                    @endif

                    @foreach($products->getUrlRange(max(1, $products->currentPage() - 2), min($products->lastPage(), $products->currentPage() + 2)) as $page => $url)
                        @if($page === $products->currentPage())
                            <span class="w-9 h-9 rounded-full bg-[#0077FE] text-white text-base font-bold flex items-center justify-center">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="w-9 h-9 rounded-full border-2 border-[#0077FE] text-[#0077FE] text-base font-bold flex items-center justify-center hover:bg-blue-50">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center text-[#0077FE]"><i class="fa-solid fa-chevron-right"></i></a>
                    @else
                        <span class="w-8 h-8 flex items-center justify-center text-slate-300"><i class="fa-solid fa-chevron-right"></i></span>
                    @endif
                </nav>
            @endif
        @else
            <div class="text-center py-20">
                <h3 class="font-extrabold text-slate-900 text-sm">
                    {{ request()->hasAny(['q', 'category_id']) ? "Mos e'lon topilmadi" : "Hozircha e'lonlar mavjud emas" }}
                </h3>
                <p class="text-xs text-slate-500 mt-1">
                    {{ request()->hasAny(['q', 'category_id']) ? "Qidiruv yoki filtr shartlarini o'zgartirib ko'ring." : "Ushbu foydalanuvchi hali e'lon joylashtirmagan." }}
                </p>
            </div>
        @endif
    </main>

    @include('partials.footer')

    @include('partials.favorite-toggle-script')

    <script>
        const pageUrl = @json($pageUrl);

        function toggleDropdown(id, event) {
            event.stopPropagation();
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (menu.id !== id) menu.classList.remove('is-open');
            });
            document.getElementById(id).classList.toggle('is-open');
        }

        document.addEventListener('click', () => {
            document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList.remove('is-open'));
        });

        async function sharePage(btn) {
            if (navigator.share) {
                try {
                    await navigator.share({ title: document.title, url: pageUrl });
                    return;
                } catch (e) {
                    if (e.name === 'AbortError') return;
                }
            }

            try {
                await navigator.clipboard.writeText(pageUrl);
            } catch (e) {
                window.prompt("Havolani nusxalang:", pageUrl);
                return;
            }

            const label = btn ? btn.querySelector('[data-share-label]') : null;
            if (label) {
                const original = label.textContent;
                label.textContent = 'Nusxalandi!';
                setTimeout(() => { label.textContent = original; }, 1800);
            }
        }
    </script>
</body>
</html>
