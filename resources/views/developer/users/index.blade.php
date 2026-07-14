@extends('layouts.developer')

@section('title', 'Foydalanuvchilar Ro\'yxati')
@section('header_title', 'Foydalanuvchilar Boshqaruvi')

@section('content')
<div class="space-y-6">
    <!-- Header Card -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div>
            <h2 class="font-display font-bold text-xl text-[#061c3f]">Tizim Foydalanuvchilari</h2>
            <p class="text-xs text-gray-400 mt-1">Hozirda ro'yxatdan o'tgan barcha foydalanuvchilar ro'yxati</p>
        </div>
        <a href="{{ route('developer.users.create') }}" class="px-5 py-2.5 bg-[#0084ff] hover:bg-[#0076e5] text-white text-sm font-semibold rounded-xl flex items-center gap-2 shadow-lg shadow-blue-500/20 transition-all">
            <i class="fa-solid fa-user-plus"></i>
            <span>Yangi Foydalanuvchi</span>
        </a>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 font-semibold">
                        <th class="px-6 py-4">Ism sharif</th>
                        <th class="px-6 py-4">Username & Email</th>
                        <th class="px-6 py-4">Telefon</th>
                        <th class="px-6 py-4">Roli (Turi)</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Yaratilgan vaqti</th>
                        <th class="px-6 py-4 text-right">Amallar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-semibold text-[#061c3f]">{{ $user->name }}</td>
                            <td class="px-6 py-4">
                                <span class="block font-medium text-gray-800">@&nbsp;{{ $user->username }}</span>
                                <span class="block text-xs text-gray-400">{{ $user->email }}</span>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-600">{{ $user->phone ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    @php
                                        $roleName = $user->role->name ?? 'no role';
                                        $badgeClass = match($roleName) {
                                            'dev' => 'bg-purple-50 text-purple-700 border-purple-200',
                                            'admin' => 'bg-red-50 text-red-700 border-red-200',
                                            'manager' => 'bg-blue-50 text-blue-700 border-blue-200',
                                            'client' => 'bg-gray-100 text-gray-700 border-gray-200',
                                            default => 'bg-gray-50 text-gray-500 border-gray-100'
                                        };
                                    @endphp
                                    <span class="px-2.5 py-0.5 rounded-full border text-xs font-semibold {{ $badgeClass }}">
                                        {{ strtoupper($roleName) }}
                                    </span>
                                    <span class="text-xs text-gray-400">({{ $user->type }})</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($user->status === 1)
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
                            <td class="px-6 py-4 text-xs text-gray-400 font-medium">
                                {{ $user->created_at ? $user->created_at->format('d.m.Y H:i') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <button type="button"
                                        class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-all btn-edit-user"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-username="{{ $user->username }}"
                                        data-email="{{ $user->email }}"
                                        data-phone="{{ $user->phone }}"
                                        data-role-id="{{ $user->role_id }}"
                                        data-type="{{ $user->type }}"
                                        data-passport="{{ $user->passport }}"
                                        data-jshshir="{{ $user->jshshir }}"
                                        title="Tahrirlash">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    @if($user->id !== auth()->id())
                                        <button type="button"
                                            class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-all btn-delete-user"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}"
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
                                Foydalanuvchilar topilmadi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" class="fixed inset-0 z-[9999] flex items-center justify-center" style="display: none;">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-[#061c3f]/40 backdrop-blur-sm transition-opacity duration-300 opacity-0" id="editModalBackdrop" onclick="closeEditModal()"></div>
    
    <!-- Content -->
    <div class="bg-white rounded-2xl border border-gray-100 p-8 w-full max-w-2xl mx-4 relative z-10 shadow-2xl transition-all duration-300 transform scale-95 opacity-0" id="editModalContent">
        <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-6">
            <h3 class="font-display font-bold text-lg text-[#061c3f] flex items-center gap-2">
                <i class="fa-solid fa-user-pen text-[#ff9e0d]"></i> Foydalanuvchini tahrirlash
            </h3>
            <button type="button" class="w-8 h-8 rounded-lg bg-gray-50 hover:bg-gray-100 text-gray-400 hover:text-gray-600 flex items-center justify-center transition-all" onclick="closeEditModal()">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form id="editUserForm" action="" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Name & Username (Two columns) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="edit_name" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Ism sharif</label>
                    <input type="text" name="name" id="edit_name" required
                        class="block w-full px-4 py-2 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                        placeholder="Ali Valiyev">
                </div>
                <div>
                    <label for="edit_username" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Username</label>
                    <input type="text" name="username" id="edit_username" required
                        class="block w-full px-4 py-2 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                        placeholder="ali_valiyev">
                </div>
            </div>

            <!-- Email & Phone (Two columns) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="edit_email" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Email</label>
                    <input type="email" name="email" id="edit_email" required
                        class="block w-full px-4 py-2 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                        placeholder="example@mail.com">
                </div>
                <div>
                    <label for="edit_phone" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Telefon raqam (Ixtiyoriy)</label>
                    <input type="text" name="phone" id="edit_phone"
                        class="block w-full px-4 py-2 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                        placeholder="+998901234567">
                </div>
            </div>

            <!-- Role & Type (Two columns) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="edit_role_id" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tizim Roli</label>
                    <select name="role_id" id="edit_role_id" required
                        class="block w-full px-4 py-2 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                        <option value="">Rolni tanlang</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ strtoupper($role->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="edit_type" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Turi (Type)</label>
                    <select name="type" id="edit_type" required
                        class="block w-full px-4 py-2 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                        <option value="">Turini tanlang</option>
                        <option value="dev">Developer</option>
                        <option value="admin">Admin (Admin/Staff)</option>
                        <option value="manager">Manager (Admin/Staff)</option>
                        <option value="client">Client (Mijoz)</option>
                    </select>
                </div>
            </div>

            <!-- Passport & JSHSHIR (Two columns, optional) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="edit_passport" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Pasport</label>
                    <input type="text" name="passport" id="edit_passport"
                        class="block w-full px-4 py-2 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                        placeholder="AA1234567">
                </div>
                <div>
                    <label for="edit_jshshir" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">JShShIR</label>
                    <input type="text" name="jshshir" id="edit_jshshir"
                        class="block w-full px-4 py-2 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                        placeholder="14 xonali raqam">
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="edit_password" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Yangi parol (Ixtiyoriy)</label>
                <input type="password" name="password" id="edit_password"
                    class="block w-full px-4 py-2 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                    placeholder="Bo'sh qoldirilsa, eski parol o'zgarmaydi">
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4 mt-6">
                <button type="button" class="px-5 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-600 font-semibold text-sm rounded-xl transition-all" onclick="closeEditModal()">
                    Bekor qilish
                </button>
                <button type="submit" class="px-6 py-2.5 bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold text-sm rounded-xl shadow-lg shadow-blue-500/20 transition-all">
                    O'zgarishlarni saqlash
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete User Modal -->
<div id="deleteUserModal" class="fixed inset-0 z-[9999] flex items-center justify-center" style="display: none;">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-[#061c3f]/40 backdrop-blur-sm transition-opacity duration-300 opacity-0" id="deleteModalBackdrop" onclick="closeDeleteModal()"></div>
    
    <!-- Content -->
    <div class="bg-white rounded-2xl border border-gray-100 p-8 w-full max-w-md mx-4 relative z-10 shadow-2xl transition-all duration-300 transform scale-95 opacity-0" id="deleteModalContent">
        <div class="flex flex-col items-center text-center space-y-4">
            <div class="w-16 h-16 rounded-full bg-red-50 text-red-500 flex items-center justify-center text-2xl border border-red-100">
                <i class="fa-solid fa-trash-can"></i>
            </div>
            <div>
                <h3 class="font-display font-bold text-lg text-[#061c3f]">Foydalanuvchini o'chirish</h3>
                <p class="text-xs text-gray-400 mt-1" id="deleteWarningText">Haqiqatdan ham ushbu foydalanuvchini o'chirmoqchimisiz?</p>
            </div>
        </div>

        <form id="deleteUserForm" action="" method="POST" class="mt-6 flex items-center gap-3">
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
    // Edit Modal Logic
    function openEditModal(btn) {
        const modal = document.getElementById('editUserModal');
        const backdrop = document.getElementById('editModalBackdrop');
        const content = document.getElementById('editModalContent');
        const form = document.getElementById('editUserForm');

        // Fill form fields
        form.action = `/developer/users/${btn.dataset.id}`;
        document.getElementById('edit_name').value = btn.dataset.name;
        document.getElementById('edit_username').value = btn.dataset.username;
        document.getElementById('edit_email').value = btn.dataset.email;
        document.getElementById('edit_phone').value = btn.dataset.phone || '';
        document.getElementById('edit_role_id').value = btn.dataset.roleId;
        document.getElementById('edit_type').value = btn.dataset.type;
        document.getElementById('edit_passport').value = btn.dataset.passport || '';
        document.getElementById('edit_jshshir').value = btn.dataset.jshshir || '';
        document.getElementById('edit_password').value = '';

        // Open animation
        modal.style.display = 'flex';
        setTimeout(() => {
            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 20);
    }

    function closeEditModal() {
        const modal = document.getElementById('editUserModal');
        const backdrop = document.getElementById('editModalBackdrop');
        const content = document.getElementById('editModalContent');

        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    // Delete Modal Logic
    function openDeleteModal(btn) {
        const modal = document.getElementById('deleteUserModal');
        const backdrop = document.getElementById('deleteModalBackdrop');
        const content = document.getElementById('deleteModalContent');
        const form = document.getElementById('deleteUserForm');
        const text = document.getElementById('deleteWarningText');

        form.action = `/developer/users/${btn.dataset.id}`;
        text.innerHTML = `Haqiqatdan ham <strong>${btn.dataset.name}</strong> foydalanuvchisini tizimdan butunlay o'chirmoqchimisiz?`;

        modal.classList.remove('hidden');
        modal.style.display = 'flex';
        setTimeout(() => {
            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 20);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteUserModal');
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

    // Attach Event Listeners
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.btn-edit-user').forEach(btn => {
            btn.addEventListener('click', () => openEditModal(btn));
        });

        document.querySelectorAll('.btn-delete-user').forEach(btn => {
            btn.addEventListener('click', () => openDeleteModal(btn));
        });
    });
</script>
@endsection
