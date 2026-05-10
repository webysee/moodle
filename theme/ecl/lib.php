<?php
// This file is part of Moodle - http://moodle.org/
//
// Theme ECL — École de Commerce de Lyon (Campus Abidjan)
// Inspired by the boost_universite premium architecture.
defined('MOODLE_INTERNAL') || die();

/**
 * Variables SCSS injectées AVANT la compilation Boost.
 */
function theme_ecl_get_pre_scss($theme) {
    $scss = '';
    $scss .= '$primary: #002362;' . "\n";
    $scss .= '$secondary: #003a99;' . "\n";
    $scss .= '$success: #009E60;' . "\n";   // Vert CI
    $scss .= '$info: #17a2b8;' . "\n";
    $scss .= '$warning: #F77F00;' . "\n";   // Orange CI
    $scss .= '$danger: #cc0000;' . "\n";

    // Typographie
    $scss .= '$font-family-sans-serif: "Inter", "Segoe UI", Roboto, Arial, sans-serif;' . "\n";
    $scss .= '$font-size-base: 0.95rem;' . "\n";
    $scss .= '$headings-font-weight: 700;' . "\n";
    $scss .= '$navbar-padding-y: 0.8rem;' . "\n";

    return $scss;
}

/**
 * CSS personnalisé injecté APRÈS la compilation Boost.
 * Toute la richesse visuelle du thème vit ici.
 */
