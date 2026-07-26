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
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo-icon {
            color: var(--accent-blue);
            font-size: 32px;
            display: flex;
            align-items: center;
        }

        .logo-text {
            display: flex;
            flex-direction: column;
        }

        .logo-title {
            font-family: var(--font-display);
            font-weight: 800;
            font-size: 24px;
            color: var(--primary-navy);
            letter-spacing: 1px;
            line-height: 1;
        }

        .logo-subtitle {
            font-size: 10px;
            color: var(--accent-blue);
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            line-height: 1;
            margin-top: 2px;
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

.top-meta-icons {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-bottom: 16px;
}

.action-meta-btn {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    border: 1px solid var(--border-color);
    color: var(--text-muted);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
}

.action-meta-btn:hover {
    color: var(--accent-blue);
    border-color: var(--accent-blue);
    background-color: #f8f9fa;
}

.phone-action-container {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 20px;
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
}

.phone-reveal-btn:hover {
    background-color: var(--primary-navy);
}

.tg-write-btn {
    width: 100%;
    border: 1px solid var(--border-color);
    color: var(--text-dark);
    padding: 9px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
    text-align: center;
    transition: all 0.2s;
    display: inline-block;
}

.tg-write-btn:hover {
    border-color: var(--accent-blue);
    color: var(--accent-blue);
    background-color: #f8f9fa;
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
                    <div class="logo-container">
                        <div class="logo-icon">
                            <i class="fas fa-house-chimney-window"></i>
                        </div>
                        <div class="logo-text">
                            <span class="logo-title">ESTORA</span>
                            <span class="logo-subtitle">Real Estate</span>
                        </div>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="btn-add-ad">
                        <i class="fas fa-plus"></i>
                        E'lon joylashtirish
                    </button>
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
                    <li><a href="#" class="nav-item active">Sotuv</a></li>
                    <li><a href="#" class="nav-item">ijara</a></li>
                    <li><a href="#" class="nav-item">Xonadosh</a></li>
                    <li><a href="#" class="nav-item">Tijorat</a></li>
                    <li><a href="#" class="nav-item">Dacha</a></li>
                    <li><a href="#" class="nav-item">Xalqaro</a></li>
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
                        <select name="property_type">
                            <option value="Tanlang">Tanlang</option>
                            <option value="Kvartira" {{ request('property_type') == 'Kvartira' ? 'selected' : '' }}>Kvartira</option>
                            <option value="Hovli" {{ request('property_type') == 'Hovli' ? 'selected' : '' }}>Hovli</option>
                            <option value="Ofis" {{ request('property_type') == 'Ofis' ? 'selected' : '' }}>Ofis</option>
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
                        <select name="time_filter">
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
                </div>
            </form>
        </div>
    </div>


    
    <!-- SEARCH RESULTS SECTION -->
    <div class="results-container">
        <div class="container">
            <div class="results-header-bar">
                <div class="breadcrumbs">
                    Bosh sahifa / {{ request('transaction_type', 'Sotuv') }} / {{ request('property_type', 'Kvartira') }}
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
                            
                            <h3 class="product-title-text">{{ strtoupper($product->category->name ?? request('transaction_type', 'SOTUV')) }} | {{ strtoupper($product->subCategory->name ?? request('property_type', 'KVARTIRA')) }}</h3>
                            <div class="product-name-subtitle" style="font-size: 14px; font-weight: 600; color: var(--text-dark); margin-bottom: 6px;">{{ $product->name }}</div>
                            
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
                            <div class="top-meta-icons">
                                <div class="action-meta-btn wishlist-btn" title="Saralanganlar"><i class="far fa-heart"></i></div>
                                <div class="action-meta-btn share-btn" title="Ulashish"><i class="far fa-share-square"></i></div>
                            </div>
                            
                            <div class="phone-action-container">
                                @if($product->phone)
                                    <button class="phone-reveal-btn" onclick="revealPhone(this, '{{ $product->phone }}')">
                                        <i class="fas fa-phone-alt"></i> Telefon raqam
                                    </button>
                                    <a href="https://t.me/estora_support" target="_blank" class="tg-write-btn">
                                        <i class="fab fa-telegram-plane"></i> Telegram orqali yozish
                                    </a>
                                @else
                                    <button class="phone-reveal-btn disabled" disabled>
                                        <i class="fas fa-phone-alt"></i> Telefon raqam yo'q
                                    </button>
                                @endif
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
                    <div class="no-results-card">
                        <i class="far fa-folder-open text-4xl mb-3 block" style="font-size: 40px; margin-bottom: 12px; color: var(--text-muted);"></i>
                        <h3>Siz tanlagan filtrlar bo'yicha e'lonlar topilmadi.</h3>
                        <p>Iltimos, filtrlarni o'zgartirib qaytadan urinib ko'ring.</p>
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
    <div class="chat-widget">
        <div class="chat-widget-pulse"></div>
        <span>Savollaringiz bormi? Biz aloqadamiz.</span>
    </div>

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

            // Filter tab toggling logic
            const filterTabs = document.querySelectorAll('.filter-tab');
            const transactionInput = document.getElementById('transaction_type');
            const navItems = document.querySelectorAll('.sub-navbar .nav-item');

            filterTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    filterTabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    const val = this.getAttribute('data-value');
                    if (transactionInput) {
                        transactionInput.value = val;
                    }

                    // Also update active state on sub-navbar links if they match
                    navItems.forEach(nav => {
                        if (nav.textContent.trim().toLowerCase() === val.toLowerCase()) {
                            navItems.forEach(n => n.classList.remove('active'));
                            nav.classList.add('active');
                        }
                    });
                });
            });

            // Sync sub-navbar links with filter tabs
            navItems.forEach(nav => {
                nav.addEventListener('click', function(e) {
                    e.preventDefault();
                    const text = this.textContent.trim();
                    const matchingTab = Array.from(filterTabs).find(t => t.textContent.trim().toLowerCase() === text.toLowerCase());
                    if (matchingTab) {
                        matchingTab.click();
                        // Scroll to filters
                        document.querySelector('.filter-container').scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                });
            });
        
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

            window.revealPhone = function(button, phone) {
                button.innerHTML = `<i class="fas fa-phone-alt"></i> ${phone}`;
                button.onclick = null;
            };

            // Set active states on search filters based on request query params
            const currentTxType = "{{ request('transaction_type', 'Sotuv') }}";
            if (currentTxType) {
                const matchingTab = Array.from(filterTabs).find(t => t.getAttribute('data-value').toLowerCase() === currentTxType.toLowerCase());
                if (matchingTab) {
                    filterTabs.forEach(t => t.classList.remove('active'));
                    matchingTab.classList.add('active');
                    if (transactionInput) transactionInput.value = matchingTab.getAttribute('data-value');
                    
                    navItems.forEach(nav => {
                        if (nav.textContent.trim().toLowerCase() === currentTxType.toLowerCase()) {
                            navItems.forEach(n => n.classList.remove('active'));
                            nav.classList.add('active');
                        }
                    });
                }
            }

            // Compact Tab toggling logic
            const compactTabs = document.querySelectorAll('.compact-tab');
            const compactTxInput = document.getElementById('transaction_type');
            const navItems = document.querySelectorAll('.sub-navbar .nav-item');

            compactTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    compactTabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    const val = this.getAttribute('data-value');
                    if (compactTxInput) {
                        compactTxInput.value = val;
                    }

                    // Sync sub-navbar links
                    navItems.forEach(nav => {
                        if (nav.textContent.trim().toLowerCase() === val.toLowerCase()) {
                            navItems.forEach(n => n.classList.remove('active'));
                            nav.classList.add('active');
                        }
                    });
                });
            });

            // Sync sub-navbar with compact tabs
            navItems.forEach(nav => {
                nav.addEventListener('click', function(e) {
                    e.preventDefault();
                    const text = this.textContent.trim();
                    const matchingTab = Array.from(compactTabs).find(t => t.textContent.trim().toLowerCase() === text.toLowerCase());
                    if (matchingTab) {
                        matchingTab.click();
                    }
                });
            });
});
    </script>
</body>
</html>
