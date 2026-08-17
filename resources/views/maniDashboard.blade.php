<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Estora - Ko'chmas mulkning yagona raqamli ekotizimi. Sotuv, ijara va boshqa xizmatlar.">
    <title>Estora Real Estate - Ko'chmas mulkning yagona raqamli ekotizimi</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Leaflet OpenStreetMap CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* CSS RESET & VARIABLES */
        :root {
            --primary-navy: #061c3f;
            --secondary-navy: #0B2240;
            --accent-blue: #0084ff;
            --accent-blue-hover: #0076e5;
            --accent-orange: #ff9e0d;
            --accent-orange-hover: #e58d05;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
            --bg-light: #f8f9fa;
            --bg-card: #ffffff;
            --border-color: #e5e7eb;
            --alert-red: #ef4444;
            --alert-bg: #fef2f2;
            --font-sans: 'Inter', sans-serif;
            --font-display: 'Outfit', sans-serif;
            --container-max: 1200px;
            --transition-speed: 0.3s;
        }

        html, body {
            max-width: 100vw !important;
            overflow-x: hidden !important;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        p, span, h1, h2, h3, h4, h5, h6, div {
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        img, video, iframe, canvas, svg {
            max-width: 100%;
            height: auto;
        }

        body {
            font-family: var(--font-sans);
            color: var(--text-dark);
            background-color: var(--bg-light);
            line-height: 1.5;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: color var(--transition-speed);
        }

        ul {
            list-style: none;
        }

        button, input, select {
            font-family: inherit;
            font-size: inherit;
            border: none;
            outline: none;
            background: none;
        }

        .container {
            width: 100%;
            max-width: var(--container-max);
            margin: 0 auto;
            padding: 0 20px;
        }

        /* TOP BAR */
        .top-bar {
            background-color: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 10px 0;
            font-size: 13px;
        }

        .top-bar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .social-links {
            display: flex;
            gap: 12px;
        }

        .social-links a {
            color: var(--accent-blue);
            font-size: 15px;
            transition: transform var(--transition-speed);
        }

        .social-links a:hover {
            transform: scale(1.15);
        }

        .test-mode-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            border: 1px solid var(--alert-red);
            background-color: var(--alert-bg);
            color: var(--alert-red);
            padding: 3px 10px;
            border-radius: 4px;
            font-weight: 500;
            animation: blink-warning 1.5s infinite;
        }

        .desktop-center-badge {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
        }

        @keyframes blink-warning {
            0%, 100% { background-color: var(--alert-bg); color: var(--alert-red); }
            50% { background-color: var(--alert-red); color: #ffffff; }
        }

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-bar-right-item {
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            color: var(--primary-navy);
            font-weight: 500;
            position: relative;
        }

        .top-bar-right-item i {
            color: var(--accent-blue);
        }

        .top-bar-right-item:hover {
            color: var(--accent-blue);
        }

        .top-bar-right-item select {
            cursor: pointer;
            font-weight: 500;
            color: var(--primary-navy);
        }

        .top-bar-right-item select:hover {
            color: var(--accent-blue);
        }

        /* HEADER */
        .main-header {
            background-color: #ffffff;
            padding: 15px 0;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .hamburger-menu {
            font-size: 24px;
            color: var(--primary-navy);
            cursor: pointer;
            display: flex;
            flex-direction: column;
            gap: 6px;
            justify-content: center;
        }

        .hamburger-menu span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: var(--primary-navy);
            border-radius: 2px;
            transition: all var(--transition-speed);
        }

        .logo-container {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            cursor: pointer;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }

        .logo-container:hover {
            opacity: 0.9;
            transform: scale(1.02);
        }

        .brand-logo-img {
            height: 44px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-add-ad {
            background-color: var(--accent-orange);
            color: #ffffff;
            font-weight: 600;
            padding: 10px 22px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: background-color var(--transition-speed), transform var(--transition-speed);
            box-shadow: 0 4px 6px rgba(255, 158, 13, 0.2);
        }

        .btn-add-ad:hover {
            background-color: var(--accent-orange-hover);
            transform: translateY(-2px);
        }

        .btn-login {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--primary-navy);
            font-weight: 600;
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 6px;
            transition: background-color var(--transition-speed);
        }

        .btn-login:hover {
            background-color: var(--bg-light);
            color: var(--accent-blue);
        }

        /* SUB NAV BAR */
        .sub-navbar {
            background-color: var(--primary-navy);
            color: #ffffff;
            font-size: 14px;
        }

        .sub-navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 50px;
        }

        .nav-menu {
            display: flex;
            height: 100%;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 0 20px;
            height: 100%;
            font-weight: 500;
            position: relative;
            transition: background-color var(--transition-speed);
        }

        .nav-item.active {
            background-color: var(--accent-blue);
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-item.active:hover {
            background-color: var(--accent-blue-hover);
        }

        .nav-contacts {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.8);
        }

        .nav-contact-item i {
            color: var(--accent-blue);
        }

        .nav-contact-item a:hover {
            color: #ffffff;
        }

        /* HERO SECTION */
        .hero-section {
            background: linear-gradient(rgba(6, 28, 63, 0.4), rgba(6, 28, 63, 0.4)), url('/images/hero.png') no-repeat center center/cover;
            padding: 80px 0 100px 0;
            position: relative;
        }

        .hero-content {
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 2;
        }

        .hero-left-card {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 12px;
            max-width: 550px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            margin-bottom: 40px;
        }

        .hero-badge {
            background-color: var(--primary-navy);
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 15px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .hero-title {
            font-family: var(--font-display);
            font-size: 44px;
            font-weight: 800;
            color: var(--primary-navy);
            line-height: 1.2;
            margin-bottom: 25px;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
        }

        .btn-hero-dark {
            background-color: var(--primary-navy);
            color: #ffffff;
            font-weight: 700;
            padding: 12px 25px;
            border-radius: 6px;
            font-size: 14px;
            text-align: center;
            flex: 1;
            transition: background-color var(--transition-speed);
        }

        .btn-hero-dark:hover {
            background-color: var(--secondary-navy);
        }

        .btn-hero-blue {
            background-color: var(--accent-blue);
            color: #ffffff;
            font-weight: 700;
            padding: 12px 25px;
            border-radius: 6px;
            font-size: 14px;
            text-align: center;
            flex: 1;
            transition: background-color var(--transition-speed);
        }

        .btn-hero-blue:hover {
            background-color: var(--accent-blue-hover);
        }

        /* FILTER FORM */
        .filter-container {
            width: 100%;
            margin-top: 20px;
        }

        .filter-tabs {
            display: flex;
            gap: 5px;
            margin-bottom: -1px;
            position: relative;
            z-index: 3;
        }

        .filter-tab {
            color: #ffffff;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 8px 8px 0 0;
            cursor: pointer;
            transition: background-color var(--transition-speed);
            font-size: 14px;
        }

        .filter-tab.active {
            background-color: #ffffff;
            color: var(--primary-navy);
        }

        .filter-tab:not(.active):hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .filter-box {
            background-color: #ffffff;
            border-radius: 0 8px 8px 8px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            display: grid;
            grid-template-columns: repeat(4, 1fr) auto auto;
            gap: 15px;
            align-items: end;
        }

        .filter-field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .filter-field label {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 600;
        }

        .filter-select-wrapper {
            position: relative;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background-color: var(--bg-light);
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .filter-select-wrapper select {
            width: 100%;
            border: none;
            background: transparent;
            font-weight: 600;
            color: var(--primary-navy);
            appearance: none;
            cursor: pointer;
        }

        .filter-select-wrapper i {
            color: var(--accent-blue);
            pointer-events: none;
            margin-left: 5px;
        }

        .btn-filter-settings {
            background-color: transparent;
            border: 2px solid var(--accent-blue);
            color: var(--accent-blue);
            font-weight: 700;
            padding: 11px 20px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            height: 44px;
            transition: background-color var(--transition-speed), color var(--transition-speed);
        }

        .btn-filter-settings:hover {
            background-color: var(--accent-blue);
            color: #ffffff;
        }

        .btn-filter-search {
            background-color: var(--secondary-navy);
            color: #ffffff;
            font-weight: 700;
            padding: 11px 25px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            height: 44px;
            transition: background-color var(--transition-speed);
        }

        .btn-filter-search:hover {
            background-color: var(--primary-navy);
        }

        .map-trigger-container {
            display: flex;
            justify-content: center;
            margin-top: 25px;
        }

        .btn-view-map {
            background-color: var(--accent-orange);
            color: #ffffff;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(255, 158, 13, 0.3);
            transition: background-color var(--transition-speed), transform var(--transition-speed);
        }

        .btn-view-map:hover {
            background-color: var(--accent-orange-hover);
            transform: translateY(-2px);
        }

        /* TICKER BANNER */
        .ticker-banner {
            background-color: var(--accent-blue);
            color: #ffffff;
            padding: 12px 0;
            font-weight: 600;
            overflow: hidden;
            white-space: nowrap;
        }

        .ticker-content {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            animation: ticker-slide 30s linear infinite;
        }

        .ticker-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
        }

        .ticker-separator {
            opacity: 0.5;
        }

        /* LISTINGS SECTION */
        .listings-section {
            padding: 60px 0;
            background-color: #ffffff;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 35px;
        }

        .section-title-area {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .section-title {
            font-family: var(--font-display);
            font-size: 32px;
            font-weight: 800;
            color: var(--primary-navy);
        }

        .section-subtitle {
            font-size: 15px;
            color: var(--text-muted);
        }

        .slider-controls {
            display: flex;
            gap: 10px;
        }

        .btn-slider {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 2px solid var(--accent-orange);
            color: var(--accent-orange);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color var(--transition-speed), color var(--transition-speed);
            font-size: 18px;
        }

        .btn-slider:hover {
            background-color: var(--accent-orange);
            color: #ffffff;
        }

        .listings-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .listing-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            overflow: hidden;
            transition: transform var(--transition-speed), box-shadow var(--transition-speed);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .listing-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        .listing-img-wrapper {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .listing-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform var(--transition-speed);
        }

        .listing-card:hover .listing-img-wrapper img {
            transform: scale(1.05);
        }

        .badge-top {
            position: absolute;
            top: 12px;
            left: 12px;
            background-color: var(--accent-orange);
            color: #ffffff;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 4px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .btn-favorite {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.8);
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color var(--transition-speed), color var(--transition-speed);
        }

        .btn-favorite:hover {
            background-color: #ffffff;
            color: var(--alert-red);
        }

        .badge-promo {
            position: absolute;
            bottom: 12px;
            left: 12px;
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 4px;
        }

        .badge-promo.yaxshi-taklif {
            background-color: var(--accent-orange);
        }

        .badge-promo.zudlik-bilan {
            background-color: var(--alert-red);
        }

        .badge-promo.super-narx {
            background-color: #2e7d32;
        }

        .listing-details {
            padding: 15px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .listing-header-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }

        .listing-price {
            font-family: var(--font-display);
            font-size: 20px;
            font-weight: 700;
            color: var(--accent-orange);
        }

        .listing-date {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 5px;
        }

        .listing-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary-navy);
            margin-bottom: 5px;
        }

        .listing-location {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 36px;
        }

        .listing-rating {
            display: flex;
            gap: 2px;
            color: #ffc107;
            font-size: 11px;
            margin-bottom: 15px;
        }

        .listing-specs {
            display: flex;
            justify-content: space-between;
            border-top: 1px solid var(--border-color);
            padding-top: 12px;
            margin-bottom: 12px;
        }

        .spec-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            color: var(--primary-navy);
        }

        .spec-item i {
            color: var(--accent-blue);
            font-size: 14px;
        }

        .listing-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            border-top: 1px dashed var(--border-color);
            padding-top: 10px;
        }

        .listing-tag {
            font-size: 11px;
            background-color: var(--bg-light);
            color: var(--primary-navy);
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .listing-tag i {
            font-size: 10px;
        }

        .listing-tag.metro i {
            color: var(--accent-blue);
        }

        .listing-tag.repair i {
            color: var(--accent-orange);
        }

        /* ANALYTICS SECTION */
        .analytics-section {
            padding: 80px 0;
            background-color: var(--bg-light);
        }

        .analytics-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .analytics-left {
            display: flex;
            flex-direction: column;
        }

        .analytics-features {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin: 30px 0;
        }

        .analytics-feature-item {
            display: flex;
            gap: 15px;
        }

        .feature-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 20px;
            flex-shrink: 0;
        }

        .feature-icon-box.blue { background-color: rgba(0, 132, 255, 0.15); color: var(--accent-blue); }
        .feature-icon-box.green { background-color: rgba(46, 125, 50, 0.15); color: #2e7d32; }
        .feature-icon-box.orange { background-color: rgba(255, 158, 13, 0.15); color: var(--accent-orange); }
        .feature-icon-box.purple { background-color: rgba(156, 39, 176, 0.15); color: #9c27b0; }

        .feature-text-box {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .feature-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary-navy);
        }

        .feature-desc {
            font-size: 13.5px;
            color: var(--text-muted);
        }

        .btn-analytics-action {
            background-color: var(--accent-blue);
            color: #ffffff;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            align-self: flex-start;
            box-shadow: 0 4px 8px rgba(0, 132, 255, 0.2);
            transition: background-color var(--transition-speed), transform var(--transition-speed);
        }

        .btn-analytics-action:hover {
            background-color: var(--accent-blue-hover);
            transform: translateY(-2px);
        }

        .analytics-right-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .map-header {
            display: flex;
            justify-content: flex-end;
        }

        .map-select-wrapper {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 6px 12px;
            display: flex;
            align-items: center;
            font-size: 13px;
            font-weight: 600;
            color: var(--primary-navy);
            gap: 5px;
        }

        .map-select-wrapper select {
            font-weight: 600;
            color: var(--primary-navy);
        }

        /* SVG Map Styling */
        .svg-map-container {
            width: 100%;
            height: 250px;
            background-color: #f1f5f9;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
        }

        .tashkent-map-svg {
            width: 100%;
            height: 100%;
        }

        .map-district {
            transition: fill 0.3s, stroke-width 0.3s;
            cursor: pointer;
        }

        .map-district:hover {
            fill: #b3d7ff !important;
            stroke-width: 3px;
        }

        .map-marker {
            cursor: pointer;
            transition: transform 0.3s;
        }

        .map-marker:hover {
            transform: scale(1.3);
        }

        .map-pulse {
            animation: pulse-ring 1.5s cubic-bezier(0.215, 0.610, 0.355, 1) infinite;
        }

        /* Stats grid under map */
        .map-stats-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 20px;
            border-top: 1px solid var(--border-color);
            padding-top: 20px;
        }

        .stat-block {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .stat-block-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-block-title {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-change-tag {
            font-size: 11px;
            font-weight: 700;
            color: #2e7d32;
            background-color: #e8f5e9;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .stat-meta-text {
            font-size: 12px;
            color: var(--text-muted);
        }

        .sparkline-container {
            width: 100%;
            height: 50px;
            margin-top: 10px;
        }

        .expensive-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 5px;
        }

        .expensive-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            font-weight: 600;
        }

        .expensive-item-left {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .expensive-num {
            color: var(--text-muted);
            font-size: 11px;
        }

        .expensive-name {
            color: var(--primary-navy);
        }

        .expensive-val {
            color: var(--primary-navy);
            font-weight: 700;
        }

        /* EXTRA SERVICES SECTION */
        .services-section {
            padding: 80px 0;
            background-color: #ffffff;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            margin-top: 30px;
        }

        .service-card {
            border: 1px solid var(--border-color);
            background-color: var(--bg-card);
            border-radius: 8px;
            padding: 25px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            cursor: pointer;
            transition: transform var(--transition-speed), border-color var(--transition-speed), box-shadow var(--transition-speed);
        }

        .service-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-blue);
            box-shadow: 0 10px 20px rgba(0, 132, 255, 0.06);
        }

        .service-icon-box {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--bg-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-blue);
            font-size: 24px;
            margin-bottom: 20px;
            transition: background-color var(--transition-speed), color var(--transition-speed);
        }

        .service-card:hover .service-icon-box {
            background-color: var(--accent-blue);
            color: #ffffff;
        }

        .service-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary-navy);
            margin-bottom: 4px;
        }

        .service-desc {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 20px;
            line-height: 1.4;
        }

        .service-arrow {
            color: var(--accent-blue);
            font-size: 16px;
            margin-top: auto;
            transition: transform var(--transition-speed);
        }

        .service-card:hover .service-arrow {
            transform: translateX(4px);
        }

        .section-header-badge {
            background-color: rgba(0, 132, 255, 0.1);
            color: var(--accent-blue);
            font-size: 11px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 4px;
            text-transform: uppercase;
            align-self: flex-start;
            margin-bottom: 12px;
            letter-spacing: 0.5px;
        }

        /* ADVANTAGES SECTION */
        .advantages-section {
            padding: 80px 0;
            background-color: var(--bg-light);
            border-top: 1px solid var(--border-color);
        }

        .advantages-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 30px;
        }

        .advantage-card {
            background-color: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 25px;
            transition: transform var(--transition-speed);
        }

        .advantage-card:hover {
            transform: translateY(-3px);
        }

        .advantage-icon-box {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            background-color: rgba(46, 125, 50, 0.1);
            color: #2e7d32;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .advantage-card:nth-child(2) .advantage-icon-box {
            background-color: rgba(0, 132, 255, 0.1);
            color: var(--accent-blue);
        }
        .advantage-card:nth-child(3) .advantage-icon-box {
            background-color: rgba(255, 158, 13, 0.1);
            color: var(--accent-orange);
        }
        .advantage-card:nth-child(4) .advantage-icon-box {
            background-color: rgba(156, 39, 176, 0.1);
            color: #9c27b0;
        }

        .advantage-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary-navy);
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .advantage-desc {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* FOOTER LINKS */
        .footer-links-bar {
            background-color: #eef2f6;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            padding: 15px 0;
        }

        .footer-links-content {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .footer-links-content a {
            font-size: 14px;
            font-weight: 600;
            color: var(--primary-navy);
        }

        .footer-links-content a:hover {
            color: var(--accent-blue);
        }

        /* MAIN FOOTER */
        .main-footer {
            background-color: var(--primary-navy);
            color: #ffffff;
            padding: 50px 0 25px 0;
            font-size: 13px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            margin-bottom: 40px;
        }

        .footer-col-left {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .app-stores {
            display: flex;
            gap: 15px;
        }

        .app-store-btn {
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: rgba(255, 255, 255, 0.05);
            transition: background-color var(--transition-speed), border-color var(--transition-speed);
            cursor: pointer;
        }

        .app-store-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: #ffffff;
        }

        .app-store-btn i {
            font-size: 24px;
        }

        .app-store-text {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            line-height: 1.2;
        }

        .app-store-text .small {
            font-size: 9px;
            opacity: 0.7;
            text-transform: uppercase;
        }

        .app-store-text .bold {
            font-size: 13px;
            font-weight: 700;
        }

        .footer-company-name {
            font-size: 14px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.9);
        }

        .footer-disclaimer-left {
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.6;
        }

        .footer-disclaimer-left a {
            color: #ffffff;
            text-decoration: underline;
        }

        .footer-col-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 25px;
        }

        .support-text {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
        }

        .hotline-display {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .hotline-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: var(--accent-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            position: relative;
        }

        .hotline-badge-24 {
            position: absolute;
            top: -2px;
            right: -2px;
            background-color: var(--accent-orange);
            color: #ffffff;
            font-size: 8px;
            font-weight: 800;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--primary-navy);
        }

        .hotline-number {
            font-family: var(--font-display);
            font-size: 26px;
            font-weight: 800;
            color: #ffffff;
        }

        .footer-social-row {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }

        .footer-social-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: rgba(255, 255, 255, 0.8);
            transition: background-color var(--transition-speed), color var(--transition-speed), border-color var(--transition-speed);
        }

        .footer-social-icon:hover {
            background-color: #ffffff;
            color: var(--primary-navy);
            border-color: #ffffff;
        }

        .footer-bottom-bar {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 25px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 11.5px;
            line-height: 1.6;
        }

        /* STICKY CHAT WIDGET */
        .chat-widget {
            position: fixed;
            bottom: 25px;
            right: 25px;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 12px;
            background-color: var(--accent-blue);
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 30px;
            box-shadow: 0 10px 20px rgba(0, 132, 255, 0.3);
            cursor: pointer;
            font-weight: 600;
            font-size: 13.5px;
            transition: background-color var(--transition-speed), transform var(--transition-speed);
        }

        .chat-widget:hover {
            background-color: var(--accent-blue-hover);
            transform: translateY(-2px);
        }

        .chat-widget-pulse {
            width: 8px;
            height: 8px;
            background-color: #2e7d32;
            border-radius: 50%;
            box-shadow: 0 0 0 rgba(46, 125, 50, 0.4);
            animation: pulse-green 2s infinite;
        }

        /* KEYFRAME ANIMATIONS */
        @keyframes ticker-slide {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.3; }
            100% { transform: scale(1.3); opacity: 0; }
        }

        @keyframes pulse-green {
            0% { box-shadow: 0 0 0 0 rgba(46, 125, 50, 0.7); }
            70% { box-shadow: 0 0 0 8px rgba(46, 125, 50, 0); }
            100% { box-shadow: 0 0 0 0 rgba(46, 125, 50, 0); }
        }

        /* RESPONSIVE MEDIA QUERIES & MOBILE OPTIMIZATIONS */
        @media (max-width: 1024px) {
            .product-row-card {
                grid-template-columns: 280px 1fr;
            }
            .product-actions-specs {
                grid-column: 1 / -1;
                border-left: none;
                border-top: 1px solid var(--border-color);
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                gap: 15px;
            }
            .listings-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .services-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 15px;
            }
            .advantages-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .analytics-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .filter-box {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 12px;
            }

            .top-bar-right {
                display: none;
            }
            .top-bar-left {
                width: 100%;
                justify-content: center;
                margin-bottom: 5px;
            }
            .desktop-center-badge {
                position: relative;
                left: auto;
                transform: none;
                width: 100%;
                justify-content: center;
                font-size: 11px;
            }
            
            .main-header {
                padding: 10px 0;
            }
            .header-content {
                flex-wrap: nowrap;
                justify-content: space-between;
                gap: 10px;
            }
            .logo-area {
                gap: 10px;
            }
            .brand-logo-img {
                height: 34px;
            }
            .header-actions {
                width: auto;
                gap: 8px;
            }
            .btn-add-ad {
                padding: 8px 12px;
                font-size: 12px;
            }
            .btn-login {
                padding: 6px 10px;
                font-size: 12px;
            }

            /* Sub navbar horizontal scrollable tabs on mobile */
            .sub-navbar {
                padding: 6px 0;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .sub-navbar-content {
                height: auto;
            }
            .nav-menu {
                flex-wrap: nowrap;
                white-space: nowrap;
                overflow-x: auto;
                width: 100%;
                gap: 4px;
                padding-bottom: 4px;
            }
            .nav-item {
                height: 32px;
                padding: 0 14px;
                font-size: 12px;
                border-radius: 16px;
                flex-shrink: 0;
            }
            .nav-contacts {
                display: none;
            }

            /* Compact Filters Strip Mobile Optimization */
            .compact-filters-strip {
                padding: 12px 0;
            }
            .compact-tabs {
                display: flex;
                overflow-x: auto;
                white-space: nowrap;
                gap: 6px;
                padding-bottom: 6px;
                -webkit-overflow-scrolling: touch;
            }
            .compact-tab {
                flex-shrink: 0;
                padding: 6px 16px;
                font-size: 12px;
                border-radius: 20px;
            }
            .compact-fields-row {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
                margin-top: 10px;
            }
            .compact-field {
                width: 100%;
            }
            .compact-field label {
                font-size: 11px;
                margin-bottom: 4px;
            }
            .compact-field select {
                font-size: 12px;
                padding: 8px 10px;
            }
            .btn-compact-search {
                grid-column: 1 / -1;
                width: 100%;
                justify-content: center;
                padding: 10px;
                font-size: 13px;
                margin-top: 4px;
            }

            /* Search Product Row Card Mobile Layout */
            .product-row-card {
                grid-template-columns: 1fr;
                border-radius: 12px;
            }
            .product-carousel-container {
                min-height: 200px;
                height: 200px;
            }
            .product-details-block {
                padding: 16px;
            }
            .product-title-text {
                font-size: 13px;
            }
            .product-price-text {
                font-size: 20px;
                margin-bottom: 8px;
            }
            .product-location-text {
                font-size: 13px;
                margin-bottom: 8px;
            }
            .location-landmark-meta {
                font-size: 11.5px;
                gap: 8px;
                margin-bottom: 12px;
            }
            .product-actions-specs {
                padding: 16px;
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }
            .phone-action-container {
                width: 100%;
                gap: 6px;
            }
            .action-row-secondary {
                width: 100%;
            }
            .specs-grid-box {
                width: 100%;
                grid-template-columns: repeat(3, 1fr);
                gap: 6px;
            }
            .spec-tag {
                font-size: 11px;
                padding: 6px 8px;
                justify-content: center;
            }

            .hero-section {
                padding: 30px 0 40px 0;
            }
            .hero-left-card {
                padding: 16px;
                max-width: 100%;
            }
            .hero-title {
                font-size: 24px;
            }
            .hero-buttons {
                flex-direction: column;
            }
            .btn-hero-dark, .btn-hero-blue {
                width: 100%;
            }
            .listings-grid {
                grid-template-columns: 1fr;
            }
            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .advantages-grid {
                grid-template-columns: 1fr;
            }
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            .footer-col-left, .footer-col-right {
                align-items: center;
                text-align: center;
            }
            .app-stores {
                justify-content: center;
                flex-wrap: wrap;
            }
            .map-stats-grid {
                grid-template-columns: 1fr;
            }
        }
    
