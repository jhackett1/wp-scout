<?php
/*
Plugin Name: WP Scout
Plugin URI: https://scout-and-outpost.netlify.app/
Description: Add service directory features to your WordPress website, powered by the Outpost platform.
Version: 0.0.1
Author: FutureGov
Author URI: https://wearefuturegov.com
License: GPLv2 or later
Text Domain: wp-scout
*/

require "inc/settings.php";
require "inc/api.php";
include "inc/helpers.php";

// must load last
require "inc/routes.php";
