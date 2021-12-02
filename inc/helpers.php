<?php

/** generate links to page through results, preserving other query string parameters */
function wps_pagination_url(int $page)
{
    global $wp;

    $query = http_build_query(array(
        "search" => $wp->query_vars["search"] ?? null,
        "location" => $wp->query_vars["location"] ?? null,
        "page" => $page
    ));

    return get_site_url() . "/services?" . $query;
}

/** pagination links */
function wps_pagination(int $currentPage, int $totalPages)
{
    echo "<ul class='wps-pagination'>";

    if ($currentPage > 1) {
        echo "<li><a href='" . wps_pagination_url($currentPage - 1) .  "'>Previous page</a></li>";
    }

    if ($currentPage > 2) {
        echo "<li><a href='" . wps_pagination_url($currentPage - 2) .  "'>" . $currentPage - 2 . "</a></li>";
    }

    if ($currentPage > 1) {
        echo "<li><a href='" . wps_pagination_url($currentPage - 1) .  "'>" . $currentPage - 1 . "</a></li>";
    }

    echo "<li>" . $currentPage . "</li>";

    if ($totalPages > $currentPage) {
        echo "<li><a href='" . wps_pagination_url($currentPage + 1) .  "'>" . $currentPage + 1 . "</a></li>";
    }

    if ($totalPages > $currentPage + 1) {
        echo "<li><a href='" . wps_pagination_url($currentPage + 2) .  "'>" . $currentPage + 2 . "</a></li>";
    }

    if ($totalPages > $currentPage) {
        echo "<li><a href='" . wps_pagination_url($currentPage + 1) .  "'>Next page</a></li>";
    }

    echo "</ul>";
}