/* SEARCH RESULTS CUSTOM STYLES */
.results-container {
    padding: 40px 0 80px 0;
    background-color: var(--bg-light);
}

.results-header-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 15px;
}

.breadcrumbs {
    font-size: 14px;
    color: var(--text-muted);
    font-weight: 500;
}

.results-filters-row {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

.sort-selector-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: var(--text-dark);
    font-weight: 600;
}

.sort-select {
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 6px 12px;
    font-size: 14px;
    font-weight: 500;
    color: var(--primary-navy);
    background-color: #ffffff;
    cursor: pointer;
    outline: none;
    transition: border-color 0.2s;
}

.sort-select:hover {
    border-color: var(--accent-blue);
}

.layout-toggle {
    display: flex;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    overflow: hidden;
    background-color: #ffffff;
}

.btn-layout {
    padding: 8px 12px;
    color: var(--text-muted);
    cursor: pointer;
    font-size: 14px;
    background: none;
    border: none;
    transition: all 0.2s;
}

.btn-layout:hover, .btn-layout.active {
    color: var(--accent-blue);
    background-color: var(--bg-light);
}

.btn-clear-filters {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    font-weight: 600;
    color: var(--text-dark);
    transition: color 0.2s;
}

.btn-clear-filters:hover {
    color: var(--alert-red);
}

