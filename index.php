<?php
/*
Plugin Name: WP Scout
Plugin URI: https://scout-and-outpost.netlify.app/
Description: Add service directory features to your WordPress website, powered by the Outpost platform.
Version: 0.0.1
Author: FutureGov
Author URI: https://wearefuturegov.com
License: GPLv2 or later
Text Domain: wps
*/

require "inc/settings.php";
include "inc/taxonomies.php";
require "inc/api.php";
include "inc/formatters.php";
include "inc/helpers.php";

// must load last
require "inc/routes.php";


function wps_load_scripts_and_styles()
{
    wp_enqueue_style("main", "/wp-content/plugins/wp-scout/assets/dist/style.css");
    // wp_enqueue_script("maps", "https://maps.googleapis.com/maps/api/js?key=" . GOOGLE_CLIENT_KEY);
    wp_enqueue_script("main", "/wp-content/plugins/wp-scout/assets/dist/index.js");
}
add_action("wp_enqueue_scripts", "wps_load_scripts_and_styles");
