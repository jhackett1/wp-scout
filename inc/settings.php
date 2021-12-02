<?php

function wps_add_settings_page()
{
    add_options_page('Service directory', 'Service Directory', 'manage_options', 'wp-scout', 'wps_render_plugin_settings_page');
}
add_action('admin_menu', 'wps_add_settings_page');

function wps_render_plugin_settings_page()
{
?>
    <div class="wrap">
        <h2>Service Directory Settings</h2>

        <form action="options.php" method="post">
            <?php settings_fields('wps_scout_options');
            do_settings_sections('wps_scout'); ?>
            <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e('Save'); ?>" />
        </form>
    </div>
<?php
}

function wps_register_settings()
{
    register_setting('wps_scout_options', 'wps_scout_options');

    // api settings
    add_settings_section('api_settings', 'Setup', function () {
        echo "<p>Don't change these unless you know what you're doing.</p>";
    }, 'wps_scout');

    add_settings_field('wps_scout_setting_outpost_endpoint', 'Outpost API endpoint', function () {
        $options = get_option('wps_scout_options');
        echo "<input id='wps_scout_setting_outpost_endpoint' name='wps_scout_options[outpost_endpoint]' type='text' value='" . esc_attr($options['outpost_endpoint'] ?? "") . "' />";
        echo "<p class='description'>Don't include /services or a trailing slash. For example, https://example.com/api/v1</p>";
    }, 'wps_scout', 'api_settings');

    add_settings_field('wps_scout_setting_google_server_key', 'Google server key', function () {
        $options = get_option('wps_scout_options');
        echo "<input id='wps_scout_setting_google_server_key' name='wps_scout_options[google_server_key]' type='text' value='" . esc_attr($options['google_server_key'] ?? "") . "' />";
        echo "<p class='description'>Needed to geocode user searches</p>";
    }, 'wps_scout', 'api_settings');

    add_settings_field('wps_scout_setting_google_client_key', 'Google client key', function () {
        $options = get_option('wps_scout_options');
        echo "<input id='wps_scout_setting_google_client_key' name='wps_scout_options[google_client_key]' type='text' value='" . esc_attr($options['google_client_key'] ?? "") . "' />";
        echo "<p class='description'>Needed to show maps</p>";
    }, 'wps_scout', 'api_settings');

    // search settings
    add_settings_section('search_settings', 'Search', function () {
    }, 'wps_scout');

    add_settings_field('wps_scout_setting_per_page', 'Results to show per page', function () {
        $options = get_option('wps_scout_options');
        echo "<input id='wps_scout_setting_per_page' name='wps_scout_options[per_page]' type='text' value='" . esc_attr($options['per_page'] ?? "") . "' />";
        echo "<p class='description'>Defaults to 20 if not given</p>";
    }, 'wps_scout', 'search_settings');
}
add_action('admin_init', 'wps_register_settings');