.search-listings-list {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.product-row-card {
    display: grid;
    grid-template-columns: 320px 1fr 280px;
    background-color: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    transition: transform 0.3s, box-shadow 0.3s;
}

.product-row-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.05);
}

.product-carousel-container {
    position: relative;
    height: 100%;
    min-height: 240px;
    background-color: #f1f3f5;
    overflow: hidden;
}

.carousel-track-wrapper {
    height: 100%;
    width: 100%;
    position: relative;
}

.carousel-slide-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
    z-index: 1;
}

.carousel-slide-img.active {
    opacity: 1;
    z-index: 2;
}

.badge-top-left {
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 3;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
}

.yaxshi-taklif-badge {
    background-color: #e6f7eb;
    color: #2b8a3e;
    border: 1px solid #c3fae8;
}

.carousel-control-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 3;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.8);
    color: var(--primary-navy);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: all 0.2s;
}

.carousel-control-btn:hover {
    background-color: #ffffff;
    color: var(--accent-blue);
}

.prev-btn { left: 10px; }
.next-btn { right: 10px; }

.carousel-index-badge {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 3;
    background-color: rgba(0, 0, 0, 0.6);
    color: #ffffff;
    padding: 3px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.product-details-block {
    padding: 24px;
    display: flex;
    flex-direction: column;
}

.id-row {
    display: flex;
    gap: 8px;
    align-items: center;
    margin-bottom: 12px;
}

.product-id-badge {
    background-color: #fff9db;
    color: #f59f00;
    border: 1px solid #ffe066;
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
}

.negotiable-badge {
    background-color: #e8f7ff;
    color: #1c7ed6;
    border: 1px solid #a5d8ff;
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
}

.product-title-text {
    font-size: 14px;
    color: var(--text-muted);
    font-weight: 700;
    margin-bottom: 8px;
    letter-spacing: 0.5px;
}

.product-price-text {
    font-family: var(--font-display);
    font-size: 26px;
    font-weight: 800;
    color: var(--accent-orange);
    margin-bottom: 12px;
}

.product-location-text {
    font-size: 15px;
    color: var(--text-dark);
    font-weight: 600;
    margin-bottom: 12px;
}

.location-landmark-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    font-size: 13px;
    color: var(--text-muted);
    font-weight: 500;
    margin-bottom: 16px;
}

