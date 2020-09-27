<?php

require_once('inc/my-theme-settings.php');

add_theme_support('menus');

register_nav_menus(
    array(
        'top-menu' => __('Top Menu', 'mcp-archtitect')
    )
);

class Custom_Menu_Walker extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = array()) {
        // sub menu wrapper or container
        if($args->walker->has_children) {
            $indent = str_repeat("\t", $depth);
            $submenu = 'nav__dropdown-menu sub-menu';
            $output .= "\n$indent<ul class=\"$submenu\">\n";
        }
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id= 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        // li tag
        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = ($args->walker->has_children) ? 'nav__dropdown' : '';
        $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = ' class="' . esc_attr($class_names) . '" ';

        $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
        $id = ($id) ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . '>';

        // a tag
        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
        if($args->walker->has_children) {
            $atts['aria-haspopup'] = 'true';
        }

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

        $attributes = '';

        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $a_output = $args->before;
        $a_output .= '<a' . $attributes . '>';
        $a_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $a_output .= '</a>';
        $a_output .= $args->after;

        // append icon to the a_output according to html template
        // Add the caret if menu level is 0
        if ($args->walker->has_children) {
            $a_output .= '<i class="ui-arrow-down nav__dropdown-trigger" role="button" aria-haspopup="true" aria-expanded="false"></i>';
        }

        // append <a></a> tag to the <li> tag
        $output .= apply_filters('walker_nav_menu_start_el', $a_output, $item, $depth, $args);
    }
}

// loading favicons
function add_favicons() {
    $favicon_path = get_template_directory_uri() . '/assets/img/favicon.ico';
    $apple_touch_icon_72x72_path = get_template_directory_uri() . '/assets/img/apple-touch-icon-72x72.png';
    $apple_touch_icon_114x114_path = get_template_directory_uri() . '/assets/img/apple-touch-icon-114x114.png';

    echo '<link rel="shortcut icon" href="' . esc_url($favicon_path) . '">';
    echo "\n";
    echo '<link rel="apple-touch-icon" sizes="72x72" href="' . esc_url($apple_touch_icon_72x72_path) . '">';
    echo "\n";
    echo '<link rel="apple-touch-icon" sizes="114x114" href="' . esc_url($apple_touch_icon_114x114_path) . '">';
}
add_action('wp_head', 'add_favicons');

// enqueue javascript and css
function load_assets() {
    // loading stylesheets
    // load bootstrap
    wp_enqueue_style('mcp-archtitect-stylesheet-bootstrap' , get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '1.0.0', 'all');
    // load font-icons
    wp_enqueue_style('mcp-archtitect-stylesheet-font-icons' , get_template_directory_uri() . '/assets/css/font-icons.css', array(), '1.0.0', 'all');
    // load revolution slider settings
    wp_enqueue_style('mcp-archtitect-stylesheet-revolution' , get_template_directory_uri() . '/assets/revolution/css/settings.css', array(), '1.0.0', 'all');
    // load theme styles
    wp_enqueue_style('mcp-archtitect-stylesheet-theme-style' , get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0', 'all');
    // load custom styles
    wp_enqueue_style('mcp-archtitect-stylesheet-custom' , get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0.0', 'all');

    // load scripts
    // load bootstrap with jquery
    wp_enqueue_script('mcp-architect-script-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '1.0.0', true);
    // load theme custom plugins js
    wp_enqueue_script('mcp-architect-script-plugins', get_template_directory_uri() . '/assets/js/plugins.js', array(), '1.0.0', true);
    // load themepunch tools
    wp_enqueue_script('mcp-architect-script-themepunch-tools', get_template_directory_uri() . '/assets/revolution/js/jquery.themepunch.tools.min.js', array(), '1.0.0', true);
    // load themepunch revolution
    wp_enqueue_script('mcp-architect-script-themepunch-revolution', get_template_directory_uri() . '/assets/revolution/js/jquery.themepunch.revolution.min.js', array(), '1.0.0', true);
    // load themepunch revolution slider
    wp_enqueue_script('mcp-architect-script-themepunch-rev-slider', get_template_directory_uri() . '/assets/js/rev-slider.js', array(), '1.0.0', true);
    // load theme scripts
    wp_enqueue_script('mcp-architect-script-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'load_assets');