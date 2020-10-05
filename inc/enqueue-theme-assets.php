<?php

// get time in miliseconds for versioning of assets files
function getTimeInMiliseconds() {
    return round(microtime(true) * 1000);
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

// enqueue google fonts, fontawesome, javascript and css
function load_assets() {
    // load fonts
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Barlow:400,600%7COpen+Sans:400,400i,700');
    // if you need, load fontawesome
    // wp_enqueue_style('fontawesome5', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css');
    // loading stylesheets
    // load bootstrap
    wp_enqueue_style('mcp-archtitect-stylesheet-bootstrap' , get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), getTimeInMiliseconds(), 'all');
    // load font-icons
    wp_enqueue_style('mcp-archtitect-stylesheet-font-icons' , get_template_directory_uri() . '/assets/css/font-icons.css', array(), getTimeInMiliseconds(), 'all');
    // load revolution slider settings
    wp_enqueue_style('mcp-archtitect-stylesheet-revolution' , get_template_directory_uri() . '/assets/revolution/css/settings.css', array(), getTimeInMiliseconds(), 'all');
    // load theme styles
    wp_enqueue_style('mcp-archtitect-stylesheet-theme-style' , get_template_directory_uri() . '/assets/css/style.css', array(), getTimeInMiliseconds(), 'all');
    // load custom styles
    wp_enqueue_style('mcp-archtitect-stylesheet-custom' , get_template_directory_uri() . '/assets/css/custom.css', array(), getTimeInMiliseconds(), 'all');

    // load scripts
    // load bootstrap with jquery
    wp_enqueue_script('mcp-architect-script-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), getTimeInMiliseconds(), true);
    // load theme custom plugins js
    wp_enqueue_script('mcp-architect-script-plugins', get_template_directory_uri() . '/assets/js/plugins.js', array(), getTimeInMiliseconds(), true);
    // load themepunch tools
    wp_enqueue_script('mcp-architect-script-themepunch-tools', get_template_directory_uri() . '/assets/revolution/js/jquery.themepunch.tools.min.js', array(), getTimeInMiliseconds(), true);
    // load themepunch revolution
    wp_enqueue_script('mcp-architect-script-themepunch-revolution', get_template_directory_uri() . '/assets/revolution/js/jquery.themepunch.revolution.min.js', array(), getTimeInMiliseconds(), true);
    // load themepunch revolution slider
    wp_enqueue_script('mcp-architect-script-themepunch-rev-slider', get_template_directory_uri() . '/assets/js/rev-slider.js', array(), getTimeInMiliseconds(), true);
    // load theme scripts
    wp_enqueue_script('mcp-architect-script-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), getTimeInMiliseconds(), true);
    // load custom js
    wp_enqueue_script( 'mcp-architect-script-custom', get_template_directory_uri() . '/assets/js/custom.js', array(), getTimeInMiliseconds(), true);
}
add_action('wp_enqueue_scripts', 'load_assets');