<?php
// This file is part of Moodle - https://moodle.org/
//
// Theme ECL - Admin settings.
//
// @package    theme_ecl
// @copyright  2026 Ecole de Commerce de Lyon

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $settings = new theme_boost_admin_settingspage_tabs('themesettingecl', get_string('configtitle', 'theme_ecl'));

    // ============================================================
    // TAB 1 - GENERAL
    // ============================================================
    $page = new admin_settingpage('theme_ecl_general', get_string('generalsettings', 'theme_ecl'));

    // Preset.
    $name = 'theme_ecl/preset';
    $title = get_string('preset', 'theme_ecl');
    $description = get_string('preset_desc', 'theme_ecl');
    $default = 'default.scss';
    $context = context_system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_ecl', 'preset', 0, 'itemid, filepath, filename', false);
    $choices = [
        'default.scss' => get_string('preset_default', 'theme_ecl'),
        'plain.scss'   => get_string('preset_plain', 'theme_ecl'),
    ];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Logo.
    $name = 'theme_ecl/logo';
    $title = get_string('logo', 'theme_ecl');
    $description = get_string('logo_desc', 'theme_ecl');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo', 0,
        ['maxfiles' => 1, 'accepted_types' => ['.png', '.jpg', '.svg']]);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Favicon.
    $name = 'theme_ecl/favicon';
    $title = get_string('favicon', 'theme_ecl');
    $description = get_string('favicon_desc', 'theme_ecl');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'favicon', 0,
        ['maxfiles' => 1, 'accepted_types' => ['.ico', '.png']]);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Primary color.
    $name = 'theme_ecl/primarycolor';
    $title = get_string('primarycolor', 'theme_ecl');
    $description = get_string('primarycolor_desc', 'theme_ecl');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#002362');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Secondary color.
    $name = 'theme_ecl/secondarycolor';
    $title = get_string('secondarycolor', 'theme_ecl');
    $description = get_string('secondarycolor_desc', 'theme_ecl');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#E30613');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Accent 1 (orange CI).
    $name = 'theme_ecl/accent1color';
    $title = get_string('accent1color', 'theme_ecl');
    $description = get_string('accent1color_desc', 'theme_ecl');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#F77F00');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Accent 2 (vert CI).
    $name = 'theme_ecl/accent2color';
    $title = get_string('accent2color', 'theme_ecl');
    $description = get_string('accent2color_desc', 'theme_ecl');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#009E60');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Custom SCSS pre.
    $name = 'theme_ecl/scsspre';
    $title = get_string('scsspre', 'theme_ecl');
    $description = get_string('scsspre_desc', 'theme_ecl');
    $setting = new admin_setting_scsscode($name, $title, $description, '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Custom SCSS post.
    $name = 'theme_ecl/scsscustom';
    $title = get_string('scsscustom', 'theme_ecl');
    $description = get_string('scsscustom_desc', 'theme_ecl');
    $setting = new admin_setting_scsscode($name, $title, $description, '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // ============================================================
    // TAB 2 - FRONT PAGE / HERO
    // ============================================================
    $page = new admin_settingpage('theme_ecl_frontpage', get_string('frontpagesettings', 'theme_ecl'));

    // Hero title.
    $page->add(new admin_setting_configtext('theme_ecl/herotitle',
        get_string('herotitle', 'theme_ecl'),
        get_string('herotitle_desc', 'theme_ecl'),
        get_string('herotitle_default', 'theme_ecl'), PARAM_TEXT));

    // Hero subtitle.
    $page->add(new admin_setting_configtextarea('theme_ecl/herosubtitle',
        get_string('herosubtitle', 'theme_ecl'),
        get_string('herosubtitle_desc', 'theme_ecl'),
        get_string('herosubtitle_default', 'theme_ecl'), PARAM_RAW));

    // Hero CTA label.
    $page->add(new admin_setting_configtext('theme_ecl/heroctalabel',
        get_string('heroctalabel', 'theme_ecl'),
        '',
        get_string('heroctalabel_default', 'theme_ecl'), PARAM_TEXT));

    // Hero CTA URL.
    $page->add(new admin_setting_configtext('theme_ecl/heroctaurl',
        get_string('heroctaurl', 'theme_ecl'),
        '',
        '', PARAM_URL));

    // Hero image.
    $page->add(new admin_setting_configstoredfile('theme_ecl/heroimage',
        get_string('heroimage', 'theme_ecl'),
        get_string('heroimage_desc', 'theme_ecl'),
        'heroimage', 0,
        ['maxfiles' => 1, 'accepted_types' => ['.png', '.jpg', '.jpeg', '.webp']]));

    // Highlights (4 cards).
    $page->add(new admin_setting_heading('theme_ecl/highlightsheader',
        get_string('highlights', 'theme_ecl'),
        get_string('highlights_desc', 'theme_ecl')));

    $defaulticons = ['fa-graduation-cap', 'fa-globe', 'fa-handshake', 'fa-trophy'];
    $defaulttitles = [
        get_string('highlight1title_default', 'theme_ecl'),
        get_string('highlight2title_default', 'theme_ecl'),
        get_string('highlight3title_default', 'theme_ecl'),
        get_string('highlight4title_default', 'theme_ecl'),
    ];
    for ($i = 1; $i <= 4; $i++) {
        $page->add(new admin_setting_configtext("theme_ecl/highlight{$i}title",
            get_string('highlighttitle', 'theme_ecl', $i), '',
            $defaulttitles[$i - 1], PARAM_TEXT));
        $page->add(new admin_setting_configtext("theme_ecl/highlight{$i}icon",
            get_string('highlighticon', 'theme_ecl', $i),
            get_string('highlighticon_desc', 'theme_ecl'),
            $defaulticons[$i - 1], PARAM_TEXT));
        $page->add(new admin_setting_configtextarea("theme_ecl/highlight{$i}text",
            get_string('highlighttext', 'theme_ecl', $i), '', '', PARAM_RAW));
        $page->add(new admin_setting_configtext("theme_ecl/highlight{$i}url",
            get_string('highlighturl', 'theme_ecl', $i), '', '', PARAM_URL));
    }

    $settings->add($page);

    // ============================================================
    // TAB 3 - SLIDER
    // ============================================================
    $page = new admin_settingpage('theme_ecl_slider', get_string('slidersettings', 'theme_ecl'));

    $page->add(new admin_setting_heading('theme_ecl/sliderheading',
        get_string('slider', 'theme_ecl'),
        get_string('slider_desc', 'theme_ecl')));

    // Number of slides.
    $page->add(new admin_setting_configselect('theme_ecl/slidercount',
        get_string('slidercount', 'theme_ecl'),
        get_string('slidercount_desc', 'theme_ecl'),
        3, ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5']));

    // Auto-play interval.
    $page->add(new admin_setting_configtext('theme_ecl/sliderinterval',
        get_string('sliderinterval', 'theme_ecl'),
        get_string('sliderinterval_desc', 'theme_ecl'),
        '6000', PARAM_INT));

    for ($i = 1; $i <= 5; $i++) {
        $page->add(new admin_setting_heading("theme_ecl/slide{$i}heading",
            get_string('slideheading', 'theme_ecl', $i), ''));

        $page->add(new admin_setting_configstoredfile("theme_ecl/slide{$i}image",
            get_string('slideimage', 'theme_ecl'),
            get_string('slideimage_desc', 'theme_ecl'),
            "slide{$i}image", 0,
            ['maxfiles' => 1, 'accepted_types' => ['.png', '.jpg', '.jpeg', '.webp']]));

        $page->add(new admin_setting_configtext("theme_ecl/slide{$i}title",
            get_string('slidetitle', 'theme_ecl'), '', '', PARAM_TEXT));

        $page->add(new admin_setting_configtextarea("theme_ecl/slide{$i}caption",
            get_string('slidecaption', 'theme_ecl'), '', '', PARAM_RAW));

        $page->add(new admin_setting_configtext("theme_ecl/slide{$i}url",
            get_string('slideurl', 'theme_ecl'), '', '', PARAM_URL));
    }

    $settings->add($page);

    // ============================================================
    // TAB 4 - LOGIN
    // ============================================================
    $page = new admin_settingpage('theme_ecl_login', get_string('loginsettings', 'theme_ecl'));

    $page->add(new admin_setting_configstoredfile('theme_ecl/loginbg',
        get_string('loginbg', 'theme_ecl'),
        get_string('loginbg_desc', 'theme_ecl'),
        'loginbg', 0,
        ['maxfiles' => 1, 'accepted_types' => ['.png', '.jpg', '.jpeg', '.webp']]));

    $page->add(new admin_setting_configtext('theme_ecl/logintagline',
        get_string('logintagline', 'theme_ecl'),
        get_string('logintagline_desc', 'theme_ecl'),
        get_string('logintagline_default', 'theme_ecl'), PARAM_TEXT));

    $settings->add($page);

    // ============================================================
    // TAB 5 - FOOTER
    // ============================================================
    $page = new admin_settingpage('theme_ecl_footer', get_string('footersettings', 'theme_ecl'));

    $page->add(new admin_setting_heading('theme_ecl/footerheading',
        get_string('footer', 'theme_ecl'),
        get_string('footer_desc', 'theme_ecl')));

    $defaultfooter = [
        ['Contact', "<p><i class=\"fa fa-map-marker-alt me-2\"></i>Campus Abidjan, Côte d'Ivoire</p><p><i class=\"fa fa-phone me-2\"></i>+225 00 00 00 00</p><p><i class=\"fa fa-envelope me-2\"></i>contact@ecl-abidjan.ci</p>"],
        ['Études', "<ul class='list-unstyled'><li><a href='#'>Programmes</a></li><li><a href='#'>Admissions</a></li><li><a href='#'>International</a></li><li><a href='#'>Bourses</a></li></ul>"],
        ['Vie étudiante', "<ul class='list-unstyled'><li><a href='#'>Campus</a></li><li><a href='#'>Associations</a></li><li><a href='#'>Bibliothèque</a></li><li><a href='#'>Sport</a></li></ul>"],
        ['Suivez-nous', "<a href='#' class='me-3'><i class='fa-brands fa-facebook fa-2x'></i></a><a href='#' class='me-3'><i class='fa-brands fa-linkedin fa-2x'></i></a><a href='#' class='me-3'><i class='fa-brands fa-instagram fa-2x'></i></a><a href='#'><i class='fa-brands fa-youtube fa-2x'></i></a>"],
    ];

    for ($i = 1; $i <= 4; $i++) {
        $page->add(new admin_setting_configtext("theme_ecl/footercol{$i}title",
            get_string('footercoltitle', 'theme_ecl', $i), '',
            $defaultfooter[$i - 1][0], PARAM_TEXT));
        $page->add(new admin_setting_confightmleditor("theme_ecl/footercol{$i}content",
            get_string('footercolcontent', 'theme_ecl', $i), '',
            $defaultfooter[$i - 1][1], PARAM_RAW));
    }

    // Footnote / copyright.
    $page->add(new admin_setting_confightmleditor('theme_ecl/footnote',
        get_string('footnote', 'theme_ecl'),
        get_string('footnote_desc', 'theme_ecl'),
        '© ' . date('Y') . ' École de Commerce de Lyon - Campus Abidjan. ' . get_string('allrightsreserved', 'theme_ecl'),
        PARAM_RAW));

    $settings->add($page);
}
