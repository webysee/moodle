<?php
// This file is part of Moodle - http://moodle.org/
defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2026011002;
$plugin->requires  = 2022041900; // Moodle 4.0 minimum (compatible 4.x + 5.x).
$plugin->component = 'theme_ecl';
$plugin->maturity  = MATURITY_STABLE;
$plugin->release   = '1.2.0';
$plugin->dependencies = [
    'theme_boost' => 2022041900,
];
