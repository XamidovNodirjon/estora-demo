@extends('layouts.developer')

@section('title', 'Tizim Yaratuvchisi Paneli')
@section('header_title', 'Developer Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Card 1 -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex items-center justify-between">
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">CPU yuklanishi</span>
                <h3 class="font-display font-bold text-2xl text-[#061c3f]">12.4 %</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-[#0084ff]/10 text-[#0084ff] flex items-center justify-center">
                <i class="fa-solid fa-microchip text-xl"></i>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex items-center justify-between">
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">RAM ishlatilishi</span>
                <h3 class="font-display font-bold text-2xl text-[#061c3f]">128 MB / 512 MB</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-500/10 text-purple-600 flex items-center justify-center">
                <i class="fa-solid fa-memory text-xl"></i>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex items-center justify-between">
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Ma'lumotlar bazasi</span>
                <h3 class="font-display font-bold text-2xl text-[#061c3f]">MySQL 8.0</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center">
                <i class="fa-solid fa-database text-xl"></i>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex items-center justify-between">
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Laravel versiyasi</span>
                <h3 class="font-display font-bold text-2xl text-[#061c3f]">v11.x</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-red-500/10 text-red-600 flex items-center justify-center">
                <i class="fa-brands fa-laravel text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Details Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- System Health -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm lg:col-span-2">
            <h3 class="font-display font-bold text-lg text-[#061c3f] mb-6 flex items-center gap-2">
                <i class="fa-solid fa-heart-pulse text-emerald-500"></i> Tizim monitoringi
            </h3>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-semibold text-gray-600">Xotira yuklanishi</span>
                        <span class="font-bold text-gray-800">25%</span>
                    </div>
                    <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                        <div class="bg-[#0084ff] h-full rounded-full" style="width: 25%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-semibold text-gray-600">Disk xotirasi</span>
                        <span class="font-bold text-gray-800">48%</span>
                    </div>
                    <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                        <div class="bg-amber-500 h-full rounded-full" style="width: 48%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-semibold text-gray-600">Kesh holati (Redis/File)</span>
                        <span class="font-bold text-emerald-600">Faol / Yaxshi</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dev Info -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <h3 class="font-display font-bold text-lg text-[#061c3f] mb-6 flex items-center gap-2">
                <i class="fa-solid fa-circle-info text-[#ff9e0d]"></i> Xavfsiz tizim
            </h3>
            <div class="text-sm space-y-3">
                <div class="flex justify-between pb-3 border-b border-gray-50">
                    <span class="text-gray-500">Foydalanuvchi:</span>
                    <span class="font-bold text-[#061c3f]">{{ Auth::user()->username }}</span>
                </div>
                <div class="flex justify-between pb-3 border-b border-gray-50">
                    <span class="text-gray-500">Email:</span>
                    <span class="font-bold text-[#061c3f]">{{ Auth::user()->email }}</span>
                </div>
                <div class="flex justify-between pb-3 border-b border-gray-50">
                    <span class="text-gray-500">Roli:</span>
                    <span class="px-2 py-0.5 rounded bg-blue-50 text-blue-700 text-xs font-semibold">Developer</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Ulanish vaqti:</span>
                    <span class="font-semibold text-gray-600">{{ date('d.m.Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
