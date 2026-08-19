<!-- MAIN HEADER (EXACT IMAGE 2) -->
<header class="main-header">
    <div class="container">
        <div class="header-content">
            <div class="logo-area">
                <a href="{{ url('/') }}" class="brand-logo-link">
                    <img src="{{ asset('images/logo-exact.png') }}" alt="Estora Real Estate" class="brand-logo-img">
                </a>
            </div>

            <div class="header-actions">
                <a href="{{ route('add.ad') }}" class="btn-add-ad">
                    <i class="fas fa-plus"></i>
                    <span>E'lon joylashtirish</span>
                </a>

                @auth
                    <a href="{{ route('dashboard') }}" class="btn-login">
                        <i class="fas fa-user-circle" style="color: #FF9800; font-size: 18px;"></i>
                        <span>Kabinet</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-login">
                        <i class="fas fa-user-circle" style="color: #FF9800; font-size: 18px;"></i>
                        <span>Login</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

<!-- DARK SUB NAV BAR (EXACT IMAGE 2) -->
<nav class="sub-navbar">
    <div class="container">
        <div class="sub-navbar-content">
            <ul class="nav-menu">
                @php
                    $currentTrans = request('transaction_type', 'Sotuv');
                @endphp
                <li>
                    <a href="{{ route('maniDashboard', ['transaction_type' => 'Sotuv']) }}" class="nav-item {{ $currentTrans == 'Sotuv' ? 'active' : '' }}">Sotuv</a>
                </li>
                <li>
                    <a href="{{ route('maniDashboard', ['transaction_type' => 'Ijara']) }}" class="nav-item {{ $currentTrans == 'Ijara' ? 'active' : '' }}">Ijara</a>
                </li>
                <li>
                    <a href="{{ route('maniDashboard', ['transaction_type' => 'Xonadosh']) }}" class="nav-item {{ $currentTrans == 'Xonadosh' ? 'active' : '' }}">Xonadosh</a>
                </li>
                <li>
                    <a href="{{ route('maniDashboard', ['transaction_type' => 'Tijorat']) }}" class="nav-item {{ $currentTrans == 'Tijorat' ? 'active' : '' }}">Tijorat</a>
                </li>
                <li>
                    <a href="{{ route('maniDashboard', ['transaction_type' => 'Dacha']) }}" class="nav-item {{ $currentTrans == 'Dacha' ? 'active' : '' }}">Dacha</a>
                </li>
                <li>
                    <a href="{{ route('maniDashboard', ['transaction_type' => 'Xalqaro']) }}" class="nav-item {{ $currentTrans == 'Xalqaro' ? 'active' : '' }}">Xalqaro</a>
                </li>
            </ul>

            <div class="nav-contacts">
                <span class="nav-contact-item">
                    <i class="far fa-envelope"></i>
                    <a href="mailto:info@estora.uz">info@estora.uz</a>
                </span>
                <span class="nav-contact-item">
                    <i class="fas fa-phone-alt"></i>
                    <a href="tel:+998951606446">+998 (95) 160 64 46</a>
                </span>
            </div>
        </div>
    </div>
</nav>
