@extends('layouts.admin')

@section('title', 'Admin Boshqaruv Paneli')
@section('header_title', 'Tizim Boshqaruv Paneli')

@section('content')
<div class="space-y-8">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Card 1 -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex items-center justify-between">
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Mijozlar soni</span>
                <h3 class="font-display font-bold text-2xl text-[#061c3f]">{{ $clientsCount }} ta</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-600 flex items-center justify-center">
                <i class="fa-solid fa-users-gear text-xl"></i>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex items-center justify-between">
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">E'lonlar</span>
                <h3 class="font-display font-bold text-2xl text-[#061c3f]">{{ $productsCount }} ta</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center">
                <i class="fa-solid fa-house-circle-check text-xl"></i>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex items-center justify-between">
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Tasdiqlanmoqda</span>
                <h3 class="font-display font-bold text-2xl text-[#061c3f]">{{ $pendingCount }} ta e'lon</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-[#ff9e0d]/10 text-[#ff9e0d] flex items-center justify-center">
                <i class="fa-solid fa-hourglass-half text-xl"></i>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex items-center justify-between">
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Tizim daromadi</span>
                <h3 class="font-display font-bold text-2xl text-[#061c3f]">{{ $incomeAmount }} so'm</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-[#0084ff]/10 text-[#0084ff] flex items-center justify-center">
                <i class="fa-solid fa-scale-balanced text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Active Listings & Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- User Role Details -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm lg:col-span-1">
            <h3 class="font-display font-bold text-lg text-[#061c3f] mb-6 flex items-center gap-2">
                <i class="fa-solid fa-user-shield text-[#0084ff]"></i> Administrator Ma'lumotlari
            </h3>
            
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-orange-500/10 text-[#ff9e0d] flex items-center justify-center font-bold text-lg">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-[#061c3f]">{{ Auth::user()->name }}</h4>
                        <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-4 space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Roli:</span>
                        <span class="font-semibold text-emerald-600 capitalize">{{ Auth::user()->role->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Tizim holati:</span>
                        <span class="font-semibold text-emerald-600">Onlayn</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
