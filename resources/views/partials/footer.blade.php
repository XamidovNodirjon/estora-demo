<!-- ESTORA FOOTER (1:1 PIXEL-PERFECT MATCHING IMAGE 3) -->
<footer class="footer-container-exact">
    <!-- Top Orange Links Strip -->
    <div class="footer-top-orange-strip">
        <div class="container">
            <ul class="footer-nav-links-exact">
                <li><a href="#about">Biz haqimizda</a></li>
                <li><a href="#services">Xizmatlar</a></li>
                <li><a href="#pricing">Narxlar</a></li>
                <li><a href="#guide">Qo'llanma</a></li>
                <li><a href="#terms">Ommaviy oferta</a></li>
                <li><a href="#partners">Hamkorlar</a></li>
                <li><a href="#contact">Aloqa</a></li>
            </ul>
        </div>
    </div>

    <!-- Main Royal Blue Gradient Body -->
    <div class="footer-royal-blue-body">
        <div class="container">
            <div class="footer-grid-exact">
                <!-- Left Column -->
                <div class="footer-left-exact">
                    <div class="footer-apps-row">
                        <a href="https://play.google.com" target="_blank" rel="noopener" class="app-btn-exact">
                            <i class="fab fa-google-play" style="font-size: 24px; color: #34d399;"></i>
                            <div style="display: flex; flex-direction: column; line-height: 1.1; text-align: left;">
                                <span style="font-size: 9px; text-transform: uppercase; opacity: 0.8;">GET IT ON</span>
                                <span style="font-size: 15px; font-weight: 700;">Google Play</span>
                            </div>
                        </a>
                        <a href="https://apple.com/app-store" target="_blank" rel="noopener" class="app-btn-exact">
                            <i class="fab fa-apple" style="font-size: 26px; color: #ffffff;"></i>
                            <div style="display: flex; flex-direction: column; line-height: 1.1; text-align: left;">
                                <span style="font-size: 9px; text-transform: uppercase; opacity: 0.8;">Download on the</span>
                                <span style="font-size: 15px; font-weight: 700;">App Store</span>
                            </div>
                        </a>
                    </div>

                    <div class="footer-company-text">
                        MCHJ "Estora Global", 2026 yy. Barcha huquqlar himoyalangan
                    </div>

                    <p class="footer-terms-text">
                        Saytdan foydalanish orqali <strong>Foydalanuvchi shartnomasi</strong> va <strong>Shaxsiy ma'lumotlarni qayta ishlash siyosati</strong> bilan rozilik bildirganingizni anglatadi.
                    </p>
                </div>

                <!-- Right Column -->
                <div class="footer-right-exact">
                    <span class="footer-toll-free-text">O'zbekiston bo'ylab barcha qo'ng'iroqlar bepul</span>
                    
                    <div class="footer-hotline-exact">
                        <div style="width: 38px; height: 38px; border: 2px solid #ffffff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 900;">
                            24
                        </div>
                        <a href="tel:+998951606446" class="footer-phone-big">+998 (95) 160 64-46</a>
                    </div>

                    <div class="footer-social-row-exact">
                        <a href="https://instagram.com" target="_blank" rel="noopener" class="footer-social-btn-exact" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://facebook.com" target="_blank" rel="noopener" class="footer-social-btn-exact" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://youtube.com" target="_blank" rel="noopener" class="footer-social-btn-exact" title="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="https://t.me" target="_blank" rel="noopener" class="footer-social-btn-exact" title="Telegram"><i class="fab fa-telegram-plane"></i></a>
                        <a href="https://x.com" target="_blank" rel="noopener" class="footer-social-btn-exact" title="X (Twitter)"><i class="fab fa-x-twitter"></i></a>
                    </div>
                </div>
            </div>

            <div class="footer-divider-line"></div>

            <p class="footer-disclaimer-full">
                © 2025 Estora — Barcha huquqlar himoyalangan. estora.uz saytida joylashtirilgan ma’lumotlardan foydalanish — jumladan, ularni namoyish etish, nusxa ko‘chirish, ko‘paytirish yoki tarqatish — faqatgina manbaga faol havola ko‘rsatilgan taqdirdagina ruxsat etiladi.
            </p>
        </div>
    </div>
</footer>

<!-- Floating Support Widget Button -->
<button type="button" onclick="openSupportModal()" class="support-widget-exact" title="Mijozlarni qo'llab-quvvatlash" aria-label="Murojaat qoldirish">
    <i class="fas fa-comment-dots" style="font-size: 16px;"></i>
    <span>Savollaringiz bormi? Biz aloqadamiz.</span>
</button>

