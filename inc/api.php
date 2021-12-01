<?php

/** search for services that match a query */
function wps_fetch_services(string $keywords, string $location, string $page)
{
    $endpoint = get_option('wps_scout_options')["outpost_endpoint"];

    $query = http_build_query(array(
        "keywords" => $keywords,
        "location" => $location,
        "page" => $page
    ));

    print_r("/services?{$query}");

    $res = wp_remote_get("{$endpoint}/services?{$query}");
    if (is_wp_error($res)) {
        return false;
    }
    $results = json_decode(wp_remote_retrieve_body($res));
    return $results;
}

/** get a particular service by unique id */
function wps_fetch_service_by_id(int $id)
{
    $endpoint = get_option('wps_scout_options')["outpost_endpoint"];
    $res = wp_remote_get("{$endpoint}/services/{$id}");
    if (is_wp_error($res)) {
        return false;
    }
    $service = json_decode(wp_remote_retrieve_body($res));
    return $service;
}
