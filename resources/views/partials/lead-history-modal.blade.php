{{-- Lid status tarixi modali. Har bir lid uchun partials.lead-status-history template'i sahifada bo'lishi kerak. --}}
<div id="leadHistoryModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-[#061c3f]/40 backdrop-blur-sm transition-opacity" onclick="if (event.target === this) closeLeadHistory()">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 transform scale-95 transition-transform duration-200 flex flex-col max-h-[85vh]">
        <div class="flex items-start justify-between gap-4 p-6 border-b border-gray-100">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-10 h-10 rounded-xl bg-[#0084ff]/10 text-[#0084ff] flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <div class="min-w-0">
                    <h3 class="text-lg font-bold text-[#061c3f]">Aloqa tarixi</h3>
                    <p id="leadHistoryName" class="text-xs text-gray-400 truncate"></p>
                </div>
            </div>
            <button type="button" onclick="closeLeadHistory()" class="text-gray-400 hover:text-gray-700 transition-colors">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>
        <div id="leadHistoryBody" class="p-6 overflow-y-auto"></div>
    </div>
</div>

<script>
    function openLeadHistory(leadId, leadName) {
        const template = document.getElementById(`lead-history-${leadId}`);
        const body = document.getElementById('leadHistoryBody');
        body.innerHTML = '';
        if (template) {
            body.appendChild(template.content.cloneNode(true));
        }
        document.getElementById('leadHistoryName').textContent = leadName || '';

        const modal = document.getElementById('leadHistoryModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modal.firstElementChild.classList.remove('scale-95');
            modal.firstElementChild.classList.add('scale-100');
        }, 10);
    }

    function closeLeadHistory() {
        const modal = document.getElementById('leadHistoryModal');
        modal.firstElementChild.classList.remove('scale-100');
        modal.firstElementChild.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 200);
    }
</script>
