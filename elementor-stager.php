<?php

namespace mklasen\ElementorStager;

/**
 * Plugin Name: Elementor Stager
 * Plugin URI: https://github.com/mklasen/elementor-stager
 * Description: This plugin adds an extra "Actions after submit" to Elementor Pro Forms for Stager integration.
 * Version: 1.0.0
 * Author: Marinus Klasen
 * Author URI: https://mklasen.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: elementor-stager
 * Domain Path: /languages
 * 
 * Elementor Stager is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * 
 * Elementor Stager is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Elementor Stager. If not, see http://www.gnu.org/licenses/gpl-2.0.txt.
 */


require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

/**
 * Main class for the Elementor Stager plugin.
 */
class Elementor_Stager {

    /**
     * Constructor for the Elementor_Stager class.
     */
    public function __construct() {
		$this->init();
    }

    /**
     * Initialize the plugin by setting up action hooks.
     */
	public function init() {
        add_action('elementor_pro/forms/actions/register', [$this, 'add_stager_action']);
        add_action('elementor_pro/forms/new_record', new Handle_Submission(), 10, 2);
	}

    /**
     * Register the Stager action with Elementor Pro Forms.
     *
     * @param \ElementorPro\Modules\Forms\Registrars\Form_Actions_Registrar $form_actions_registrar The Elementor form actions registrar.
     */
    public function add_stager_action($form_actions_registrar) {
		$form_actions_registrar->register(new Stager_Elementor_Component());
    }
}

// Initialize the Elementor_Stager class
new Elementor_Stager();
