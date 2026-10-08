@extends('layouts.public')

@section('title', "Aloqa - Estora Real Estate bilan bog'lanish")
@section('meta_description', "Estora ko'chmas mulk platformasi bilan bog'lanish. 24/7 yagona call-markaz, qo'shimcha telefon raqamlar, Telegram, Instagram va boshqa barcha aloqa vositalari.")

@section('styles')
<style>
/* ==========================================================================
   ESTORA CONTACT PAGE STYLES (Strictly follows Estora Design System)
   ========================================================================== */

.contact-page-wrapper {
    background-color: var(--bg-light);
    padding-bottom: 70px;
}

/* Hero & Breadcrumb Banner */
.contact-hero-banner {
    background: linear-gradient(135deg, #061c3f 0%, #002570 50%, #0038A8 100%);
    color: #ffffff;
    padding: 44px 0 54px 0;
    position: relative;
    overflow: hidden;
}

.contact-hero-banner::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 500px;
    height: 500px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(0, 132, 255, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
    pointer-events: none;
}

.contact-breadcrumbs {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: rgba(255, 255, 255, 0.7);
    margin-bottom: 16px;
}

.contact-breadcrumbs a {
    color: rgba(255, 255, 255, 0.85);
    transition: color var(--transition-speed);
}

.contact-breadcrumbs a:hover {
    color: var(--accent-orange);
}

.contact-breadcrumbs span.sep {
    color: rgba(255, 255, 255, 0.4);
}

.contact-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255, 158, 13, 0.18);
    border: 1px solid rgba(255, 158, 13, 0.4);
    color: #ffb74d;
    font-size: 11px;
    font-weight: 800;
    padding: 5px 12px;
    border-radius: 20px;
    letter-spacing: 0.7px;
    text-transform: uppercase;
    margin-bottom: 14px;
}

.contact-hero-title {
    font-family: var(--font-display);
    font-size: 38px;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 12px;
    color: #ffffff;
}

.contact-hero-desc {
    font-size: 16px;
    color: rgba(255, 255, 255, 0.85);
    max-width: 650px;
    line-height: 1.6;
    margin-bottom: 24px;
}

.contact-highlight-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

.contact-pill-item {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 13px;
    color: #ffffff;
}

.contact-pill-item i {
    color: var(--accent-orange);
}

/* Sections Common Header */
.contact-section-header {
    margin-bottom: 24px;
}

.contact-section-title {
    font-family: var(--font-display);
    font-size: 24px;
    font-weight: 800;
    color: var(--primary-navy);
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 6px;
}

.contact-section-title i {
    color: var(--accent-blue);
    font-size: 22px;
}

.contact-section-subtitle {
    font-size: 14px;
    color: var(--text-muted);
}

/* Phone Cards Grid */
.contact-phones-section {
    margin-top: -30px;
    position: relative;
    z-index: 20;
    margin-bottom: 50px;
}

.contact-phones-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.contact-phone-card {
    background: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 22px;
    box-shadow: 0 4px 16px rgba(6, 28, 63, 0.05);
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    overflow: hidden;
}

.contact-phone-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(6, 28, 63, 0.1);
    border-color: #cbd5e1;
}

.contact-phone-card.featured {
    border: 2px solid var(--accent-orange);
    background: linear-gradient(180deg, #ffffff 0%, #fffbf5 100%);
    box-shadow: 0 8px 24px rgba(255, 158, 13, 0.15);
}

.phone-card-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 16px;
}

