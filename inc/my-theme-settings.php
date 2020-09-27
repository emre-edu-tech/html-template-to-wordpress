<?php

class MySettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $socialOptions;
    private $contactOptions;
    private $brandOptions;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'My Settings', 
            'manage_options', 
            'my-setting-admin', 
            array($this, 'create_admin_page')
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->socialOptions = get_option('social_links');
        $this->contactOptions = get_option('contact_info');
        $this->brandOptions = get_option('brand_info');
        ?>
        <div class="wrap">
            <h1>My Theme Settings</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields('my_option_group');
                do_settings_sections('my-setting-admin');
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'my_option_group', // Option group
            'social_links' // Option name
        );

        add_settings_section(
            'social_links_id', // ID
            'Social Links Settings', // Title
            array( $this, 'print_section_social_links' ), // Callback
            'my-setting-admin' // Page
        );  

        add_settings_field(
            'social_icon_1', // ID
            'Social Icon 1', // Title 
            array( $this, 'social_icon_1_callback' ), // Callback
            'my-setting-admin', // Page
            'social_links_id' // Section           
        );

        add_settings_field(
            'social_icon_2', // ID
            'Social Icon 2', // Title 
            array( $this, 'social_icon_2_callback' ), // Callback
            'my-setting-admin', // Page
            'social_links_id' // Section           
        );

        add_settings_field(
            'social_icon_3', // ID
            'Social Icon 3', // Title 
            array( $this, 'social_icon_3_callback' ), // Callback
            'my-setting-admin', // Page
            'social_links_id' // Section           
        );

        add_settings_field(
            'social_icon_4', // ID
            'Social Icon 4', // Title 
            array( $this, 'social_icon_4_callback' ), // Callback
            'my-setting-admin', // Page
            'social_links_id' // Section           
        );

        register_setting(
            'my_option_group', // Option group
            'contact_info', // Option name
            array($this, 'sanitize') // sanitize callback
        );

        add_settings_section(
            'contact_info_id', // ID
            'Contact Info Settings', // Title
            array( $this, 'print_section_contact_info' ), // Callback
            'my-setting-admin' // Page
        );

        add_settings_field(
            'phone_number', // ID
            'Phone number', // Title 
            array( $this, 'phone_number_callback' ), // Callback
            'my-setting-admin', // Page
            'contact_info_id' // Section           
        );

        add_settings_field(
            'phone_text', // ID
            'Phone Text', // Title 
            array( $this, 'phone_text_callback' ), // Callback
            'my-setting-admin', // Page
            'contact_info_id' // Section           
        );

        register_setting(
            'my_option_group', // Option group
            'brand_info', // Option name
            'handle_logo_upload' // logo upload function
        );

        add_settings_section(
            'brand_info_id', // ID
            'Brand Info Settings', // Title
            array( $this, 'print_section_brand_info' ), // Callback
            'my-setting-admin' // Page
        );

        add_settings_field(
            'brand_logo', // ID
            'Brand Logo', // Title 
            array( $this, 'brand_logo_callback' ), // Callback
            'my-setting-admin', // Page
            'brand_info_id' // Section           
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        // if( isset( $input['id_number'] ) )
        //     $new_input['id_number'] = absint( $input['id_number'] );

        if( isset( $input['phone_number'] ) )
            $new_input['phone_number'] = sanitize_text_field( $input['phone_number']);

        if( isset( $input['phone_text'] ) )
            $new_input['phone_text'] = sanitize_text_field( $input['phone_text']);

        return $new_input;
    }

    public function handle_logo_upload($input) {

        if(!empty($_FILES['brand_info[brand_logo]']['tmp_name'])) {
            $file_to_upload = $_FILES['brand_info[brand_logo]'];
            $move_logo = wp_handle_upload($file_to_upload, array('test_form' => FALSE));
            if($move_logo) {
                $wp_upload_dir = wp_upload_dir();
                $attachment = array(
                    'guid' => $wp_upload_dir['url']. '/' . basename($move_logo['file']),
                    'post_mime_type' => $move_logo['type'],
                    'post_title' => $move_logo['file']
                );
                $logo_attach_id = wp_insert_attachment( $attachment, $move_logo['file']);
                
            }
        }

        return $input;
    }

    /** 
     * Print the Section texts
     */
    public function print_section_social_links()
    {
        print 'Enter social links:';
    }

    public function print_section_contact_info()
    {
        print 'Enter contact info:';
    }

    public function print_section_brand_info() {
        print 'Enter brand info:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    // public function id_number_callback()
    // {
    //     printf(
    //         '<input type="text" id="id_number" name="my_option_name[id_number]" value="%s" />',
    //         isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
    //     );
    // }

    /** 
     * Get the settings option array and print one of its values
     */
    public function social_icon_1_callback()
    {
        printf(
            '<input type="text" id="social_icon_1" name="social_links[social_icon_1]" value="%s" />',
            isset( $this->socialOptions['social_icon_1'] ) ? esc_attr($this->socialOptions['social_icon_1']) : ''
        );
    }

    public function social_icon_2_callback()
    {
        printf(
            '<input type="text" id="social_icon_2" name="social_links[social_icon_2]" value="%s" />',
            isset( $this->socialOptions['social_icon_2'] ) ? esc_attr( $this->socialOptions['social_icon_2']) : ''
        );
    }

    public function social_icon_3_callback()
    {
        printf(
            '<input type="text" id="social_icon_3" name="social_links[social_icon_3]" value="%s" />',
            isset( $this->socialOptions['social_icon_3'] ) ? esc_attr( $this->socialOptions['social_icon_3']) : ''
        );
    }

    public function social_icon_4_callback()
    {
        printf(
            '<input type="text" id="social_icon_4" name="social_links[social_icon_4]" value="%s" />',
            isset( $this->socialOptions['social_icon_4'] ) ? esc_attr( $this->socialOptions['social_icon_4']) : ''
        );
    }
    public function phone_number_callback()
    {
        printf(
            '<input type="text" id="phone_number" name="contact_info[phone_number]" value="%s" />',
            isset( $this->contactOptions['phone_number'] ) ? esc_attr( $this->contactOptions['phone_number']) : ''
        );
    }

    public function phone_text_callback()
    {
        printf(
            '<input type="text" id="phone_text" name="contact_info[phone_text]" value="%s" />',
            isset( $this->contactOptions['phone_text'] ) ? esc_attr( $this->contactOptions['phone_text']) : ''
        );
    }

    public function brand_logo_callback()
    {
        echo '<input type="file" id="brand_logo" name="brand_info[brand_logo]" />';
        if(isset($this->brandOptions['brand_logo'])) {
            echo '<img src="' . esc_attr($this->brandOptions['brand_logo']) . '">';
        } else {
            echo '<span>No logo chosen</span>';
        }
    }
}

if( is_admin() )
    $my_settings_page = new MySettingsPage();