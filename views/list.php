<?php

$perPage = get_option('wps_scout_options')["per_page"];

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

<form class="wps-search-form" method="get">
    <div>
        <label for="search">Search</label>
        <input name="search" type="search" value="<?php echo $search ?>">
    </div>
    <div>
        <label for="location">Near</label>
        <input name="location" type="text" placeholder="eg. PO19 1RQ" value="<?php echo $location ?>" />
    </div>
    <button>Search</button>
</form>

<aside>
    <form method="get">
        <fieldset>
            <legend>Categories</legend>

            <?php wps_category_checkbox("Things to do", "things-to-do", $categories); ?>
            <?php wps_category_checkbox("Advice and support", "advice-and-support", $categories); ?>

        </fieldset>

        <button>Update results</button>
    </form>
</aside>

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

<p>Showing <?php echo ((intval($page) - 1) * $perPage) + 1 ?> to <?php echo (intval($page)) * count($results)  ?> of <?php echo $totalResults ?> services.</p>

<?php wps_pagination(intval($page), intval($totalPages)) ?>

<?php get_footer(); ?>