.phone-card-icon-wrap {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    background: #eef6ff;
    color: var(--accent-blue);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.contact-phone-card.featured .phone-card-icon-wrap {
    background: #fff3e0;
    color: #e65100;
}

.phone-badge-tag {
    font-size: 11px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 4px;
    background: #f1f5f9;
    color: #475569;
}

.contact-phone-card.featured .phone-badge-tag {
    background: var(--accent-orange);
    color: #ffffff;
}

.phone-card-label {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-muted);
    margin-bottom: 4px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.phone-card-number {
    font-family: var(--font-display);
    font-size: 18px;
    font-weight: 800;
    color: var(--primary-navy);
    line-height: 1.3;
    margin-bottom: 6px;
    word-break: break-word;
}

.phone-card-desc {
    font-size: 13px;
    color: var(--text-muted);
    margin-bottom: 16px;
    min-height: 38px;
    line-height: 1.4;
}

.phone-card-actions {
    display: flex;
    gap: 8px;
    margin-top: auto;
}

.btn-phone-call {
    flex: 1;
    background-color: var(--primary-navy);
    color: #ffffff;
    font-size: 13px;
    font-weight: 700;
    padding: 9px 12px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: background-color var(--transition-speed);
}

.btn-phone-call:hover {
    background-color: var(--accent-blue);
    color: #ffffff;
}

.contact-phone-card.featured .btn-phone-call {
    background-color: var(--accent-orange);
}

.contact-phone-card.featured .btn-phone-call:hover {
    background-color: var(--accent-orange-hover);
}

.btn-phone-copy {
    width: 38px;
    height: 38px;
    border: 1px solid var(--border-color);
    background: #ffffff;
    color: #64748b;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all var(--transition-speed);
}

.btn-phone-copy:hover {
    background: #f1f5f9;
    color: var(--primary-navy);
    border-color: #cbd5e1;
}

/* Social Media & Messengers Hub */
.contact-social-section {
    margin-bottom: 50px;
}

.contact-social-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.social-hub-card {
    background: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 22px;
    display: flex;
    align-items: flex-start;
    gap: 16px;
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    text-decoration: none;
    color: inherit;
    position: relative;
    overflow: hidden;
}

.social-hub-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(6, 28, 63, 0.08);
    border-color: #cbd5e1;
}

.social-hub-icon-wrap {
    width: 52px;
    height: 52px;
    min-width: 52px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
}

.social-hub-info {
    flex: 1;
}

.social-hub-title-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 4px;
}

.social-hub-name {
    font-family: var(--font-display);
    font-size: 16px;
    font-weight: 700;
    color: var(--primary-navy);
}

.social-hub-badge {
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    padding: 2px 7px;
    border-radius: 4px;
    background: #f1f5f9;
    color: #475569;
}

.social-hub-username {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--accent-blue);
    margin-bottom: 6px;
    display: inline-block;
}

.social-hub-desc {
    font-size: 12.5px;
    color: var(--text-muted);
    line-height: 1.45;
}

.social-hub-arrow {
    margin-top: 10px;
    font-size: 12.5px;
    font-weight: 700;
    color: var(--primary-navy);
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: gap var(--transition-speed);
}

.social-hub-card:hover .social-hub-arrow {
    gap: 10px;
    color: var(--accent-blue);
}

/* Main Form & Office Info Layout */
.contact-main-grid {
    display: grid;
    grid-template-columns: 7fr 5fr;
    gap: 30px;
    margin-bottom: 50px;
}

/* Contact Form Card */
.contact-form-container {
    background: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 14px;
    padding: 34px;
    box-shadow: 0 6px 20px rgba(6, 28, 63, 0.04);
}

.contact-form-header {
    margin-bottom: 24px;
}

.contact-form-title {
    font-family: var(--font-display);
    font-size: 22px;
    font-weight: 800;
    color: var(--primary-navy);
    margin-bottom: 6px;
}

.contact-form-subtitle {
    font-size: 14px;
    color: var(--text-muted);
}

.contact-input-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
    margin-bottom: 18px;
}

.contact-field-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 18px;
}

