<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ro'yxatdan O'tish - Estora</title>
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
            --accent-orange: #ff9e0d;
            --text-dark: #1f2937;
            --font-sans: 'Inter', sans-serif;
            --font-display: 'Outfit', sans-serif;
        }

        body {
            font-family: var(--font-sans);
            background: radial-gradient(circle at 10% 20%, rgb(4, 21, 51) 0%, rgb(9, 35, 75) 90%);
        }

        .font-display {
            font-family: var(--font-display);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .role-tab {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .role-tab.active {
            background: rgba(0, 132, 255, 0.15);
            border-color: #0084ff;
            box-shadow: 0 0 15px rgba(0, 132, 255, 0.25);
        }

        .form-label-uniform {
            display: block;
            height: 18px;
            font-size: 11.5px;
            font-weight: 700;
            color: #cbd5e1;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 8px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 18px;
        }

        .form-input-uniform {
            height: 44px;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 py-12">

    <div class="w-full max-w-lg">
        <!-- Logo and Brand -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2 mb-2 hover:opacity-90 transition-opacity" title="Bosh sahifa">
                <img src="/images/logo-exact.png" alt="ESTORA Real Estate" class="h-12 w-auto object-contain mx-auto">
            </a>
            <p class="text-gray-400 text-sm">Ko'chmas mulkning yagona raqamli ekotizimi</p>
        </div>

        <!-- Info Banner (e.g. from Add Ad button) -->
        @if(session('info'))
            <div class="mb-5 p-4 rounded-2xl bg-blue-500/20 border border-blue-500/40 text-blue-200 flex items-start gap-3 shadow-lg text-xs sm:text-sm animate-fade-in backdrop-blur-md">
                <i class="fa-solid fa-circle-info text-xl text-blue-400 flex-shrink-0 mt-0.5"></i>
                <div class="space-y-1">
                    <span class="font-bold text-white block">{{ session('info') }}</span>
                    <span class="text-xs text-blue-200 block">Agar sizda allaqachon hisob mavjud bo'lsa, <a href="{{ route('login') }}" class="underline font-bold text-white hover:text-blue-300">Tizimga kiring &rarr;</a></span>
                </div>
            </div>
        @endif

        <!-- Register Card -->
        <div class="glass-card rounded-3xl p-8 shadow-2xl">
            <h2 class="font-display font-bold text-2xl text-white text-center mb-2">Yangi hisob yaratish</h2>
            <p class="text-center text-xs text-gray-400 mb-6">O'zingizga mos ro'yxatdan o'tish turini tanlang</p>

            <!-- Role Selection Tabs (Client vs Makler) -->
            @php $currentRole = old('role', 'client'); @endphp
            <div class="grid grid-cols-2 gap-3 mb-6 p-1.5 rounded-2xl bg-white/5 border border-white/10">
                <button type="button" id="tab-client" onclick="selectRole('client')"
                    class="role-tab flex flex-col items-center justify-center py-3 px-4 rounded-xl border border-transparent text-center transition-all cursor-pointer {{ $currentRole === 'client' ? 'active text-white' : 'text-gray-400 hover:text-gray-200' }}">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fa-solid fa-user text-base text-[#0084ff]"></i>
                        <span class="font-display font-bold text-sm">Mijoz (Uy egasi)</span>
                    </div>
                    <span class="text-[11px] opacity-80">Maksimal 2 ta tekin e'lon</span>
                </button>

                <button type="button" id="tab-makler" onclick="selectRole('makler')"
                    class="role-tab flex flex-col items-center justify-center py-3 px-4 rounded-xl border border-transparent text-center transition-all cursor-pointer {{ $currentRole === 'makler' ? 'active text-white' : 'text-gray-400 hover:text-gray-200' }}">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fa-solid fa-user-tie text-base text-amber-400"></i>
                        <span class="font-display font-bold text-sm">Makler (Rieltor)</span>
                    </div>
                    <span class="text-[11px] opacity-80">Cheksiz e'lonlar joylash</span>
                </button>
            </div>

            <!-- Errors -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-200">
                    <ul class="list-disc list-inside text-xs space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Hidden input for role -->
                <input type="hidden" name="role" id="role_input" value="{{ $currentRole }}">

                <!-- Row 1: Name & Username -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="form-label-uniform">Ism sharifingiz</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400">
                                <i class="fa-regular fa-user"></i>
                            </span>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="form-input-uniform block w-full pl-10 pr-4 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:border-transparent transition-all text-sm"
                                placeholder="Ali Valiyev">
                        </div>
                    </div>
                    <div>
                        <label for="username" class="form-label-uniform">Foydalanuvchi nomi</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400">
                                <i class="fa-solid fa-at"></i>
                            </span>
                            <input type="text" name="username" id="username" value="{{ old('username') }}" required
                                class="form-input-uniform block w-full pl-10 pr-4 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:border-transparent transition-all text-sm"
                                placeholder="ali_valiyev">
                        </div>
                    </div>
                </div>

                <!-- Row 2: Email & Phone -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="email" class="form-label-uniform">Elektron pochta</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400">
                                <i class="fa-regular fa-envelope"></i>
                            </span>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="form-input-uniform block w-full pl-10 pr-4 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:border-transparent transition-all text-sm"
                                placeholder="example@mail.com">
                        </div>
                    </div>
                    <div>
                        <label for="phone" class="form-label-uniform">Telefon raqam</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400">
                                <i class="fa-solid fa-phone"></i>
                            </span>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                                class="form-input-uniform block w-full pl-10 pr-4 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:border-transparent transition-all text-sm"
                                placeholder="+998901234567">
                        </div>
                    </div>
                </div>

                <!-- Row 3: Passport & JSHSHIR -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="passport" class="form-label-uniform">Pasport seriyasi (Ixtiyoriy)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400">
                                <i class="fa-regular fa-id-card"></i>
                            </span>
                            <input type="text" name="passport" id="passport" value="{{ old('passport') }}"
                                class="form-input-uniform block w-full pl-10 pr-4 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:border-transparent transition-all text-sm"
                                placeholder="AA1234567">
                        </div>
                    </div>
                    <div>
                        <label for="jshshir" class="form-label-uniform">JShShIR (Ixtiyoriy)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400">
                                <i class="fa-solid fa-fingerprint"></i>
                            </span>
                            <input type="text" name="jshshir" id="jshshir" value="{{ old('jshshir') }}"
                                class="form-input-uniform block w-full pl-10 pr-4 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:border-transparent transition-all text-sm"
                                placeholder="14 xonali raqam">
                        </div>
                    </div>
                </div>

                <!-- Row 4: Password & Confirmation -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="form-label-uniform">Mahfiy kalit (Parol)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" name="password" id="password" required
                                class="form-input-uniform block w-full pl-10 pr-4 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:border-transparent transition-all text-sm"
                                placeholder="Kamida 6 belgi">
                        </div>
                    </div>
                    <div>
                        <label for="password_confirmation" class="form-label-uniform">Parolni tasdiqlash</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400">
                                <i class="fa-solid fa-lock-open"></i>
                            </span>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="form-input-uniform block w-full pl-10 pr-4 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:border-transparent transition-all text-sm"
                                placeholder="Parolni takrorlang">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-3 px-4 mt-4 rounded-xl bg-[#0084ff] hover:bg-[#0076e5] text-white font-bold text-sm transition-all shadow-lg hover:shadow-cyan-500/25 transform hover:-translate-y-0.5 active:translate-y-0">
                    Ro'yxatdan o'tish
                </button>
            </form>

            <div class="mt-6 text-center text-xs text-gray-400">
                Hisobingiz bormi? 
                <a href="{{ route('login') }}" class="text-[#0084ff] hover:underline font-semibold ml-1">Kirish</a>
            </div>
        </div>
        
        <!-- Footer -->
        <p class="text-center text-xs text-gray-500 mt-8">
            &copy; {{ date('Y') }} Estora. Barcha huquqlar himoyalangan.
        </p>
    </div>

    <script>
        function selectRole(role) {
            document.getElementById('role_input').value = role;
            const clientTab = document.getElementById('tab-client');
            const maklerTab = document.getElementById('tab-makler');

            if (role === 'client') {
                clientTab.classList.add('active', 'text-white');
                clientTab.classList.remove('text-gray-400');
                maklerTab.classList.remove('active', 'text-white');
                maklerTab.classList.add('text-gray-400');
            } else {
                maklerTab.classList.add('active', 'text-white');
                maklerTab.classList.remove('text-gray-400');
                clientTab.classList.remove('active', 'text-white');
                clientTab.classList.add('text-gray-400');
            }
        }
    </script>

</body>
</html>
