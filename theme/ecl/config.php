<?php
// This file is part of Moodle - http://moodle.org/
defined('MOODLE_INTERNAL') || die();

$THEME->name = 'ecl';

// Last-loaded CSS sheets — write overrides here so they win on cascade.
$THEME->sheets = ['navbar'];

$THEME->editor_sheets = [];
$THEME->parents = ['boost'];
$THEME->enable_dock = false;
$THEME->extrascsscallback = 'theme_ecl_get_extra_scss';
$THEME->prescsscallback   = 'theme_ecl_get_pre_scss';
$THEME->precompiledcsscallback = 'theme_ecl_get_precompiled_css';
$THEME->yuicssmodules = [];
$THEME->rendererfactory = 'theme_overridden_renderer_factory';
$THEME->requiredblocks = '';
$THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;
$THEME->iconsystem = \core\output\icon_system::FONTAWESOME;
$THEME->haseditswitch = true;
$THEME->usescourseindex = true;

// JS premium (compteurs animés hero + injection bienvenue + dark mode)
$THEME->javascripts_footer = ['ecl'];
