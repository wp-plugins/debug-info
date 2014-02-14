<?php
   /*
   Plugin Name: Debug Info
   Plugin URI: http://oizuled.com/wordpress-plugins/wordpress-debug-info-plugin
   Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=H2A9X5BC7P4MN
   Description: A plugin to display your server's PHP info and WordPress environment data for debugging purposes.
   Version: 1.3
   Author: Scott DeLuzio
   Author URI: http://oizuled.com
   License: GPL2
   */
   
	/*  Copyright 2013  Scott DeLuzio  (email : scott (at) oizuled.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	*/

/* Add language support */
function php_info_lang() {
	load_plugin_textdomain('php_info_translate', false, dirname(plugin_basename(__FILE__)) . '/lang/');
}
add_action('init', 'php_info_lang');
	
/* Info Page */

// Hook for adding admin menus
add_action('admin_menu', 'oizuled_debug_info');

// action function for above hook
function oizuled_debug_info() {
    // Add a new submenu under Settings:
    add_dashboard_page('Debug Info','Debug Info', 'manage_options', 'oizuleddebuginfo', 'oizuled_debug_info_page');
	
}

function oizuled_get_php_info() {
	//retrieve php info for current server
	ob_start();
	phpinfo();
	$pinfo = ob_get_contents();
	ob_end_clean();
 
	$pinfo = preg_replace( '%^.*<body>(.*)</body>.*$%ms','$1',$pinfo);
	echo $pinfo;
}

function getMySqlVersion() {
        global $wpdb;
        $rows = $wpdb->get_results('select version() as mysqlversion');
        if (!empty($rows)) {
             return $rows[0]->mysqlversion;
        }
        return false;
    }

function oizuled_version_check() {
	//outputs basic information
	$wp = get_bloginfo( 'version' );
	$theme = wp_get_theme();
	$plugins = get_option('active_plugins', array());
	
	$php = phpversion();
	
	$mem_usage = memory_get_usage(true);
	if ($mem_usage < 1024) {
        $phpmemuse = $mem_usage."B"; 
    } elseif ($mem_usage < 1048576) {
        $phpmemuse = round($mem_usage/1024,2)."K"; 
    } else {
        $phpmemuse = round($mem_usage/1048576,2)."M"; 
	}
	$phpmemlim = ini_get('memory_limit');
	
	$mysql = getMySqlVersion();
	
	$apache = apache_get_version();
	
	$wpver = __('WordPress Version: ', 'php_info_translate');
	$themever = __('Current WordPress Theme: ', 'php_info_translate');
	$themeversion = $theme->get('Name') . __(' version ', 'php_info_translate') . $theme->get('Version') . $theme->get('Template');
	$themeauthor = __(' Theme Author: ', 'php_info_translate');
	$themeauth = $theme->get('Author') . ' - ' . $theme->get('AuthorURI');
	$themeuri = __(' Theme URI: ', 'php_info_translate');
	$uri = $theme->get('ThemeURI');
	$pluginlist = __('Active Plugins: ', 'php_info_translate');
	$phpver = __('PHP Version: ', 'php_info_translate');
	$phpmemory = __('PHP Memory Usage: ', 'php_info_translate');
	$outof = __(' out of ', 'php_info_translate');
	$mysqlver = __('MySQL Version: ', 'php_info_translate');
	$apachever = __('Apache Version: ', 'php_info_translate');
		
	echo '<strong>' . $wpver . '</strong>' . $wp . '<br />';
	echo '<strong>' . $themever . '</strong>' . $themeversion . '<br />';
	echo '<strong>' . $themeauthor . '</strong>' . $themeauth . '<br />';
	echo '<strong>' .  $themeuri . '</strong>' . $uri . '<br />'; 
	echo '<strong>' . $pluginlist . '</strong>';
		foreach ( $plugins as $plugin ) {
			echo $plugin . ' | ';
		}
	echo '<br /><strong>' . $phpver . '</strong>' . $php . '<br />';
	echo '<strong>' . $phpmemory . '</strong>' . $phpmemuse . $outof . $phpmemlim . '<br />';
	echo '<strong>' . $mysqlver . '</strong>' . $mysql . '<br />';
	echo '<strong>' . $apachever . '</strong>' . $apache . '<br />';
	
}

// Display the page content for the PHP Info submenu
function oizuled_debug_info_page() {
	include(WP_PLUGIN_DIR.'/debug-info/options.php');  
}

?>