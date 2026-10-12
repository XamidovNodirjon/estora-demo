@extends('layouts.manager')

@section('title', 'Shaxsiy ma\'lumotlar')
@section('header_title', 'Shaxsiy ma\'lumotlar')

@section('content')

@if ($errors->any())
    <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800">
        <ul class="list-disc list-inside text-xs space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Profile Card -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm lg:col-span-1 h-fit">
        <div class="flex flex-col items-center text-center">
            <div class="w-20 h-20 rounded-2xl bg-orange-500/10 text-[#ff9e0d] flex items-center justify-center font-display font-bold text-3xl mb-4">
                {{ strtoupper(substr($user->name ?? 'M', 0, 1)) }}
            </div>
            <h3 class="font-display font-bold text-lg text-[#061c3f]">{{ $user->name }}</h3>
            <span class="mt-2 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                <i class="fa-solid fa-user-tie text-[10px]"></i> Menejer
            </span>
        </div>

        <div class="border-t border-gray-100 mt-6 pt-4 space-y-3 text-sm">
            <div class="flex justify-between gap-4">
                <span class="text-gray-400">Telefon:</span>
                <span class="font-semibold text-gray-800 truncate">{{ $user->phone ?? '—' }}</span>
            </div>
            <div class="flex justify-between gap-4">
                <span class="text-gray-400">Email:</span>
                <span class="font-semibold text-gray-800 truncate">{{ $user->email ?? '—' }}</span>
            </div>
            <div class="flex justify-between gap-4">
                <span class="text-gray-400">Username:</span>
                <span class="font-semibold text-gray-800 truncate">{{ $user->username ? '@' . $user->username : '—' }}</span>
            </div>
            <div class="flex justify-between gap-4">
                <span class="text-gray-400">Ro'yxatdan o'tgan:</span>
                <span class="font-semibold text-gray-800">{{ $user->created_at?->format('d.m.Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm lg:col-span-2">
        <h3 class="font-display font-bold text-lg text-[#061c3f] flex items-center gap-2 mb-6">
            <i class="fa-solid fa-pen-to-square text-[#0084ff]"></i> Ma'lumotlarni tahrirlash
        </h3>

        <form action="{{ route('manager.profile.update') }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Ism</label>
                    <input type="text" name="first_name" required maxlength="100" value="{{ old('first_name', $user->first_name) }}"
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Familiya</label>
                    <input type="text" name="last_name" maxlength="100" value="{{ old('last_name', $user->last_name) }}"
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Telefon raqam</label>
                    <input type="text" name="phone" maxlength="30" value="{{ old('phone', $user->phone) }}"
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm font-mono"
                        placeholder="+998 90 123 45 67">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Email</label>
                    <input type="email" name="email" maxlength="255" value="{{ old('email', $user->email) }}"
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Username</label>
                    <input type="text" name="username" maxlength="255" value="{{ old('username', $user->username) }}"
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                </div>
            </div>

            <div class="border-t border-gray-100 pt-5">
                <h4 class="text-sm font-bold text-[#061c3f] mb-1">Parolni o'zgartirish</h4>
                <p class="text-xs text-gray-400 mb-4">O'zgartirmoqchi bo'lmasangiz bo'sh qoldiring</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Yangi parol</label>
                        <input type="password" name="password" autocomplete="new-password"
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Parolni tasdiqlash</label>
                        <input type="password" name="password_confirmation" autocomplete="new-password"
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="py-2.5 px-6 rounded-xl bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold text-sm transition-all shadow-lg hover:shadow-cyan-500/20">
                    Saqlash
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
