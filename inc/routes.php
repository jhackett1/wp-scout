<?php

/** handle extra routes for service list, detail and pinboard pages */
add_action('init',  function () {
    add_rewrite_rule(
        'services/?$',
        'index.php?wps_service_list=1',
        'top'
    );
    add_rewrite_rule(
        'services/pinboard/?$',
        'index.php?wps_service_pinboard=1',
        'top'
    );
    add_rewrite_rule(
        'services/([a-z0-9-]+)/?$',
        'index.php?wps_service_id=$matches[1]',
        'top'
    );
});

/** add extra query vars to support service directory pages and search */
add_filter('query_vars', function ($query_vars) {
    // routing
    $query_vars[] = 'wps_service_list';
    $query_vars[] = 'wps_service_pinboard';
    $query_vars[] = 'wps_service_id';
    // search
    $query_vars[] = 'location';
    return $query_vars;
});

/** load the correct templates when the right query variables are present */
add_action('parse_request', function (&$wp) {
    if (array_key_exists('wps_service_list', $wp->query_vars)) {
        require plugin_dir_path(__DIR__) . "views/list.php";
        exit();
    }
    if (array_key_exists('wps_service_pinboard', $wp->query_vars)) {
        require plugin_dir_path(__DIR__) . "views/pinboard.php";
        exit();
    }
    if (array_key_exists('wps_service_id', $wp->query_vars)) {
        require plugin_dir_path(__DIR__) . "views/service.php";
        exit();
    }
    return;
});
