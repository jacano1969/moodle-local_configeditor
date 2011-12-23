<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * Defines functions for retrieveing plugins and settings
 *
 * @package    local_configeditor
 * @author      Mark Johnson <mark.johnson@tauntons.ac.uk>
 * @copyright   2011 Tauntons College, UK
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_configeditor;

function get_plugins() {
    global $DB;
    $plugins = array();
    $pluginrecords = $DB->get_records_sql('SELECT DISTINCT plugin FROM {config_plugins}');
    foreach ($pluginrecords as $pluginrecord) {
        $plugins[$pluginrecord->plugin] = $pluginrecord->plugin;
    }
    return $plugins;
}

function get_settings_for_plugin($plugin = 'core') {
    global $DB;
    if ($plugin == 'core') {
        $settings = $DB->get_records_menu('config', null, 'name', 'name, name AS name2');
    } else {
        $settings = $DB->get_records_menu('config_plugins',
                                          array('plugin' => $plugin),
                                          'name',
                                          'name,
                                          name AS name2');
    }
    return $settings;
}
