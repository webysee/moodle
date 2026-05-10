<?php
// This file is part of Moodle - https://moodle.org/
//
// Theme ECL - Library functions.
//
// @package    theme_ecl
// @copyright  2026 Ecole de Commerce de Lyon

defined('MOODLE_INTERNAL') || die();

/**
 * Returns the main SCSS content (compiled).
 *
 * @param theme_config $theme
 * @return string
 */
function theme_ecl_get_main_scss_content($theme) {
    global $CFG;

    $scss = '';
    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : 'default.scss';
    $fs = get_file_storage();
    $context = context_system::instance();

    // 1) Boost variables / defaults loaded first via parent.
    $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');

    // 2) ECL preset (variable overrides + components).
    $eclpreset = $CFG->dirroot . '/theme/ecl/scss/preset/' . $filename;
    if (is_readable($eclpreset)) {
        $scss .= "\n" . file_get_contents($eclpreset);
    } else {
        $scss .= "\n" . file_get_contents($CFG->dirroot . '/theme/ecl/scss/preset/default.scss');
    }

    // 3) Components.
    $componentdir = $CFG->dirroot . '/theme/ecl/scss/ecl/';
    $components = [
        '_variables.scss',
        '_navbar.scss',
        '_buttons.scss',
        '_cards.scss',
        '_frontpage.scss',
        '_slider.scss',
        '_blocks.scss',
        '_login.scss',
        '_footer.scss',
        '_dark.scss',
    ];
    foreach ($components as $file) {
        $path = $componentdir . $file;
        if (is_readable($path)) {
            $scss .= "\n" . file_get_contents($path);
        }
    }

    return $scss;
}

/**
 * Pre-SCSS: variables that override Boost's.
 *
 * @param theme_config $theme
 * @return string
 */
function theme_ecl_get_pre_scss($theme) {
    $scss = '';
    $configurable = [
        'brandprimary'   => ['primarycolor', '#002362'],
        'brandsecondary' => ['secondarycolor', '#E30613'],
        'brandaccent1'   => ['accent1color', '#F77F00'],
        'brandaccent2'   => ['accent2color', '#009E60'],
    ];

    foreach ($configurable as $varname => $cfg) {
        list($settingname, $default) = $cfg;
        $value = isset($theme->settings->{$settingname}) && !empty($theme->settings->{$settingname})
            ? $theme->settings->{$settingname}
            : $default;
        $scss .= '$' . $varname . ': ' . $value . ";\n";
    }

    // Map to Boost variables.
    $scss .= '$primary: $brandprimary;' . "\n";
    $scss .= '$secondary: $brandsecondary;' . "\n";
    $scss .= '$navbar-bg: $brandprimary;' . "\n";

    // Custom raw SCSS (admin field).
    if (!empty($theme->settings->scsspre)) {
        $scss .= "\n" . $theme->settings->scsspre;
    }

    return $scss;
}

/**
 * Extra SCSS appended at the end (lowest priority).
 *
 * @param theme_config $theme
 * @return string
 */
function theme_ecl_get_extra_scss($theme) {
    $scss = '';
    if (!empty($theme->settings->scsscustom)) {
        $scss .= $theme->settings->scsscustom;
    }
    return $scss;
}

/**
 * Serve files from theme settings (logo, slider images, favicon).
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return mixed
 */
function theme_ecl_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = []) {
    static $allowed = ['logo', 'favicon', 'loginbg', 'heroimage',
        'slide1image', 'slide2image', 'slide3image', 'slide4image', 'slide5image'];

    if ($context->contextlevel == CONTEXT_SYSTEM && in_array($filearea, $allowed)) {
        $theme = theme_config::load('ecl');
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    }
    send_file_not_found();
}

/**
 * Inject footer / header HTML from settings.
 *
 * @return array
 */
function theme_ecl_get_html_for_settings() {
    global $PAGE;
    $theme = theme_config::load('ecl');
    $html = new stdClass();

    $html->footnote = !empty($theme->settings->footnote) ? format_text($theme->settings->footnote) : '';

    return $html;
}

/**
 * Build slider data for frontpage template.
 *
 * @return array
 */
function theme_ecl_get_slides() {
    $theme = theme_config::load('ecl');
    $slides = [];
    $count = !empty($theme->settings->slidercount) ? (int)$theme->settings->slidercount : 0;

    for ($i = 1; $i <= $count; $i++) {
        $title = !empty($theme->settings->{'slide' . $i . 'title'}) ? $theme->settings->{'slide' . $i . 'title'} : '';
        $caption = !empty($theme->settings->{'slide' . $i . 'caption'}) ? $theme->settings->{'slide' . $i . 'caption'} : '';
        $url = !empty($theme->settings->{'slide' . $i . 'url'}) ? $theme->settings->{'slide' . $i . 'url'} : '';
        $imageurl = $theme->setting_file_url('slide' . $i . 'image', 'slide' . $i . 'image');

        if (!empty($title) || !empty($imageurl)) {
            $slides[] = [
                'index'    => $i,
                'active'   => $i === 1,
                'title'    => format_string($title),
                'caption'  => format_text($caption, FORMAT_HTML),
                'url'      => $url,
                'imageurl' => $imageurl,
            ];
        }
    }
    return $slides;
}

/**
 * Highlight cards on frontpage.
 *
 * @return array
 */
function theme_ecl_get_highlights() {
    $theme = theme_config::load('ecl');
    $items = [];
    for ($i = 1; $i <= 4; $i++) {
        $title = !empty($theme->settings->{'highlight' . $i . 'title'}) ? $theme->settings->{'highlight' . $i . 'title'} : '';
        $text = !empty($theme->settings->{'highlight' . $i . 'text'}) ? $theme->settings->{'highlight' . $i . 'text'} : '';
        $icon = !empty($theme->settings->{'highlight' . $i . 'icon'}) ? $theme->settings->{'highlight' . $i . 'icon'} : 'fa-graduation-cap';
        $url  = !empty($theme->settings->{'highlight' . $i . 'url'}) ? $theme->settings->{'highlight' . $i . 'url'} : '';
        if (!empty($title)) {
            $items[] = [
                'title' => format_string($title),
                'text'  => format_text($text, FORMAT_HTML),
                'icon'  => $icon,
                'url'   => $url,
            ];
        }
    }
    return $items;
}

/**
 * Footer columns.
 *
 * @return array
 */
function theme_ecl_get_footer_columns() {
    $theme = theme_config::load('ecl');
    $cols = [];
    for ($i = 1; $i <= 4; $i++) {
        $title = !empty($theme->settings->{'footercol' . $i . 'title'}) ? $theme->settings->{'footercol' . $i . 'title'} : '';
        $content = !empty($theme->settings->{'footercol' . $i . 'content'}) ? $theme->settings->{'footercol' . $i . 'content'} : '';
        if (!empty($title) || !empty($content)) {
            $cols[] = [
                'title'   => format_string($title),
                'content' => format_text($content, FORMAT_HTML),
            ];
        }
    }
    return $cols;
}
