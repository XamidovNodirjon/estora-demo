@extends('layouts.admin')

@section('title', 'E\'lonlar')
@section('header_title', 'E\'lonlar Boshqaruvi')

@section('content')
<div class="space-y-6">
    <!-- Header Card -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
        <div>
            <h2 class="font-display font-bold text-xl text-[#061c3f]">Mavjud E'lonlar</h2>
            <p class="text-xs text-gray-400 mt-1">Tizimdagi ko'chmas mulk va boshqa e'lonlar ro'yxati</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="px-5 py-2.5 bg-[#0084ff] hover:bg-[#0076e5] text-white text-sm font-semibold rounded-xl flex items-center gap-2 shadow-lg shadow-blue-500/20 transition-all">
            <i class="fa-solid fa-plus"></i>
            <span>Yangi E'lon Qo'shish</span>
        </a>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 font-semibold">
                        <th class="px-6 py-4">Nomi</th>
                        <th class="px-6 py-4">Kategoriya</th>
                        <th class="px-6 py-4">Manzil</th>
                        <th class="px-6 py-4">Narxi</th>
                        <th class="px-6 py-4">Xona / Maydon</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Amallar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-semibold text-[#061c3f]">
                                <span class="block">{{ $product->name }}</span>
                                <span class="block text-xs text-gray-400 font-normal">ID: #{{ $product->id }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="block font-medium text-gray-800">{{ $product->category->name ?? '-' }}</span>
                                <span class="block text-xs text-gray-400">{{ $product->subCategory->name ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="block text-gray-800 font-medium">{{ $product->region->name ?? '-' }}</span>
                                <span class="block text-xs text-gray-400">{{ $product->city->name ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4 font-semibold text-emerald-600">
                                {{ number_format($product->price, 0, '.', ' ') }} UZS
                            </td>
                            <td class="px-6 py-4">
                                <span class="block text-gray-800 font-medium">{{ $product->rooms ?? '-' }} xonali</span>
                                <span class="block text-xs text-gray-400">{{ $product->square ?? '-' }} m²</span>
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
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Tahrirlash">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button type="button"
                                        class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-all btn-delete-product"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        title="O'chirish">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400 font-medium">
                                <i class="fa-regular fa-folder-open text-3xl mb-3 block"></i>
                                Hozircha e'lonlar mavjud emas.
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

<!-- Delete Product Modal -->
<div id="deleteProductModal" class="fixed inset-0 z-[9999] flex items-center justify-center" style="display: none;">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-[#061c3f]/40 backdrop-blur-sm transition-opacity duration-300 opacity-0" id="deleteModalBackdrop" onclick="closeDeleteModal()"></div>
    
    <!-- Content -->
    <div class="bg-white rounded-2xl border border-gray-100 p-8 w-full max-w-md mx-4 relative z-10 shadow-2xl transition-all duration-300 transform scale-95 opacity-0" id="deleteModalContent">
        <div class="flex flex-col items-center text-center space-y-4">
            <div class="w-16 h-16 rounded-full bg-red-50 text-red-500 flex items-center justify-center text-2xl border border-red-100">
                <i class="fa-solid fa-trash-can"></i>
            </div>
            <div>
                <h3 class="font-display font-bold text-lg text-[#061c3f]">E'lonni o'chirish</h3>
                <p class="text-xs text-gray-400 mt-1" id="deleteWarningText">Haqiqatdan ham ushbu e'lonni o'chirmoqchimisiz?</p>
            </div>
        </div>

        <form id="deleteProductForm" action="" method="POST" class="mt-6 flex items-center gap-3">
            @csrf
            @method('DELETE')
            <button type="button" class="flex-1 py-3 bg-gray-50 hover:bg-gray-100 text-gray-600 font-semibold text-sm rounded-xl transition-all border border-gray-200" onclick="closeDeleteModal()">
                Yo'q, bekor qilish
            </button>
            <button type="submit" class="flex-1 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold text-sm rounded-xl shadow-lg shadow-red-600/20 transition-all">
                Ha, o'chirilsin
            </button>
        </form>
    </div>
</div>

<script>
    // Delete Modal Logic
    function openDeleteModal(btn) {
        const modal = document.getElementById('deleteProductModal');
        const backdrop = document.getElementById('deleteModalBackdrop');
        const content = document.getElementById('deleteModalContent');
        const form = document.getElementById('deleteProductForm');
        const text = document.getElementById('deleteWarningText');

        form.action = `/admin/products/${btn.dataset.id}`;
        text.innerHTML = `Haqiqatdan ham <strong>${btn.dataset.name}</strong> e'lonini tizimdan butunlay o'chirmoqchimisiz?`;

        modal.style.display = 'flex';
        setTimeout(() => {
            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 20);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteProductModal');
        const backdrop = document.getElementById('deleteModalBackdrop');
        const content = document.getElementById('deleteModalContent');

        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.btn-delete-product').forEach(btn => {
            btn.addEventListener('click', () => openDeleteModal(btn));
        });
    });
</script>
@endsection
