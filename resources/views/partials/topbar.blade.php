<!-- TOP BAR (IMAGE 2) -->
<div class="top-bar">
    <div class="container">
        <div class="top-bar-left">
            <div class="social-links">
                <a href="https://instagram.com" target="_blank" rel="noopener" class="social-icon-btn" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://facebook.com" target="_blank" rel="noopener" class="social-icon-btn" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://youtube.com" target="_blank" rel="noopener" class="social-icon-btn" title="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="https://t.me" target="_blank" rel="noopener" class="social-icon-btn" title="Telegram"><i class="fab fa-telegram-plane"></i></a>
                <a href="https://x.com" target="_blank" rel="noopener" class="social-icon-btn" title="X (Twitter)"><i class="fab fa-x-twitter"></i></a>
            </div>
        </div>
        
        <!-- Soft, eye-friendly test mode badge (Image 2) -->
        <div class="test-mode-badge desktop-center-badge" title="Tizim sinov rejimida ishlamoqda">
            <i class="fas fa-exclamation-triangle"></i>
            <span>The site works in test mode</span>
        </div>

        <div class="top-bar-right">
            <div class="top-bar-right-item">
                <i class="far fa-comment-dots" style="font-size: 16px;"></i>
            </div>
            <div class="top-bar-right-item">
                <i class="fas fa-language" style="font-size: 16px;"></i>
                <select aria-label="Tilni tanlang">
                    <option value="uz">O'zbekcha</option>
                    <option value="en">English</option>
                    <option value="ru">Русский</option>
                </select>
            </div>
            <div class="top-bar-right-item">
                <a href="{{ route('client.favorites') }}" style="color: inherit;" title="Saralanganlar">
                    <i class="far fa-heart" style="font-size: 16px;"></i>
                </a>
            </div>
            <div class="top-bar-right-item">
                <i class="fas fa-coins" style="font-size: 15px;"></i>
                <select style="font-weight: 700;" aria-label="Valyutani tanlang">
                    <option value="USD">USD</option>
                    <option value="UZS">UZS</option>
                    <option value="EUR">EUR</option>
                </select>
            </div>
        </div>
    </div>
</div>
