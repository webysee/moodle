<?php
// This file is part of Moodle - https://moodle.org/
//
// Theme ECL - Login layout (custom split screen).
//
// @package    theme_ecl

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/theme/ecl/lib.php');

$bodyattributes = $OUTPUT->body_attributes(['theme-ecl', 'ecl-login']);

$theme = theme_config::load('ecl');

$logourl = $theme->setting_file_url('logo', 'logo');
if (empty($logourl)) {
    $logourl = new moodle_url('/theme/ecl/pix/logo.png');
}

$loginbg = $theme->setting_file_url('loginbg', 'loginbg');
$tagline = !empty($theme->settings->logintagline) ? format_string($theme->settings->logintagline)
            : get_string('logintagline_default', 'theme_ecl');

$templatecontext = [
    'sitename'        => format_string($SITE->fullname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output'          => $OUTPUT,
    'bodyattributes'  => $bodyattributes,
    'logourl'         => $logourl,
    'loginbg'         => $loginbg,
    'tagline'         => $tagline,
    'maincontent'     => $OUTPUT->main_content(),
    'currentyear'     => date('Y'),
];

echo $OUTPUT->render_from_template('theme_ecl/login', $templatecontext);
