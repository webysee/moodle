<?php
// This file is part of Moodle - https://moodle.org/
//
// Theme ECL - Core renderer override.
//
// @package    theme_ecl
// @copyright  2026 Ecole de Commerce de Lyon

namespace theme_ecl\output;

defined('MOODLE_INTERNAL') || die();

use moodle_url;

class core_renderer extends \theme_boost\output\core_renderer {

    /**
     * Returns the URL of the site logo.
     *
     * @param int $maxwidth
     * @param int $maxheight
     * @return moodle_url|false
     */
    public function get_logo_url($maxwidth = null, $maxheight = 200) {
        $theme = \theme_config::load('ecl');
        $logourl = $theme->setting_file_url('logo', 'logo');
        if (!empty($logourl)) {
            return new moodle_url($logourl);
        }
        // Fallback to bundled default logo.
        return new moodle_url('/theme/ecl/pix/logo.png');
    }

    /**
     * Returns the URL of the compact logo (navbar).
     *
     * @param int $maxwidth
     * @param int $maxheight
     * @return moodle_url|false
     */
    public function get_compact_logo_url($maxwidth = 120, $maxheight = 40) {
        return $this->get_logo_url($maxwidth, $maxheight);
    }

    /**
     * Site favicon.
     *
     * @return moodle_url
     */
    public function favicon() {
        $theme = \theme_config::load('ecl');
        $favicon = $theme->setting_file_url('favicon', 'favicon');
        if (!empty($favicon)) {
            return new moodle_url($favicon);
        }
        return parent::favicon();
    }
}
