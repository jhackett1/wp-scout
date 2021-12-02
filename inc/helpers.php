<?php

/** generate links to page through results, preserving other query string parameters */
function wps_pagination_url(int $page): string
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
function wps_pagination(int $currentPage, int $totalPages): void
{
    echo "<ul class='wps-pagination'>";

    // prev page
    if ($currentPage > 1)
        echo "<li><a href='" . wps_pagination_url($currentPage - 1) .  "'>Previous page</a></li>";

    // shortcut back to first page
    if ($currentPage > 3) {
        echo "<li><a href='" . wps_pagination_url(1) .  "'>1</a></li>";
        if ($currentPage > 4) echo "...";
    }

    if ($currentPage > 2)
        echo "<li><a href='" . wps_pagination_url($currentPage - 2) .  "'>" . $currentPage - 2 . "</a></li>";

    if ($currentPage > 1)
        echo "<li><a href='" . wps_pagination_url($currentPage - 1) .  "'>" . $currentPage - 1 . "</a></li>";

    // current page
    echo "<li aria-current='true'>" . $currentPage . "</li>";

    if ($totalPages > $currentPage)
        echo "<li><a href='" . wps_pagination_url($currentPage + 1) .  "'>" . $currentPage + 1 . "</a></li>";

    if ($totalPages > $currentPage + 1)
        echo "<li><a href='" . wps_pagination_url($currentPage + 2) .  "'>" . $currentPage + 2 . "</a></li>";

    // next page
    if ($totalPages > $currentPage)
        echo "<li><a href='" . wps_pagination_url($currentPage + 1) .  "'>Next page</a></li>";

    echo "</ul>";
}


/** render a category checkbox with label */
function wps_category_checkbox(string $label, string $value, array $current_categories)
{
    echo '<input type="checkbox" name="cat[]" value="' . $value . '" id="cat-' . $value . '"' . (in_array($value, $current_categories) ? "checked" : "") . '/>';
    echo '<label for="cat-' . $value . '">' . $label . '</label>';
}
