@extends('layouts.developer')

@section('title', 'Infratuzilma Boshqaruvi')
@section('header_title', 'Infratuzilma Boshqaruvi')

@section('content')

@if (session('success'))
    <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-semibold">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm font-semibold">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800">
        <ul class="list-disc list-inside text-xs space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Metrolar qismi -->
<div class="mb-8">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg shadow-sm">
            <i class="fa-solid fa-train-subway"></i>
        </div>
        <div>
            <h2 class="font-display font-bold text-xl text-[#061c3f]">Metrolar</h2>
            <p class="text-xs text-gray-500">Tizimdagi barcha metro bekatlari</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Metro List -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Metro Nomi</th>
                            <th class="px-6 py-4 text-right">Harakatlar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm text-gray-700">
                        @forelse($metros as $metro)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 font-mono text-gray-500">#{{ $metro->id }}</td>
                                <td class="px-6 py-4 font-semibold text-[#061c3f]">{{ $metro->name }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Edit tugmasi (Modal uchun tayyorlangan) -->
                                        <button type="button" onclick="openEditModal('metro', {{ $metro->id }}, '{{ addslashes($metro->name) }}')" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Tahrirlash">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <!-- O'chirish tugmasi -->
                                        <button type="button" onclick="openDeleteModal('{{ route('developer.metros.delete', $metro->id) }}', 'Ushbu bekatni rostdan ham o\'chirmoqchimisiz?')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="O'chirish">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-400 font-medium">
                                    <i class="fa-solid fa-train-subway text-3xl mb-3 block"></i>
                                    Metrolar topilmadi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create Metro Form -->
        <div>
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                <h3 class="font-display font-bold text-lg text-[#061c3f] flex items-center gap-2 mb-4">
                    <i class="fa-solid fa-plus text-[#ff9e0d]"></i> Yangi Metro
                </h3>
                <form action="{{ route('developer.metros.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Metro Nomi</label>
                        <input type="text" name="name" required value="{{ old('name') }}"
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                            placeholder="Masalan: Chilonzor">
                    </div>
                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold text-sm transition-all shadow-lg hover:shadow-cyan-500/20">
                        Saqlash
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<hr class="border-gray-200 mb-8">

<!-- Universitetlar qismi -->
<div class="mb-8">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg shadow-sm">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <div>
            <h2 class="font-display font-bold text-xl text-[#061c3f]">Universitetlar</h2>
            <p class="text-xs text-gray-500">Tizimdagi barcha universitetlar</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- University List -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Universitet Nomi</th>
                            <th class="px-6 py-4 text-right">Harakatlar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm text-gray-700">
                        @forelse($universities as $university)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 font-mono text-gray-500">#{{ $university->id }}</td>
                                <td class="px-6 py-4 font-semibold text-[#061c3f]">{{ $university->name }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Edit tugmasi -->
                                        <button type="button" onclick="openEditModal('university', {{ $university->id }}, '{{ addslashes($university->name) }}')" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Tahrirlash">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <!-- O'chirish tugmasi -->
                                        <button type="button" onclick="openDeleteModal('{{ route('developer.universities.delete', $university->id) }}', 'Ushbu universitetni rostdan ham o\'chirmoqchimisiz?')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="O'chirish">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-400 font-medium">
                                    <i class="fa-solid fa-graduation-cap text-3xl mb-3 block"></i>
                                    Universitetlar topilmadi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create University Form -->
        <div>
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                <h3 class="font-display font-bold text-lg text-[#061c3f] flex items-center gap-2 mb-4">
                    <i class="fa-solid fa-plus text-[#ff9e0d]"></i> Yangi Universitet
                </h3>
                <form action="{{ route('developer.universities.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Universitet Nomi</label>
                        <input type="text" name="name" required value="{{ old('name') }}"
                            class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                            placeholder="Masalan: O'zMU">
                    </div>
                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold text-sm transition-all shadow-lg hover:shadow-cyan-500/20">
                        Saqlash
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODALS ================= -->

<!-- O'chirish (Delete) Modali -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-2xl p-6 shadow-2xl w-full max-w-sm mx-4 transform scale-95 transition-transform duration-200">
        <div class="flex items-center justify-center w-16 h-16 mx-auto bg-red-100 rounded-full mb-4 text-red-500 text-2xl">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <h3 class="text-xl font-bold text-center text-[#061c3f] mb-2">Tasdiqlang</h3>
        <p id="deleteModalMessage" class="text-sm text-center text-gray-500 mb-6">Ushbu elementni rostdan ham o'chirmoqchimisiz?</p>
        
        <form id="deleteForm" method="POST" class="flex gap-3">
            @csrf
            @method('DELETE')
            <button type="button" onclick="closeDeleteModal()" class="flex-1 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold transition-colors">
                Bekor qilish
            </button>
            <button type="submit" class="flex-1 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold shadow-lg hover:shadow-red-500/30 transition-all">
                Ha, o'chirish
            </button>
        </form>
    </div>
</div>

<!-- Tahrirlash (Edit) Modali -->
<div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-2xl p-6 shadow-2xl w-full max-w-md mx-4 transform scale-95 transition-transform duration-200">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-[#061c3f] flex items-center gap-2">
                <i class="fa-solid fa-pen-to-square text-[#0084ff]"></i> Tahrirlash
            </h3>
            <button type="button" onclick="closeEditModal()" class="text-gray-400 hover:text-gray-700 transition-colors">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>
        
        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Nomi</label>
                <input type="text" name="name" id="editNameInput" required
                    class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
            </div>
            
            <div class="pt-2 flex gap-3">
                <button type="button" onclick="closeEditModal()" class="flex-1 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold transition-colors">
                    Bekor qilish
                </button>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold shadow-lg hover:shadow-cyan-500/30 transition-all">
                    Saqlash
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal JS -->
<script>
    // Delete Modal Logic
    function openDeleteModal(url, message) {
        document.getElementById('deleteForm').action = url;
        if(message) document.getElementById('deleteModalMessage').textContent = message;
        
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modal.firstElementChild.classList.remove('scale-95');
            modal.firstElementChild.classList.add('scale-100');
        }, 10);
    }
    
    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.firstElementChild.classList.remove('scale-100');
        modal.firstElementChild.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 200);
    }

    // Edit Modal Logic
    function openEditModal(type, id, currentName) {
        const form = document.getElementById('editForm');
        
        if (type === 'metro') {
            form.action = `/developer/metros/${id}`;
        } else if (type === 'university') {
            form.action = `/developer/universities/${id}`;
        }
        
        document.getElementById('editNameInput').value = currentName;
        
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modal.firstElementChild.classList.remove('scale-95');
            modal.firstElementChild.classList.add('scale-100');
        }, 10);
    }
    
    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.firstElementChild.classList.remove('scale-100');
        modal.firstElementChild.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 200);
    }
</script>

@endsection
