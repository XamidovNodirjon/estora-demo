@extends('layouts.developer')

@section('title', 'Rollar Boshqaruvi')
@section('header_title', 'Rollar Boshqaruvi')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Roles List Card -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <h2 class="font-display font-bold text-lg text-[#061c3f]">Mavjud Rollar</h2>
            <p class="text-xs text-gray-400 mt-1">Tizimda ro'yxatdan o'tkazilgan barcha foydalanuvchi rollari</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 font-semibold">
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Rol nomi</th>
                            <th class="px-6 py-4">Foydalanuvchilar soni</th>
                            <th class="px-6 py-4">Yaratilgan vaqti</th>
                            <th class="px-6 py-4 text-right">Amallar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-700">
                        @forelse($roles as $role)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 font-bold text-gray-400">#&nbsp;{{ $role->id }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $badgeClass = match($role->name) {
                                            'dev' => 'bg-purple-50 text-purple-700 border-purple-200',
                                            'admin' => 'bg-red-50 text-red-700 border-red-200',
                                            'manager' => 'bg-blue-50 text-blue-700 border-blue-200',
                                            'client' => 'bg-gray-100 text-gray-700 border-gray-200',
                                            default => 'bg-gray-50 text-gray-500 border-gray-100'
                                        };
                                    @endphp
                                    <span class="px-3 py-1 rounded-full border text-xs font-semibold {{ $badgeClass }}">
                                        {{ strtoupper($role->name) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-800">
                                    {{ $role->users_count }} ta foydalanuvchi
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-400 font-medium">
                                    {{ $role->created_at ? $role->created_at->format('d.m.Y H:i') : '-' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button type="button" onclick="openEditModal({{ $role->id }}, '{{ addslashes($role->name) }}')" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Tahrirlash">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        @if($role->name !== 'dev')
                                            <button type="button" onclick="openDeleteModal('{{ route('developer.roles.delete', $role->id) }}', 'Haqiqatdan ham ushbu rolni o\'chirmoqchimisiz?')" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-all" title="O'chirish">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400 font-medium">
                                    <i class="fa-regular fa-folder-open text-3xl mb-3 block"></i>
                                    Rollar topilmadi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Role Card -->
    <div>
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm sticky top-24 space-y-6">
            <div>
                <h3 class="font-display font-bold text-lg text-[#061c3f] flex items-center gap-2">
                    <i class="fa-solid fa-folder-plus text-[#ff9e0d]"></i> Yangi Rol Yaratish
                </h3>
                <p class="text-xs text-gray-400 mt-1">Tizimga yangi foydalanish roli qo'shish formasi</p>
            </div>

            @if ($errors->any())
                <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800">
                    <ul class="list-disc list-inside text-xs space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('developer.roles.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Rol nomi (inglizcha, maxsus belgilarsiz)</label>
                    <input type="text" name="name" id="name" required value="{{ old('name') }}"
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                        placeholder="Masalan: agent, content_creator">
                    <span class="text-[10px] text-gray-400 mt-1 block">Faqat harflar, raqamlar va pastki chiziq (snake_case) tavsiya etiladi.</span>
                </div>

                <button type="submit" class="w-full py-3 px-4 rounded-xl bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold text-sm transition-all shadow-lg hover:shadow-cyan-500/20">
                    Rolni saqlash
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

    function openEditModal(id, currentName) {
        const form = document.getElementById('editForm');
        form.action = `/developer/roles/${id}`;
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
