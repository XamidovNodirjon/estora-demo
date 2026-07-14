@extends('layouts.admin')

@section('title', 'Foydalanuvchi Qo\'shish')
@section('header_title', 'Foydalanuvchi Qo\'shish')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Header Card -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex items-center gap-4">
        <a href="{{ route('admin.users') }}" class="w-10 h-10 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-100 transition-all">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h2 class="font-display font-bold text-lg text-[#061c3f]">Yangi foydalanuvchi qo'shish</h2>
            <p class="text-xs text-gray-400">Tizim xodimi (hodim) yoki mijoz yaratish formasi</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-sm">
        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800">
                <ul class="list-disc list-inside text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name & Username (Two columns) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Ism sharif</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                        placeholder="Ali Valiyev">
                </div>
                <div>
                    <label for="username" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Foydalanuvchi nomi (Username) (Ixtiyoriy)</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}"
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                        placeholder="ali_valiyev">
                </div>
            </div>

            <!-- Email & Phone (Two columns) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Elektron pochta (Email)</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                        placeholder="example@mail.com">
                </div>
                <div>
                    <label for="phone" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Telefon raqam (Ixtiyoriy)</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                        placeholder="+998901234567">
                </div>
            </div>

            <!-- Role & Type (Two columns) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="role_id" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tizim Roli</label>
                    <select name="role_id" id="role_id" required
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                        <option value="">Rolni tanlang</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ strtoupper($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="type" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Turi (Type)</label>
                    <select name="type" id="type" required
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm">
                        <option value="">Turini tanlang</option>
                        <option value="admin" {{ old('type') == 'admin' ? 'selected' : '' }}>Admin (Staff)</option>
                        <option value="manager" {{ old('type') == 'manager' ? 'selected' : '' }}>Manager (Staff)</option>
                        <option value="client" {{ old('type') == 'client' ? 'selected' : '' }}>Client (Mijoz)</option>
                    </select>
                </div>
            </div>

            <!-- Passport & JSHSHIR (Two columns, optional) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="passport" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Pasport seriya va raqami</label>
                    <input type="text" name="passport" id="passport" value="{{ old('passport') }}"
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                        placeholder="AA1234567">
                </div>
                <div>
                    <label for="jshshir" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">JShShIR (14 xonali raqam)</label>
                    <input type="text" name="jshshir" id="jshshir" value="{{ old('jshshir') }}"
                        class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                        placeholder="14 xonali raqam">
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Kirish paroli</label>
                <input type="password" name="password" id="password" required
                    class="block w-full px-4 py-2.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#0084ff] focus:bg-white transition-all text-sm"
                    placeholder="Kamida 6 xonali parol">
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end gap-4 border-t border-gray-200 pt-6">
                <a href="{{ route('admin.users') }}" class="px-5 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-600 font-semibold text-sm rounded-xl transition-all">
                    Bekor qilish
                </a>
                <button type="submit" class="px-6 py-2.5 bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold text-sm rounded-xl shadow-lg shadow-blue-500/20 transition-all">
                    Saqlash (Yaratish)
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