.location-time i, .landmark-name i {
    color: var(--accent-blue);
    margin-right: 4px;
}

.date-published-row {
    margin-top: auto;
    font-size: 12px;
    color: var(--text-muted);
    font-weight: 500;
}

.product-actions-specs {
    padding: 24px;
    border-left: 1px solid var(--border-color);
    display: flex;
    flex-direction: column;
}

.phone-action-container {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 16px;
}

.phone-reveal-btn {
    width: 100%;
    background-color: var(--secondary-navy);
    color: #ffffff;
    padding: 10px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 13px;
    cursor: pointer;
    text-align: center;
    transition: background-color 0.2s;
    border: none;
}

.phone-reveal-btn:hover {
    background-color: var(--primary-navy);
}

.action-row-secondary {
    display: flex;
    align-items: center;
    gap: 8px;
    width: 100%;
}

.tg-write-btn {
    flex: 1;
    border: 1px solid var(--border-color);
    color: var(--text-dark);
    padding: 10px 12px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
    text-align: center;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    text-decoration: none;
    background-color: #ffffff;
}

.tg-write-btn:hover {
    border-color: var(--accent-blue);
    color: var(--accent-blue);
    background-color: #f8f9fa;
}

.action-icon-btn {
    width: 42px;
    height: 42px;
    border-radius: 8px;
    border: 1px solid var(--border-color);
    background-color: #ffffff;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
    flex-shrink: 0;
    font-size: 15px;
}

.action-icon-btn:hover {
    color: var(--accent-blue);
    border-color: var(--accent-blue);
    background-color: #f8f9fa;
}

.action-icon-btn.is-favorite {
    color: #ef4444;
    border-color: #fca5a5;
    background-color: #fef2f2;
}

.specs-grid-box {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 6px;
    margin-bottom: 12px;
}

.spec-tag {
    background-color: #f8f9fa;
    border: 1px solid #f1f3f5;
    padding: 6px 4px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    color: var(--text-dark);
    text-align: center;
}

.spec-tag i {
    color: var(--text-muted);
    margin-right: 2px;
}

.quality-tags-box {
    display: flex;
    gap: 8px;
    margin-bottom: 12px;
}

.quality-tag {
    background-color: #f1f3f5;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    color: var(--text-dark);
}

.quality-tag i {
    color: var(--text-muted);
    margin-right: 4px;
}

.finance-badges-box {
    display: flex;
    gap: 8px;
    margin-top: auto;
}

.finance-badge {
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
}

.ipoteka-badge {
    background-color: #fff4e6;
    color: #fd7e14;
    border: 1px solid #ffd8a8;
}

.subsidiya-badge {
    background-color: #fff9db;
    color: #f59f00;
    border: 1px solid #ffe066;
}

.no-results-card {
    background-color: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 60px 20px;
    text-align: center;
    color: var(--text-muted);
}

.no-results-card h3 {
    font-size: 18px;
    color: var(--primary-navy);
    margin: 15px 0 8px 0;
    font-weight: 700;
}

.search-pagination {
    margin-top: 40px;
    display: flex;
    justify-content: center;
}

.search-pagination nav {
    display: flex;
    gap: 5px;
}

.search-pagination nav .relative {
    display: flex;
    gap: 4px;
}

.search-pagination nav span, .search-pagination nav a {
    padding: 8px 16px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    background-color: #ffffff;
    color: var(--text-dark);
    font-weight: 600;
    transition: all 0.2s;
}

.search-pagination nav a:hover {
    color: var(--accent-blue);
    border-color: var(--accent-blue);
}

.search-pagination nav span.bg-blue-500, 
.search-pagination nav .bg-blue-600 {
    background-color: var(--accent-blue) !important;
    color: #ffffff !important;
    border-color: var(--accent-blue) !important;
}

@media (max-width: 992px) {
    .product-row-card {
        grid-template-columns: 280px 1fr;
    }
    
    .product-actions-specs {
        grid-column: span 2;
        border-left: none;
        border-top: 1px solid var(--border-color);
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }
    
    .phone-action-container {
        flex-direction: row;
        margin-bottom: 0;
        flex-grow: 1;
        max-width: 400px;
    }
    
    .top-meta-icons {
        margin-bottom: 0;
        order: 3;
    }
}

@media (max-width: 768px) {
    .product-row-card {
        grid-template-columns: 1fr;
    }
    
    .product-actions-specs {
        grid-column: span 1;
        flex-direction: column;
        align-items: stretch;
    }
    
    .phone-action-container {
        flex-direction: column;
        max-width: none;
    }
    
    .top-meta-icons {
        order: 0;
        justify-content: flex-start;
        margin-bottom: 12px;
    }
}

/* COMPACT FILTERS STRIP STYLES */
.compact-filters-strip {
    background-color: #ffffff;
    border-bottom: 1px solid var(--border-color);
    padding: 15px 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
}

.compact-filter-form {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.compact-tabs {
    display: flex;
    gap: 8px;
    border-bottom: 1px solid #f1f3f5;
    padding-bottom: 8px;
    overflow-x: auto;
}

.compact-tab {
    padding: 6px 16px;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-muted);
    cursor: pointer;
    border-radius: 8px;
    transition: all 0.2s;
}

.compact-tab.active, .compact-tab:hover {
    background-color: #e8f4ff;
    color: var(--accent-blue);
}

.compact-fields-row {
    display: flex;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
}

