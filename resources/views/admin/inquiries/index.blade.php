@extends($layout)

@section('title', 'Murojaatlar Boshqaruvi')
@section('header_title', 'Murojaatlar Boshqaruvi')

@section('content')

<div class="mb-8">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-10 rounded-xl bg-[#0084ff]/10 text-[#0084ff] flex items-center justify-center font-bold text-lg shadow-sm">
            <i class="fa-solid fa-envelope-open-text"></i>
        </div>
        <div>
            <h2 class="font-display font-bold text-xl text-[#061c3f]">Murojaatlar (Inquiries)</h2>
            <p class="text-xs text-gray-500">Mijozlar tomonidan qoldirilgan barcha savollar, arizalar va obuna so'rovlari</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <!-- Tablar -->
        <div class="flex border-b border-gray-200 bg-gray-50/50 px-6 pt-2">
            <a href="{{ route($routePrefix . '.inquiries.index') }}"
               class="px-5 py-3 border-b-2 font-semibold text-sm transition-all flex items-center gap-2 {{ request('type') !== 'subscription' ? 'border-[#0084ff] text-[#0084ff]' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                <i class="fa-solid fa-inbox"></i>
                <span>Barcha murojaatlar</span>
            </a>
            <a href="{{ route($routePrefix . '.inquiries.index', ['type' => 'subscription']) }}"
               class="px-5 py-3 border-b-2 font-semibold text-sm transition-all flex items-center gap-2 {{ request('type') === 'subscription' ? 'border-[#0084ff] text-[#0084ff]' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                <i class="fa-solid fa-crown"></i>
                <span>Obuna so'rovlari</span>
                @if($pendingSubscriptions > 0)
                    <span class="bg-amber-500 text-white text-[11px] font-black px-2 py-0.5 rounded-full">{{ $pendingSubscriptions }}</span>
                @endif
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-200 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="px-4 py-4">Mijoz (Ismi)</th>
                        <th class="px-4 py-4">Telefon raqam</th>
                        <th class="px-4 py-4">Qisqacha tavsif (savol)</th>
                        <th class="px-4 py-4">Obuna</th>
                        <th class="px-4 py-4">Holat</th>
                        <th class="px-4 py-4">Kelgan sana</th>
                        <th class="px-4 py-4 text-center">Amallar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @forelse ($inquiries as $inquiry)
                        <tr class="hover:bg-gray-50/30 transition-colors {{ $inquiry->isSubscriptionRequest() && $inquiry->status !== 'completed' ? 'bg-amber-50/40' : '' }}">
                            <!-- Mijoz -->
                            <td class="px-4 py-4 font-bold text-[#061c3f]">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-blue-50 text-[#0084ff] flex items-center justify-center font-bold text-xs flex-shrink-0">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div class="leading-tight">
                                        <span>{{ $inquiry->name ?: 'Noma\'lum mijoz' }}</span>
                                        @if($inquiry->user)
                                            <a href="{{ route('users.show', $inquiry->user->username ?? $inquiry->user->id) }}" target="_blank" class="block text-xs font-semibold text-[#0084ff] hover:underline">
                                                &#64;{{ $inquiry->user->username ?? $inquiry->user->id }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Telefon -->
                            <td class="px-4 py-4 font-semibold text-gray-900">
                                <a href="tel:{{ $inquiry->phone }}" class="text-[#0084ff] hover:underline flex items-center gap-2 font-mono">
                                    <i class="fa-solid fa-phone text-xs"></i>
                                    {{ $inquiry->phone }}
                                </a>
                            </td>

                            <!-- Tavsif -->
                            <td class="px-4 py-4 text-gray-600 max-w-[220px] truncate" title="{{ $inquiry->description }}">
                                {{ $inquiry->description ?? 'Savol matni kiritilmagan' }}
                            </td>

                            <!-- Obuna so'rovi va tez faollashtirish -->
                            <td class="px-4 py-4">
                                @if($inquiry->isSubscriptionRequest())
                                    <div class="space-y-1.5">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-300 whitespace-nowrap">
                                            <i class="fa-solid fa-crown text-[10px]"></i>
                                            {{ config("subscriptions.plans.{$inquiry->requested_plan}.name") }} &middot; {{ config("subscriptions.periods.{$inquiry->requested_period}.label") }}
                                        </span>
                                        @if($inquiry->user)
                                            @include('partials.staff.subscription-badge', [
                                                'user' => $inquiry->user,
                                                'inquiry' => $inquiry->status !== 'completed' ? $inquiry : null,
                                            ])
                                        @endif
                                    </div>
                                @elseif($inquiry->user)
                                    @include('partials.staff.subscription-badge', ['user' => $inquiry->user])
                                @else
                                    <span class="text-xs text-gray-400">&mdash;</span>
                                @endif
                            </td>

                            <!-- Holat -->
                            <td class="px-4 py-4">
                                @if($inquiry->status === 'new')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200 whitespace-nowrap">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                        Yangi
                                    </span>
                                @elseif($inquiry->status === 'in_progress')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200 whitespace-nowrap">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        Ko'rib chiqilmoqda
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200 whitespace-nowrap">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Bajarildi
                                    </span>
                                @endif
                            </td>

                            <!-- Sana -->
                            <td class="px-4 py-4 text-gray-500 text-xs whitespace-nowrap">
                                {{ $inquiry->created_at ? $inquiry->created_at->format('d.m.Y H:i') : 'No date' }}
                            </td>

                            <!-- Amallar -->
                            <td class="px-4 py-4 text-center">
                                <div class="flex flex-col items-stretch justify-center gap-2 min-w-[120px]">
                                    <a href="{{ route($routePrefix . '.inquiries.show', $inquiry->id) }}" class="inline-flex items-center justify-center gap-1 px-3 py-1.5 rounded-lg bg-gray-50 hover:bg-gray-100 text-gray-700 text-xs font-semibold transition-colors border border-gray-300">
                                        <i class="fa-regular fa-eye"></i>
                                        Batafsil
                                    </a>

                                    <!-- Holatni tez o'zgartirish -->
                                    <form action="{{ route($routePrefix . '.inquiries.update', $inquiry->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()" class="w-full text-xs border border-gray-300 rounded-lg py-1 px-2 bg-gray-50 focus:outline-none focus:border-[#0084ff] cursor-pointer">
                                            <option value="new" {{ $inquiry->status === 'new' ? 'selected' : '' }}>Yangi</option>
                                            <option value="in_progress" {{ $inquiry->status === 'in_progress' ? 'selected' : '' }}>O'rganilmoqda</option>
                                            <option value="completed" {{ $inquiry->status === 'completed' ? 'selected' : '' }}>Bog'lanildi</option>
                                        </select>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                <i class="fa-regular fa-folder-open text-3xl mb-2 block"></i>
                                {{ request('type') === 'subscription' ? "Hozircha obuna so'rovlari yo'q." : 'Hozircha murojaatlar kelib tushmagan.' }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($inquiries->hasPages())
            <div class="px-4 py-4 border-t border-gray-200">
                {{ $inquiries->links() }}
            </div>
        @endif
    </div>
</div>

@include('partials.staff.subscription-modal')

@endsection
