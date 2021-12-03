<?php

$perPage = get_option('wps_scout_options')["per_page"];
$category_options = get_terms(array('taxonomy' => "service_categories", 'hide_empty' => false));

$top_level_category_options = array_filter($category_options, function ($term) {
    return $term->parent == 0;
});

$search = $wp->query_vars["search"] ?? "";
$location = $wp->query_vars["location"] ?? "";
$categories = $wp->query_vars["cat"] ?? [];
$page = $wp->query_vars["page"] ?? 1;

$res = wps_fetch_services($search, $location, $categories, $page, $perPage);

$results = $res->content;
$totalPages = $res->totalPages;
$totalResults = $res->totalElements;

get_header();

?>

<form class="wps-search-form wide-max-width" method="get">
    <div>
        <label for="search">Search</label>
        <input name="search" id="search" type="search" placeholder="eg. football" value="<?php echo $search ?>">
    </div>
    <div>
        <label for="location">Near</label>
        <input name="location" id="location" type="text" placeholder="eg. PO19 1RQ" value="<?php echo $location ?>" />
    </div>
    <button>Search</button>
</form>

<div class="wps-results-wrapper wide-max-width">

    <aside>
        <form class="wps-filter-form" method="get">
            <fieldset>
                <legend>Categories</legend>

                <ul>
                    <?php foreach ($top_level_category_options as $filter) : ?>
                        <?php wps_category_checkbox($filter->name, $filter->slug, $categories, $filter->term_id, $category_options); ?>
                    <?php endforeach; ?>
                </ul>

            </fieldset>

            <button>Update results</button>
        </form>
    </aside>

    <div>
        <ul class="wps-results">
            <?php foreach ($results as $result) : ?>
                <li class="wps-results__item">
                    <small><?php echo $result->organisation->name ?></small>
                    <a href="<?php echo get_site_url() . "/services/{$result->id}" ?>">
                        <h2><?php echo $result->name ?></h2>
                    </a>
                    <p><?php echo wp_trim_words($result->description, 20) ?></p>

                    <?php if ($result->distance_away) : ?>
                        <p><em><?php echo prettyDistanceAway($result->distance_away) ?></em></p>
                    <?php endif; ?>

                </li>
            <?php endforeach; ?>
        </ul>

        <footer>
            <?php wps_pagination(intval($page), intval($totalPages)) ?>
            <p>Showing <?php echo ((intval($page) - 1) * $perPage) + 1 ?> to <?php echo (intval($page)) * count($results)  ?> of <?php echo $totalResults ?> services.</p>
        </footer>
    </div>

</div>


<?php get_footer(); ?>