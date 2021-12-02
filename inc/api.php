<?php

/** search for services that match a query */
function wps_fetch_services(string $keywords, string $location, array $categories, string $page, string $per_page)
{
    $endpoint = get_option('wps_scout_options')["outpost_endpoint"];

    $query = http_build_query(array(
        "keywords" => $keywords,
        "location" => $location,
        "taxonomies" => join(",", $categories),
        "page" => $page,
        "per_page" => $per_page
    ));

    $res = wp_remote_get("{$endpoint}/services?{$query}");
    if (is_wp_error($res)) {
        return false;
    }
    $results = json_decode(wp_remote_retrieve_body($res));
    return $results;
}

/** get a particular service by unique id */
function wps_fetch_service_by_id(string $id)
{
    $endpoint = get_option('wps_scout_options')["outpost_endpoint"];
    $res = wp_remote_get("{$endpoint}/services/{$id}");
    if (is_wp_error($res)) {
        return false;
    }
    $service = json_decode(wp_remote_retrieve_body($res));
    return $service;
}
