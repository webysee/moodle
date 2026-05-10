<?php
// This file is part of Moodle - https://moodle.org/
//
// Theme ECL - Frontpage layout (custom hero + slider + highlights).
//
// @package    theme_ecl

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/theme/ecl/lib.php');

user_preference_allow_ajax_update('drawer-open-index', PARAM_BOOL);
user_preference_allow_ajax_update('drawer-open-block', PARAM_BOOL);

if (isloggedin()) {
    $courseindexopen = (get_user_preferences('drawer-open-index', true) == true);
    $blockdraweropen = (get_user_preferences('drawer-open-block', true) == true);
} else {
    $courseindexopen = false;
    $blockdraweropen = false;
}

$extraclasses = ['uses-drawers', 'pagelayout-frontpage', 'theme-ecl'];
$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks  = (strpos($blockshtml, 'data-block=') !== false || !empty($addblockbutton));
$bodyattributes = $OUTPUT->body_attributes($extraclasses);

// Theme settings.
$theme = theme_config::load('ecl');

// Resolve logo URL (custom or default file).
$logourl = $theme->setting_file_url('logo', 'logo');
if (empty($logourl)) {
    $logourl = new moodle_url('/theme/ecl/pix/logo.png');
}

// Hero data.
$herotitle    = !empty($theme->settings->herotitle) ? format_string($theme->settings->herotitle)
                : get_string('herotitle_default', 'theme_ecl');
$herosubtitle = !empty($theme->settings->herosubtitle) ? format_text($theme->settings->herosubtitle)
                : get_string('herosubtitle_default', 'theme_ecl');
$heroctalabel = !empty($theme->settings->heroctalabel) ? $theme->settings->heroctalabel
                : get_string('heroctalabel_default', 'theme_ecl');
$heroctaurl   = !empty($theme->settings->heroctaurl) ? $theme->settings->heroctaurl
                : (new moodle_url('/login/index.php'))->out(false);
$heroimage    = $theme->setting_file_url('heroimage', 'heroimage');

$slides     = theme_ecl_get_slides();
$highlights = theme_ecl_get_highlights();
$footercols = theme_ecl_get_footer_columns();
$footnote   = !empty($theme->settings->footnote) ? format_text($theme->settings->footnote) : '';
$sliderinterval = !empty($theme->settings->sliderinterval) ? (int)$theme->settings->sliderinterval : 6000;

$templatecontext = [
    'sitename'         => format_string($SITE->fullname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output'           => $OUTPUT,
    'sidepreblocks'    => $blockshtml,
    'hasblocks'        => $hasblocks,
    'bodyattributes'   => $bodyattributes,
    'courseindexopen'  => $courseindexopen,
    'blockdraweropen'  => $blockdraweropen,
    'addblockbutton'   => $OUTPUT->addblockbutton(),
    'logourl'          => $logourl,
    'herotitle'        => $herotitle,
    'herosubtitle'     => $herosubtitle,
    'heroctalabel'     => $heroctalabel,
    'heroctaurl'       => $heroctaurl,
    'heroimage'        => $heroimage,
    'slides'           => $slides,
    'hasslides'        => !empty($slides),
    'sliderinterval'   => $sliderinterval,
    'highlights'       => $highlights,
    'hashighlights'    => !empty($highlights),
    'footercols'       => $footercols,
    'footnote'         => $footnote,
    'isloggedin'       => isloggedin() && !isguestuser(),
    'loginurl'         => (new moodle_url('/login/index.php'))->out(false),
    'dashboardurl'     => (new moodle_url('/my/'))->out(false),
    'mycoursesurl'     => (new moodle_url('/my/courses.php'))->out(false),
];

if (isloggedin() && !isguestuser()) {
    $templatecontext['userpicture'] = $OUTPUT->user_picture($USER, ['size' => 36, 'class' => 'rounded-circle', 'link' => false]);
}

echo $OUTPUT->render_from_template('theme_ecl/frontpage', $templatecontext);
