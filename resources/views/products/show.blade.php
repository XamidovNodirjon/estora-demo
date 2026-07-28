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

/* ================= PRODUCT SHOW PAGE PREMIUM STYLES ================= */
.breadcrumbs-container {
    background-color: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    padding: 12px 0;
    font-size: 13px;
    color: var(--text-muted);
}
.breadcrumbs-container a {
    color: var(--text-muted);
    text-decoration: none;
    transition: color 0.2s;
}
.breadcrumbs-container a:hover {
    color: var(--accent-blue);
}

.product-detail-section {
    padding: 30px 0 60px 0;
    background-color: #fcfdfe;
}

.product-detail-header-block {
    margin-bottom: 24px;
}

.detail-header-top-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.header-badges-left {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.badge-detail {
    padding: 5px 12px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    border-radius: 6px;
    letter-spacing: 0.5px;
}

.kelishiladi-badge {
    background-color: #e0f2fe;
    color: #0369a1;
}

.ipoteka-badge {
    background-color: #fef3c7;
    color: #b45309;
}

.subsidiya-badge {
    background-color: #dcfce7;
    color: #15803d;
}

.date-badge {
    background-color: #f1f5f9;
    color: #475569;
}

.detail-id-badge {
    background-color: var(--primary-navy);
    color: #ffffff;
    padding: 5px 12px;
    font-size: 12px;
    font-weight: 700;
    border-radius: 6px;
}

.detail-title-text {
    font-family: 'Outfit', sans-serif;
    font-size: 26px;
    font-weight: 800;
    color: var(--primary-navy);
    margin-bottom: 10px;
}

.detail-header-tags {
    display: flex;
    gap: 8px;
}

.header-tag {
    background-color: #f1f3f5;
    color: var(--text-dark);
    padding: 4px 10px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 6px;
}

/* Two-column layout grid */
.detail-columns-grid {
    display: grid;
    grid-template-columns: 1.4fr 1fr;
    gap: 30px;
    align-items: start;
}

/* Gallery / Carousel Styles */
.detail-gallery-wrapper {
    display: flex;
    gap: 15px;
    background-color: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    margin-bottom: 30px;
    height: 480px;
}

.gallery-thumbnails {
    width: 90px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    overflow-y: auto;
    max-height: 100%;
}

.thumb-item {
    border: 2px solid transparent;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.2s;
    flex-shrink: 0;
    aspect-ratio: 1/1;
}

.thumb-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.thumb-item.active, .thumb-item:hover {
    border-color: var(--accent-blue);
    transform: scale(0.96);
}

.gallery-main-view {
    flex: 1;
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    background-color: #f3f4f6;
    height: 100%;
}

.main-image-wrapper {
    width: 100%;
    height: 100%;
}

.main-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.badge-top-left-yaxshi {
    position: absolute;
    top: 15px;
    left: 15px;
    background-color: #10b981;
    color: white;
    padding: 4px 10px;
    font-size: 11px;
    font-weight: 700;
    border-radius: 6px;
    z-index: 10;
}

.gallery-controls-overlay {
    position: absolute;
    bottom: 15px;
    right: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    z-index: 10;
}

.gallery-index-badge {
    background-color: rgba(0,0,0,0.6);
    backdrop-filter: blur(4px);
    color: white;
    padding: 4px 10px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 6px;
}

.gallery-fullscreen-btn {
    background-color: rgba(255,255,255,0.9);
    border: none;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 14px;
    color: var(--primary-navy);
    transition: all 0.2s;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.gallery-fullscreen-btn:hover {
    background-color: #ffffff;
    transform: scale(1.05);
}

/* Address Box & Map Styles */
.detail-address-box {
    background-color: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    margin-bottom: 30px;
}

.detail-address-box h3 {
    font-family: 'Outfit', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: var(--primary-navy);
    margin-bottom: 12px;
}

.address-text {
    font-size: 14px;
    color: var(--text-dark);
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 15px;
}

.text-orange {
    color: var(--accent-orange);
}

#showMap {
    height: 280px;
    width: 100%;
    border-radius: 12px;
    border: 1px solid var(--border-color);
}

/* Right Column Owner / Pricing Card */
.owner-pricing-card {
    background-color: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    margin-bottom: 24px;
}

.owner-header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #f1f3f5;
    padding-bottom: 15px;
    margin-bottom: 20px;
}

