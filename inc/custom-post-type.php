<?php

function mcp_portfolio_post_type() {
    register_post_type( 'portfolio', array(
        'rewrite' => array('slug' => 'portfolio'),
        'labels' => array(
            'name' => 'Portfolios',
            'menu_name' => 'Portfolios',    // This is the name that appears on admin menu on the left
            'singular_name' => 'Portfolio',
            'add_new_item' => 'Add New Portfolio',
            'add_new' => 'Add New',
            'edit_item' => 'Edit Portfolio',
            'all_items' => 'All Portfolios',
            'archives' => 'Portfolio Archives',
            'view_item' => 'View Portfolio',
            'update_item' => 'Update Portfolio',
            'search_items' => 'Search Portfolios',
        ),
        'menu-icon' => 'dashicons-clipboard',
        'hierarchical' => false,
        'has_archive' => true,  // this is to enable archive-portfolio.php template
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'public' => true,
        'has_archive' => true,
        // determine what will be enabled for this post type
        'supports' => array(
            'title', 'thumbnail', 'editor', 'excerpt', 'comments'
        )
    ));
}

add_action('init', 'mcp_portfolio_post_type');

// portfolio categories taxonomy for portfolio custom post type
function create_portfolio_categories_taxonomy() {
    // here the category or taxonomy name should be different than category
    // here we specify that we add this taxonomy to portfolio custom post type only
    register_taxonomy('portfolio-category', array('portfolio'), array(
        'labels' => array(
            'name' => 'Portfolio Categories',
            'menu_name' => 'Categories',
            'singular_name' => 'Portfolio Category',
            'all_items' => 'All Portfolios',
            'search_items' => 'Search Categories',
            'parent_item' => 'Parent Category',
            'parent_item_colon' => 'Parent Category:',
            'edit_item' => 'Edit Portfolio Category',
            'update_item' => 'Update Portfolio Category',
            'add_new_item' => 'Add New Portfolio Category'
        ),
        'hierarchical' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'portfolio-categories'),  // here this way we remove porfolio slug from url
    ));
}

add_action( 'init', 'create_portfolio_categories_taxonomy');