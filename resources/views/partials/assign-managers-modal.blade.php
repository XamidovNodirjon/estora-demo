{{-- Uyni (product) menejerlarga biriktirish modali. Kerakli o'zgaruvchi: $managers --}}
<div id="assignManagersModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-[#061c3f]/40 backdrop-blur-sm transition-opacity">
    <div class="bg-white rounded-2xl p-6 shadow-2xl w-full max-w-md mx-4 transform scale-95 transition-transform duration-200">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-xl font-bold text-[#061c3f] flex items-center gap-2">
                <i class="fa-solid fa-user-tie text-[#0084ff]"></i> Menejerga biriktirish
            </h3>
            <button type="button" onclick="closeAssignManagersModal()" class="text-gray-400 hover:text-gray-700 transition-colors">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>
        <p id="assignManagersProductName" class="text-xs text-gray-400 mb-5"></p>

        <form id="assignManagersForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')  
            <div class="max-h-64 overflow-y-auto space-y-2 pr-1">
                @forelse($managers as $managerOption)
                    <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 bg-gray-50 hover:bg-blue-50/60 hover:border-blue-100 cursor-pointer transition-colors">
                        <input type="checkbox" name="manager_ids[]" value="{{ $managerOption->id }}" class="assign-manager-checkbox w-4 h-4 rounded text-[#0084ff] focus:ring-[#0084ff]">
                        <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">
                            {{ mb_strtoupper(mb_substr($managerOption->name ?? 'M', 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <span class="block text-sm font-semibold text-[#061c3f] truncate">{{ $managerOption->name }}</span>
                            <span class="block text-[11px] text-gray-400 truncate">{{ $managerOption->phone ?: $managerOption->email }}</span>
                        </div>
                    </label>
                @empty
                    <div class="py-8 text-center text-gray-400 text-sm">
                        <i class="fa-solid fa-user-slash text-2xl mb-2 block"></i>
                        Tizimda menejer roli bilan foydalanuvchi yo'q.
                    </div>
                @endforelse
            </div>

            <div class="pt-2 flex gap-3">
                <button type="button" onclick="closeAssignManagersModal()" class="flex-1 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold transition-colors">
                    Bekor qilish
                </button>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-[#0084ff] hover:bg-[#0076e5] text-white font-semibold shadow-lg hover:shadow-cyan-500/30 transition-all">
                    Saqlash
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAssignManagersModal(btn) {
        const assigned = JSON.parse(btn.dataset.managers || '[]').map(Number);
        document.getElementById('assignManagersForm').action = btn.dataset.action;
        document.getElementById('assignManagersProductName').textContent = btn.dataset.name || '';
        document.querySelectorAll('.assign-manager-checkbox').forEach(cb => {
            cb.checked = assigned.includes(Number(cb.value));
        });

        const modal = document.getElementById('assignManagersModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modal.firstElementChild.classList.remove('scale-95');
            modal.firstElementChild.classList.add('scale-100');
        }, 10);
    }

    function closeAssignManagersModal() {
        const modal = document.getElementById('assignManagersModal');
        modal.firstElementChild.classList.remove('scale-100');
        modal.firstElementChild.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 200);
    }
</script>