function theme_ecl_get_extra_scss($theme) {
    $scss = '';

    // ── GOOGLE FONTS ────────────────────────────────────────
    $scss .= '
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&display=swap");
    body, .navbar, .btn, .card, input, select, textarea {
        font-family: "Inter", "Segoe UI", sans-serif !important;
    }
    h1, h2, h3, .page-header-headings h1 {
        font-family: "Playfair Display", Georgia, serif !important;
        font-weight: 700;
    }
    ';

    // ── NAVBAR ──────────────────────────────────────────────
    $scss .= '
    .navbar {
        background: linear-gradient(135deg, #002362 0%, #003a99 100%) !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.18);
        border-bottom: 3px solid #cc0000;
        position: relative;
    }
    /* Bandeau drapeau Côte d\'Ivoire subtil au-dessus du rouge */
    .navbar::after {
        content: "";
        position: absolute;
        left: 0; right: 0; bottom: -3px;
        height: 3px;
        background: linear-gradient(90deg, #F77F00 0 33.3%, #ffffff 33.3% 66.6%, #009E60 66.6% 100%);
        opacity: 0;
    }

    .navbar-nav .nav-link,
    .navbar-nav .nav-link:link,
    .navbar-nav .nav-link:visited,
    .primary-navigation .nav-link,
    .primary-navigation .nav-link:link,
    .primary-navigation .nav-link:visited,
    [data-region="primary-navigation"] .nav-link,
    .moremenu-navigation .nav-link,
    .moremenu .nav-link {
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 0.95rem !important;
        letter-spacing: 0.03em !important;
        opacity: 1 !important;
    }
    .navbar-nav .nav-link:hover,
    .primary-navigation .nav-link:hover,
    [data-region="primary-navigation"] .nav-link:hover,
    .moremenu .nav-link:hover {
        color: #ffaaaa !important;
    }

    #usernavigation .nav-link,
    #usernavigation a,
    .usermenu .nav-link,
    .langmenu .nav-link,
    .langmenu a {
        color: #ffffff !important;
        font-weight: 600 !important;
        opacity: 1 !important;
    }
    #usernavigation .nav-link:hover,
    #usernavigation a:hover,
    .langmenu a:hover { color: #ffaaaa !important; }

    .navbar-brand,
    .navbar-brand:link,
    .navbar-brand:visited {
        font-family: "Playfair Display", serif !important;
        font-size: 1.3rem !important;
        font-weight: 700 !important;
        color: #ffffff !important;
        opacity: 1 !important;
    }

    .navbar .icon, .navbar i,
    #usernavigation .icon, #usernavigation i,
    .primary-navigation .icon {
        color: #ffffff !important;
        fill: #ffffff !important;
        opacity: 1 !important;
    }

    .navbar .dropdown-menu {
        background: #001a4d !important;
        border: none;
        box-shadow: 0 6px 24px rgba(0,0,0,0.35);
        border-radius: 10px;
        border-top: 3px solid #cc0000;
    }
    .navbar .dropdown-menu .dropdown-item,
    .navbar .dropdown-menu a {
        color: #ffffff !important;
        font-weight: 500 !important;
        padding: 0.55rem 1.2rem;
    }
    .navbar .dropdown-menu .dropdown-item:hover,
    .navbar .dropdown-menu a:hover {
        background: rgba(255,255,255,0.12) !important;
        color: #ffaaaa !important;
    }
    ';

    // ── HERO PAGE D\'ACCUEIL ──────────────────────────────────
    $scss .= '
    #page-site-index #page-header {
        background: linear-gradient(135deg, #001a4d 0%, #002362 50%, #003a99 100%);
        color: white;
        padding: 5rem 2rem 4rem;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
        text-align: center;
        border-radius: 0 0 22px 22px;
    }
    #page-site-index #page-header::before {
        content: "";
        position: absolute;
        top: -60px; right: -60px;
        width: 320px; height: 320px;
        background: rgba(204,0,0,0.10);
        border-radius: 50%;
    }
    #page-site-index #page-header::after {
        content: "";
        position: absolute;
        bottom: -80px; left: -80px;
        width: 400px; height: 400px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }
    #page-site-index .page-header-headings h1 {
        color: white !important;
        font-size: 3rem;
        font-weight: 800;
        text-shadow: 0 2px 16px rgba(0,0,0,0.3);
        font-family: "Playfair Display", serif !important;
    }
    .hero-stats-bar {
        display: flex;
        justify-content: center;
        gap: 3rem;
        flex-wrap: wrap;
        padding: 1.5rem 0 0.5rem;
        position: relative;
        z-index: 2;
    }
    .hero-stat-item { text-align: center; }
    .hero-stat-num {
        display: block;
        font-size: 2.2rem;
        font-weight: 800;
        color: #ffaaaa;
        font-family: "Playfair Display", serif;
    }
    .hero-stat-lbl {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.75);
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }
    .hero-cta-btn {
        display: inline-block;
        background: #cc0000;
        color: white !important;
        padding: 0.9rem 2.5rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        text-decoration: none !important;
        letter-spacing: 0.05em;
        margin-top: 1.5rem;
        box-shadow: 0 4px 20px rgba(204,0,0,0.45);
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        z-index: 2;
    }
    .hero-cta-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(204,0,0,0.55);
        color: white !important;
    }
    ';

    // ── CARTES DE COURS ENRICHIES ────────────────────────────
    $scss .= '
    .card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 2px 16px rgba(0,35,98,0.10);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        overflow: hidden;
    }
    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 32px rgba(0,35,98,0.18);
    }
    .card-header {
        background: linear-gradient(135deg, #002362, #003a99);
        color: white;
        font-weight: 600;
        padding: 1rem 1.2rem;
        border-bottom: 3px solid #cc0000;
    }
    .course-progress-mini {
        height: 5px;
        background: rgba(0,35,98,0.1);
        border-radius: 3px;
        margin-top: 0.5rem;
        overflow: hidden;
    }
    .course-progress-mini-fill {
        height: 100%;
        background: linear-gradient(90deg, #002362, #cc0000);
        border-radius: 3px;
    }
    .badge-niveau {
        font-size: 0.7rem;
        font-weight: 600;
        padding: 2px 9px;
        border-radius: 20px;
        display: inline-block;
    }
    .badge-debutant { background: rgba(0,158,96,0.18); color: #1e7e34; }
    .badge-intermediaire { background: rgba(247,127,0,0.20); color: #856404; }
    .badge-avance { background: rgba(204,0,0,0.12); color: #a50000; }
    ';

    // ── BOUTONS ─────────────────────────────────────────────
    $scss .= '
    .btn-primary {
        background: linear-gradient(135deg, #002362, #003a99);
        border: none;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 0.04em;
        padding: 0.6rem 1.6rem;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 3px 12px rgba(0,35,98,0.25);
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,35,98,0.35);
        background: linear-gradient(135deg, #001a4d, #002362);
        border: none;
    }
    .btn-danger, .btn-secondary { border-radius: 50px; font-weight: 600; }
    ';

    // ── SIDEBAR / BLOCS ─────────────────────────────────────
    $scss .= '
    .block {
        border-radius: 14px;
        box-shadow: 0 2px 12px rgba(0,35,98,0.08);
        border: none;
        margin-bottom: 1.5rem;
        overflow: hidden;
    }
    .block .card-body { padding: 1rem; }
    .block-header {
        background: linear-gradient(135deg, #002362, #003a99);
        color: white;
        padding: 0.75rem 1rem;
        font-weight: 600;
        font-size: 0.9rem;
        border-bottom: 2px solid #cc0000;
    }
    ';

    // ── NAVIGATION FLATNAV ───────────────────────────────────
    $scss .= '
    .list-group-item.list-group-item-action {
        border-left: 3px solid transparent;
        transition: border-color 0.2s, background 0.2s;
        font-size: 0.93rem;
    }
    .list-group-item.list-group-item-action:hover,
    .list-group-item.list-group-item-action.active {
        border-left: 3px solid #cc0000;
        background: rgba(0,35,98,0.07);
        color: #002362;
        font-weight: 600;
    }
    ';

    // ── DASHBOARD GAMIFIÉ ────────────────────────────────────
    $scss .= '
    .streak-container {
        background: linear-gradient(135deg, #002362, #003a99);
        color: white;
        border-radius: 12px;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
        border-left: 4px solid #cc0000;
    }
    .streak-count {
        font-size: 2rem;
        font-weight: 800;
        color: #ffaaaa;
        font-family: "Playfair Display", serif;
    }
    .streak-label { font-size: 0.85rem; opacity: 0.85; }
    .gamification-badge {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        margin: 0.5rem;
        opacity: 0.3;
        transition: opacity 0.2s, transform 0.2s;
    }
    .gamification-badge.earned { opacity: 1; }
    .gamification-badge.earned:hover { transform: scale(1.1); }
    .gamification-badge-icon {
        width: 52px; height: 52px;
        border-radius: 50%;
        background: linear-gradient(135deg, #cc0000, #ff4444);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem; margin-bottom: 4px;
        box-shadow: 0 3px 10px rgba(204,0,0,0.3);
        color: #fff;
    }
    .gamification-badge-label {
        font-size: 0.7rem;
        color: #6c757d;
        text-align: center;
        font-weight: 500;
    }
    .dashboard-stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.2rem;
        box-shadow: 0 2px 12px rgba(0,35,98,0.08);
        border-left: 4px solid #002362;
        margin-bottom: 1rem;
    }
    .dashboard-stat-card.accent-red { border-left-color: #cc0000; }
    .dashboard-stat-card.accent-orange { border-left-color: #F77F00; }
    .dashboard-stat-card.accent-green { border-left-color: #009E60; }
    .dashboard-stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: #002362;
        font-family: "Playfair Display", serif;
    }
    .dashboard-stat-label {
        font-size: 0.82rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }
    .course-info-container {
        border-left: 4px solid #cc0000;
        padding-left: 1rem;
        margin-bottom: 1rem;
    }
    ';

    // ── BLOC PAGE D\'ACCUEIL — Bienvenue + Formations ────────
    $scss .= '
    .welcome-banner {
        background: linear-gradient(135deg, #002362 0%, #003a99 100%);
        color: white;
        border-radius: 14px;
        padding: 2.5rem 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    .welcome-banner::before {
        content: "";
        position: absolute;
        top: -40px; right: -40px;
        width: 200px; height: 200px;
        background: rgba(204,0,0,0.12);
        border-radius: 50%;
    }
    .welcome-banner::after {
        content: "";
        position: absolute;
        bottom: -60px; left: -30px;
        width: 250px; height: 250px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }
    .welcome-banner h2 {
        font-family: "Playfair Display", serif !important;
        font-size: 2rem;
        font-weight: 800;
        color: white !important;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 2;
    }
    .welcome-banner p {
        color: rgba(255,255,255,0.85);
        font-size: 1rem;
        font-weight: 300;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 2;
    }
    .welcome-banner .welcome-cta {
        display: inline-block;
        background: #cc0000;
        color: white !important;
        padding: 0.7rem 2rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none !important;
        box-shadow: 0 4px 16px rgba(204,0,0,0.4);
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        z-index: 2;
    }
    .welcome-banner .welcome-cta:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(204,0,0,0.5);
        color: white !important;
    }
    .welcome-banner .welcome-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        display: block;
        position: relative;
        z-index: 2;
    }

    .formations-section { margin-bottom: 2.5rem; }
    .formations-section h3 {
        font-family: "Playfair Display", serif !important;
        font-size: 1.6rem;
        color: #002362 !important;
        font-weight: 800;
        margin-bottom: 0.3rem;
    }
    .formations-section .formations-subtitle {
        color: #6c757d;
        font-size: 0.92rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #cc0000;
        display: inline-block;
    }
    .formations-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.2rem;
        margin-top: 1rem;
    }
    .formation-card {
        background: white;
        border-radius: 14px;
        padding: 1.5rem;
        box-shadow: 0 2px 16px rgba(0,35,98,0.09);
        border-top: 4px solid #002362;
        transition: transform 0.2s, box-shadow 0.2s;
        text-decoration: none !important;
        display: block;
        cursor: pointer;
    }
    .formation-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 28px rgba(0,35,98,0.16);
        text-decoration: none !important;
    }
    .formation-card.accent-red { border-top-color: #cc0000; }
    .formation-card.accent-blue { border-top-color: #003a99; }
    .formation-card.accent-dark { border-top-color: #001a4d; }
    .formation-card.accent-orange { border-top-color: #F77F00; }
    .formation-card.accent-green { border-top-color: #009E60; }
    .formation-card-icon {
        font-size: 2.2rem;
        margin-bottom: 0.75rem;
        display: block;
    }
    .formation-card-title {
        font-size: 1rem;
        font-weight: 700;
        color: #002362;
        margin-bottom: 0.4rem;
    }
    .formation-card-desc {
        font-size: 0.82rem;
        color: #6c757d;
        line-height: 1.5;
        margin-bottom: 0.75rem;
    }
    .formation-card-count {
        font-size: 0.78rem;
        font-weight: 600;
        color: #cc0000;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }
    ';

    // ── FOOTER INSTITUTIONNEL ECL ────────────────────────────
    $scss .= '
    #page-footer {
        background: #001a4d;
        color: #b0bfd4;
        padding: 3rem 2rem 1.5rem;
        font-size: 0.88rem;
        border-top: 4px solid #cc0000;
        margin-top: 3rem;
        position: relative;
    }
    /* Bandeau drapeau CI au-dessus du rouge */
    #page-footer::before {
        content: "";
        position: absolute;
        top: -7px; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, #F77F00 0 33.3%, #ffffff 33.3% 66.6%, #009E60 66.6% 100%);
    }
    #page-footer a { color: #8fa8c8 !important; text-decoration: none; }
    #page-footer a:hover { color: #ffffff !important; }
    .footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
        max-width: 1280px;
        margin-left: auto;
        margin-right: auto;
    }
    .footer-col-title {
        color: white;
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        border-bottom: 2px solid #cc0000;
        padding-bottom: 0.5rem;
    }
    .footer-links {
        list-style: none;
        padding: 0; margin: 0;
    }
    .footer-links li { margin-bottom: 0.45rem; }
    .footer-social {
        display: flex;
        gap: 0.6rem;
        margin-top: 0.75rem;
        flex-wrap: wrap;
    }
    .footer-social a {
        width: 34px; height: 34px;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
        display: flex; align-items: center; justify-content: center;
        color: white !important;
        font-size: 0.85rem;
        transition: background 0.2s, transform 0.2s;
    }
    .footer-social a:hover {
        background: #cc0000 !important;
        transform: translateY(-3px);
    }
    .footer-bottom {
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        font-size: 0.8rem;
        color: #6c8ab0;
        max-width: 1280px;
        margin: 0 auto;
    }
    ';

    // ── MODE SOMBRE ──────────────────────────────────────────
    $scss .= '
    @media (prefers-color-scheme: dark) {
        body:not(.force-light) {
            background-color: #0d1117 !important;
            color: #c9d1d9 !important;
        }
        body:not(.force-light) #page,
        body:not(.force-light) #region-main {
            background-color: #0d1117 !important;
        }
        body:not(.force-light) .card {
            background: #161b22 !important;
            border: 1px solid #30363d !important;
        }
        body:not(.force-light) .card-header {
            background: linear-gradient(135deg, #001a4d, #002362) !important;
        }
        body:not(.force-light) h1,
        body:not(.force-light) h2,
        body:not(.force-light) h3,
        body:not(.force-light) h4 { color: #e6edf3 !important; }
        body:not(.force-light) .block {
            background: #161b22 !important;
            border: 1px solid #30363d !important;
        }
        body:not(.force-light) .block-header {
            background: linear-gradient(135deg, #001a4d, #002362) !important;
        }
        body:not(.force-light) .list-group-item {
            background: #161b22 !important;
            color: #c9d1d9 !important;
            border-color: #30363d !important;
        }
        body:not(.force-light) .breadcrumb {
            background: rgba(255,255,255,0.05) !important;
        }
        body:not(.force-light) .formation-card {
            background: #161b22 !important;
        }
        body:not(.force-light) .formation-card-title { color: #e6edf3; }
        body:not(.force-light) .dashboard-stat-card {
            background: #161b22 !important;
        }
        body:not(.force-light) .dashboard-stat-number { color: #e6edf3; }
    }
    body.force-dark {
        background-color: #0d1117 !important;
        color: #c9d1d9 !important;
    }
    body.force-dark .card {
        background: #161b22 !important;
        border: 1px solid #30363d !important;
    }
    body.force-dark h1, body.force-dark h2,
    body.force-dark h3, body.force-dark h4 { color: #e6edf3 !important; }
    body.force-light {
        background-color: #ffffff !important;
        color: #212529 !important;
    }
    ';

    // ── TYPOGRAPHIE & LIENS ──────────────────────────────────
    $scss .= '
    h1, h2, h3, h4 { color: #002362; }
    a { color: #003a99; }
    a:hover { color: #002362; }
    p { line-height: 1.75; }
    ';

    // ── BREADCRUMB ──────────────────────────────────────────
    $scss .= '
    .breadcrumb {
        background: rgba(0,35,98,0.05);
        border-radius: 6px;
        padding: 0.5rem 1rem;
        font-size: 0.88rem;
    }
    .breadcrumb-item.active { color: #002362; font-weight: 600; }
    ';

    // ── MASQUER BOUTON ÉDITION AUX NON-ADMINS ───────────────
    $scss .= '
    body:not(.userloggedin) .editmode-switch-form,
    body:not(.userloggedin) [data-action="toggle-editmode"] { display: none !important; }
    body:not(.role-editingteacher):not(.role-manager):not(.role-coursecreator) .editmode-switch-form,
    body:not(.role-editingteacher):not(.role-manager):not(.role-coursecreator) [data-action="toggle-editmode"] { display: none !important; }
    ';

    // ── BURGER MOBILE ────────────────────────────────────────
    $scss .= '
    @media (max-width: 991.98px) {
        .navbar-toggler {
            border: 2px solid #cc0000 !important;
            border-radius: 8px !important;
            padding: 0.5rem 0.75rem !important;
            background: rgba(204,0,0,0.15) !important;
            transition: background 0.2s ease;
            min-width: 48px; min-height: 48px;
            display: flex !important;
            align-items: center; justify-content: center;
        }
        .navbar-toggler:hover, .navbar-toggler:focus {
            background: rgba(204,0,0,0.35) !important;
            outline: none !important;
            box-shadow: 0 0 0 3px rgba(204,0,0,0.3) !important;
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 30 30\'%3e%3cpath stroke=\'%23cc0000\' stroke-linecap=\'round\' stroke-miterlimit=\'10\' stroke-width=\'3\' d=\'M4 7h22M4 15h22M4 23h22\'/%3e%3c/svg%3e") !important;
            width: 1.6em !important; height: 1.6em !important;
        }
    }
    ';

    return $scss;
}

/**
 * CSS précompilé de secours.
 */
function theme_ecl_get_precompiled_css($theme) {
    $path = dirname(__FILE__) . '/style/moodle.css';
    if (is_readable($path)) {
        return file_get_contents($path);
    }
    return '';
}