<!-- Animated Support / Inquiry Modal -->
<div id="supportModalOverlay" class="support-modal-overlay" onclick="handleSupportBackdropClick(event)">
    <div class="support-modal-card" onclick="event.stopPropagation()">
        <!-- Header -->
        <div class="support-modal-header">
            <div class="support-modal-title-group">
                <div class="support-modal-icon-badge">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <div>
                    <h3 class="support-modal-title">Savollaringiz bormi?</h3>
                    <p class="support-modal-subtitle">Ma'lumotlaringizni qoldiring, mutaxassislarimiz tez orada siz bilan bog'lanishadi.</p>
                </div>
            </div>
            <button type="button" onclick="closeSupportModal()" class="btn-support-modal-close" title="Yopish" aria-label="Yopish">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Success Alert (Hidden by default) -->
        <div id="supportSuccessAlert" class="support-modal-success" style="display: none;">
            <div class="support-success-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <h4>Rahmat! Murojaatingiz qabul qilindi.</h4>
            <p>Mutaxassislarimiz tez orada siz qoldirgan telefon raqam orqali bog'lanishadi.</p>
            <button type="button" onclick="closeSupportModal()" class="btn-support-success-close">Tushunarli</button>
        </div>

        <!-- Form Body -->
        <form id="supportInquiryForm" onsubmit="submitSupportInquiry(event)" class="support-modal-form">
            @csrf
            <!-- Name Field -->
            <div class="support-form-field">
                <label for="inquiry_name">Ismingiz</label>
                <div class="support-input-wrap">
                    <i class="fa-regular fa-user support-input-icon"></i>
                    <input type="text" id="inquiry_name" name="name" placeholder="Masalan: Nodirbek" class="support-input" autocomplete="name">
                </div>
            </div>

            <!-- Phone Field -->
            <div class="support-form-field">
                <label for="inquiry_phone">Telefon raqamingiz <span class="required-star">*</span></label>
                <div class="support-input-wrap">
                    <i class="fa-solid fa-phone support-input-icon"></i>
                    <input type="tel" id="inquiry_phone" name="phone" required placeholder="+998 90 123 45 67" class="support-input" autocomplete="tel">
                </div>
            </div>

            <!-- Description Field -->
            <div class="support-form-field">
                <label for="inquiry_description">Savol yoki murojaatingiz matni</label>
                <div class="support-input-wrap">
                    <i class="fa-regular fa-comment-dots support-input-icon support-textarea-icon"></i>
                    <textarea id="inquiry_description" name="description" rows="3" placeholder="Sizni qanday mulk yoki xizmat qiziqtiryapti? Yozib qoldiring..." class="support-input support-textarea"></textarea>
                </div>
            </div>

            <!-- Error message container -->
            <div id="supportFormError" class="support-form-error" style="display: none;"></div>

            <!-- Action Buttons -->
            <div class="support-modal-actions">
                <button type="submit" id="supportSubmitBtn" class="btn-support-submit">
                    <span class="btn-text">Murojaatni yuborish</span>
                    <i class="fa-solid fa-paper-plane btn-icon"></i>
                </button>
            </div>

            <!-- Quick Direct Call -->
            <div class="support-direct-call">
                <span>yoki to'g'ridan-to'g'ri qo'ng'iroq qiling:</span>
                <a href="tel:+998951606446"><i class="fa-solid fa-phone"></i> +998 (95) 160 64-46</a>
            </div>
        </form>
    </div>
</div>

<script>
    function openSupportModal() {
        const overlay = document.getElementById('supportModalOverlay');
        const form = document.getElementById('supportInquiryForm');
        const successAlert = document.getElementById('supportSuccessAlert');
        const errorDiv = document.getElementById('supportFormError');

        if (errorDiv) errorDiv.style.display = 'none';
        if (form) form.style.display = 'flex';
        if (successAlert) successAlert.style.display = 'none';

        if (overlay) {
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                const phoneInput = document.getElementById('inquiry_phone');
                if (phoneInput) phoneInput.focus();
            }, 200);
        }
    }

    function closeSupportModal() {
        const overlay = document.getElementById('supportModalOverlay');
        if (overlay) {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    function handleSupportBackdropClick(e) {
        if (e.target.id === 'supportModalOverlay') {
            closeSupportModal();
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSupportModal();
        }
    });

    async function submitSupportInquiry(e) {
        e.preventDefault();

        const form = document.getElementById('supportInquiryForm');
        const submitBtn = document.getElementById('supportSubmitBtn');
        const errorDiv = document.getElementById('supportFormError');
        const successAlert = document.getElementById('supportSuccessAlert');
        const btnText = submitBtn ? submitBtn.querySelector('.btn-text') : null;

        if (!form) return;

        const phoneVal = form.phone ? form.phone.value.trim() : '';
        if (!phoneVal) {
            if (errorDiv) {
                errorDiv.textContent = 'Iltimos, telefon raqamingizni kiriting.';
                errorDiv.style.display = 'block';
            }
            return;
        }

        // Loading state
        if (submitBtn) {
            submitBtn.disabled = true;
            if (btnText) btnText.textContent = 'Yuborilmoqda...';
        }
        if (errorDiv) errorDiv.style.display = 'none';

        const formData = new FormData(form);

        try {
            const response = await fetch("{{ route('inquiries.store') }}", {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok && data.success) {
                form.reset();
                form.style.display = 'none';
                if (successAlert) {
                    successAlert.style.display = 'flex';
                }
            } else {
                if (errorDiv) {
                    errorDiv.textContent = data.message || 'Xatolik yuz berdi. Iltimos, qayta urinib ko\'ring.';
                    errorDiv.style.display = 'block';
                }
            }
        } catch (err) {
            // Fallback for non-ajax or standard post
            form.submit();
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
                if (btnText) btnText.textContent = 'Murojaatni yuborish';
            }
        }
    }
</script>