.contact-field-group label {
    font-size: 13.5px;
    font-weight: 700;
    color: #334155;
    margin-bottom: 7px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.contact-field-group label span.req {
    color: var(--alert-red);
}

.contact-field-wrap {
    position: relative;
    display: flex;
    align-items: center;
}

.contact-field-icon {
    position: absolute;
    left: 14px;
    color: #94a3b8;
    font-size: 15px;
    pointer-events: none;
}

.contact-input, .contact-select, .contact-textarea {
    width: 100%;
    padding: 12px 14px 12px 42px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: 14px;
    color: var(--text-dark);
    background-color: #ffffff;
    transition: border-color var(--transition-speed), box-shadow var(--transition-speed);
}

.contact-input:focus, .contact-select:focus, .contact-textarea:focus {
    border-color: var(--accent-blue);
    box-shadow: 0 0 0 3px rgba(0, 132, 255, 0.15);
}

.contact-textarea {
    padding-top: 12px;
    resize: vertical;
    min-height: 120px;
}

.contact-field-group .contact-field-wrap.textarea-wrap .contact-field-icon {
    top: 14px;
}

.contact-submit-btn {
    background-color: var(--accent-orange);
    color: #ffffff;
    font-size: 15px;
    font-weight: 700;
    padding: 13px 28px;
    border-radius: 8px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    box-shadow: 0 4px 14px rgba(255, 158, 13, 0.3);
    transition: background-color var(--transition-speed), transform var(--transition-speed);
    width: 100%;
}

.contact-submit-btn:hover {
    background-color: var(--accent-orange-hover);
    transform: translateY(-1px);
}

.contact-submit-btn:disabled {
    opacity: 0.65;
    cursor: not-allowed;
    transform: none;
}

/* Success / Error Alerts */
.contact-alert-success {
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    color: #065f46;
    padding: 16px;
    border-radius: 8px;
    margin-bottom: 20px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.contact-alert-success i {
    font-size: 20px;
    color: #10b981;
    margin-top: 2px;
}

/* Office Details & Working Hours Side Card */
.contact-sidebar-wrap {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.contact-info-card {
    background: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 14px;
    padding: 26px;
    box-shadow: 0 4px 16px rgba(6, 28, 63, 0.04);
}

.contact-info-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 18px;
    padding-bottom: 14px;
    border-bottom: 1px solid #f1f5f9;
}

.contact-info-card-title {
    font-family: var(--font-display);
    font-size: 17px;
    font-weight: 800;
    color: var(--primary-navy);
    display: flex;
    align-items: center;
    gap: 8px;
}

.contact-status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #ecfdf5;
    color: #047857;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 12px;
}

.pulse-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #10b981;
    animation: pulseGlow 1.8s infinite;
}

@keyframes pulseGlow {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
}

.office-info-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.office-info-item {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}

.office-info-item-icon {
    width: 38px;
    height: 38px;
    min-width: 38px;
    border-radius: 8px;
    background: #f1f5f9;
    color: var(--primary-navy);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
}

.office-info-item-content h5 {
    font-size: 12.5px;
    font-weight: 700;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 2px;
}

.office-info-item-content p {
    font-size: 14px;
    font-weight: 600;
    color: var(--primary-navy);
    line-height: 1.45;
}

.office-info-item-content p.sub {
    font-size: 12.5px;
    color: var(--text-muted);
    font-weight: 400;
    margin-top: 2px;
}

/* Email Directory List */
.email-directory-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.email-dir-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 12px;
    border-radius: 8px;
    background: #f8fafc;
    border: 1px solid #f1f5f9;
    transition: background var(--transition-speed);
}

.email-dir-item:hover {
    background: #eef6ff;
    border-color: #cbd5e1;
}

.email-dir-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

.email-dir-left i {
    color: var(--accent-blue);
    font-size: 15px;
}

.email-dir-info h6 {
    font-size: 12px;
    color: var(--text-muted);
    font-weight: 600;
}

.email-dir-info a {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--primary-navy);
}

.email-dir-info a:hover {
    color: var(--accent-blue);
}

/* Interactive Map Card */
.contact-map-section {
    margin-bottom: 50px;
}

.contact-map-container {
    background: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 4px 18px rgba(6, 28, 63, 0.04);
}

.contact-map-header {
    padding: 20px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid var(--border-color);
    background: #ffffff;
}

.contact-map-actions {
    display: flex;
    gap: 10px;
}

.btn-map-external {
    font-size: 12.5px;
    font-weight: 700;
    padding: 7px 12px;
    border-radius: 6px;
    border: 1px solid #cbd5e1;
    background: #ffffff;
    color: var(--primary-navy);
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all var(--transition-speed);
}

.btn-map-external:hover {
    background: var(--primary-navy);
    color: #ffffff;
    border-color: var(--primary-navy);
}

#contactOfficeMap {
    height: 380px;
    width: 100%;
    z-index: 10;
}

/* FAQ Accordion Section */
.contact-faq-section {
    margin-bottom: 20px;
}

.contact-faq-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.contact-faq-item {
    background: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(6, 28, 63, 0.03);
    transition: border-color var(--transition-speed);
}

.contact-faq-item.active {
    border-color: var(--accent-blue);
}