.compact-field {
    flex: 1;
    min-width: 160px;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.compact-field label {
    font-size: 11px;
    text-transform: uppercase;
    font-weight: 700;
    color: var(--text-muted);
    letter-spacing: 0.5px;
}

.compact-field select {
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 8px 12px;
    font-size: 13px;
    color: var(--primary-navy);
    font-weight: 500;
    background-color: #ffffff;
    cursor: pointer;
    outline: none;
}

.compact-field select:focus {
    border-color: var(--accent-blue);
}

.btn-compact-search {
    background-color: var(--accent-orange);
    color: #ffffff;
    padding: 10px 24px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    height: 40px;
    margin-top: auto;
    transition: background-color 0.2s;
    border: none;
    outline: none;
}

.btn-compact-search:hover {
    background-color: var(--accent-orange-hover);
}

@media (max-width: 768px) {
    .compact-field {
        min-width: 100%;
    }
    
    .btn-compact-search {
        width: 100%;
        justify-content: center;
    }
}

        /* INQUIRY MODAL PREMIUM STYLES */
        .inquiry-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .inquiry-modal-backdrop {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
        }

        .inquiry-modal-content {
            position: relative;
            background-color: #ffffff;
            width: 90%;
            max-width: 480px;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            z-index: 10;
            overflow: hidden;
            animation: modalFadeIn 0.3s ease-out;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(10px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .inquiry-modal-header {
            background-color: var(--primary-navy, #0f172a);
            padding: 20px 24px;
            color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .inquiry-modal-header h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            font-weight: 700;
            margin: 0;
        }

        .close-modal-btn {
            background: none;
            border: none;
            color: #ffffff;
            font-size: 28px;
            line-height: 1;
            cursor: pointer;
            opacity: 0.8;
            transition: opacity 0.2s;
            padding: 0;
        }

        .close-modal-btn:hover {
            opacity: 1;
        }

        .inquiry-modal-form {
            padding: 24px;
        }

        .form-group-item {
            margin-bottom: 20px;
        }

        .form-group-item label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark, #334155);
            margin-bottom: 6px;
            text-align: left;
        }

        .required-star {
            color: #ef4444;
        }

        .inquiry-input, .inquiry-textarea {
            width: 100%;
            border: 1px solid var(--border-color, #e2e8f0);
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 14px;
            color: #0f172a;
            transition: border-color 0.2s, box-shadow 0.2s;
            background-color: #f8fafc;
            box-sizing: border-box;
        }

        .inquiry-input:focus, .inquiry-textarea:focus {
            border-color: var(--accent-blue, #3b82f6);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
            outline: none;
            background-color: #ffffff;
        }

        .btn-submit-inquiry {
            width: 100%;
            background-color: var(--accent-orange, #f97316);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
            letter-spacing: 0.5px;
        }

        .btn-submit-inquiry:hover {
            background-color: #ea580c;
        }

        .btn-submit-inquiry:active {
            transform: scale(0.98);
        }

        .inquiry-success-alert {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .success-alert-content {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 90%;
            animation: modalFadeIn 0.3s ease-out;
            border-top: 4px solid #10b981;
        }

        .success-icon {
            font-size: 48px;
            color: #10b981;
            margin-bottom: 15px;
        }

        .success-alert-content p {
            font-size: 15px;
            color: #334155;
            font-weight: 600;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .btn-close-alert {
            background-color: var(--primary-navy, #0f172a);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 24px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-close-alert:hover {
            background-color: #1e293b;
        }
    </style>
</head>
<body>

    <!-- TOP BAR -->
    <div class="top-bar" style="position: relative;">
        <div class="container" style="position: relative;">
            <div class="top-bar-left">
                <div class="social-links">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-telegram"></i></a>
                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                </div>
            </div>
            
            <div class="test-mode-badge desktop-center-badge">
                <i class="fas fa-exclamation-triangle"></i>
                <span>The site works in test mode</span>
            </div>
            <div class="top-bar-right">
                <div class="top-bar-right-item">
                    <i class="far fa-comment-dots"></i>
                </div>
                <div class="top-bar-right-item">
                    <i class="fas fa-globe"></i>
                    <select>
                        <option>English</option>
                        <option>O'zbekcha</option>
                        <option>Русский</option>
                    </select>
                </div>
                <div class="top-bar-right-item">
                    <i class="far fa-heart"></i>
                </div>
                <div class="top-bar-right-item">
                    <select style="font-weight: 700;">
                        <option>UZS</option>
                        <option>USD</option>
                        <option>EUR</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN HEADER -->
    <header class="main-header">
        <div class="container">
            <div class="header-content">
                <div class="logo-area">
                    <div class="hamburger-menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <a href="/" class="logo-container" title="Bosh sahifa">
                        <img src="/images/logo.svg" alt="ESTORA Real Estate" class="brand-logo-img">
                    </a>
                </div>
                <div class="header-actions">
                    <a href="{{ route('add.ad') }}" class="btn-add-ad">
                        <i class="fas fa-plus"></i>
                        E'lon joylashtirish
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-login">
                            <i class="far fa-user-circle" style="font-size: 20px;"></i>
                            Kabinet
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-login">
                            <i class="far fa-user-circle" style="font-size: 20px;"></i>
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- SUB NAV BAR -->
    <nav class="sub-navbar">
        <div class="container">
            <div class="sub-navbar-content">
                <ul class="nav-menu">
                    <li><a href="{{ route('maniDashboard', ['transaction_type' => 'Sotuv']) }}" class="nav-item {{ request('transaction_type', 'Sotuv') == 'Sotuv' ? 'active' : '' }}">Sotuv</a></li>
                    <li><a href="{{ route('maniDashboard', ['transaction_type' => 'Ijara']) }}" class="nav-item {{ request('transaction_type') == 'Ijara' ? 'active' : '' }}">Ijara</a></li>
                    <li><a href="{{ route('maniDashboard', ['transaction_type' => 'Xonadosh']) }}" class="nav-item {{ request('transaction_type') == 'Xonadosh' ? 'active' : '' }}">Xonadosh</a></li>
                    <li><a href="{{ route('maniDashboard', ['transaction_type' => 'Tijorat']) }}" class="nav-item {{ request('transaction_type') == 'Tijorat' ? 'active' : '' }}">Tijorat</a></li>
                    <li><a href="{{ route('maniDashboard', ['transaction_type' => 'Dacha']) }}" class="nav-item {{ request('transaction_type') == 'Dacha' ? 'active' : '' }}">Dacha</a></li>
                    <li><a href="{{ route('maniDashboard', ['transaction_type' => 'Xalqaro']) }}" class="nav-item {{ request('transaction_type') == 'Xalqaro' ? 'active' : '' }}">Xalqaro</a></li>
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

    
    <!-- COMPACT FILTERS STRIP -->
    <div class="compact-filters-strip">
        <div class="container">
            <form action="{{ route('maniDashboard') }}" method="GET" class="compact-filter-form">
                <input type="hidden" name="transaction_type" id="transaction_type" value="{{ request('transaction_type', 'Sotuv') }}">
                
                <div class="compact-tabs">
                    <div class="compact-tab {{ request('transaction_type', 'Sotuv') == 'Sotuv' ? 'active' : '' }}" data-value="Sotuv">Sotuv</div>
                    <div class="compact-tab {{ request('transaction_type') == 'Ijara' ? 'active' : '' }}" data-value="Ijara">Ijara</div>
                    <div class="compact-tab {{ request('transaction_type') == 'Xonadosh' ? 'active' : '' }}" data-value="Xonadosh">Xonadosh</div>
                    <div class="compact-tab {{ request('transaction_type') == 'Tijorat' ? 'active' : '' }}" data-value="Tijorat">Tijorat</div>
                    <div class="compact-tab {{ request('transaction_type') == 'Dacha' ? 'active' : '' }}" data-value="Dacha">Dacha</div>
                    <div class="compact-tab {{ request('transaction_type') == 'Xalqaro' ? 'active' : '' }}" data-value="Xalqaro">Xalqaro</div>
                </div>
                
                <div class="compact-fields-row">
                    <div class="compact-field">
                        <label>Mulk turi</label>
                        <select name="property_type" id="property_type">
                            <option value="Tanlang">Tanlang</option>
                            @if(isset($propertyTypes))
                                @foreach($propertyTypes as $pt)
                                    <option value="{{ $pt }}" {{ request('property_type') == $pt ? 'selected' : '' }}>{{ $pt }}</option>
                                @endforeach
                            @else
                                <option value="Kvartira" {{ request('property_type') == 'Kvartira' ? 'selected' : '' }}>Kvartira</option>
                                <option value="Hovli" {{ request('property_type') == 'Hovli' ? 'selected' : '' }}>Hovli</option>
                                <option value="Ofis" {{ request('property_type') == 'Ofis' ? 'selected' : '' }}>Ofis</option>
                                <option value="Do'kon" {{ request('property_type') == "Do'kon" ? 'selected' : '' }}>Do'kon</option>
                                <option value="Ombor" {{ request('property_type') == 'Ombor' ? 'selected' : '' }}>Ombor</option>
                                <option value="Dacha" {{ request('property_type') == 'Dacha' ? 'selected' : '' }}>Dacha</option>
                            @endif
                        </select>
                    </div>
                    
                    <div class="compact-field">
                        <label>Viloyat</label>
                        <select name="region_id" id="region_id">
                            <option value="">Tanlang</option>
                            @if(isset($regions))
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}" {{ request('region_id') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    
                    <div class="compact-field">
                        <label>Tuman</label>
                        <select name="city_id" id="city_id">
                            <option value="">Tanlang</option>
                            @if(isset($regions))
                                @foreach($regions as $region)
                                    @foreach($region->cities as $city)
                                        <option value="{{ $city->id }}" data-region="{{ $region->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                    @endforeach
                                @endforeach
                            @endif
                        </select>
                    </div>
                    
                    <div class="compact-field">
                        <label>So'ngi e'lonlar</label>
                        <select name="time_filter" id="time_filter">
                            <option value="Tanlang">Tanlang</option>
                            <option value="Bugungi" {{ request('time_filter') == 'Bugungi' ? 'selected' : '' }}>Bugungi</option>
                            <option value="Haftalik" {{ request('time_filter') == 'Haftalik' ? 'selected' : '' }}>Haftalik</option>
                            <option value="Oylik" {{ request('time_filter') == 'Oylik' ? 'selected' : '' }}>Oylik</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn-compact-search">
                        <i class="fas fa-search"></i>
                        QIDIRISH
                    </button>
                    
                    <button type="button" onclick="openInteractiveMapModal()" class="btn-view-map" style="padding: 10px 18px; height: 44px; margin: 0; font-size: 13px;">
                        <i class="fas fa-map-marked-alt"></i>
                        Xaritadan ko'rish
                    </button>
                </div>
            </form>
        </div>
    </div>


    
    <!-- SEARCH RESULTS SECTION -->
    <div class="results-container">
        <div class="container">
            <div class="results-header-bar">
                <div class="breadcrumbs">
                    Bosh sahifa / {{ request('transaction_type', 'Sotuv') }} @if(request('property_type') && request('property_type') !== 'Tanlang') / {{ request('property_type') }} @endif @if(request('region_id') && isset($regions)) @php $selReg = $regions->firstWhere('id', request('region_id')); @endphp @if($selReg) / {{ $selReg->name }} @endif @endif
                </div>
                <div class="results-filters-row">
                    <div class="sort-selector-wrapper">
                        <span>Saralash turi:</span>
                        <form id="sortForm" method="GET" action="{{ route('maniDashboard') }}" style="display:inline-block;">
                            <!-- Carry over existing filters as hidden fields -->
                            <input type="hidden" name="transaction_type" value="{{ request('transaction_type') }}">
                            <input type="hidden" name="property_type" value="{{ request('property_type') }}">
                            <input type="hidden" name="region_id" value="{{ request('region_id') }}">
                            <input type="hidden" name="city_id" value="{{ request('city_id') }}">
                            <input type="hidden" name="time_filter" value="{{ request('time_filter') }}">
                            
                            <select name="sort_by" onchange="document.getElementById('sortForm').submit();" class="sort-select">
                                <option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>Tanlang (Yangi)</option>
                                <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Arzonroq</option>
                                <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Qimmatroq</option>
                            </select>
                        </form>
                    </div>
                    
                    <div class="layout-toggle">
                        <button class="btn-layout active" title="Ro'yxat"><i class="fas fa-bars"></i></button>
                        <button class="btn-layout" title="Setka"><i class="fas fa-th-large"></i></button>
                    </div>
                    
                    <a href="{{ route('maniDashboard') }}" class="btn-clear-filters">
                        <i class="fas fa-times"></i>
                        Filtrlarni o'chirish
                    </a>
                </div>
            </div>
            
            <!-- Product Listings -->
            <div class="search-listings-list">
                @forelse($products as $product)
                    <!-- Product Card Row -->
                    <div class="product-row-card">
                        <!-- Carousel Block (Left) -->
                        <div class="product-carousel-container">
                            @php
                                $images = $product->images;
                                if (is_string($images)) {
                                    $images = json_decode($images, true);
                                }
                                $images = is_array($images) ? $images : [];
                            @endphp
                            
                            <a href="{{ route('products.show', $product->id) }}" style="display: block; width: 100%; height: 100%; text-decoration: none; color: inherit;">
                                <div class="carousel-track-wrapper">
                                    @if(count($images) > 0)
                                        @foreach($images as $index => $img)
                                            <img src="{{ Str::startsWith($img, 'http') ? $img : (Str::startsWith($img, '/storage') ? $img : (Str::startsWith($img, 'storage') ? '/' . $img : '/storage/' . $img)) }}" 
                                                 class="carousel-slide-img {{ $loop->first ? 'active' : '' }}" 
                                                 data-index="{{ $loop->index }}" 
                                                 alt="{{ $product->name }}">
                                        @endforeach
                                    @else
                                        <img src="/images/apartment1.png" class="carousel-slide-img active" alt="Placeholder">
                                    @endif
                                </div>
                            </a>
                            
                            <span class="badge-top-left yaxshi-taklif-badge">Yaxshi Taklif</span>
                            
                            @if(count($images) > 1)
                                <button class="carousel-control-btn prev-btn" onclick="moveSlide(this, -1)"><i class="fas fa-chevron-left"></i></button>
                                <button class="carousel-control-btn next-btn" onclick="moveSlide(this, 1)"><i class="fas fa-chevron-right"></i></button>
                            @endif
                            
                            <span class="carousel-index-badge">1/{{ max(count($images), 1) }}</span>
                        </div>
                        
                        <!-- Meta Info Block (Middle) -->
                        <div class="product-details-block">
                            <div class="id-row">
                                <span class="product-id-badge">ID {{ 10000 + $product->id }}</span>
                                <span class="negotiable-badge">Kelishiladi</span>
                            </div>
                            
                            <h3 class="product-title-text">
                                <a href="{{ route('products.show', $product->id) }}" style="color: inherit; text-decoration: none;" onmouseover="this.style.color='var(--accent-blue)'" onmouseout="this.style.color='inherit'">
                                    {{ strtoupper($product->category->name ?? request('transaction_type', 'SOTUV')) }} | {{ strtoupper($product->subCategory->name ?? request('property_type', 'KVARTIRA')) }}
                                </a>
                            </h3>
                            <div class="product-name-subtitle" style="font-size: 14px; font-weight: 600; color: var(--text-dark); margin-bottom: 6px;">
                                <a href="{{ route('products.show', $product->id) }}" style="color: inherit; text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">{{ $product->name }}</a>
                            </div>
                            
                            <div class="product-price-text">
                                @if($product->price > 0)
                                    {{ number_format($product->price) }} USD
                                @else
                                    Kelishiladi
                                @endif
                            </div>
                            
                            <div class="product-location-text">
                                {{ $product->region->name ?? 'Toshkent shahar' }}, {{ $product->city->name ?? 'Yashnobod tumani' }}
                            </div>
                            
                            <div class="location-landmark-meta">
                                <span class="location-time">
                                    <i class="fas fa-walking"></i> {{ $product->city->name ?? 'Yashnobod' }} – 20 daqiqa
                                </span>
                                @if($product->landmark)
                                    <span class="landmark-name">
                                        <i class="fas fa-map-marker-alt"></i> Mo‘ljal: {{ $product->landmark }}
                                    </span>
                                @endif
                            </div>
                            
                            <div class="date-published-row">
                                E'lon joylangan sana: {{ $product->created_at ? $product->created_at->format('d.m.Y') : '16.09.2025' }}
                            </div>
                        </div>
                        
                        <!-- Action & Specs Block (Right) -->
                        <div class="product-actions-specs">
                            <div class="phone-action-container">
                                @if($product->phone)
                                    <button class="phone-reveal-btn" onclick="revealPhone(this, '{{ $product->phone }}')">
                                        <i class="fas fa-phone-alt"></i> Telefon raqam
                                    </button>
                                @else
                                    <button class="phone-reveal-btn disabled" disabled>
                                        <i class="fas fa-phone-alt"></i> Telefon raqam yo'q
                                    </button>
                                @endif

                                <div class="action-row-secondary">
                                     @auth
                                         @if(Auth::id() !== $product->user_id)
                                             <button type="button" class="tg-write-btn" onclick="openSendMessageModal({{ $product->id }}, '{{ addslashes($product->name) }}')" style="border: none; cursor: pointer; background: #0066FF; color: white;">
                                                 <i class="fas fa-paper-plane"></i> Xabar yozish
                                             </button>
                                         @else
                                             <span class="tg-write-btn" style="background: #e0f2fe; color: #0369a1; font-weight: 700; cursor: default;">
                                                 <i class="fas fa-user-check"></i> Mening e'lonim
                                             </span>
                                         @endif
                                     @else
                                         <button type="button" onclick="openAuthModal()" class="tg-write-btn" style="border: none; cursor: pointer; background: #0066FF; color: white;">
                                             <i class="fas fa-paper-plane"></i> Xabar yozish
                                         </button>
                                     @endauth
                                    @php $isFav = Auth::check() && $product->isFavoritedBy(Auth::user()); @endphp
                                    <button type="button" class="action-icon-btn js-favorite-btn {{ $isFav ? 'is-favorite' : '' }}" data-id="{{ $product->id }}" title="Saralanganlar">
                                        <i class="{{ $isFav ? 'fas fa-heart text-red-500' : 'far fa-heart' }}"></i>
                                    </button>
                                    <button type="button" class="action-icon-btn share-btn" data-id="{{ $product->id }}" title="Ulashish">
                                        <i class="far fa-share-square"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Specs grid -->
                            <div class="specs-grid-box">
                                <span class="spec-tag"><i class="fas fa-layer-group"></i> {{ $product->floor ?? '5' }}/{{ $product->building_floor ?? '7' }} etaj</span>
                                <span class="spec-tag"><i class="fas fa-door-open"></i> {{ $product->rooms ?? '2' }} xona</span>
                                <span class="spec-tag"><i class="fas fa-expand-arrows-alt"></i> {{ $product->square ?? '45' }}m²</span>
                            </div>
                            
                            <!-- Quality tags -->
                            <div class="quality-tags-box">
                                <span class="quality-tag"><i class="fas fa-tools"></i> {{ $product->repair ?? "Yevro ta'mir" }}</span>
                                <span class="quality-tag"><i class="fas fa-chair"></i> Mebel bor</span>
                            </div>
                            
                            <!-- Finance Badges -->
                            <div class="finance-badges-box">
                                @if($product->credit)
                                    <span class="finance-badge ipoteka-badge"><i class="fas fa-file-signature"></i> Ipoteka</span>
                                @endif
                                @if($product->pay_in_installments)
                                    <span class="finance-badge subsidiya-badge"><i class="fas fa-hand-holding-usd"></i> Subsidiya</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="no-results-card" style="text-align: center; padding: 48px 24px; background: #fff; border-radius: 16px; border: 1px solid #e2e8f0; margin: 20px 0;">
                        <i class="far fa-folder-open text-4xl mb-3 block" style="font-size: 48px; margin-bottom: 16px; color: #94a3b8;"></i>
                        <h3 style="font-size: 18px; font-weight: 800; color: #1e293b; margin-bottom: 8px;">Siz tanlagan filtrlar bo'yicha e'lonlar topilmadi.</h3>
                        <p style="font-size: 14px; color: #64748b; margin-bottom: 20px;">Iltimos, viloyat, tuman yoki boshqa filtrlarni o'zgartirib qaytadan urinib ko'ring.</p>
                        <a href="{{ route('maniDashboard') }}" class="btn-clear-filters" style="display: inline-flex; align-items: center; gap: 8px; background: #0066ff; color: #fff; padding: 10px 20px; border-radius: 10px; font-weight: 700; text-decoration: none;">
                            <i class="fas fa-rotate-left"></i>
                            Barcha e'lonlarni ko'rish
                        </a>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination Links -->
            <div class="search-pagination">
                {{ $products->links() }}
            </div>
        </div>
    </div>
<!-- FOOTER LINKS BAR -->
    <div class="footer-links-bar">
        <div class="container">
            <div class="footer-links-content">
                <a href="#">Biz haqimizda</a>
                <a href="#">Xizmatlar</a>
                <a href="#">Narxlar</a>
                <a href="#">Qo'llanma</a>
                <a href="#">Ommaviy oferta</a>
                <a href="#">Hamkorlar</a>
                <a href="#">Aloqa</a>
            </div>
        </div>
    </div>

    <!-- MAIN FOOTER -->
    <footer class="main-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col-left">
                    <div class="app-stores">
                        <!-- Play store -->
                        <div class="app-store-btn">
                            <i class="fab fa-google-play"></i>
                            <div class="app-store-text">
                                <span class="small">Get it on</span>
                                <span class="bold">Google Play</span>
                            </div>
                        </div>
                        <!-- App store -->
                        <div class="app-store-btn">
                            <i class="fab fa-apple"></i>
                            <div class="app-store-text">
                                <span class="small">Download on the</span>
                                <span class="bold">App Store</span>
                            </div>
                        </div>
                    </div>
                    
                    <span class="footer-company-name">MCHJ "Estora Global", 2026 yy. Barcha huquqlar himoyalangan</span>
                    
                    <p class="footer-disclaimer-left">
                        Saytdan foydalanish orqali <a href="#">Foydalanuvchi shartnomasi</a> va <a href="#">Shaxsiy ma’lumotlarni qayta ishlash siyosati</a> bilan rozilik bildirganingizni angalatadi.
                    </p>
                </div>

                <div class="footer-col-right">
                    <span class="support-text">O'zbekiston bo'ylab barcha qo'ng'iroqlar bepul</span>
                    <div class="hotline-display">
                        <div class="hotline-icon-box">
                            <i class="fas fa-phone-alt"></i>
                            <div class="hotline-badge-24">24/7</div>
                        </div>
                        <span class="hotline-number">+998 (95) 160 64-46</span>
                    </div>

                    <div class="footer-social-row">
                        <a href="#" class="footer-social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="footer-social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="footer-social-icon"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="footer-social-icon"><i class="fab fa-telegram"></i></a>
                        <a href="#" class="footer-social-icon"><i class="fab fa-x-twitter"></i></a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom-bar">
                © 2025 Estora – Barcha huquqlar himoyalangan. estora.uz saytida joylashtirilgan ma’lumotlardan foydalanish — jumladan, ularni namoyish etish, nusxa ko‘chirish, ko‘paytirish yoki tarqatish — faqatgina manbaga faol havola ko‘rsatilgan taqdirda ruxsat etiladi.
            </div>
        </div>
    </footer>

    <!-- STICKY CHAT WIDGET -->
    <div class="chat-widget" onclick="openInquiryModal()">
        <div class="chat-widget-pulse"></div>
        <span>Savollaringiz bormi? Biz aloqadamiz.</span>
    </div>

    <!-- INQUIRY MODAL -->
    <div id="inquiryModal" class="inquiry-modal" style="display: none;">
        <div class="inquiry-modal-backdrop" onclick="closeInquiryModal()"></div>
        <div class="inquiry-modal-content">
            <div class="inquiry-modal-header">
                <h3>Savollaringiz bormi? Biz aloqadamiz.</h3>
                <button type="button" class="close-modal-btn" onclick="closeInquiryModal()">&times;</button>
            </div>
            <form action="{{ route('inquiries.store') }}" method="POST" class="inquiry-modal-form">
                @csrf
                <div class="form-group-item">
                    <label for="inquiry_phone">Telefon raqamingiz <span class="required-star">*</span></label>
                    <input type="text" id="inquiry_phone" name="phone" placeholder="+998 (90) 123-45-67" required class="inquiry-input">
                </div>
                <div class="form-group-item">
                    <label for="inquiry_desc">Savolingiz yoki izohingiz</label>
                    <textarea id="inquiry_desc" name="description" rows="4" placeholder="Savollaringizni shu yerga yozishingiz mumkin..." class="inquiry-textarea"></textarea>
                </div>
                <button type="submit" class="btn-submit-inquiry">YUBORISH</button>
            </form>
        </div>
    </div>

    @if(session('success_inquiry'))
        <!-- Success Alert Popup -->
        <div id="inquirySuccessAlert" class="inquiry-success-alert">
            <div class="inquiry-modal-backdrop" onclick="closeSuccessAlert()"></div>
            <div class="success-alert-content">
                <div class="success-icon"><i class="fas fa-check-circle"></i></div>
                <p>{{ session('success_inquiry') }}</p>
                <button type="button" class="btn-close-alert" onclick="closeSuccessAlert()">OK</button>
            </div>
        </div>
    @endif

    <script>
        function openInquiryModal() {
            document.getElementById('inquiryModal').style.display = 'flex';
        }
        function closeInquiryModal() {
            document.getElementById('inquiryModal').style.display = 'none';
        }
        function closeSuccessAlert() {
            const alert = document.getElementById('inquirySuccessAlert');
            if (alert) alert.style.display = 'none';
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterForm = document.querySelector('.compact-filter-form');
            const regionSelect = document.getElementById('region_id');
            const citySelect = document.getElementById('city_id');
            const propertyTypeSelect = document.getElementById('property_type');
            const timeFilterSelect = document.getElementById('time_filter');
            const compactTabs = document.querySelectorAll('.compact-tab');
            const transactionInput = document.getElementById('transaction_type');

            // Server-selected values from URL parameters
            const serverCityId = "{{ request('city_id') }}";
            const serverRegionId = "{{ request('region_id') }}";

            // 1. Dynamic Region/City Cascading Select
            if (regionSelect && citySelect) {
                // Collect and cache all city options from DOM
                const allCityOptions = [];
                Array.from(citySelect.options).forEach(opt => {
                    if (opt.value !== "") {
                        allCityOptions.push({
                            value: opt.value,
                            text: opt.text,
                            regionId: opt.getAttribute('data-region')
                        });
                    }
                });

                function updateCityOptions(preserveSelected = true) {
                    const selectedRegion = regionSelect.value;
                    const currentCityVal = preserveSelected ? (citySelect.value || serverCityId) : '';

                    // Clear and add placeholder
                    citySelect.innerHTML = '<option value="">Tanlang</option>';

                    let hasMatchingSelected = false;

                    allCityOptions.forEach(city => {
                        if (!selectedRegion || city.regionId === selectedRegion) {
                            const opt = document.createElement('option');
                            opt.value = city.value;
                            opt.textContent = city.text;
                            opt.setAttribute('data-region', city.regionId);

                            if (String(city.value) === String(currentCityVal)) {
                                opt.selected = true;
                                hasMatchingSelected = true;
                            }
                            citySelect.appendChild(opt);
                        }
                    });

                    if (!hasMatchingSelected && currentCityVal) {
                        citySelect.value = "";
                    }
                }

                // Initial setup on page load
                updateCityOptions(true);

                // Update on region change
                regionSelect.addEventListener('change', function() {
                    updateCityOptions(false);
                });
            }

            // 2. Compact Tabs click -> update input and submit search
            compactTabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    compactTabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    const val = this.getAttribute('data-value');
                    if (transactionInput) {
                        transactionInput.value = val;
                    }

                    if (filterForm) {
                        filterForm.submit();
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Carousel sliding logic for search listings
            window.moveSlide = function(button, direction) {
                const container = button.closest('.product-carousel-container');
                const slides = container.querySelectorAll('.carousel-slide-img');
                const indexBadge = container.querySelector('.carousel-index-badge');
                
                let activeIndex = -1;
                slides.forEach((slide, index) => {
                    if (slide.classList.contains('active')) {
                        activeIndex = index;
                    }
                });
                
                if (activeIndex !== -1 && slides.length > 1) {
                    slides[activeIndex].classList.remove('active');
                    let nextIndex = activeIndex + direction;
                    
                    if (nextIndex >= slides.length) {
                        nextIndex = 0;
                    } else if (nextIndex < 0) {
                        nextIndex = slides.length - 1;
                    }
                    
                    slides[nextIndex].classList.add('active');
                    indexBadge.textContent = `${nextIndex + 1}/${slides.length}`;
                }
            };

            // Phone number reveal
            window.revealPhone = function(button, phone) {
                button.innerHTML = `<i class="fas fa-phone-alt"></i> ${phone}`;
                button.onclick = null;
            };
        });

        // Universal Favorite & Share Handlers
        document.addEventListener('DOMContentLoaded', function () {
            const csrfToken = '{{ csrf_token() }}';

            document.body.addEventListener('click', function(e) {
                // 1. Favorite Toggle
                const favBtn = e.target.closest('.js-favorite-btn');
                if (favBtn) {
                    e.preventDefault();
                    e.stopPropagation();

                    const productId = favBtn.dataset.id;
                    if (!productId) return;

                    fetch('/favorites/toggle/' + productId, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(res => {
                        if (res.status === 401) {
                            window.location.href = '{{ route("login") }}';
                            return;
                        }
                        return res.json();
                    })
                    .then(data => {
                        if (data && data.success) {
                            const allButtonsForProduct = document.querySelectorAll(`.js-favorite-btn[data-id="${productId}"]`);
                            allButtonsForProduct.forEach(b => {
                                const icon = b.querySelector('i');
                                if (data.is_favorited) {
                                    b.classList.add('is-favorite');
                                    if (icon) icon.className = 'fas fa-heart text-red-500';
                                } else {
                                    b.classList.remove('is-favorite');
                                    if (icon) icon.className = 'far fa-heart';
                                }
                            });

                            showAppToast(data.message, data.is_favorited ? 'favorite' : 'info');
                        }
                    })
                    .catch(err => console.error('Favorite toggle error:', err));
                    return;
                }

                // 2. Share URL Copy
                const shareBtn = e.target.closest('.share-btn');
                if (shareBtn) {
                    e.preventDefault();
                    e.stopPropagation();

                    const productId = shareBtn.dataset.id;
                    const productUrl = productId ? (window.location.origin + '/products/' + productId) : window.location.href;

                    if (navigator.clipboard && window.isSecureContext) {
                        navigator.clipboard.writeText(productUrl).then(() => {
                            showAppToast("E'lon havolasi nusxalandi!", 'share');
                        }).catch(() => {
                            fallbackCopyTextToClipboard(productUrl);
                        });
                    } else {
                        fallbackCopyTextToClipboard(productUrl);
                    }
                }
            });

            function fallbackCopyTextToClipboard(text) {
                const textArea = document.createElement("textarea");
                textArea.value = text;
                textArea.style.position = "fixed";
                textArea.style.left = "-999999px";
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                try {
                    document.execCommand('copy');
                    showAppToast("E'lon havolasi nusxalandi!", 'share');
                } catch (err) {
                    showAppToast("E'lon havolasi: " + text, 'info');
                }
                document.body.removeChild(textArea);
            }

            function showAppToast(message, type = 'info') {
                let toast = document.getElementById('appToastNotice');
                if (!toast) {
                    toast = document.createElement('div');
                    toast.id = 'appToastNotice';
                    toast.style.cssText = 'position: fixed; bottom: 30px; right: 30px; z-index: 100000; display: flex; align-items: center; gap: 14px; padding: 14px 22px; background: rgba(6, 28, 63, 0.95); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(0, 132, 255, 0.3); border-radius: 16px; color: #ffffff; font-family: system-ui, -apple-system, sans-serif; font-size: 14px; font-weight: 600; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3), 0 0 20px rgba(0, 132, 255, 0.15); transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); opacity: 0; transform: translateY(30px) scale(0.95); pointer-events: none;';
                    document.body.appendChild(toast);
                }

                let iconBg = 'background: linear-gradient(135deg, #0084ff, #0052cc);';
                let iconClass = 'fa-solid fa-link';
                let subtext = "Ma'lumotlar yangilandi";

                if (type === 'favorite') {
                    iconBg = 'background: linear-gradient(135deg, #ff4757, #ff6b81);';
                    iconClass = 'fa-solid fa-heart';
                    subtext = "Saralanganlarga saqlandi";
                } else if (type === 'share') {
                    iconBg = 'background: linear-gradient(135deg, #10b981, #059669);';
                    iconClass = 'fa-solid fa-check';
                    subtext = "Vaqtincha xotiraga nusxalandi";
                } else if (type === 'error') {
                    iconBg = 'background: linear-gradient(135deg, #ef4444, #dc2626);';
                    iconClass = 'fa-solid fa-exclamation';
                    subtext = "Xatolik yuz berdi";
                }

                toast.innerHTML = `
                    <div style="width: 36px; height: 36px; border-radius: 10px; ${iconBg} display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
                        <i class="${iconClass}" style="color: #ffffff; font-size: 15px;"></i>
                    </div>
                    <div style="display: flex; flex-direction: column;">
                        <span style="font-size: 14px; font-weight: 700; color: #ffffff; line-height: 1.2;">${message}</span>
                        <span style="font-size: 11px; font-weight: 400; color: rgba(255, 255, 255, 0.7); margin-top: 2px;">${subtext}</span>
                    </div>
                `;

                requestAnimationFrame(() => {
                    toast.style.opacity = '1';
                    toast.style.transform = 'translateY(0) scale(1)';
                });

                if (toast.timeoutId) clearTimeout(toast.timeoutId);

                toast.timeoutId = setTimeout(() => {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateY(20px) scale(0.95)';
                }, 3000);
            }
        });

        function openSendMessageModal(productId, productTitle) {
            const modal = document.getElementById('sendMessageModal');
            if (modal) {
                document.getElementById('modalProductId').value = productId;
                document.getElementById('modalProductTitleDisplay').innerText = productTitle;
                modal.classList.remove('hidden');
                modal.style.display = 'flex';
            }
        }

        function closeSendMessageModal() {
            const modal = document.getElementById('sendMessageModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.style.display = 'none';
            }
        }

        function openAuthModal() {
            const modal = document.getElementById('authRequiredModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.style.display = 'flex';
            }
        }

        function closeAuthModal() {
            const modal = document.getElementById('authRequiredModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.style.display = 'none';
            }
        }
    </script>

    <!-- Auth Required Modal -->
    <div id="authRequiredModal" class="hidden" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(8px); z-index: 99999; align-items: center; justify-content: center; padding: 20px; animation: fadeIn 0.2s ease-out;">
        <div style="background: white; border-radius: 24px; max-width: 420px; width: 100%; padding: 32px 28px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); text-align: center; position: relative;">
            <button type="button" onclick="closeAuthModal()" style="position: absolute; top: 18px; right: 18px; background: #f3f4f6; border: none; width: 32px; height: 32px; border-radius: 50%; font-size: 16px; color: #6b7280; cursor: pointer; display: flex; align-items: center; justify-content: center;">&times;</button>
            
            <div style="width: 72px; height: 72px; background: #eff6ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; border: 4px solid #dbeafe;">
                <i class="fas fa-lock" style="font-size: 28px; color: #0066FF;"></i>
            </div>
            
            <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">Tizimga kirish talab etiladi</h3>
            <p style="font-size: 14px; color: #64748b; line-height: 1.5; margin-bottom: 24px;">
                Uy egasiga xabar yuborish va muloqot qilish uchun avval tizimga kiring yoki ro'yxatdan o'ting!
            </p>

            <div style="display: flex; flex-direction: column; gap: 10px;">
                <a href="{{ route('login') }}" style="width: 100%; padding: 13px; background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%); color: white; border-radius: 14px; font-weight: 800; font-size: 14px; text-decoration: none; box-shadow: 0 4px 14px rgba(0, 102, 255, 0.35); display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <i class="fas fa-right-to-bracket"></i> Tizimga kirish
                </a>
                <a href="{{ route('register') }}" style="width: 100%; padding: 13px; background: #f8fafc; color: #334155; border: 1px solid #e2e8f0; border-radius: 14px; font-weight: 700; font-size: 14px; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <i class="fas fa-user-plus"></i> Ro'yxatdan o'tish
                </a>
            </div>
        </div>
    </div>

    <!-- Send Message Modal -->
    <div id="sendMessageModal" class="hidden" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 99999; align-items: center; justify-content: center; padding: 20px;">
        <div style="background: white; border-radius: 20px; max-width: 480px; width: 100%; padding: 24px; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e5e7eb; padding-bottom: 14px; margin-bottom: 16px;">
                <h3 style="font-size: 18px; font-weight: 800; color: #111827; margin: 0;">Uy egasiga xabar yuborish</h3>
                <button type="button" onclick="closeSendMessageModal()" style="background: none; border: none; font-size: 20px; color: #6b7280; cursor: pointer;">&times;</button>
            </div>
            
            <form action="{{ route('messages.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" id="modalProductId" value="">
                
                <div style="margin-bottom: 14px;">
                    <span style="font-size: 12px; font-weight: 700; color: #0066FF; text-transform: uppercase; letter-spacing: 0.5px;">Tanlangan e'lon</span>
                    <p id="modalProductTitleDisplay" style="font-size: 14px; font-weight: 700; color: #374151; margin-top: 2px;"></p>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="modalMessageText" style="display: block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 6px;">Xabar matni:</label>
                    <textarea name="message" id="modalMessageText" rows="4" required placeholder="Salom, ushbu xonadon bo'yicha ma'lumot olmoqchi edim..." style="width: 100%; border: 1px solid #d1d5db; border-radius: 12px; padding: 12px; font-size: 14px; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#0066FF'"></textarea>
                </div>

                <div style="display: flex; gap: 12px; justify-content: flex-end;">
                    <button type="button" onclick="closeSendMessageModal()" style="padding: 10px 18px; border-radius: 10px; font-weight: 700; font-size: 13px; background: #f3f4f6; color: #374151; border: none; cursor: pointer;">Bekor qilish</button>
                    <button type="submit" style="padding: 10px 22px; border-radius: 10px; font-weight: 700; font-size: 13px; background: #0066FF; color: white; border: none; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-paper-plane"></i> Yuborish
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- FULLSCREEN INTERACTIVE UZBEKISTAN MAP MODAL -->
    <div id="interactiveMapModal" class="hidden" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(6px); z-index: 999999; align-items: center; justify-content: center; padding: 12px sm:padding: 24px;">
        <div style="background: white; border-radius: 24px; max-width: 1280px; width: 100%; height: 90vh; display: flex; flex-direction: column; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4); border: 1px solid rgba(255,255,255,0.2);">
            
            <!-- Map Header Bar -->
            <div style="background: #061c3f; color: white; padding: 16px 24px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.1);">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="width: 40px; height: 40px; border-radius: 12px; background: #0084ff; display: flex; align-items: center; justify-content: center; font-size: 18px; color: white;">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 18px; font-weight: 800; margin: 0; color: white; tracking-tight">O'zbekiston Xaritasi bo'yicha Ko'chmas Mulklar</h3>
                        <p style="font-size: 12px; color: #94a3b8; margin: 0;">Marker ustiga bosib e'lon haqida ma'lumot oling va ko'rish sahifasiga o'ting</p>
                    </div>
                </div>
                <button type="button" onclick="closeInteractiveMapModal()" style="background: rgba(255,255,255,0.1); border: none; width: 38px; height: 38px; border-radius: 50%; color: white; font-size: 20px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">&times;</button>
            </div>

            <!-- Leaflet Container -->
            <div id="uzbekistanLeafletMap" style="flex: 1; width: 100%; height: 100%; z-index: 1;"></div>
        </div>
    </div>

    <script>
        let leafletMapInstance = null;
        const mapProductsData = @json($mapProducts ?? []);

        function openInteractiveMapModal() {
            const modal = document.getElementById('interactiveMapModal');
            if (!modal) return;
            modal.classList.remove('hidden');
            modal.style.display = 'flex';

            setTimeout(() => {
                if (!leafletMapInstance) {
                    // Center on Uzbekistan coordinates [41.3775, 64.5853], zoom 6.5
                    leafletMapInstance = L.map('uzbekistanLeafletMap').setView([41.2995, 69.2401], 11);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(leafletMapInstance);

                    // Add Custom Pins for each property
                    if (mapProductsData && mapProductsData.length > 0) {
                        const markersGroup = L.featureGroup();

                        mapProductsData.forEach(item => {
                            const customIcon = L.divIcon({
                                className: 'custom-map-pin',
                                html: `<div style="background: #0084ff; color: white; font-weight: 800; font-size: 11px; padding: 5px 10px; border-radius: 16px; box-shadow: 0 4px 10px rgba(0,132,255,0.4); border: 2px solid white; white-space: nowrap; display: flex; align-items: center; gap: 4px;">
                                           <i class="fas fa-home"></i> ${item.price}
                                       </div>`,
                                iconSize: [90, 30],
                                iconAnchor: [45, 15]
                            });

                            const popupHtml = `
                                <div style="width: 220px; font-family: 'Inter', sans-serif; text-align: left; padding: 2px;">
                                    <img src="${item.image}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 10px; margin-bottom: 8px;">
                                    <span style="background: #eff6ff; color: #0066FF; font-size: 10px; font-weight: 800; padding: 2px 6px; border-radius: 4px; text-transform: uppercase;">${item.category} | ${item.sub_category}</span>
                                    <h4 style="font-size: 13px; font-weight: 800; color: #0f172a; margin: 4px 0 2px; line-height: 1.3;">${item.name}</h4>
                                    <div style="font-size: 15px; font-weight: 800; color: #ff9e0d; margin-bottom: 4px;">${item.price}</div>
                                    <p style="font-size: 11px; color: #64748b; margin-bottom: 10px;"><i class="fas fa-map-marker-alt" style="color: #0084ff;"></i> ${item.region}, ${item.city}</p>
                                    <a href="${item.url}" style="display: block; width: 100%; padding: 8px; background: #061c3f; color: white; text-align: center; border-radius: 8px; font-weight: 700; font-size: 12px; text-decoration: none; box-shadow: 0 2px 6px rgba(6,28,63,0.3);">
                                        Ko'rish sahifasiga o'tish &rarr;
                                    </a>
                                </div>
                            `;

                            const marker = L.marker([item.lat, item.lng], { icon: customIcon })
                                .bindPopup(popupHtml)
                                .addTo(leafletMapInstance);

                            markersGroup.addLayer(marker);
                        });

                        leafletMapInstance.fitBounds(markersGroup.getBounds().pad(0.2));
                    }
                } else {
                    leafletMapInstance.invalidateSize();
                }
            }, 200);
        }

        function closeInteractiveMapModal() {
            const modal = document.getElementById('interactiveMapModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>
