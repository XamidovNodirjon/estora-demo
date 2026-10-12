@extends('layouts.manager')

@section('title', 'Uylar')
@section('header_title', 'Uylar (Products)')

@section('content')
<div class="space-y-6">
    <!-- Header Card -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
        <div>
            <h2 class="font-display font-bold text-xl text-[#061c3f]">Mening uylarim</h2>
            <p class="text-xs text-gray-400 mt-1">Admin tomonidan biriktirilgan va o'zingiz qo'shgan uylar ro'yxati</p>
        </div>
        <a href="{{ route('manager.products.create') }}" class="px-5 py-2.5 bg-[#0084ff] hover:bg-[#0076e5] text-white text-sm font-semibold rounded-xl flex items-center gap-2 shadow-lg shadow-blue-500/20 transition-all">
            <i class="fa-solid fa-plus"></i>
            <span>Yangi Uy Qo'shish</span>
        </a>
    </div>

    <!-- Source Tabs -->
    <div class="flex flex-wrap items-center gap-2">
        @php
            $tabs = [
                null => ['label' => 'Barchasi', 'icon' => 'fa-layer-group', 'count' => null],
                'assigned' => ['label' => 'Admin biriktirgan', 'icon' => 'fa-house-circle-check', 'count' => $assignedCount],
                'own' => ['label' => "O'zim qo'shgan", 'icon' => 'fa-house-medical', 'count' => $ownCount],
            ];
        @endphp
        @foreach($tabs as $key => $tab)
            <a href="{{ route('manager.products', $key ? ['source' => $key] : []) }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold border transition-all {{ $source === ($key ?: null) ? 'bg-[#0084ff] text-white border-[#0084ff] shadow-md shadow-blue-500/20' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                <i class="fa-solid {{ $tab['icon'] }}"></i>
                <span>{{ $tab['label'] }}</span>
                @if(!is_null($tab['count']))
                    <span class="px-1.5 py-0.5 rounded-md text-[11px] {{ $source === $key ? 'bg-white/20' : 'bg-gray-100 text-gray-500' }}">{{ $tab['count'] }}</span>
                @endif
            </a>
        @endforeach
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 font-semibold">
                        <th class="px-6 py-4">Nomi / ID</th>
                        <th class="px-6 py-4">Kategoriya</th>
                        <th class="px-6 py-4">Manzil</th>
                        <th class="px-6 py-4">Narxi</th>
                        <th class="px-6 py-4">Manba</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Amallar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                    @forelse($products as $product)
                        @php($isOwn = (int) $product->user_id === (int) auth()->id())
                        <tr class="hover:bg-blue-50/40 transition-colors cursor-pointer" onclick="window.location.href='{{ route('products.show', $product->id) }}'">
                            <td class="px-6 py-4 font-semibold text-[#061c3f]">
                                <a href="{{ route('products.show', $product->id) }}" class="font-bold text-[#061c3f] hover:text-blue-600 block transition-colors">
                                    {{ $product->name }}
                                </a>
                                <span class="block text-xs text-blue-600 font-mono font-bold mt-0.5">ID: #{{ $product->id }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="block font-medium text-gray-800">{{ $product->category->name ?? '-' }}</span>
                                <span class="block text-xs text-gray-400">{{ $product->subCategory->name ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="block text-gray-800 font-medium">{{ $product->region->name ?? '-' }}</span>
                                <span class="block text-xs text-gray-400">{{ $product->city->name ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4 font-semibold text-emerald-600 whitespace-nowrap">
                                ${{ number_format($product->price, 0, '.', ' ') }}
                            </td>
                            <td class="px-6 py-4">
                                @if($isOwn)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-orange-50 text-[#e58d05] border border-orange-100 whitespace-nowrap">
                                        <i class="fa-solid fa-house-medical text-[10px]"></i>
                                        O'zim qo'shgan
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100 whitespace-nowrap">
                                        <i class="fa-solid fa-user-shield text-[10px]"></i>
                                        Admin biriktirgan
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($product->status === 'active')
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Faol
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-gray-50 text-gray-500 border border-gray-200 text-xs font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                        Nofaol
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right" onclick="event.stopPropagation()">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('products.show', $product->id) }}" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Batafsil ko'rish">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    @if($isOwn)
                                        <a href="{{ route('manager.products.edit', $product->id) }}" class="p-1.5 text-amber-600 hover:bg-amber-50 rounded-lg transition-all" title="Tahrirlash">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <button type="button"
                                            class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-all btn-delete-product"
                                            data-action="{{ route('manager.products.delete', $product->id) }}"
                                            data-name="{{ $product->name }}"
                                            title="O'chirish">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400 font-medium">
                                <i class="fa-regular fa-folder-open text-3xl mb-3 block"></i>
                                Hozircha uylar mavjud emas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Delete Product Modal -->
<div id="deleteProductModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-2xl p-6 shadow-2xl w-full max-w-md mx-4 transform scale-95 transition-transform duration-200">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-full bg-red-50 text-red-600 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-[#061c3f]">O'chirishni tasdiqlang</h3>
                <p id="deleteProductMessage" class="text-sm text-gray-500 mt-1">Ushbu uyni rostdan ham o'chirmoqchimisiz?</p>
            </div>
        </div>
        <form id="deleteProductForm" method="POST" class="flex gap-3 pt-2">
            @csrf
            @method('DELETE')
            <button type="button" onclick="closeDeleteProductModal()" class="flex-1 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold transition-colors">
                Bekor qilish
            </button>
            <button type="submit" class="flex-1 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold shadow-lg hover:shadow-red-500/30 transition-all">
                Ha, o'chirish
            </button>
        </form>
    </div>
</div>

<script>
    function closeDeleteProductModal() {
        const modal = document.getElementById('deleteProductModal');
        modal.firstElementChild.classList.remove('scale-100');
        modal.firstElementChild.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 200);
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-delete-product').forEach(btn => {
            btn.addEventListener('click', function () {
                document.getElementById('deleteProductForm').action = btn.dataset.action;
                document.getElementById('deleteProductMessage').textContent = `"${btn.dataset.name}" uyini rostdan ham o'chirmoqchimisiz?`;

                const modal = document.getElementById('deleteProductModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                setTimeout(() => {
                    modal.firstElementChild.classList.remove('scale-95');
                    modal.firstElementChild.classList.add('scale-100');
                }, 10);
            });
        });
    });
</script>
@endsection
