<?php

function wps_create_custom_taxonomies()
{
    register_taxonomy('service_categories', 'post', array(
        "labels" => array(
            "name" => "Service Categories",
            "singular_name" => "Service Category",
            "add_new_item" => "Add New Service Category",
            "choose_from_most_used" => "Choose from the most used categories",
            "not_found" => "No service categories found"
        ),
        "hierarchical" => true,
        'show_ui' => true,
        'show_admin_column' => true,
        // 'query_var' => true
    ));
}
add_action('init', 'wps_create_custom_taxonomies', 0);
