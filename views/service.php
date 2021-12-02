<?php

$id = $wp->query_vars["wps_service_id"];
if (!$id) wp_redirect("/404");

$service = wps_fetch_service_by_id($id);
if (!$service) wp_redirect("/404");

get_header();

?>

<small><?php echo $service->organisation->name ?></small>

<h1><?php echo $service->name ?></h1>

<p><?php echo $service->description ?></p>

<?php get_footer(); ?>