.contact-faq-question {
    padding: 16px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    font-family: var(--font-display);
    font-size: 15px;
    font-weight: 700;
    color: var(--primary-navy);
    user-select: none;
}

.contact-faq-question i.faq-icon {
    font-size: 14px;
    color: #94a3b8;
    transition: transform 0.25s ease, color 0.25s ease;
}

.contact-faq-item.active .contact-faq-question i.faq-icon {
    transform: rotate(180deg);
    color: var(--accent-blue);
}

.contact-faq-answer {
    display: none;
    padding: 0 20px 18px 20px;
    font-size: 14px;
    color: #475569;
    line-height: 1.6;
    border-top: 1px solid #f1f5f9;
    padding-top: 14px;
}

.contact-faq-item.active .contact-faq-answer {
    display: block;
}

/* Toast Notification */
.contact-toast {
    position: fixed;
    bottom: 24px;
    right: 24px;
    background: #0f172a;
    color: #ffffff;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 13.5px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
    z-index: 99999;
    transform: translateY(100px);
    opacity: 0;
    transition: transform 0.3s ease, opacity 0.3s ease;
    pointer-events: none;
}

.contact-toast.show {
    transform: translateY(0);
    opacity: 1;
}

/* Responsive Breakpoints */
@media (max-width: 1024px) {
    .contact-phones-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .contact-social-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .contact-main-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 640px) {
    .contact-hero-banner {
        padding: 30px 0 40px 0;
    }
    .contact-hero-title {
        font-size: 28px;
    }
    .contact-phones-grid {
        grid-template-columns: 1fr;
    }
    .contact-social-grid {
        grid-template-columns: 1fr;
    }
    .contact-input-row {
        grid-template-columns: 1fr;
    }
    .contact-form-container {
        padding: 20px;
    }
    #contactOfficeMap {
        height: 280px;
    }
}
</style>
@endsection

