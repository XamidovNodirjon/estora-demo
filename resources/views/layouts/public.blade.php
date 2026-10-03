<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', "Estora Real Estate - O'zbekistondagi ko'chmas mulk platformasi")</title>
    <meta name="description" content="@yield('meta_description', 'Ko\'chmas mulkning yagona raqamli ekotizimi. Xonadonlar, hovlilar, ofislar va tijorat binolari oldi-sotdisi va ijarasi.')">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Estora Master Core Stylesheet (DRY / SOLID) -->
    <link rel="stylesheet" href="{{ asset('css/estora-core.css') }}?v={{ time() }}">

    @yield('styles')
</head>
<body>

    <!-- TOP BAR -->
    @include('partials.topbar')

    <!-- HEADER & CATEGORY NAVIGATION -->
    @include('partials.header')

    <!-- MAIN BODY CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER (Exact Design from Screenshot & PDFs) -->
    @include('partials.footer')

    <!-- INTERACTIVE MAP MODAL -->
    @include('partials.map-modal')

    <!-- Universal Favorite Toggle AJAX Script -->
    <script>
    function toggleFavorite(productId, event) {
        if (event) {
            event.preventDefault();
            event.stopPropagation();
        }

        fetch(`/favorites/toggle/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (response.status === 401) {
                window.location.href = "{{ route('login') }}";
                return null;
            }
            return response.json();
        })
        .then(data => {
            if (data && data.status) {
                const favButtons = document.querySelectorAll(`.fav-btn-${productId}`);
                favButtons.forEach(btn => {
                    if (data.status === 'added') {
                        btn.classList.add('active');
                        btn.innerHTML = '<i class="fas fa-heart" style="color: #ef4444;"></i>';
                    } else {
                        btn.classList.remove('active');
                        btn.innerHTML = '<i class="far fa-heart"></i>';
                    }
                });
            }
        })
        .catch(err => console.error('Favorite error:', err));
    }
    </script>

    @yield('scripts')
</body>
</html>