.owner-avatar-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.owner-avatar {
    font-size: 40px;
    color: var(--accent-blue);
}

.owner-name {
    font-size: 15px;
    font-weight: 700;
    color: var(--primary-navy);
}

.owner-type {
    font-size: 12px;
    color: var(--text-muted);
}

.owner-action-icons {
    display: flex;
    gap: 8px;
}

.btn-owner-action {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: 1px solid var(--border-color);
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    cursor: pointer;
    font-size: 13px;
    transition: all 0.2s;
}

.btn-owner-action:hover {
    background-color: #f8fafc;
    color: var(--accent-blue);
    border-color: var(--accent-blue);
}

.phone-and-price-row {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.detail-phone-wrapper {
    flex: 1;
}

.phone-label, .price-label {
    font-size: 11px;
    text-transform: uppercase;
    font-weight: 700;
    color: var(--text-muted);
    letter-spacing: 0.5px;
    display: block;
    margin-bottom: 6px;
}

.phone-reveal-container {
    display: flex;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    overflow: hidden;
    height: 42px;
    align-items: center;
    padding-left: 12px;
}

.phone-masked-num {
    font-size: 14px;
    font-weight: 600;
    color: var(--primary-navy);
    flex: 1;
}

.btn-reveal-phone {
    background-color: var(--primary-navy);
    color: white;
    border: none;
    padding: 0 15px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    height: 100%;
    transition: background-color 0.2s;
}

.btn-reveal-phone:hover {
    background-color: var(--secondary-navy);
}

.detail-price-box {
    flex: 1;
}

.price-value {
    font-family: 'Outfit', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: var(--accent-blue);
    display: block;
}

.btn-telegram-direct {
    background-color: #24A1DE;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    width: 100%;
    transition: background-color 0.2s;
}

.btn-telegram-direct:hover {
    background-color: #208fbe;
}

/* Parameters Table Box */
.detail-params-box {
    background-color: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    margin-bottom: 24px;
}

.detail-params-box h3, .detail-amenities-box h3, .detail-desc-box h3 {
    font-family: 'Outfit', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: var(--primary-navy);
    margin-bottom: 15px;
    border-bottom: 1px solid #f1f3f5;
    padding-bottom: 10px;
}

.params-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px 20px;
}

.param-item {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    padding: 4px 0;
    border-bottom: 1px dashed #f1f3f5;
}

.param-label {
    color: var(--text-muted);
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 6px;
}

.param-label i {
    width: 16px;
    color: var(--accent-blue);
}

.param-value {
    color: var(--primary-navy);
    font-weight: 600;
}

/* Amenities & Nearby list */
.detail-amenities-box {
    background-color: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    margin-bottom: 24px;
}

.amenities-group {
    margin-bottom: 15px;
}

.amenities-group:last-child {
    margin-bottom: 0;
}

.group-title {
    font-size: 13px;
    font-weight: 700;
    color: var(--primary-navy);
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 8px;
}

.group-tags {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.group-tag-item {
    background-color: #f8fafc;
    border: 1px solid #e2e8f0;
    color: var(--text-dark);
    font-size: 12px;
    font-weight: 500;
    padding: 4px 12px;
    border-radius: 6px;
}

/* Description Box */
.detail-desc-box {
    background-color: #ffffff;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
}

.desc-content {
    font-size: 14px;
    line-height: 1.6;
    color: var(--text-dark);
    font-weight: 500;
    word-break: break-word;
    overflow-wrap: anywhere;
    max-width: 100%;
}

/* Recommendations styling */
.recommendations-title {
    font-family: 'Outfit', sans-serif;
    font-size: 22px;
    font-weight: 800;
    color: var(--primary-navy);
    margin-bottom: 20px;
}

.recommendations-tabs {
    display: flex;
    gap: 8px;
    margin-bottom: 25px;
    border-bottom: 1px solid var(--border-color);
    padding-bottom: 10px;
    overflow-x: auto;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
    max-width: 100%;
    scrollbar-width: none;
}

.recommendations-tabs::-webkit-scrollbar {
    display: none;
}

.rec-tab-btn {
    border: none;
    background: none;
    font-size: 14px;
    font-weight: 600;
    color: var(--text-muted);
    padding: 8px 16px;
    cursor: pointer;
    border-radius: 8px;
    transition: all 0.2s;
    flex-shrink: 0;
    white-space: nowrap;
}

.rec-tab-btn:hover {
    color: var(--accent-blue);
    background-color: #f1f5f9;
}

.rec-tab-btn.active {
    background-color: #e8f4ff;
    color: var(--accent-blue);
}

.rec-tab-panel {
    display: none;
}

.rec-tab-panel.active {
    display: block;
}

.rec-listings-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 20px;
}

