<!-- Auth Required Modal for Owner Phone Access -->
<div id="ownerAuthModal" class="owner-auth-modal-overlay" onclick="handleOwnerAuthModalBackdrop(event)" style="display: none;">
    <div class="owner-auth-modal-content">
        <button type="button" class="owner-auth-modal-close" onclick="closeOwnerAuthModal()" aria-label="Yopish">&times;</button>
        
        <div class="owner-auth-modal-icon">
            <i class="fas fa-user-shield"></i>
        </div>

        <h3 class="owner-auth-modal-title">Uy egasi telefon raqami</h3>
        
        <p class="owner-auth-modal-desc">
            Siz to'g'ridan-to'g'ri <strong>uy egasi (Owner)</strong> e'lonini ko'rmoqdasiz. Uy egalari bilan to'g'ridan-to'g'ri bog'lanish va xavfsiz muloqot qilish uchun tizimda ro'yxatdan o'tishingiz lozim.
        </p>

        <div class="owner-auth-modal-tip">
            <i class="fas fa-info-circle"></i>
            <span>Ro'yxatdan o'tish mutlaqo bepul va 1 daqiqa vaqt oladi! Maklerlar bilan esa ro'yxatdan o'tmasdan ham to'g'ridan-to'g'ri bog'lana olasiz.</span>
        </div>

        <div class="owner-auth-modal-actions">
            <a href="{{ route('register') }}" class="btn-owner-modal-register">
                <i class="fas fa-user-plus"></i>
                <span>Ro'yxatdan o'tish</span>
            </a>
            <a href="{{ route('login') }}" class="btn-owner-modal-login">
                <i class="fas fa-sign-in-alt"></i>
                <span>Mavjud hisobga kirish</span>
            </a>
        </div>
    </div>
</div>

<style>
.owner-auth-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(15, 23, 42, 0.7);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    z-index: 999999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
    animation: fadeInModal 0.2s ease-out;
}

.owner-auth-modal-content {
    background: #ffffff;
    border-radius: 20px;
    max-width: 460px;
    width: 100%;
    padding: 32px 28px;
    text-align: center;
    position: relative;
    box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.3);
    animation: slideUpModal 0.25s cubic-bezier(0.16, 1, 0.3, 1);
}

.owner-auth-modal-close {
    position: absolute;
    top: 16px;
    right: 18px;
    background: transparent;
    border: none;
    font-size: 26px;
    line-height: 1;
    color: #94a3b8;
    cursor: pointer;
    transition: color 0.15s;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.owner-auth-modal-close:hover {
    color: #1e293b;
    background: #f1f5f9;
}

.owner-auth-modal-icon {
    width: 68px;
    height: 68px;
    background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
    color: #2563eb;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    margin: 0 auto 20px;
    box-shadow: 0 8px 16px -4px rgba(37, 99, 235, 0.2);
}

.owner-auth-modal-title {
    font-size: 20px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 12px;
    line-height: 1.3;
}

.owner-auth-modal-desc {
    font-size: 14px;
    color: #475569;
    line-height: 1.6;
    margin-bottom: 18px;
}

.owner-auth-modal-tip {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 12px 14px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    text-align: left;
    margin-bottom: 24px;
    font-size: 12.5px;
    color: #64748b;
    line-height: 1.5;
}

.owner-auth-modal-tip i {
    color: #0284c7;
    margin-top: 2px;
    font-size: 14px;
    flex-shrink: 0;
}

.owner-auth-modal-actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.btn-owner-modal-register {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: #0084ff;
    color: #ffffff !important;
    text-decoration: none;
    font-weight: 700;
    font-size: 15px;
    padding: 13px 20px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 132, 255, 0.35);
    transition: all 0.15s ease;
}

.btn-owner-modal-register:hover {
    background: #0073e6;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(0, 132, 255, 0.45);
}

.btn-owner-modal-login {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: #f1f5f9;
    color: #334155 !important;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    padding: 12px 20px;
    border-radius: 12px;
    transition: all 0.15s ease;
}

.btn-owner-modal-login:hover {
    background: #e2e8f0;
    color: #0f172a !important;
}

@keyframes fadeInModal {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUpModal {
    from { opacity: 0; transform: translateY(16px) scale(0.97); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}
</style>

<script>
function openOwnerAuthModal() {
    const modal = document.getElementById('ownerAuthModal');
    if (modal) {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

function closeOwnerAuthModal() {
    const modal = document.getElementById('ownerAuthModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }
}

function handleOwnerAuthModalBackdrop(event) {
    if (event.target && event.target.id === 'ownerAuthModal') {
        closeOwnerAuthModal();
    }
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeOwnerAuthModal();
    }
});
</script>
