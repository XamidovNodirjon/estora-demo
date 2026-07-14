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
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 py-12">

    <div class="w-full max-w-lg">
        <!-- Logo and Brand -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2 mb-2">
                <i class="fa-solid fa-house-chimney text-[#0084ff] text-4xl shadow-md"></i>
                <span class="font-display font-black text-3xl tracking-wider text-white">ESTORA</span>
            </a>
            <p class="text-gray-400 text-sm">Ko'chmas mulkning yagona raqamli ekotizimi</p>
        </div>

        <!-- Register Card -->
        <div class="glass-card rounded-3xl p-8 shadow-2xl">
            <h2 class="font-display font-bold text-2xl text-white text-center mb-6">Yangi hisob yaratish</h2>

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

                <!-- Name & Username (Two columns) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">Ism sharifingiz</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fa-regular fa-user"></i>
                            </span>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="block w-full pl-10 pr-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:border-transparent transition-all text-sm"
                                placeholder="Ali Valiyev">
                        </div>
                    </div>
                    <div>
                        <label for="username" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">Foydalanuvchi nomi (Username)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fa-solid fa-at"></i>
                            </span>
                            <input type="text" name="username" id="username" value="{{ old('username') }}" required
                                class="block w-full pl-10 pr-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:border-transparent transition-all text-sm"
                                placeholder="ali_valiyev">
                        </div>
                    </div>
                </div>

                <!-- Email & Phone (Two columns) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="email" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">Elektron pochta</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fa-regular fa-envelope"></i>
                            </span>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="block w-full pl-10 pr-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:border-transparent transition-all text-sm"
                                placeholder="example@mail.com">
                        </div>
                    </div>
                    <div>
                        <label for="phone" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">Telefon raqam</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fa-solid fa-phone"></i>
                            </span>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                                class="block w-full pl-10 pr-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:border-transparent transition-all text-sm"
                                placeholder="+998901234567">
                        </div>
                    </div>
                </div>

                <!-- Passport & JSHSHIR (Two columns, optional) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="passport" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">Pasport seriyasi va raqami (Ixtiyoriy)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fa-regular fa-id-card"></i>
                            </span>
                            <input type="text" name="passport" id="passport" value="{{ old('passport') }}"
                                class="block w-full pl-10 pr-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:border-transparent transition-all text-sm"
                                placeholder="AA1234567">
                        </div>
                    </div>
                    <div>
                        <label for="jshshir" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">JShShIR (Ixtiyoriy)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fa-solid fa-fingerprint"></i>
                            </span>
                            <input type="text" name="jshshir" id="jshshir" value="{{ old('jshshir') }}"
                                class="block w-full pl-10 pr-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:border-transparent transition-all text-sm"
                                placeholder="14 xonali raqam">
                        </div>
                    </div>
                </div>

                <!-- Password & Confirmation (Two columns) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">Mahfiy kalit (Parol)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" name="password" id="password" required
                                class="block w-full pl-10 pr-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:border-transparent transition-all text-sm"
                                placeholder="Kamida 6 belgi">
                        </div>
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">Tasdiqlash</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                <i class="fa-solid fa-lock-open"></i>
                            </span>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="block w-full pl-10 pr-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:border-transparent transition-all text-sm"
                                placeholder="Parolni takrorlang">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-3 px-4 mt-2 rounded-xl bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold text-sm transition-all shadow-lg hover:shadow-cyan-500/20 transform hover:-translate-y-0.5 active:translate-y-0">
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

</body>
</html>
