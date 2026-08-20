<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tizimga Kirish - Estora</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite Assets with fallback -->
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

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
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <!-- Logo and Brand -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2 mb-2 hover:opacity-90 transition-opacity" title="Bosh sahifa">
                <img src="/images/logo-white.svg" alt="ESTORA Real Estate" class="h-12 w-auto object-contain mx-auto">
            </a>
            <p class="text-gray-400 text-sm">Ko'chmas mulkning yagona raqamli ekotizimi</p>
        </div>

        <!-- Info Banner (e.g. from Add Ad button) -->
        @if(session('info'))
            <div class="mb-5 p-4 rounded-2xl bg-blue-500/20 border border-blue-500/40 text-blue-200 flex items-start gap-3 shadow-lg text-xs sm:text-sm animate-fade-in backdrop-blur-md">
                <i class="fa-solid fa-circle-info text-xl text-blue-400 flex-shrink-0 mt-0.5"></i>
                <div class="space-y-1">
                    <span class="font-bold text-white block">{{ session('info') }}</span>
                    <span class="text-xs text-blue-200 block">Agar hali ro'yxatdan o'tmagan bo'lsangiz, <a href="{{ route('register') }}" class="underline font-bold text-white hover:text-blue-300">Ro'yxatdan o'ting &rarr;</a></span>
                </div>
            </div>
        @endif

        <!-- Login Card -->
        <div class="glass-card rounded-3xl p-8 shadow-2xl">
            <h2 class="font-display font-bold text-2xl text-white text-center mb-6">Tizimga kirish</h2>

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

            @if (session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-200 flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-400 text-sm"></i>
                    <span class="text-xs">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Login input (Username or Email) -->
                <div>
                    <label for="login" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider mb-2">Email yoki Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fa-regular fa-user"></i>
                        </span>
                        <input type="text" name="login" id="login" value="{{ old('login') }}" required autofocus
                            class="block w-full pl-10 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:border-transparent transition-all text-sm"
                            placeholder="username yoki email...">
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-xs font-semibold text-gray-300 uppercase tracking-wider">Mahfiy kalit</label>
                        <a href="#" class="text-xs text-[#0084ff] hover:underline">Parolni unutdingizmi?</a>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" name="password" id="password" required
                            class="block w-full pl-10 pr-10 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:border-transparent transition-all text-sm"
                            placeholder="••••••••">
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-white transition-all">
                            <i id="password-icon" class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" value="1"
                        class="h-4 w-4 rounded bg-white/5 border-white/10 text-[#0084ff] focus:ring-[#0084ff]">
                    <label for="remember" class="ml-2 block text-xs text-gray-300">Meni yodda saqla</label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-3 px-4 rounded-xl bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold text-sm transition-all shadow-lg hover:shadow-cyan-500/20 transform hover:-translate-y-0.5 active:translate-y-0">
                    Kiriş
                </button>
            </form>

            <div class="mt-6 text-center text-xs text-gray-400">
                Hisobingiz yo'qmi? 
                <a href="{{ route('register') }}" class="text-[#0084ff] hover:underline font-semibold ml-1">Ro'yxatdan o'tish</a>
            </div>
        </div>
        
        <!-- Footer -->
        <p class="text-center text-xs text-gray-500 mt-8">
            &copy; {{ date('Y') }} Estora. Barcha huquqlar himoyalangan.
        </p>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>
</html>
