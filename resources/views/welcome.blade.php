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
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
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

        /* RESPONSIVE MEDIA QUERIES */
        @media (max-width: 1024px) {
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
            }
            .nav-contacts {
                display: none;
            }
            .header-content {
                flex-wrap: wrap;
                gap: 15px;
            }
            .header-actions {
                width: 100%;
                justify-content: center;
            }
            .sub-navbar {
                padding: 10px 0;
            }
            .sub-navbar-content {
                height: auto;
            }
            .nav-menu {
                flex-wrap: wrap;
                justify-content: center;
                gap: 5px;
            }
            .nav-item {
                height: 36px;
                padding: 0 15px;
                border-radius: 18px;
            }
            .hero-section {
                padding: 40px 0 60px 0;
            }
            .hero-left-card {
                padding: 20px;
            }
            .hero-title {
                font-size: 28px;
            }
            .hero-buttons {
                flex-wrap: wrap;
            }
            .btn-hero-dark, .btn-hero-blue {
                width: 100%;
            }
            .filter-tabs {
                flex-wrap: wrap;
                gap: 5px;
            }
            .filter-tab {
                flex: 1 1 calc(50% - 5px);
                text-align: center;
                border-radius: 6px;
                margin-bottom: 5px;
            }
            .filter-box {
                grid-template-columns: 1fr;
                border-radius: 8px;
                padding: 20px;
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
                gap: 40px;
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
                    <li><a href="{{ route('maniDashboard', ['transaction_type' => 'Sotuv']) }}" class="nav-item active">Sotuv</a></li>
                    <li><a href="{{ route('maniDashboard', ['transaction_type' => 'Ijara']) }}" class="nav-item">Ijara</a></li>
                    <li><a href="{{ route('maniDashboard', ['transaction_type' => 'Xonadosh']) }}" class="nav-item">Xonadosh</a></li>
                    <li><a href="{{ route('maniDashboard', ['transaction_type' => 'Tijorat']) }}" class="nav-item">Tijorat</a></li>
                    <li><a href="{{ route('maniDashboard', ['transaction_type' => 'Dacha']) }}" class="nav-item">Dacha</a></li>
                    <li><a href="{{ route('maniDashboard', ['transaction_type' => 'Xalqaro']) }}" class="nav-item">Xalqaro</a></li>
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

    <!-- HERO SECTION -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="hero-left-card">
                    <span class="hero-badge">Estora Real Estate</span>
                    <h1 class="hero-title">Ko'chmas mulkning yagona raqamli ekotizimi</h1>
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn-hero-dark">KABINET</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-hero-dark">KIRISH</a>
                            <a href="{{ route('register') }}" class="btn-hero-blue">RO'YXATDAN O'TISH</a>
                        @endauth
                </div>
                
                <!-- Floating Search/Filter Form -->
                <form action="{{ route('maniDashboard') }}" method="GET" class="filter-container">
                    <input type="hidden" name="transaction_type" id="transaction_type" value="Sotuv">
                    
                    <div class="filter-tabs">
                        <div class="filter-tab active" data-value="Sotuv">Sotuv</div>
                        <div class="filter-tab" data-value="Ijara">Ijara</div>
                        <div class="filter-tab" data-value="Xonadosh">Xonadosh</div>
                        <div class="filter-tab" data-value="Tijorat">Tijorat</div>
                        <div class="filter-tab" data-value="Dacha">Dacha</div>
                        <div class="filter-tab" data-value="Xalqaro">Xalqaro</div>
                    </div>
                    <div class="filter-box">
                        <div class="filter-field">
                            <label>Mulk turi</label>
                            <div class="filter-select-wrapper">
                                <select name="property_type">
                                    <option>Tanlang</option>
                                    <option>Kvartira</option>
                                    <option>Hovli</option>
                                    <option>Ofis</option>
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="filter-field">
                            <label>Viloyat</label>
                            <div class="filter-select-wrapper">
                                <select name="region_id" id="region_id">
                                    <option value="">Tanlang</option>
                                    @if(isset($regions))
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="filter-field">
                            <label>Tuman</label>
                            <div class="filter-select-wrapper">
                                <select name="city_id" id="city_id">
                                    <option value="">Tanlang</option>
                                    @if(isset($regions))
                                        @foreach($regions as $region)
                                            @foreach($region->cities as $city)
                                                <option value="{{ $city->id }}" data-region="{{ $region->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        @endforeach
                                    @endif
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="filter-field">
                            <label>So'ngi e'lonlar</label>
                            <div class="filter-select-wrapper">
                                <select name="time_filter">
                                    <option>Tanlang</option>
                                    <option>Bugungi</option>
                                    <option>Haftalik</option>
                                    <option>Oylik</option>
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn-filter-settings">
                            <i class="fas fa-sliders-h"></i>
                            FILTR
                        </button>
                        <button type="submit" class="btn-filter-search">
                            <i class="fas fa-search"></i>
                            QIDIRISH
                        </button>
                    </div>
                </form>

                <div class="map-trigger-container">
                    <button class="btn-view-map">
                        <i class="fas fa-map-marked-alt"></i>
                        Xaritadan ko'rish
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- TICKER BANNER -->
    <div class="ticker-banner">
        <div class="ticker-content">
            <div class="ticker-item">
                <span>Estora yangi imkoniyatlar taqdim etmoqda!</span>
            </div>
            <span class="ticker-separator">–</span>
            <div class="ticker-item">
                <span>Yangi turar-joy loyihalari ishga tushirildi.</span>
            </div>
            <span class="ticker-separator">–</span>
            <div class="ticker-item">
                <span>Xalqaro hamkorlik kengaymoqda</span>
            </div>
            <!-- Duplicated for loop effect -->
            <span class="ticker-separator">–</span>
            <div class="ticker-item">
                <span>Estora yangi imkoniyatlar taqdim etmoqda!</span>
            </div>
            <span class="ticker-separator">–</span>
            <div class="ticker-item">
                <span>Yangi turar-joy loyihalari ishga tushirildi.</span>
            </div>
            <span class="ticker-separator">–</span>
            <div class="ticker-item">
                <span>Xalqaro hamkorlik kengaymoqda</span>
            </div>
        </div>
    </div>

    <!-- BEST OFFERS SECTION -->
    <section class="listings-section">
        <div class="container">
            <div class="section-header">
                <div class="section-title-area">
                    <h2 class="section-title">Eng yaxshi takliflar</h2>
                    <p class="section-subtitle">Siz uchun eng maqbul va samarali yechimlarni topishda ishonchli hamkoringiz bo'lamiz.</p>
                </div>
                <div class="slider-controls">
                    <button class="btn-slider"><i class="fas fa-chevron-left"></i></button>
                    <button class="btn-slider"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>

            <div class="listings-grid">
                <!-- CARD 1 -->
                <div class="listing-card">
                    <div class="listing-img-wrapper">
                        <img src="/images/apartment1.png" alt="Bedroom Interior">
                        <span class="badge-top">TOP</span>
                        <div class="btn-favorite"><i class="far fa-heart"></i></div>
                        <span class="badge-promo yaxshi-taklif">Yaxshi Taklif</span>
                    </div>
                    <div class="listing-details">
                        <div class="listing-header-row">
                            <span class="listing-price">50.000 y.e</span>
                            <span class="listing-date">1 hafta oldin</span>
                        </div>
                        <h3 class="listing-title">Kvartira Sotiladi</h3>
                        <p class="listing-location">Qibray tumani, Limonaria village turar-joy majmuasi</p>
                        <div class="listing-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <div class="listing-specs">
                            <div class="spec-item"><i class="fas fa-building"></i> 5/7 etaj</div>
                            <div class="spec-item"><i class="fas fa-door-open"></i> 2 xona</div>
                            <div class="spec-item"><i class="fas fa-ruler-combined"></i> 45m²</div>
                        </div>
                        <div class="listing-tags">
                            <span class="listing-tag repair"><i class="fas fa-tools"></i> Yevro ta'mir</span>
                            <span class="listing-tag metro"><i class="fas fa-subway"></i> Oybek Metro</span>
                        </div>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="listing-card">
                    <div class="listing-img-wrapper">
                        <img src="/images/apartment2.png" alt="Living Room Interior">
                        <span class="badge-top">TOP</span>
                        <div class="btn-favorite"><i class="far fa-heart"></i></div>
                        <span class="badge-promo zudlik-bilan">Zudlik bilan</span>
                    </div>
                    <div class="listing-details">
                        <div class="listing-header-row">
                            <span class="listing-price">45.000 y.e</span>
                            <span class="listing-date">1 hafta oldin</span>
                        </div>
                        <h3 class="listing-title">Kvartira Sotiladi</h3>
                        <p class="listing-location">Qibray tumani, Limonaria village turar-joy majmuasi</p>
                        <div class="listing-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <div class="listing-specs">
                            <div class="spec-item"><i class="fas fa-building"></i> 5/7 etaj</div>
                            <div class="spec-item"><i class="fas fa-door-open"></i> 2 xona</div>
                            <div class="spec-item"><i class="fas fa-ruler-combined"></i> 45m²</div>
                        </div>
                        <div class="listing-tags">
                            <span class="listing-tag repair"><i class="fas fa-tools"></i> Yevro ta'mir</span>
                            <span class="listing-tag metro"><i class="fas fa-subway"></i> Oybek Metro</span>
                        </div>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="listing-card">
                    <div class="listing-img-wrapper">
                        <img src="/images/apartment3.png" alt="Kitchen Interior">
                        <span class="badge-top">TOP</span>
                        <div class="btn-favorite"><i class="far fa-heart"></i></div>
                        <span class="badge-promo super-narx">Super Narx</span>
                    </div>
                    <div class="listing-details">
                        <div class="listing-header-row">
                            <span class="listing-price">30.000 y.e</span>
                            <span class="listing-date">1 hafta oldin</span>
                        </div>
                        <h3 class="listing-title">Kvartira Sotiladi</h3>
                        <p class="listing-location">Qibray tumani, Limonaria village turar-joy majmuasi</p>
                        <div class="listing-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <div class="listing-specs">
                            <div class="spec-item"><i class="fas fa-building"></i> 5/7 etaj</div>
                            <div class="spec-item"><i class="fas fa-door-open"></i> 2 xona</div>
                            <div class="spec-item"><i class="fas fa-ruler-combined"></i> 45m²</div>
                        </div>
                        <div class="listing-tags">
                            <span class="listing-tag repair"><i class="fas fa-tools"></i> Yevro ta'mir</span>
                            <span class="listing-tag metro"><i class="fas fa-subway"></i> Oybek Metro</span>
                        </div>
                    </div>
                </div>

                <!-- CARD 4 -->
                <div class="listing-card">
                    <div class="listing-img-wrapper">
                        <img src="/images/apartment1.png" alt="Bedroom Interior">
                        <span class="badge-top">TOP</span>
                        <div class="btn-favorite"><i class="far fa-heart"></i></div>
                        <span class="badge-promo super-narx">Super Narx</span>
                    </div>
                    <div class="listing-details">
                        <div class="listing-header-row">
                            <span class="listing-price">30.000 y.e</span>
                            <span class="listing-date">1 hafta oldin</span>
                        </div>
                        <h3 class="listing-title">Kvartira Sotiladi</h3>
                        <p class="listing-location">Qibray tumani, Limonaria village turar-joy majmuasi</p>
                        <div class="listing-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <div class="listing-specs">
                            <div class="spec-item"><i class="fas fa-building"></i> 5/7 etaj</div>
                            <div class="spec-item"><i class="fas fa-door-open"></i> 2 xona</div>
                            <div class="spec-item"><i class="fas fa-ruler-combined"></i> 45m²</div>
                        </div>
                        <div class="listing-tags">
                            <span class="listing-tag repair"><i class="fas fa-tools"></i> Yevro ta'mir</span>
                            <span class="listing-tag metro"><i class="fas fa-subway"></i> Oybek Metro</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ANALYTICS SECTION -->
    <section class="analytics-section">
        <div class="container">
            <div class="analytics-content">
                <div class="analytics-left">
                    <h2 class="section-title" style="line-height: 1.3;">Ko'chmas mulk bozorining haqiqiy qiymatini bilib oling.</h2>
                    <p class="section-subtitle" style="margin-top: 10px;">Real vaqt statistikasi, narx dinamikasi va hududlar kesimidagi tahlillar orqali ko'chmas mulk bozorini ishonch bilan baholang.</p>
                    
                    <div class="analytics-features">
                        <!-- Feature 1 -->
                        <div class="analytics-feature-item">
                            <div class="feature-icon-box blue">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="feature-text-box">
                                <span class="feature-title">Real vaqt ma'lumotlari</span>
                                <p class="feature-desc">Narxlar, e'lonlar soni va bozor tendensiyalari doimiy yangilanib, sizga eng so‘nggi ma'lumotlarni taqdim etadi.</p>
                            </div>
                        </div>
                        <!-- Feature 2 -->
                        <div class="analytics-feature-item">
                            <div class="feature-icon-box green">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <div class="feature-text-box">
                                <span class="feature-title">Interaktiv xarita</span>
                                <p class="feature-desc">Hududlar kesimida narxlar, infratuzilma va bozor ko‘rsatkichlarini xaritada ko‘ring, solishtiring va tahlil qiling.</p>
                            </div>
                        </div>
                        <!-- Feature 3 -->
                        <div class="analytics-feature-item">
                            <div class="feature-icon-box orange">
                                <i class="fas fa-pie-chart"></i>
                            </div>
                            <div class="feature-text-box">
                                <span class="feature-title">Chuqur tahlil va statistika</span>
                                <p class="feature-desc">Narx dinamikasi, bozor faolligi va tarixiy ma'lumotlarni grafiklar hamda analitik ko‘rsatkichlar orqali baholang.</p>
                            </div>
                        </div>
                        <!-- Feature 4 -->
                        <div class="analytics-feature-item">
                            <div class="feature-icon-box purple">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="feature-text-box">
                                <span class="feature-title">Shaxsiy kuzatuv va ogohlantirishlar</span>
                                <p class="feature-desc">Qiziqtirgan hududlaringiz yoki mulklar bo‘yicha narx va bozor o‘zgarishlari haqida avtomatik xabarnomalar oling.</p>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="btn-analytics-action">
                        Bozor tahliliga kirish
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="analytics-right">
                    <div class="analytics-right-card">
                        <div class="map-header">
                            <div class="map-select-wrapper">
                                <select>
                                    <option>Toshkent shahri</option>
                                    <option>Samarqand shahri</option>
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>

                        <!-- Stylized SVG Map of Tashkent districts -->
                        <div class="svg-map-container">
                            <svg viewBox="0 0 400 300" class="tashkent-map-svg">
                                <defs>
                                    <radialGradient id="glow" cx="50%" cy="50%" r="50%">
                                        <stop offset="0%" stop-color="#0084ff" stop-opacity="0.6"/>
                                        <stop offset="100%" stop-color="#0084ff" stop-opacity="0"/>
                                    </radialGradient>
                                </defs>
                                <!-- Map Background grid paths (styled look) -->
                                <rect width="100%" height="100%" fill="#f1f5f9" />
                                
                                <!-- Abstract District Shapes -->
                                <!-- Yunusobod -->
                                <path d="M 120,40 L 260,20 L 250,90 L 170,110 Z" fill="#90caf9" stroke="#ffffff" stroke-width="1.5" class="map-district" />
                                <text x="180" y="65" font-size="11" font-weight="700" fill="#061c3f" opacity="0.8">Yunusobod</text>
                                
                                <!-- Shayxontohur -->
                                <path d="M 70,100 L 170,110 L 150,170 L 60,160 Z" fill="#42a5f5" stroke="#ffffff" stroke-width="1.5" class="map-district" />
                                <text x="90" y="135" font-size="11" font-weight="700" fill="#061c3f" opacity="0.8">Shayxontohur</text>
                                
                                <!-- Mirobod -->
                                <path d="M 170,110 L 250,90 L 310,160 L 230,220 Z" fill="#1e88e5" stroke="#ffffff" stroke-width="1.5" class="map-district" />
                                <text x="220" y="145" font-size="11" font-weight="700" fill="#ffffff" opacity="0.9">Mirobod</text>
                                
                                <!-- Glowing Pins -->
                                <circle cx="230" cy="130" r="12" fill="url(#glow)" class="map-pulse" />
                                <circle cx="230" cy="130" r="4" fill="#ff9e0d" />

                                <circle cx="130" cy="120" r="12" fill="url(#glow)" class="map-pulse" />
                                <circle cx="130" cy="120" r="4" fill="#ff9e0d" />

                                <circle cx="210" cy="70" r="12" fill="url(#glow)" class="map-pulse" />
                                <circle cx="210" cy="70" r="4" fill="#ff9e0d" />
                            </svg>
                        </div>

                        <!-- Sparkline Stats Section -->
                        <div class="map-stats-grid">
                            <div class="stat-block">
                                <div class="stat-block-header">
                                    <span class="stat-block-title">Narx tendensiyasi</span>
                                    <span class="stat-change-tag">2.8%</span>
                                </div>
                                <span class="stat-meta-text">O'tgan 3 oy</span>
                                
                                <!-- SVG Line Chart -->
                                <div class="sparkline-container">
                                    <svg viewBox="0 0 160 50" width="100%" height="100%">
                                        <defs>
                                            <linearGradient id="chartGrad" x1="0" y1="0" x2="0" y2="1">
                                                <stop offset="0%" stop-color="#0084ff" stop-opacity="0.3" />
                                                <stop offset="100%" stop-color="#0084ff" stop-opacity="0" />
                                            </linearGradient>
                                        </defs>
                                        <path d="M 0,40 Q 30,25 60,35 T 120,15 T 160,5 L 160,50 L 0,50 Z" fill="url(#chartGrad)" />
                                        <path d="M 0,40 Q 30,25 60,35 T 120,15 T 160,5" fill="none" stroke="#0084ff" stroke-width="2.5" />
                                        <circle cx="160" cy="5" r="4" fill="#0084ff" />
                                    </svg>
                                </div>
                            </div>

                            <div class="stat-block" style="border-left: 1px solid var(--border-color); padding-left: 20px;">
                                <div class="stat-block-header">
                                    <span class="stat-block-title">Eng qimmat hududlar</span>
                                    <span class="stat-change-tag" style="color: #2e7d32; background-color: #e8f5e9;">14.3%</span>
                                </div>
                                <div class="expensive-list">
                                    <div class="expensive-item">
                                        <div class="expensive-item-left">
                                            <span class="expensive-num">01</span>
                                            <span class="expensive-name">Mirobod</span>
                                        </div>
                                        <span class="expensive-val">22.8 mln</span>
                                    </div>
                                    <div class="expensive-item">
                                        <div class="expensive-item-left">
                                            <span class="expensive-num">02</span>
                                            <span class="expensive-name">Yunusobod</span>
                                        </div>
                                        <span class="expensive-val">20.1 mln</span>
                                    </div>
                                    <div class="expensive-item">
                                        <div class="expensive-item-left">
                                            <span class="expensive-num">03</span>
                                            <span class="expensive-name">Shayxontohur</span>
                                        </div>
                                        <span class="expensive-val">19.2 mln</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- EXTRA SERVICES SECTION -->
    <section class="services-section">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                <div class="section-title-area">
                    <span class="section-header-badge">Xizmatlarimiz</span>
                    <h2 class="section-title">Qo'shimcha uy xizmatlari</h2>
                    <p class="section-subtitle">Uy bilan bog'liq har qanday muammoda — bitta qo'ng'iroq, ishonchli yechim.</p>
                </div>
                <a href="{{ route('maniDashboard') }}" class="btn-add-ad" style="background-color: var(--accent-orange); box-shadow: 0 4px 6px rgba(255,152,0,0.2); text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                    Barchasini ko'rish
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="services-grid">
                <!-- Service 1 -->
                <div class="service-card">
                    <div class="service-icon-box">
                        <i class="fas fa-couch"></i>
                    </div>
                    <span class="service-title">Dizayner</span>
                    <p class="service-desc">Interer & Ekster'er</p>
                    <i class="fas fa-arrow-right service-arrow"></i>
                </div>

                <!-- Service 2 -->
                <div class="service-card">
                    <div class="service-icon-box">
                        <i class="fas fa-bed"></i>
                    </div>
                    <span class="service-title">Mebel</span>
                    <p class="service-desc">Ta'mirlash & Buyurtma</p>
                    <i class="fas fa-arrow-right service-arrow"></i>
                </div>

                <!-- Service 3 -->
                <div class="service-card">
                    <div class="service-icon-box">
                        <i class="fas fa-truck-moving"></i>
                    </div>
                    <span class="service-title">Ko'chish</span>
                    <p class="service-desc">Uydan-uyga ko'chirish</p>
                    <i class="fas fa-arrow-right service-arrow"></i>
                </div>

                <!-- Service 4 -->
                <div class="service-card">
                    <div class="service-icon-box">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <span class="service-title">Elektrik</span>
                    <p class="service-desc">O'rnatish & Ta'mirlash</p>
                    <i class="fas fa-arrow-right service-arrow"></i>
                </div>

                <!-- Service 5 -->
                <div class="service-card">
                    <div class="service-icon-box">
                        <i class="fas fa-faucet"></i>
                    </div>
                    <span class="service-title">Santexnik</span>
                    <p class="service-desc">O'rnatish & Ta'mirlash</p>
                    <i class="fas fa-arrow-right service-arrow"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- ADVANTAGES SECTION -->
    <section class="advantages-section">
        <div class="container">
            <div class="section-title-area" style="align-items: center; text-align: center; margin-bottom: 20px;">
                <span class="section-header-badge">Afzalliklar</span>
                <h2 class="section-title">Nima uchun Estora?</h2>
            </div>

            <div class="advantages-grid">
                <!-- Advantage 1 -->
                <div class="advantage-card">
                    <div class="advantage-icon-box">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <h3 class="advantage-title">To‘liq va aniq bozor ma’lumotlari</h3>
                    <p class="advantage-desc">Xarita, radius va bozor narxlari tahlili yordamida eng mos mulkni tez va aniq toping.</p>
                </div>

                <!-- Advantage 2 -->
                <div class="advantage-card">
                    <div class="advantage-icon-box">
                        <i class="fas fa-magnifying-glass-location"></i>
                    </div>
                    <h3 class="advantage-title">Aqlli va qulay qidiruv</h3>
                    <p class="advantage-desc">Radius bo‘yicha qidiruv, bitta ishonch raqami va xavfsiz aloqa orqali kerakli mulkni tez va oson toping.</p>
                </div>

                <!-- Advantage 3 -->
                <div class="advantage-card">
                    <div class="advantage-icon-box">
                        <i class="fas fa-shield-halved"></i>
                    </div>
                    <h3 class="advantage-title">Xavfsiz va ishonchli aloqa</h3>
                    <p class="advantage-desc">Uy egasi bilan to‘g‘ridan-to‘g‘ri aloqa qiling, vositachisiz bevosita bog‘lanish imkoniyatidan foydalaning.</p>
                </div>

                <!-- Advantage 4 -->
                <div class="advantage-card">
                    <div class="advantage-icon-box">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3 class="advantage-title">Zamonaviy va xalqaro darajadagi xizmat</h3>
                    <p class="advantage-desc">Bitta platformada barcha ko'chmas mulk xizmatlari. Mahalliy va xalqaro foydalanuvchilar uchun qulay yechim.</p>
                </div>
            </div>
        </div>
    </section>

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
            const regionSelect = document.getElementById('region_id');
            const citySelect = document.getElementById('city_id');
            
            if (regionSelect && citySelect) {
                // Hamma original optionlarni saqlab qolamiz
                const originalCityOptions = Array.from(citySelect.options);
                
                regionSelect.addEventListener('change', function() {
                    const selectedRegionId = this.value;
                    
                    // Mavjud tumanlarni tozalash
                    citySelect.innerHTML = '';
                    
                    // Default "Tanlang" ni qaytarish
                    citySelect.appendChild(originalCityOptions[0].cloneNode(true));
                    
                    if (selectedRegionId) {
                        // Agar viloyat tanlangan bo'lsa, faqat shunga tegishli tumanlarni qo'shish
                        originalCityOptions.forEach(option => {
                            if (option.value !== "" && option.getAttribute('data-region') === selectedRegionId) {
                                citySelect.appendChild(option.cloneNode(true));
                            }
                        });
                    } else {
                        // Agar viloyat tanlanmagan bo'lsa (yoki "Tanlang"ga qaytilsa),
                        // barcha tumanlarni qaytadan ko'rsatish (yoki bo'sh qoldirish) mumkin.
                        // Foydalanuvchi qulayligi uchun barcha tumanlarni ko'rsatamiz:
                        originalCityOptions.forEach(option => {
                            if (option.value !== "") {
                                citySelect.appendChild(option.cloneNode(true));
                            }
                        });
                    }
                });

                // Sahifa yuklanganda viloyat tanlanmagan bo'lsa barcha tumanlarni ko'rsatib turish yoki 
                // tanlangan viloyatga mos tumanlarni ko'rsatish uchun:
                regionSelect.dispatchEvent(new Event('change'));
            }

            // Filter tab toggling logic in hero form
            const filterTabs = document.querySelectorAll('.filter-tab');
            const transactionInput = document.getElementById('transaction_type');

            filterTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    filterTabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    const val = this.getAttribute('data-value');
                    if (transactionInput) {
                        transactionInput.value = val;
                    }
                });
            });

            // Universal AJAX Favorite Toggle Handler
            const csrfToken = '{{ csrf_token() }}';
            document.body.addEventListener('click', function(e) {
                const btn = e.target.closest('.js-favorite-btn');
                if (!btn) return;

                e.preventDefault();
                e.stopPropagation();

                const productId = btn.dataset.id;
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

                        showFavoriteToast(data.message, data.is_favorited);
                    }
                })
                .catch(err => console.error('Favorite toggle error:', err));
            });

            function showFavoriteToast(message, isFavorited) {
                let toast = document.getElementById('favoriteToast');
                if (!toast) {
                    toast = document.createElement('div');
                    toast.id = 'favoriteToast';
                    toast.style.cssText = 'position: fixed; bottom: 24px; right: 24px; z-index: 9999; padding: 12px 20px; border-radius: 12px; font-weight: 700; font-size: 13px; color: white; box-shadow: 0 10px 25px rgba(0,0,0,0.2); transition: all 0.3s ease; opacity: 0; transform: translateY(20px); pointer-events: none; display: flex; align-items: center; gap: 8px; font-family: sans-serif;';
                    document.body.appendChild(toast);
                }

                toast.style.backgroundColor = isFavorited ? '#061c3f' : '#374151';
                toast.innerHTML = (isFavorited ? '<i class="fas fa-heart text-red-500"></i> ' : '<i class="far fa-heart text-gray-300"></i> ') + message;
                toast.style.opacity = '1';
                toast.style.transform = 'translateY(0)';

                setTimeout(() => {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateY(20px)';
                }, 2500);
            }
        });
    </script>
</body>
</html>