.rec-listings-grid > .listing-card {
    width: 100%;
    max-width: 320px;
}

.rec-empty-message {
    padding: 40px;
    text-align: center;
    color: var(--text-muted);
    font-weight: 500;
    background-color: #f8fafc;
    border-radius: 12px;
    border: 1px dashed var(--border-color);
    grid-column: 1 / -1;
}

/* Responsive Show page styles */
@media (max-width: 1200px) {
    .rec-listings-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }
}

@media (max-width: 992px) {
    .detail-columns-grid {
        grid-template-columns: 1fr;
    }
    .rec-listings-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 768px) {
    .detail-gallery-wrapper {
        flex-direction: column-reverse;
        height: auto;
    }
    
    .gallery-thumbnails {
        width: 100%;
        flex-direction: row;
        overflow-x: auto;
        max-height: none;
        height: 80px;
        margin-top: 10px;
        padding-bottom: 5px;
    }
    
    .thumb-item {
        flex: 0 0 65px;
        height: 65px;
    }
    
    .gallery-main-view {
        height: 350px;
    }
    
    .params-grid {
        grid-template-columns: 1fr;
    }
    
    .phone-and-price-row {
        flex-direction: column;
        gap: 15px;
    }
}

@media (max-width: 576px) {
    .rec-listings-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .detail-header-top-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .detail-id-badge {
        align-self: flex-start;
    }
    
    .owner-header-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
    
    .owner-action-icons {
        width: 100%;
        justify-content: flex-start;
    }
    
    
    .gallery-main-view {
        height: 250px;
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

<!-- BREADCRUMBS -->
<div class="breadcrumbs-container">
    <div class="container">
        <a href="/">Bosh sahifa</a> / 
        <a href="{{ route('maniDashboard') }}?transaction_type={{ $product->category->name ?? 'Sotuv' }}">{{ $product->category->name ?? 'Sotuv' }}</a> / 
        <a href="{{ route('maniDashboard') }}?transaction_type={{ $product->category->name ?? 'Sotuv' }}&property_type={{ $product->subCategory->name ?? 'Kvartira' }}">{{ $product->subCategory->name ?? 'Kvartira' }}</a>
    </div>
</div>

<!-- PRODUCT DETAIL CONTENT -->
<div class="product-detail-section">
    <div class="container">
        @if(!empty($isOwner))
            <div style="background: linear-gradient(135deg, #061c3f 0%, #0B2240 100%); border-radius: 16px; padding: 20px 24px; color: #fff; margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; border: 1px solid #1e3a8a;">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(255,255,255,0.1); color: #38bdf8; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <div>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #93c5fd;">Maxsus statistika</span>
                            <span style="padding: 2px 8px; border-radius: 9999px; background: rgba(16,185,129,0.2); color: #6ee7b7; font-size: 10px; font-weight: 700;">Faqat sizga ko'rinadi</span>
                        </div>
                        <h3 style="font-size: 22px; font-weight: 700; margin-top: 4px;">{{ number_format($viewsCount ?? 0, 0, ',', ' ') }} ta ko'rishlar</h3>
                    </div>
                </div>
            </div>
        @endif
        <!-- Main title & badges -->
        <div class="product-detail-header-block">
            <div class="detail-header-top-row">
                <div class="header-badges-left">
                    @if($product->exchange)
                        <span class="badge-detail kelishiladi-badge">Kelishiladi</span>
                    @endif
                    @if($product->credit)
                        <span class="badge-detail ipoteka-badge">Ipoteka</span>
                    @endif
                    @if($product->pay_in_installments)
                        <span class="badge-detail subsidiya-badge">Subsidiya</span>
                    @endif
                    <span class="badge-detail date-badge">E'lon joylangan sana: {{ $product->created_at->format('d.m.Y') }}</span>
                </div>
                <span class="detail-id-badge">ID {{ 10000 + $product->id }}</span>
            </div>
            
            <h1 class="detail-title-text">{{ $product->subCategory->name ?? 'Kvartira' }} - {{ $product->square }} m², {{ $product->rooms }} xona</h1>
            
            <div class="detail-header-tags">
                <span class="header-tag">{{ $product->category->name ?? 'Sotuv' }}</span>
                <span class="header-tag">Turar joy</span>
                <span class="header-tag">{{ $product->subCategory->name ?? 'Kvartira' }}</span>
            </div>
        </div>

        <div class="detail-columns-grid">
            <!-- LEFT COLUMN (Media and Address) -->
            <div class="detail-left-column">
                <!-- Gallery Wrapper -->
                <div class="detail-gallery-wrapper">
                    @php
                        $images = $product->images;
                        if (is_string($images)) {
                            $images = json_decode($images, true);
                        }
                        $images = is_array($images) ? $images : [];
                    @endphp
                    
                    <!-- Thumbnails column -->
                    <div class="gallery-thumbnails">
                        @if(count($images) > 0)
                            @foreach($images as $idx => $img)
                                <div class="thumb-item {{ $loop->first ? 'active' : '' }}" onclick="switchMainImage(this, '{{ Str::startsWith($img, 'http') ? $img : (Str::startsWith($img, '/storage') ? $img : (Str::startsWith($img, 'storage') ? '/' . $img : '/storage/' . $img)) }}', {{ $loop->index }})">
                                    <img src="{{ Str::startsWith($img, 'http') ? $img : (Str::startsWith($img, '/storage') ? $img : (Str::startsWith($img, 'storage') ? '/' . $img : '/storage/' . $img)) }}" alt="Thumbnail">
                                </div>
                            @endforeach
                        @else
                            <div class="thumb-item active">
                                <img src="/images/apartment1.png" alt="Thumbnail">
                            </div>
                        @endif
                    </div>
                    
                    <!-- Main image view -->
                    <div class="gallery-main-view">
                        <div class="main-image-wrapper">
                            @if(count($images) > 0)
                                <img id="mainGalleryImage" src="{{ Str::startsWith($images[0], 'http') ? $images[0] : (Str::startsWith($images[0], '/storage') ? $images[0] : (Str::startsWith($images[0], 'storage') ? '/' . $images[0] : '/storage/' . $images[0])) }}" alt="{{ $product->name }}">
                            @else
                                <img id="mainGalleryImage" src="/images/apartment1.png" alt="Placeholder">
                            @endif
                        </div>
                        <span class="badge-top-left-yaxshi yaxshi-taklif-badge">Yaxshi Taklif</span>
                        
                        <div class="gallery-controls-overlay">
                            <span class="gallery-index-badge" id="galleryIndexText">1/{{ max(count($images), 1) }}</span>
                            <button class="gallery-fullscreen-btn" onclick="toggleFullscreen()"><i class="fas fa-expand"></i></button>
                        </div>
                    </div>
                </div>
                
                <!-- Address Section -->
                <div class="detail-address-box">
                    <h3>Manzil</h3>
                    <p class="address-text">
                        <i class="fas fa-map-marker-alt text-orange"></i>
                        {{ $product->region->name ?? 'Toshkent shahri' }}, {{ $product->city->name ?? 'Chilonzor tumani' }}
                        @if($product->landmark)
                            , Mo'ljal: {{ $product->landmark }}
                        @endif
                    </p>
                    
                    <!-- Leaflet map container -->
                    <div id="showMap"></div>
                </div>
            </div>

            <!-- RIGHT COLUMN (Pricing, Params, Nearby, Description) -->
            <div class="detail-right-column">
                <!-- Owner & Pricing card -->
                <div class="owner-pricing-card">
                    <div class="owner-header-row">
                        <a href="{{ route('users.show', $product->user_id) }}" class="owner-avatar-info" style="text-decoration: none; color: inherit; cursor: pointer;">
                            <div class="owner-avatar"><i class="fas fa-user-circle"></i></div>
                            <div>
                                <h4 class="owner-name" style="transition: color 0.2s;" onmouseover="this.style.color='#0084ff'" onmouseout="this.style.color='inherit'">{{ $product->user->name ?? 'Muallif' }}</h4>
                                <span class="owner-type">{{ ($product->user->role?->name ?? $product->user->type) === 'makler' ? 'Makler (Rieltor)' : 'Jismoniy shaxs' }}</span>
                            </div>
                        </a>
                        <div class="owner-action-icons">
                            <button class="btn-owner-action js-favorite-btn" data-id="{{ $product->id }}" title="Saralanganlarga qo'shish"><i class="{{ Auth::check() && $product->isFavoritedBy(Auth::user()) ? 'fas fa-heart text-red-500' : 'far fa-heart' }}"></i></button>
                            <button class="btn-owner-action share-btn" data-id="{{ $product->id }}" title="Ulashish"><i class="fas fa-share-alt"></i></button>
                            <button class="btn-owner-action" title="Chop etish" onclick="window.print();"><i class="fas fa-print"></i></button>
                            <button class="btn-owner-action" title="Shikoyat qilish"><i class="fas fa-exclamation-triangle"></i></button>
                        </div>
                    </div>
                    
                    <div class="phone-and-price-row">
                        <div class="detail-phone-wrapper">
                            <span class="phone-label">Telefon raqam</span>
                            <div class="phone-reveal-container">
                                <span class="phone-masked-num" id="showPhoneText">+998 ** *** ** **</span>
                                <button class="btn-reveal-phone" id="revealPhoneBtn" onclick="revealProductPhone('{{ $product->phone }}')">To'liq ko'rish</button>
                            </div>
                        </div>
                        <div class="detail-price-box">
                            <span class="price-label">Narx</span>
                            <span class="price-value">{{ number_format($product->price) }} USD</span>
                        </div>
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 15px;">
                        <a href="https://t.me/estora_realestate" target="_blank" class="btn-telegram-direct">
                            <i class="fab fa-telegram-plane"></i>
                            Telegram orqali yozish
                        </a>
                        <a href="{{ route('users.show', $product->user_id) }}" style="display: flex; align-items: center; justify-content: center; gap: 8px; background-color: #f0f7ff; color: #0084ff; font-weight: 700; padding: 12px 20px; border-radius: 8px; border: 1px solid #cce5ff; text-decoration: none; font-size: 13px; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#e0f0ff'" onmouseout="this.style.backgroundColor='#f0f7ff'">
                            <i class="fas fa-layer-group"></i>
                            Muallifning barcha e'lonlari ({{ $sellerTotalProductsCount ?? 1 }} ta)
                        </a>
                    </div>
                </div>

                <!-- Parameters Box -->
                <div class="detail-params-box">
                    <h3>Parametrlar</h3>
                    <div class="params-grid">
                        <div class="param-item">
                            <span class="param-label"><i class="fas fa-door-open"></i> Xonalar soni:</span>
                            <span class="param-value">{{ $product->rooms ?? '—' }}</span>
                        </div>
                        <div class="param-item">
                            <span class="param-label"><i class="fas fa-ruler-combined"></i> Umumiy maydon:</span>
                            <span class="param-value">{{ $product->square ? $product->square . ' m²' : '—' }}</span>
                        </div>
                        @if($product->floor)
                        <div class="param-item">
                            <span class="param-label"><i class="fas fa-building"></i> Yashash qavati:</span>
                            <span class="param-value">{{ $product->floor }}</span>
                        </div>
                        @endif
                        @if($product->building_floor)
                        <div class="param-item">
                            <span class="param-label"><i class="fas fa-level-up-alt"></i> Uydagi qavatlar soni:</span>
                            <span class="param-value">{{ $product->building_floor }}</span>
                        </div>
                        @endif
                        @if($product->repair)
                        <div class="param-item">
                            <span class="param-label"><i class="fas fa-tools"></i> Ta'mir holati:</span>
                            <span class="param-value">{{ $product->repair }}</span>
                        </div>
                        @endif
                        @if($product->sotix)
                        <div class="param-item">
                            <span class="param-label"><i class="fas fa-tree"></i> Sotix:</span>
                            <span class="param-value">{{ $product->sotix }}</span>
                        </div>
                        @endif
                        <div class="param-item">
                            <span class="param-label"><i class="fas fa-exchange-alt"></i> Almashish:</span>
                            <span class="param-value">{{ $product->exchange ? 'Bor' : "Yo'q" }}</span>
                        </div>
                        <div class="param-item">
                            <span class="param-label"><i class="fas fa-credit-card"></i> Bo'lib to'lash:</span>
                            <span class="param-value">{{ $product->pay_in_installments ? 'Mavjud' : "Yo'q" }}</span>
                        </div>
                        <div class="param-item">
                            <span class="param-label"><i class="fas fa-hand-holding-usd"></i> Kredit (Ipoteka):</span>
                            <span class="param-value">{{ $product->credit ? 'Mavjud' : "Yo'q" }}</span>
                        </div>
                    </div>
                </div>

                <!-- Product Items (Amenities / Qulayliklar) Box -->
                <div class="detail-amenities-box">
                    <h3>Qo'shimcha</h3>
                    
                    @if(count($product->metros) > 0)
                        <div class="amenities-group">
                            <span class="group-title"><i class="fas fa-subway text-blue"></i> Infratuzilma (Metro):</span>
                            <div class="group-tags">
                                @foreach($product->metros as $metro)
                                    <span class="group-tag-item">{{ $metro->name }} Metro</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    @if(count($product->universities) > 0)
                        <div class="amenities-group">
                            <span class="group-title"><i class="fas fa-graduation-cap text-orange"></i> Yaqin universitetlar:</span>
                            <div class="group-tags">
                                @foreach($product->universities as $uni)
                                    <span class="group-tag-item">{{ $uni->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if(count($product->items) > 0)
                        <div class="amenities-group">
                            <span class="group-title"><i class="fas fa-concierge-bell text-green"></i> Qulayliklar:</span>
                            <div class="group-tags">
                                @foreach($product->items as $item)
                                    <span class="group-tag-item">{{ $item->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Description (Tavsif) Box -->
                <div class="detail-desc-box">
                    <h3>Tavsif</h3>
                    <div class="desc-content">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- RECOMMENDATIONS BLOCK -->
        <div class="recommendations-container py-12">
            <h2 class="recommendations-title">Sizga qiziqarli bo'lishi mumkin</h2>
            
            <div class="recommendations-tabs">
                <button class="rec-tab-btn active" onclick="switchRecTab(this, 'price')">O'xshash narxli</button>
                <button class="rec-tab-btn" onclick="switchRecTab(this, 'area')">O'xshash maydonli</button>
                <button class="rec-tab-btn" onclick="switchRecTab(this, 'location')">Joylashuvga ko'ra o'xshash</button>
                @if(isset($sellerOtherProducts) && $sellerOtherProducts->count() > 0)
                    <button class="rec-tab-btn" onclick="switchRecTab(this, 'seller')">Muallifning boshqa e'lonlari ({{ $sellerOtherProducts->count() }})</button>
                @endif
            </div>

            <!-- TAB CONTENT: Price -->
            <div class="rec-tab-panel active" id="rec-price">
                <div class="rec-listings-grid">
                    @forelse($similarPrice as $rec)
                        @include('products.partials.rec_card', ['product' => $rec])
                    @empty
                        <div class="rec-empty-message">O'xshash narxli e'lonlar topilmadi.</div>
                    @endforelse
                </div>
            </div>

            <!-- TAB CONTENT: Area -->
            <div class="rec-tab-panel" id="rec-area">
                <div class="rec-listings-grid">
                    @forelse($similarArea as $rec)
                        @include('products.partials.rec_card', ['product' => $rec])
                    @empty
                        <div class="rec-empty-message">O'xshash maydonli e'lonlar topilmadi.</div>
                    @endforelse
                </div>
            </div>

            <!-- TAB CONTENT: Location -->
            <div class="rec-tab-panel" id="rec-location">
                <div class="rec-listings-grid">
                    @forelse($similarLocation as $rec)
                        @include('products.partials.rec_card', ['product' => $rec])
                    @empty
                        <div class="rec-empty-message">Yaqin hududdagi o'xshash e'lonlar topilmadi.</div>
                    @endforelse
                </div>
            </div>

            @if(isset($sellerOtherProducts) && $sellerOtherProducts->count() > 0)
                <!-- TAB CONTENT: Seller -->
                <div class="rec-tab-panel" id="rec-seller">
                    <div class="rec-listings-grid">
                        @foreach($sellerOtherProducts as $rec)
                            @include('products.partials.rec_card', ['product' => $rec])
                        @endforeach
                    </div>
                    @if($sellerTotalProductsCount > 1)
                        <div style="text-align: center; margin-top: 25px;">
                            <a href="{{ route('users.show', $product->user_id) }}" class="btn-filter-search" style="display: inline-flex; text-decoration: none; align-items: center; justify-content: center; gap: 8px;">
                                <i class="fas fa-layer-group"></i> Muallifning barcha {{ $sellerTotalProductsCount }} ta e'lonini ko'rish
                            </a>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
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

    <!-- Leaflet CSS and JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // Switch main image in Gallery
        function switchMainImage(thumbElement, imageSrc, index) {
            // Remove active from all thumbnails
            const thumbs = document.querySelectorAll('.thumb-item');
            thumbs.forEach(t => t.classList.remove('active'));
            
            // Add active to current
            thumbElement.classList.add('active');
            
            // Update main image source
            document.getElementById('mainGalleryImage').src = imageSrc;
            
            // Update index badge
            const totalCount = thumbs.length;
            document.getElementById('galleryIndexText').textContent = `${index + 1}/${totalCount}`;
        }

        // Fullscreen toggle logic
        function toggleFullscreen() {
            const mainImg = document.getElementById('mainGalleryImage');
            if (mainImg.requestFullscreen) {
                mainImg.requestFullscreen();
            } else if (mainImg.webkitRequestFullscreen) {
                mainImg.webkitRequestFullscreen();
            } else if (mainImg.msRequestFullscreen) {
                mainImg.msRequestFullscreen();
            }
        }

        // Reveal phone number
        function revealProductPhone(phoneNum) {
            const phoneTextElement = document.getElementById('showPhoneText');
            const revealBtn = document.getElementById('revealPhoneBtn');
            if (phoneTextElement && phoneNum) {
                phoneTextElement.textContent = phoneNum;
                if (revealBtn) {
                    revealBtn.style.display = 'none';
                }
            }
        }

        // Switch similar product tabs
        function switchRecTab(tabButton, tabType) {
            // Remove active class from buttons
            const buttons = document.querySelectorAll('.rec-tab-btn');
            buttons.forEach(b => b.classList.remove('active'));
            
            // Add active class to clicked button
            tabButton.classList.add('active');
            
            // Hide all tab panels
            const panels = document.querySelectorAll('.rec-tab-panel');
            panels.forEach(p => p.classList.remove('active'));
            
            // Show corresponding panel
            const activePanel = document.getElementById(`rec-${tabType}`);
            if (activePanel) {
                activePanel.classList.add('active');
            }
        }

        // Leaflet map initialization
        document.addEventListener('DOMContentLoaded', function() {
            const lat = {{ $product->latitude ?? 41.311081 }};
            const lng = {{ $product->longitude ?? 69.240562 }};
            
            const map = L.map('showMap').setView([lat, lng], 15);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            L.marker([lat, lng]).addTo(map)
                .bindPopup("{{ $product->name }}")
                .openPopup();

            // Universal Favorite & Share Handlers
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

                    const productId = shareBtn.dataset.id || "{{ $product->id }}";
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
                    alert("E'lon havolasi: " + text);
                }
                document.body.removeChild(textArea);
            }

            function showAppToast(message, type = 'info') {
                let toast = document.getElementById('appToastNotice');
                if (!toast) {
                    toast = document.createElement('div');
                    toast.id = 'appToastNotice';
                    toast.style.cssText = 'position: fixed; bottom: 24px; right: 24px; z-index: 9999; padding: 14px 22px; border-radius: 14px; font-weight: 700; font-size: 14px; color: white; box-shadow: 0 10px 30px rgba(0,0,0,0.25); transition: all 0.3s ease; opacity: 0; transform: translateY(20px); pointer-events: none; display: flex; align-items: center; gap: 10px; font-family: sans-serif;';
                    document.body.appendChild(toast);
                }

                let iconHtml = '<i class="fas fa-info-circle text-blue-400"></i>';
                if (type === 'favorite') {
                    toast.style.backgroundColor = '#061c3f';
                    iconHtml = '<i class="fas fa-heart text-red-500"></i>';
                } else if (type === 'share') {
                    toast.style.backgroundColor = '#0084ff';
                    iconHtml = '<i class="fas fa-share-square text-white"></i>';
                } else {
                    toast.style.backgroundColor = '#374151';
                }

                toast.innerHTML = iconHtml + ' <span>' + message + '</span>';
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
