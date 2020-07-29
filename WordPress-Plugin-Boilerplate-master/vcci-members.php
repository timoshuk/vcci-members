<?php

/**
 * Plugin Name:       VcciMembers
 * Description:       Плагін додає тип запису Члени ТПП для виводу на сторінці членської бази
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Oleksandr Timoshchuk
 * Author URI:        https://timoshchuk.pp.ua/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       vcci_members
 * Domain Path:       /languages
 */



//  https://developer.wordpress.org/plugins/hooks/



// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_vcci_members() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-vcci-members-activator.php';
	Vcci_Members_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_vcci_members() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-vcci-members-deactivator.php';
	Vcci_Members_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_vcci_members' );
register_deactivation_hook( __FILE__, 'deactivate_vcci_members' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-vcci-members.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_name() {

	$plugin = new Vcci_Members();
	$plugin->run();

}
run_plugin_name();
