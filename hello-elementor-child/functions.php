<?php

function hello_elementor_child_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

add_action('wp_enqueue_scripts', 'hello_elementor_child_enqueue_styles');

function create_deer_tests_post_type() {
    $labels = array(
        'name'               => _x('Deer Tests', 'post type general name'),
        'singular_name'      => _x('Deer Test', 'post type singular name'),
        'menu_name'          => _x('Deer Tests', 'admin menu'),
        'name_admin_bar'     => _x('Deer Test', 'add new on admin bar'),
        'add_new'            => _x('Add New', 'deer test'),
        'add_new_item'       => __('Add New Deer Test'),
        'new_item'           => __('New Deer Test'),
        'edit_item'          => __('Edit Deer Test'),
        'view_item'          => __('View Deer Test'),
        'all_items'          => __('All Deer Tests'),
        'search_items'       => __('Search Deer Tests'),
        'not_found'          => __('No Deer Tests found.'),
        'not_found_in_trash' => __('No Deer Tests found in Trash.'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'deer-test'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
    );

    register_post_type('deer_test', $args);
}

add_action('init', 'create_deer_tests_post_type');


//Overall outputting as a shortcode
function deer_tests_shortcode() {
    ob_start();
    
    $args = array(
        'post_type' => 'deer_test',
        'posts_per_page' => -1,
    );

    $deer_tests_query = new WP_Query($args);

    if ($deer_tests_query->have_posts()) {
        echo '<div class="deer-tests">';
        while ($deer_tests_query->have_posts()) {
            $deer_tests_query->the_post();
            echo '<div class="deer-test-item">';
            echo '<h2>' . get_the_title() . '</h2>';
            echo '<div>' . get_the_content() . '</div>';
            echo '</div>';
        }
        echo '</div>';
        wp_reset_postdata();
    } else {
        echo '<p>No Deer Tests found.</p>';
    }

    return ob_get_clean();
}

add_shortcode('deer_tests', 'deer_tests_shortcode');
