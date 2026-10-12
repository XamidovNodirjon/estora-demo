@extends('layouts.manager')

@section('title', 'Menejer Kabineti')
@section('header_title', 'Menejer Kabineti')

@section('content')
<div class="space-y-8">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-6">
        <a href="{{ route('manager.leads') }}" class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex items-center justify-between hover:border-blue-200 transition-colors">
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Biriktirilgan lidlar</span>
                <h3 class="font-display font-bold text-2xl text-[#061c3f]">{{ $leadsCount }} ta</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-[#0084ff]/10 text-[#0084ff] flex items-center justify-center">
                <i class="fa-solid fa-address-book text-xl"></i>
            </div>
        </a>

        <a href="{{ route('manager.products', ['source' => 'assigned']) }}" class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex items-center justify-between hover:border-blue-200 transition-colors">
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Admin biriktirgan uylar</span>
                <h3 class="font-display font-bold text-2xl text-[#061c3f]">{{ $assignedProductsCount }} ta</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center">
                <i class="fa-solid fa-house-circle-check text-xl"></i>
            </div>
        </a>

        <a href="{{ route('manager.products', ['source' => 'own']) }}" class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm flex items-center justify-between hover:border-blue-200 transition-colors">
            <div>
                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">O'zim qo'shgan uylar</span>
                <h3 class="font-display font-bold text-2xl text-[#061c3f]">{{ $ownProductsCount }} ta</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-[#ff9e0d]/10 text-[#ff9e0d] flex items-center justify-center">
                <i class="fa-solid fa-house-medical text-xl"></i>
            </div>
        </a>
    </div>

    <!-- Lead statuses overview -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-display font-bold text-lg text-[#061c3f] flex items-center gap-2">
                <i class="fa-solid fa-chart-pie text-[#0084ff]"></i> Lidlar holati
            </h3>
            <a href="{{ route('manager.leads') }}" class="text-xs font-semibold text-[#0084ff] hover:underline">Lidlarga o'tish</a>
        </div>

        @php($statusTotal = max(array_sum($statusCounts), 1))
        <div class="flex h-2.5 rounded-full overflow-hidden bg-gray-100 mb-5">
            @foreach(\App\Enums\LeadStatus::cases() as $statusOption)
                @if(($statusCounts[$statusOption->value] ?? 0) > 0)
                    <div class="{{ $statusOption->dotClass() }}" style="width: {{ round($statusCounts[$statusOption->value] / $statusTotal * 100, 2) }}%" title="{{ $statusOption->label() }}"></div>
                @endif
            @endforeach
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
            @foreach(\App\Enums\LeadStatus::cases() as $statusOption)
                <a href="{{ route('manager.leads', ['status' => $statusOption->value]) }}" class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50/30 transition-colors">
                    <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0 {{ $statusOption->iconClasses() }}">
                        <i class="fa-solid {{ $statusOption->icon() }} text-sm"></i>
                    </div>
                    <div class="min-w-0">
                        <span class="block text-[11px] text-gray-400 font-semibold truncate">{{ $statusOption->label() }}</span>
                        <span class="block font-display font-bold text-lg text-[#061c3f]">{{ $statusCounts[$statusOption->value] ?? 0 }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Manager Info -->
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm lg:col-span-1">
            <h3 class="font-display font-bold text-lg text-[#061c3f] mb-6 flex items-center gap-2">
                <i class="fa-solid fa-user-tie text-[#0084ff]"></i> Menejer Ma'lumotlari
            </h3>

            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-orange-500/10 text-[#ff9e0d] flex items-center justify-center font-bold text-lg">
                        {{ strtoupper(substr($user->name ?? 'M', 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-bold text-[#061c3f] truncate">{{ $user->name }}</h4>
                        <p class="text-xs text-gray-400 truncate">{{ $user->email ?? '—' }}</p>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-4 space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Telefon:</span>
                        <span class="font-semibold text-gray-800">{{ $user->phone ?? '—' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Roli:</span>
                        <span class="font-semibold text-emerald-600">Menejer</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Ro'yxatdan o'tgan:</span>
                        <span class="font-semibold text-gray-800">{{ $user->created_at?->format('d.m.Y') }}</span>
                    </div>
                </div>

                <a href="{{ route('manager.profile') }}" class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-gray-50 hover:bg-gray-100 border border-gray-200 text-gray-700 text-sm font-semibold transition-colors">
                    <i class="fa-solid fa-pen-to-square"></i> Ma'lumotlarni tahrirlash
                </a>
            </div>
        </div>

        <!-- Latest Leads -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm lg:col-span-2 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
                <h3 class="font-display font-bold text-lg text-[#061c3f] flex items-center gap-2">
                    <i class="fa-solid fa-address-book text-[#0084ff]"></i> Oxirgi biriktirilgan lidlar
                </h3>
                <a href="{{ route('manager.leads') }}" class="text-xs font-semibold text-[#0084ff] hover:underline">Barchasi</a>
            </div>

            <div class="divide-y divide-gray-50">
                @forelse($latestLeads as $lead)
                    <div class="px-6 py-4 flex items-center justify-between gap-4 hover:bg-gray-50/50 transition-colors">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-9 h-9 rounded-full bg-blue-50 text-[#0084ff] flex items-center justify-center font-bold text-xs flex-shrink-0">
                                {{ mb_strtoupper(mb_substr($lead->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <span class="block font-bold text-sm text-[#061c3f] truncate">{{ $lead->name }}</span>
                                <span class="block text-xs text-gray-400 truncate">{{ $lead->description ?: 'Tavsif kiritilmagan' }}</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-end gap-1.5">
                            @include('partials.lead-status-badge', ['status' => $lead->status])
                            <a href="tel:{{ $lead->phone }}" class="text-[#0084ff] hover:underline flex items-center gap-2 font-mono text-xs font-semibold whitespace-nowrap">
                                <i class="fa-solid fa-phone text-[10px]"></i>
                                {{ $lead->phone }}
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center text-gray-400 text-sm">
                        <i class="fa-regular fa-folder-open text-3xl mb-2 block"></i>
                        Sizga hali lidlar biriktirilmagan.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
