<?php

/**
 * @package DeMomentSomTres Restaurant
 */
/*
  Plugin Name: DeMomentSomTres Restaurant
  Plugin URI: http://DeMomentSomTres.com/english/wordpress-plugin-restaurant
  Description: DeMomentSomTres Restaurants creates a custom type to represent restaurant lists and menus and show them using shortcodes and menu entries.
  Version: 0.0
  Author: DeMomentSomTres
  Author URI: http://DeMomentSomTres.com
  License: GPLv2 or later
 */

/*
  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

define('DMS3_RESTAURANT_TEXT_DOMAIN', 'dms3-restaurant');
define('DMS3_RESTAURANT_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('DMS3_RESTAURANT_PLUGIN_DIR',dirname( plugin_basename( __FILE__ ) ) );
/* used when no value is specified for the expiry date */
define('DMS3_RESTAURANT_LAST_DATE','9999-12-31');

// Make sure we don't expose any info if called directly
if (!function_exists('add_action')) {
    echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
    exit;
}

require_once DMS3_RESTAURANT_PLUGIN_PATH . 'functions.php';

load_plugin_textdomain(DMS3_RESTAURANT_TEXT_DOMAIN, false, DMS3_RESTAURANT_PLUGIN_DIR . '/languages/');
add_action('init', 'demomentsomtres_restaurant_create_dish_lists');

add_shortcode('demomentsomtres-restaurant-dish-list', 'demomentsomtres_restaurant_dish_list_shortcode');
add_shortcode('eco', 'demomentsomtres_restaurant_eco_shortcode');
add_shortcode('veg', 'demomentsomtres_restaurant_veg_shortcode');
add_shortcode('P', 'demomentsomtres_restaurant_p_shortcode');
add_action('add_meta_boxes','demomentsomtres_restaurant_expiry_date');
add_action('save_post','demomentsomtres_restaurant_meta_save');
add_action( 'pre_get_posts', 'demomentsomtres_restaurant_filter_expired' );
add_action('admin_head','demomentsomtres_restaurant_insert_buttons');
?>