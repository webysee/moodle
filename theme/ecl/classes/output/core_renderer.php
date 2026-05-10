<?php
// This file is part of Moodle - http://moodle.org/
defined('MOODLE_INTERNAL') || die();

/**
 * Surcharge du rendu — nettoyage footer (Moodle native mentions).
 */
class theme_ecl_core_renderer extends \theme_boost\output\core_renderer {

    /**
     * Supprime les liens et mentions Moodle indésirables du footer.
     */
    public function standard_footer_html() {
        $output = parent::standard_footer_html();

        $output = preg_replace('/<div[^>]*class="[^"]*powered-by[^"]*"[^>]*>.*?<\/div>/si', '', $output);
        $output = preg_replace('/Fourni par.*?<\/a>/si', '', $output);
        $output = preg_replace('/Powered by.*?<\/a>/si', '', $output);

        $output = preg_replace('/<a[^>]*href="[^"]*moodle\.com[^"]*"[^>]*>.*?<\/a>/si', '', $output);
        $output = preg_replace('/<a[^>]*href="[^"]*moodle\.org[^"]*"[^>]*>.*?<\/a>/si', '', $output);
        $output = preg_replace('/<a[^>]*href="[^"]*download\.moodle[^"]*"[^>]*>.*?<\/a>/si', '', $output);
        $output = preg_replace('/<a[^>]*href="[^"]*moodlemobile[^"]*"[^>]*>.*?<\/a>/si', '', $output);
        $output = preg_replace('/<a[^>]*href="[^"]*settheme[^"]*"[^>]*>.*?<\/a>/si', '', $output);
        $output = preg_replace('/<a[^>]*href="[^"]*theme_switch[^"]*"[^>]*>.*?<\/a>/si', '', $output);

        $output = preg_replace('/<li[^>]*>\s*<\/li>/si', '', $output);
        $output = preg_replace('/<ul[^>]*>\s*<\/ul>/si', '', $output);

        return $output;
    }

    public function footer() {
        $output = parent::footer();

        $output = preg_replace('/Administr[ée] par.*?(<\/[a-z]+>)/si', '$1', $output);
        $output = preg_replace('/Fourni par.*?(<\/[a-z]+>)/si', '$1', $output);
        $output = preg_replace('/Powered by.*?(<\/[a-z]+>)/si', '$1', $output);

        return $output;
    }
}