@section('content')
<div class="contact-page-wrapper">

    <!-- 1. HERO BANNER & BREADCRUMBS -->
    <section class="contact-hero-banner">
        <div class="container">
            <!-- Breadcrumbs -->
            <nav class="contact-breadcrumbs" aria-label="Breadcrumb">
                <a href="{{ url('/') }}"><i class="fas fa-home"></i> Bosh sahifa</a>
                <span class="sep"><i class="fas fa-chevron-right" style="font-size: 10px;"></i></span>
                <span>Aloqa markazi</span>
            </nav>

            <span class="contact-badge-pill">
                <i class="fas fa-headset"></i> Yagona aloqa markazi
            </span>

            <h1 class="contact-hero-title">Biz bilan bog'laning</h1>
            
            <p class="contact-hero-desc">
                Savollaringiz bormi yoki ko'chmas mulk masalasida professional maslahat kerakmi?
                Estora mutaxassislari haftaning barcha kunlarida sizga yordam berishga tayyor.
            </p>

            <div class="contact-highlight-pills">
                <div class="contact-pill-item">
                    <i class="fas fa-phone-alt"></i>
                    <span>24/7 Bepul qo'ng'iroqlar</span>
                </div>
                <div class="contact-pill-item">
                    <i class="fab fa-telegram-plane"></i>
                    <span>Tezkor Telegram yordamchi</span>
                </div>
                <div class="contact-pill-item">
                    <i class="fas fa-clock"></i>
                    <span>O'rtacha javob vaqti: 10 daqiqa</span>
                </div>
                <div class="contact-pill-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Toshkent shahri, Amir Temur sh.k.</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. TELEFON RAQAMLARI BO'LIMI (GRID OF 4 CARDS) -->
    <section class="contact-phones-section">
        <div class="container">
            <div class="contact-phones-grid">
                @foreach($contactData['phones'] as $phone)
                    <div class="contact-phone-card {{ $phone['is_primary'] ? 'featured' : '' }}">
                        <div>
                            <div class="phone-card-top">
                                <div class="phone-card-icon-wrap">
                                    <i class="{{ $phone['icon'] }}"></i>
                                </div>
                                <span class="phone-badge-tag">{{ $phone['badge'] }}</span>
                            </div>

                            <div class="phone-card-label">{{ $phone['label'] }}</div>
                            <div class="phone-card-number">{{ $phone['number'] }}</div>
                            <div class="phone-card-desc">{{ $phone['desc'] }}</div>
                        </div>

                        <div class="phone-card-actions">
                            <a href="tel:{{ $phone['raw'] }}" class="btn-phone-call" title="Qo'ng'iroq qilish">
                                <i class="fas fa-phone"></i>
                                <span>Qo'ng'iroq</span>
                            </a>
                            <button type="button" 
                                    class="btn-phone-copy" 
                                    onclick="copyToClipboard('{{ $phone['number'] }}', 'Telefon raqami nusxalandi!')" 
                                    title="Raqamdan nusxa olish"
                                    aria-label="Raqamdan nusxa olish">
                                <i class="far fa-copy"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 3. IJTIMOIY TARMOQLAR VA MESSENJERLAR HUBI -->
    <section class="contact-social-section">
        <div class="container">
            <div class="contact-section-header">
                <h2 class="contact-section-title">
                    <i class="fas fa-comments"></i>
                    <span>Ijtimoiy tarmoqlar va messenjerlar</span>
                </h2>
                <p class="contact-section-subtitle">
                    O'zingizga qulay ijtimoiy tarmoq orqali yangiliklarni kuzating yoki to'g'ridan-to'g'ri mutaxassislarimizga murojaat qiling.
                </p>
            </div>

            <div class="contact-social-grid">
                @foreach($contactData['socials'] as $social)
                    <a href="{{ $social['url'] }}" target="_blank" rel="noopener" class="social-hub-card">
                        <div class="social-hub-icon-wrap" style="background-color: {{ $social['brand_color'] }};">
                            <i class="{{ $social['icon'] }}"></i>
                        </div>
                        <div class="social-hub-info">
                            <div class="social-hub-title-row">
                                <span class="social-hub-name">{{ $social['name'] }}</span>
                                <span class="social-hub-badge">{{ $social['badge'] }}</span>
                            </div>
                            <span class="social-hub-username">{{ $social['username'] }}</span>
                            <p class="social-hub-desc">{{ $social['description'] }}</p>
                            <span class="social-hub-arrow">
                                Bog'lanish <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 4. ONLAYN MUROJAAT QOLDIRISH & OFIS TARTIBI (2-COLUMN) -->
    <section class="container contact-main-grid">
        
        <!-- Left Column: Inquiry Form -->
        <div class="contact-form-container">
            <div class="contact-form-header">
                <h3 class="contact-form-title">
                    <i class="fas fa-paper-plane" style="color: var(--accent-orange); margin-right: 6px;"></i>
                    Onlayn murojaat qoldirish
                </h3>
                <p class="contact-form-subtitle">
                    Quyidagi formani to'ldiring. Mutaxassislarimiz tez orada siz bilan bog'lanib barcha savollaringizga javob berishadi.
                </p>
            </div>

            @if(session('contact_success'))
                <div class="contact-alert-success">
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <strong>Muvaffaqiyatli!</strong>
                        <p>{{ session('contact_success') }}</p>
                    </div>
                </div>
            @endif

            <!-- AJAX feedback container -->
            <div id="contactFormAlert" class="contact-alert-success" style="display: none;">
                <i class="fas fa-check-circle"></i>
                <div id="contactFormAlertMsg"></div>
            </div>

            <form id="contactPageForm" action="{{ route('contact.submit') }}" method="POST" onsubmit="handleContactSubmit(event)">
                @csrf

                <div class="contact-input-row">
                    <!-- Ism -->
                    <div class="contact-field-group">
                        <label for="contact_name">
                            Ismingiz
                        </label>
                        <div class="contact-field-wrap">
                            <i class="far fa-user contact-field-icon"></i>
                            <input type="text" 
                                   id="contact_name" 
                                   name="name" 
                                   value="{{ old('name', auth()->user()?->name) }}"
                                   placeholder="Masalan: Jamshid" 
                                   class="contact-input" 
                                   autocomplete="name">
                        </div>
                        @error('name')
                            <span style="color: var(--alert-red); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Telefon -->
                    <div class="contact-field-group">
                        <label for="contact_phone">
                            Telefon raqamingiz <span class="req">*</span>
                        </label>
                        <div class="contact-field-wrap">
                            <i class="fas fa-phone contact-field-icon"></i>
                            <input type="tel" 
                                   id="contact_phone" 
                                   name="phone" 
                                   required 
                                   value="{{ old('phone', auth()->user()?->phone) }}"
                                   placeholder="+998 (90) 123-45-67" 
                                   class="contact-input" 
                                   autocomplete="tel">
                        </div>
                        @error('phone')
                            <span style="color: var(--alert-red); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Murojaat yo'nalishi / Bo'lim -->
                <div class="contact-field-group">
                    <label for="contact_subject">
                        Murojaat yo'nalishi
                    </label>
                    <div class="contact-field-wrap">
                        <i class="fas fa-layer-group contact-field-icon"></i>
                        <select id="contact_subject" name="subject" class="contact-select">
                            <option value="">Yo'nalishni tanlang...</option>
                            @foreach($contactData['departments'] as $dept)
                                <option value="{{ $dept }}" {{ old('subject') == $dept ? 'selected' : '' }}>
                                    {{ $dept }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('subject')
                        <span style="color: var(--alert-red); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Xabar matni -->
                <div class="contact-field-group">
                    <label for="contact_message">
                        Xabar yoki savolingiz matni
                    </label>
                    <div class="contact-field-wrap textarea-wrap">
                        <i class="far fa-comment-dots contact-field-icon"></i>
                        <textarea id="contact_message" 
                                  name="message" 
                                  rows="4" 
                                  placeholder="Sizni qanday mulk, xizmat yoki hamkorlik masalasi qiziqtirmoqda? Yozib qoldiring..." 
                                  class="contact-textarea">{{ old('message') }}</textarea>
                    </div>
                    @error('message')
                        <span style="color: var(--alert-red); font-size: 12px; margin-top: 4px;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" id="contactSubmitBtn" class="contact-submit-btn">
                    <span id="contactSubmitBtnText">Murojaatni yuborish</span>
                    <i class="fas fa-paper-plane" id="contactSubmitBtnIcon"></i>
                </button>
            </form>
        </div>

        <!-- Right Column: Bosh ofis, Ish tartibi va Emaillar -->
        <div class="contact-sidebar-wrap">
            
            <!-- Ish tartibi Card -->
            <div class="contact-info-card">
                <div class="contact-info-card-header">
                    <div class="contact-info-card-title">
                        <i class="far fa-clock" style="color: var(--accent-orange);"></i>
                        <span>Ish tartibi</span>
                    </div>
                    <div class="contact-status-badge">
                        <span class="pulse-dot"></span>
                        <span>Call-center 24/7</span>
                    </div>
                </div>

                <div class="office-info-list">
                    <div class="office-info-item">
                        <div class="office-info-item-icon">
                            <i class="fas fa-building-user"></i>
                        </div>
                        <div class="office-info-item-content">
                            <h5>Bosh ofis qabuli</h5>
                            <p>{{ $contactData['company']['working_hours']['office'] }}</p>
                            <p class="sub">Yakshanba — dam olish kuni</p>
                        </div>
                    </div>

                    <div class="office-info-item">
                        <div class="office-info-item-icon">
                            <i class="fas fa-phone-volume" style="color: var(--accent-blue);"></i>
                        </div>
                        <div class="office-info-item-content">
                            <h5>Telefon orqali konsultatsiya</h5>
                            <p>{{ $contactData['company']['working_hours']['call_center'] }}</p>
                            <p class="sub">Barcha operatorlar uchun mutlaqo bepul</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Manzil Card -->
            <div class="contact-info-card">
                <div class="contact-info-card-header">
                    <div class="contact-info-card-title">
                        <i class="fas fa-map-pin" style="color: var(--alert-red);"></i>
                        <span>Bosh ofis manzili</span>
                    </div>
                </div>

                <div class="office-info-list">
                    <div class="office-info-item">
                        <div class="office-info-item-icon">
                            <i class="fas fa-location-dot"></i>
                        </div>
                        <div class="office-info-item-content">
                            <h5>Manzil</h5>
                            <p>{{ $contactData['company']['address'] }}</p>
                            <p class="sub">Mo'ljal: {{ $contactData['company']['landmark'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rasmiy E-mail pochta Card -->
            <div class="contact-info-card">
                <div class="contact-info-card-header">
                    <div class="contact-info-card-title">
                        <i class="far fa-envelope-open" style="color: var(--accent-blue);"></i>
                        <span>Elektron pochta manzillari</span>
                    </div>
                </div>

                <div class="email-directory-list">
                    @foreach($contactData['emails'] as $email)
                        <div class="email-dir-item">
                            <div class="email-dir-left">
                                <i class="{{ $email['icon'] }}"></i>
                                <div class="email-dir-info">
                                    <h6>{{ $email['label'] }}</h6>
                                    <a href="mailto:{{ $email['address'] }}">{{ $email['address'] }}</a>
                                </div>
                            </div>
                            <button type="button" 
                                    class="btn-phone-copy" 
                                    onclick="copyToClipboard('{{ $email['address'] }}', 'Elektron pochta nusxalandi!')" 
                                    title="Nusxa olish"
                                    aria-label="E-mail nusxa olish">
                                <i class="far fa-copy" style="font-size: 13px;"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <!-- 5. INTERAKTIV OFIS XARITASI (LEAFLET MAP) -->
    <section class="container contact-map-section">
        <div class="contact-map-container">
            <div class="contact-map-header">
                <div>
                    <h3 class="contact-form-title" style="margin-bottom: 2px;">
                        <i class="fas fa-map-marked-alt" style="color: var(--accent-blue); margin-right: 6px;"></i>
                        Ofisimiz joylashuvi
                    </h3>
                    <p class="contact-section-subtitle">
                        {{ $contactData['company']['address'] }}
                    </p>
                </div>
                <div class="contact-map-actions">
                    <a href="https://maps.google.com/?q={{ $contactData['company']['coords']['lat'] }},{{ $contactData['company']['coords']['lng'] }}" 
                       target="_blank" 
                       rel="noopener" 
                       class="btn-map-external">
                        <i class="fab fa-google"></i>
                        <span>Google Xarita</span>
                    </a>
                    <a href="https://yandex.com/maps/?pt={{ $contactData['company']['coords']['lng'] }},{{ $contactData['company']['coords']['lat'] }}&z=17&l=map" 
                       target="_blank" 
                       rel="noopener" 
                       class="btn-map-external">
                        <i class="fas fa-compass"></i>
                        <span>Yandex Xarita</span>
                    </a>
                </div>
            </div>

            <!-- Leaflet Map Container -->
            <div id="contactOfficeMap"></div>
        </div>
    </section>

    <!-- 6. KO'P SO'RALADIGAN SAVOLLAR (FAQ ACCORDION) -->
    <section class="container contact-faq-section">
        <div class="contact-section-header">
            <h2 class="contact-section-title">
                <i class="far fa-circle-question"></i>
                <span>Ko'p beriladigan savollar</span>
            </h2>
            <p class="contact-section-subtitle">
                Aloqa va xizmatlarimiz yuzasidan eng ommabop savollarga javoblar.
            </p>
        </div>

        <div class="contact-faq-list">
            @foreach($contactData['faqs'] as $index => $faq)
                <div class="contact-faq-item {{ $index === 0 ? 'active' : '' }}">
                    <div class="contact-faq-question" onclick="toggleFaq(this)">
                        <span>{{ $faq['q'] }}</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="contact-faq-answer">
                        <p>{{ $faq['a'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

</div>

<!-- Copied Toast Element -->
<div id="contactToast" class="contact-toast">
    <i class="fas fa-circle-check" style="color: #10b981;"></i>
    <span id="contactToastMsg">Nusxa olindi!</span>
</div>
@endsection

@section('scripts')
<script>
// Leaflet Map Initialization for Head Office
document.addEventListener('DOMContentLoaded', function() {
    const officeLat = {{ $contactData['company']['coords']['lat'] }};
    const officeLng = {{ $contactData['company']['coords']['lng'] }};

    const mapElement = document.getElementById('contactOfficeMap');
    if (mapElement && typeof L !== 'undefined') {
        const map = L.map('contactOfficeMap', {
            center: [officeLat, officeLng],
            zoom: 16,
            scrollWheelZoom: false
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors | Estora Real Estate',
            maxZoom: 19
        }).addTo(map);

        // Custom Branded Estora Pin
        const customPin = L.divIcon({
            className: 'custom-estora-pin',
            html: `
                <div style="
                    width: 44px;
                    height: 44px;
                    background: #0038A8;
                    border: 3px solid #ffffff;
                    border-radius: 50%;
                    box-shadow: 0 4px 15px rgba(0, 56, 168, 0.4);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #ffffff;
                    font-size: 18px;
                ">
                    <i class="fas fa-building"></i>
                </div>
            `,
            iconSize: [44, 44],
            iconAnchor: [22, 22],
            popupAnchor: [0, -26]
        });

        const marker = L.marker([officeLat, officeLng], { icon: customPin }).addTo(map);

        const popupContent = `
            <div style="font-family: 'Plus Jakarta Sans', sans-serif; padding: 4px; max-width: 240px;">
                <h4 style="margin: 0 0 4px 0; font-size: 14px; font-weight: 800; color: #061c3f;">Estora Global Bosh Ofisi</h4>
                <p style="margin: 0 0 8px 0; font-size: 12px; color: #475569; line-height: 1.4;">{{ $contactData['company']['address'] }}</p>
                <div style="display: flex; gap: 6px;">
                    <a href="tel:{{ $contactData['phones'][0]['raw'] }}" style="display: inline-block; background: #FF9800; color: #fff; font-size: 11px; font-weight: 700; padding: 4px 8px; border-radius: 4px; text-decoration: none;">
                        <i class="fas fa-phone"></i> Qo'ng'iroq
                    </a>
                </div>
            </div>
        `;

        marker.bindPopup(popupContent).openPopup();
    }
});

// FAQ Accordion Toggle
function toggleFaq(element) {
    const item = element.closest('.contact-faq-item');
    if (!item) return;

    const isActive = item.classList.contains('active');
    
    // Close other items
    document.querySelectorAll('.contact-faq-item').forEach(el => {
        el.classList.remove('active');
    });

    if (!isActive) {
        item.classList.add('active');
    }
}

// Copy to clipboard with toast notification
function copyToClipboard(text, customMessage) {
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(text).then(() => {
            showToast(customMessage || 'Nusxa olindi!');
        }).catch(() => {
            fallbackCopy(text, customMessage);
        });
    } else {
        fallbackCopy(text, customMessage);
    }
}

function fallbackCopy(text, customMessage) {
    const tempInput = document.createElement('input');
    tempInput.value = text;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);
    showToast(customMessage || 'Nusxa olindi!');
}

function showToast(message) {
    const toast = document.getElementById('contactToast');
    const msgSpan = document.getElementById('contactToastMsg');
    if (!toast || !msgSpan) return;

    msgSpan.textContent = message;
    toast.classList.add('show');

    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}

// Handle Contact Form AJAX Submission
async function handleContactSubmit(event) {
    event.preventDefault();

    const form = document.getElementById('contactPageForm');
    const submitBtn = document.getElementById('contactSubmitBtn');
    const submitBtnText = document.getElementById('contactSubmitBtnText');
    const alertBox = document.getElementById('contactFormAlert');
    const alertMsg = document.getElementById('contactFormAlertMsg');

    if (!form || !submitBtn) return;

    const phoneInput = document.getElementById('contact_phone');
    if (!phoneInput || !phoneInput.value.trim()) {
        showToast('Iltimos, telefon raqamingizni kiriting!');
        phoneInput?.focus();
        return;
    }

    // Button loading state
    submitBtn.disabled = true;
    if (submitBtnText) submitBtnText.textContent = 'Yuborilmoqda...';

    const formData = new FormData(form);

    try {
        const response = await fetch("{{ route('contact.submit') }}", {
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
            if (alertBox && alertMsg) {
                alertMsg.innerHTML = `<strong>Rahmat!</strong> ${data.message}`;
                alertBox.style.display = 'flex';
                alertBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
            showToast('Murojaatingiz qabul qilindi!');
        } else {
            const err = data.message || 'Xatolik yuz berdi. Iltimos, qayta urinib ko\'ring.';
            showToast(err);
        }
    } catch (err) {
        // Fallback: standard submission
        form.submit();
    } finally {
        submitBtn.disabled = false;
        if (submitBtnText) submitBtnText.textContent = 'Murojaatni yuborish';
    }
}
</script>
@endsection
