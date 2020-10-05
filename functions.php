<?php

// General theme settings file
require_once('inc/my-theme-settings.php');

// Custom Nav Walker Class for custom menu
require_once('inc/custom-nav-walker.php');

// Enqueue Theme Assets (css, javascript and icons)
require_once('inc/enqueue-theme-assets.php');

// Adding menu support to theme
add_theme_support('menus');

// create a menu location for the theme
register_nav_menus(
    array(
        'top-menu' => __('Top Menu', 'mcp-archtitect')
    )
);

// add theme support for post thumbnails
add_theme_support('post-thumbnails');

// Create Portfolio Custom Post Type
require_once('inc/custom-post-type.php');

// add theme support for post and page titles instead ofdefault site name and tagline
add_theme_support('title-tag');

// add html5 attributes support in some of the places in our theme
add_theme_support('html5', array(
    'comment-list',
    'comment-form',
    'search-form'
));

// Mark the current menu item active when custom post type single or archive page
// GREAT ADDITION TO SOLVE THE CURRENT ITEM MENU HIGHLIGHTING PROBLEM
function add_current_nav_class($classes, $item) {

    if (!($item instanceof WP_Post )) 
        return $classes;
    
    // Getting the current post details
    global $post;

    if(empty($post))
        return $classes;
    
    // Getting the post type of the current post
    $current_post_type = get_post_type_object(get_post_type($post->ID));
    $current_post_type_slug = $current_post_type->rewrite['slug'];
    
    // Getting the URL of the menu item
    $menu_slug = strtolower(trim($item->url));
    
    // If the menu item URL contains the current post types slug add the current-menu-item class
    if (strpos($menu_slug, $current_post_type_slug) !== false) {
        $classes[] = 'current-menu-item active';
    } else {
        $classes = array_diff($classes, array('current_page_parent' ));
    }
    
    // Return the corrected set of classes to be added to the menu item
    return $classes;

}

add_action('nav_menu_css_class', 'add_current_nav_class', 10, 2 );