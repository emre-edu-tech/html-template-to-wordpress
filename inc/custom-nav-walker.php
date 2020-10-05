<?php

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
        if($item->post_name == 'portfolio') {
            $classes[] = 'current-menu-item';
        }
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