{{-- Kabinet menyusi: desktop sidebar va mobil drawer uchun umumiy --}}
@php
    $active = $active ?? request('section', 'home');
    $navUser = Auth::user();
    $navVerification = app(\App\Services\ProductService::class)->getVerificationStatus($navUser);
    $navUnread = $navUser->unreadNotifications->count();
    $sectionUrl = fn (string $section) => route('client.dashboard', ['section' => $section]);

    $mainItems = [
        ['key' => 'my_page',     'label' => 'Mening sahifam',    'icon' => 'fa-regular fa-circle-user', 'url' => route('users.show', $navUser->username ?? $navUser->id)],
        ['key' => 'my_products', 'label' => "E'lonlarim",        'icon' => 'fa-regular fa-folder-open'],
        ['key' => 'calendar',    'label' => 'Kalendar',          'icon' => 'fa-regular fa-calendar',    'soon' => true],
        ['key' => 'chats',       'label' => 'Suxbat',            'icon' => 'fa-regular fa-comment-dots'],
        ['key' => 'offers',      'label' => 'Takliflar',         'icon' => 'fa-solid fa-hand-holding-dollar'],
        ['key' => 'favorites',   'label' => 'Sevimlilar',        'icon' => 'fa-regular fa-heart'],
        ['key' => 'news',        'label' => 'Bildirishnomalar',  'icon' => 'fa-regular fa-bell',        'badge' => $navUnread],
        ['key' => 'account',     'label' => "Hisob ma'lumotlari", 'icon' => 'fa-regular fa-id-card',    'badge' => count($navVerification['missing_fields'] ?? [])],
        ['key' => 'stats',       'label' => 'Statistika',        'icon' => 'fa-solid fa-chart-line'],
    ];

    $toolItems = [
        ['key' => 'ai',           'label' => 'AI Agent',      'icon' => 'fa-solid fa-robot',               'soon' => true],
        ['key' => 'market',       'label' => 'Bozor tahlili', 'icon' => 'fa-solid fa-magnifying-glass-chart', 'soon' => true],
        ['key' => 'area',         'label' => 'Hudud tahlili', 'icon' => 'fa-solid fa-map-location-dot',    'soon' => true],
        ['key' => 'monetization', 'label' => 'Monetizatsiya', 'icon' => 'fa-solid fa-coins',               'soon' => true],
        ['key' => 'settings',     'label' => 'Sozlamalar',    'icon' => 'fa-solid fa-gear'],
        ['key' => 'support',      'label' => 'Yordam / Shikoyatlar', 'icon' => 'fa-solid fa-headset', 'onclick' => 'openSupportModal()'],
    ];
@endphp

<nav class="cabinet-nav">
    <a href="{{ $sectionUrl('home') }}" class="cabinet-nav-home {{ $active === 'home' ? 'is-active' : '' }}">
        <i class="fa-solid fa-house"></i>
        <span>Bosh sahifa</span>
    </a>

    @foreach([$mainItems, $toolItems] as $group)
        <div class="cabinet-nav-group">
            @foreach($group as $item)
                @php
                    $isActive = $active === $item['key'];
                    $classes = 'cabinet-nav-item' . ($isActive ? ' is-active' : '') . (!empty($item['soon']) ? ' is-soon' : '');
                @endphp

                @if(!empty($item['soon']))
                    <span class="{{ $classes }}" title="Tez orada">
                @elseif(!empty($item['onclick']))
                    <button type="button" onclick="{{ $item['onclick'] }}" class="{{ $classes }}">
                @else
                    <a href="{{ $item['url'] ?? $sectionUrl($item['key']) }}" class="{{ $classes }}">
                @endif

                    <i class="{{ $item['icon'] }} cabinet-nav-icon"></i>
                    <span class="cabinet-nav-label">{{ $item['label'] }}</span>

                    @if(!empty($item['soon']))
                        <span class="cabinet-soon-pill">Tez orada</span>
                    @elseif(!empty($item['badge']))
                        <span class="cabinet-nav-badge">{{ $item['badge'] }}</span>
                    @endif

                @if(!empty($item['soon']))
                    </span>
                @elseif(!empty($item['onclick']))
                    </button>
                @else
                    </a>
                @endif
            @endforeach
        </div>
    @endforeach
</nav>
