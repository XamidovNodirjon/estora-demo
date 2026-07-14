@extends('layouts.client')

@section('title', 'Mening Kabinetim')

@section('content')
<div class="space-y-8">
    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-[#061c3f] to-[#0B2240] rounded-3xl p-8 text-white relative overflow-hidden shadow-lg">
        <div class="absolute right-0 bottom-0 top-0 opacity-10 flex items-center justify-center pr-8">
            <i class="fa-solid fa-house-chimney-user text-[180px]"></i>
        </div>
        <div class="relative z-10 max-w-xl">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-white text-xs font-semibold mb-4">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                Estora Ekotizimi
            </span>
            <h2 class="font-display font-bold text-3xl mb-2">Hush kelibsiz, {{ Auth::user()->name }}!</h2>
            <p class="text-gray-300 text-sm leading-relaxed mb-6">
                Ko'chmas mulk sotish yoki ijaraga berish, orzuingizdagi uyni qidirish va barcha shartnomalarni onlayn rasmiylashtirish endi juda oson.
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="#" class="px-5 py-2.5 bg-[#0084ff] hover:bg-[#0076e5] rounded-xl font-semibold text-sm transition-all shadow-md">
                    <i class="fa-solid fa-plus mr-1"></i> Yangi e'lon berish
                </a>
                <a href="/" class="px-5 py-2.5 bg-white/10 hover:bg-white/20 rounded-xl font-semibold text-sm transition-all border border-white/10">
                    <i class="fa-solid fa-magnifying-glass mr-1"></i> Uylarni qidirish
                </a>
            </div>
        </div>
    </div>

    <!-- Client Quick Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Stat 1 -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-blue-500/10 text-[#0084ff] flex items-center justify-center text-2xl">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Mening e'lonlarim</span>
                <h3 class="font-display font-bold text-2xl text-[#061c3f]">0 ta e'lon</h3>
            </div>
        </div>

        <!-- Stat 2 -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-red-500/10 text-red-500 flex items-center justify-center text-2xl">
                <i class="fa-regular fa-heart"></i>
            </div>
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Saralangan e'lonlar</span>
                <h3 class="font-display font-bold text-2xl text-[#061c3f]">0 ta uy</h3>
            </div>
        </div>

        <!-- Stat 3 -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-amber-500/10 text-amber-500 flex items-center justify-center text-2xl">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Mening balansim</span>
                <h3 class="font-display font-bold text-2xl text-[#061c3f]">{{ Auth::user()->balls ?? 0 }} ball</h3>
            </div>
        </div>
    </div>

    <!-- Active Inquiries or Offers -->
    <div class="bg-white rounded-3xl border border-gray-200 p-8 shadow-sm">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-display font-bold text-lg text-[#061c3f]">Hozirgi takliflar va yangiliklar</h3>
            <a href="#" class="text-sm font-semibold text-[#0084ff] hover:underline">Hammasini ko'rish</a>
        </div>
        
        <div class="text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
            <i class="fa-regular fa-folder-open text-gray-400 text-4xl mb-4 block"></i>
            <h4 class="font-semibold text-gray-600 text-sm mb-1">Hozircha hech qanday ma'lumotlar yo'q</h4>
            <p class="text-xs text-gray-400 max-w-xs mx-auto">Tizimda yangi uylarni izlang va ularni saralanganlar ro'yxatiga qo'shing.</p>
        </div>
    </div>
</div>
@endsection
