@extends('layouts.developer')

@section('title', 'Barcha E\'lonlar')
@section('header_title', 'E\'lonlar Boshqaruvi')

@section('content')
<div class="space-y-6">
    <!-- Header Card -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div>
            <h2 class="font-display font-bold text-xl text-[#061c3f]">E'lonlar (Mahsulotlar) Ro'yxati</h2>
            <p class="text-xs text-gray-400 mt-1">Tizimga joylashtirilgan barcha ko'chmas mulk e'lonlarini kuzatish va boshqarish</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3.5 py-1.5 bg-blue-50 text-blue-700 font-extrabold text-xs rounded-xl border border-blue-200">
                Jami: {{ $products->total() }} ta e'lon
            </span>
        </div>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 font-semibold">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Nomi / Sarlavhasi</th>
                        <th class="px-6 py-4">Yaratuvchi (Muallif)</th>
                        <th class="px-6 py-4">Kategoriya</th>
                        <th class="px-6 py-4">Narxi</th>
                        <th class="px-6 py-4">TOP Maqomi</th>
                        <th class="px-6 py-4">Joylashuvi</th>
                        <th class="px-6 py-4">Joylangan sana</th>
                        <th class="px-6 py-4 text-right">Amallar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                    @forelse($products as $product)
                        <tr class="hover:bg-blue-50/40 transition-colors cursor-pointer" onclick="window.location.href='{{ route('products.show', $product->id) }}'">
                            <!-- ID -->
                            <td class="px-6 py-4 font-mono font-bold text-blue-600 text-xs">
                                #{{ $product->id }}
                            </td>

                            <!-- Product Name & Image -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @php
                                        $imgs = is_array($product->images) ? $product->images : json_decode($product->images, true);
                                        $firstImg = (!empty($imgs) && is_array($imgs)) ? $imgs[0] : null;
                                    @endphp
                                    @if($firstImg)
                                        <img src="{{ asset('storage/' . $firstImg) }}" alt="{{ $product->name }}" class="w-10 h-10 rounded-lg object-cover border border-gray-200 flex-shrink-0">
                                    @else
                                        <div class="w-10 h-10 rounded-lg bg-gray-100 text-gray-400 flex items-center justify-center text-xs flex-shrink-0">
                                            <i class="fa-solid fa-image"></i>
                                        </div>
                                    @endif
                                    <div class="min-w-0 max-w-xs">
                                        <a href="{{ route('products.show', $product->id) }}" class="font-bold text-[#061c3f] hover:text-blue-600 truncate block transition-colors">
                                            {{ $product->name ?? 'Nomsiz e\'lon' }}
                                        </a>
                                        <span class="text-xs text-gray-400 block truncate">
                                            {{ $product->rooms ? $product->rooms . ' xona | ' : '' }}{{ $product->square ? $product->square . ' m²' : '' }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <!-- Author (User) -->
                            <td class="px-6 py-4">
                                @if($product->user)
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-xs">
                                            {{ strtoupper(substr($product->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <span class="font-bold text-gray-900 block text-xs">{{ $product->user->name }}</span>
                                            <span class="text-[11px] text-gray-400 block">@&nbsp;{{ $product->user->username ?? 'user' }}</span>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400 italic">O'chirilgan foydalanuvchi</span>
                                @endif
                            </td>

                            <!-- Category & Subcategory -->
                            <td class="px-6 py-4">
                                <span class="font-semibold text-gray-800 text-xs block">
                                    {{ $product->category->name ?? 'Kategoriyasiz' }}
                                </span>
                                @if($product->subCategory)
                                    <span class="text-[11px] text-gray-400 block">
                                        {{ $product->subCategory->name }}
                                    </span>
                                @endif
                            </td>

                            <!-- Price -->
                            <td class="px-6 py-4">
                                <span class="font-black text-emerald-600 text-sm">
                                    ${{ number_format($product->price) }}
                                </span>
                            </td>

                            <!-- TOP Status Badge -->
                            <td class="px-6 py-4">
                                @if($product->is_top)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black bg-amber-500 text-white shadow-xs">
                                        <i class="fa-solid fa-crown text-[10px]"></i>
                                        <span>TOP da</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                        <i class="fa-regular fa-circle text-[9px]"></i>
                                        <span>Oddiy</span>
                                    </span>
                                @endif
                            </td>

                            <!-- Location (Region / District) -->
                            <td class="px-6 py-4 text-xs text-gray-600">
                                <span class="font-semibold block text-gray-800">{{ $product->region->name ?? '-' }}</span>
                                <span class="text-gray-400 block">{{ $product->city->name ?? '-' }}</span>
                            </td>

                            <!-- Created Date -->
                            <td class="px-6 py-4 text-xs text-gray-500 whitespace-nowrap">
                                {{ $product->created_at ? $product->created_at->format('d.m.Y H:i') : '-' }}
                            </td>

                            <!-- Action Buttons -->
                            <td class="px-6 py-4 text-right" onclick="event.stopPropagation()">
                                <div class="flex items-center justify-end gap-2">
                                    <!-- TOP Toggle Button -->
                                    <button type="button" 
                                            onclick="openDevTopModal({{ $product->id }}, {{ $product->is_top ? 'true' : 'false' }}, '{{ addslashes($product->name ?? 'E\'lon') }}')"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold transition-all shadow-2xs {{ $product->is_top ? 'bg-amber-100 text-amber-800 hover:bg-amber-200 border border-amber-300' : 'bg-gray-100 text-gray-700 hover:bg-amber-500 hover:text-white' }}">
                                        <i class="fa-solid fa-crown"></i>
                                        <span>{{ $product->is_top ? 'TOPdan olish' : 'TOPga chiqarish' }}</span>
                                    </button>

                                    <!-- View Button -->
                                    <a href="{{ route('products.show', $product->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white rounded-lg text-xs font-bold transition-all shadow-2xs">
                                        <i class="fa-solid fa-eye"></i>
                                        <span>Ko'rish</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <i class="fa-solid fa-building-circle-xmark text-4xl text-gray-300"></i>
                                    <p class="font-semibold text-gray-500">Hozircha hech qanday e'lon mavjud emas!</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Custom Developer TOP Confirmation Modal -->
<div id="devTopConfirmModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-xs hidden transition-opacity duration-300">
    <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-sm w-full mx-4 shadow-2xl border border-slate-100 transform transition-all text-center space-y-5" onclick="event.stopPropagation()">
        <!-- Icon -->
        <div class="w-16 h-16 rounded-full bg-amber-50 text-amber-500 flex items-center justify-center text-2xl mx-auto border border-amber-100 shadow-inner">
            <i class="fa-solid fa-crown"></i>
        </div>

        <!-- Text -->
        <div class="space-y-2">
            <h3 class="font-display font-black text-xl text-slate-900" id="devTopModalTitle">TOP Maqomi</h3>
            <p class="text-xs font-medium text-slate-500 leading-relaxed" id="devTopModalBody">
                Ushbu e'lonni TOP ga chiqarmoqchimisiz?
            </p>
        </div>

        <!-- Form Actions -->
        <form id="devTopConfirmForm" method="POST" action="" class="grid grid-cols-2 gap-3 pt-2">
            @csrf
            <button type="button" onclick="closeDevTopModal()" class="w-full py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold text-xs rounded-xl transition-all shadow-2xs">
                Bekor qilish
            </button>
            <button type="submit" id="devTopSubmitBtn" class="w-full py-3 px-4 bg-amber-500 hover:bg-amber-600 text-white font-extrabold text-xs rounded-xl transition-all shadow-md shadow-amber-500/20">
                Tasdiqlash
            </button>
        </form>
    </div>
</div>

<script>
    function openDevTopModal(productId, isTop, productName) {
        const modal = document.getElementById('devTopConfirmModal');
        const form = document.getElementById('devTopConfirmForm');
        const title = document.getElementById('devTopModalTitle');
        const body = document.getElementById('devTopModalBody');
        const submitBtn = document.getElementById('devTopSubmitBtn');

        form.action = `/developer/products/${productId}/toggle-top`;

        if (isTop) {
            title.innerText = 'TOPdan Olish';
            body.innerHTML = `Haqiqatdan ham <strong class="text-slate-900">"${productName}"</strong> e'lonini TOP ro'yxatidan olmoqchimisiz?`;
            submitBtn.innerText = 'Ha, olib tashlash';
            submitBtn.className = 'w-full py-3 px-4 bg-slate-800 hover:bg-slate-900 text-white font-extrabold text-xs rounded-xl transition-all shadow-md';
        } else {
            title.innerText = 'TOPga Chiqarish';
            body.innerHTML = `Haqiqatdan ham <strong class="text-slate-900">"${productName}"</strong> e'lonini TOP e'lonlar safiga qo'shmoqchimisiz?`;
            submitBtn.innerText = 'Ha, TOPga chiqarish';
            submitBtn.className = 'w-full py-3 px-4 bg-amber-500 hover:bg-amber-600 text-white font-extrabold text-xs rounded-xl transition-all shadow-md shadow-amber-500/20';
        }

        modal.classList.remove('hidden');
    }

    function closeDevTopModal() {
        const modal = document.getElementById('devTopConfirmModal');
        if (modal) {
            modal.classList.add('hidden');
        }
    }
</script>
@endsection

