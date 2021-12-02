<?php

function add_drafts_admin_menu_item()
{
    add_menu_page(__('Service Categories'), __('Service Categories'), 'read', 'edit-tags.php?taxonomy=service_categories');
}
add_action('admin_menu', 'add_drafts_admin_menu_item');


function wps_create_custom_taxonomies()
{
    register_taxonomy('service_categories', 'service', array(
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
