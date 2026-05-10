<?php
// This file is part of Moodle - https://moodle.org/
//
// Theme ECL - Ecole de Commerce de Lyon (Campus Abidjan)
//
// @package    theme_ecl
// @copyright  2026 Ecole de Commerce de Lyon
// @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later

defined('MOODLE_INTERNAL') || die();

$plugin->component = 'theme_ecl';
$plugin->version   = 2026011000;
$plugin->release   = '1.0.0';
$plugin->requires  = 2024100700; // Moodle 4.5+ / 5.x.
$plugin->maturity  = MATURITY_STABLE;
$plugin->dependencies = [
    'theme_boost' => 2024100700,
];
