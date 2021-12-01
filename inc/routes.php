<?php

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

add_filter('query_vars', function ($query_vars) {
    $query_vars[] = 'wps_service_list';
    $query_vars[] = 'wps_service_pinboard';
    $query_vars[] = 'wps_service_id';
    return $query_vars;
});


add_action('parse_request', function (&$wp) {

    print_r($wp->query_vars);

    if (array_key_exists('wps_service_list', $wp->query_vars)) {
        include "views/list.php";
        exit();
    }
    if (array_key_exists('wps_service_pinboard', $wp->query_vars)) {
        include "views/pinboard.php";
        exit();
    }
    if (array_key_exists('wps_service_id', $wp->query_vars)) {
        include "views/service.php";
        exit();
    }
    return;
});
