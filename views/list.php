<?php

$search = $_GET["search"] ?? "";
$location = $_GET["location"] ?? "";
$page = $_GET["page"] ?? "";

$res = wps_fetch_services($search, $location, $page);

$perPage = 20;
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

<ul class="wps-results">
    <?php foreach ($results as $result) : ?>
        <li class="wps-results__item">
            <small><?php echo $result->organisation->name ?></small>
            <a href="<?php echo get_site_url() . "/services/{$result->id}" ?>">
                <h2><?php echo $result->name ?></h2>
            </a>
            <p><?php echo wp_trim_words($result->description, 20) ?></p>

            <p><?php echo round($result->distance_away) ?> miles away</p>
        </li>
    <?php endforeach; ?>
</ul>

<p>Showing <?php echo (intval($page) * $perPage) + 1  ?> to <?php echo (intval($page) + 1) * count($results)  ?> of <?php echo $totalResults ?> services.</p>

<?php get_footer(); ?>