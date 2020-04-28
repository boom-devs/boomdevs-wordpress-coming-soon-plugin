<?php
 
    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "cst_taspristudio";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'cst_taspristudio/opt_name', $opt_name );

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../theme_option/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../theme_option/patterns/';
    $sample_patterns      = array();
    
    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.
    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => CST_NAME,
        // Name that appears at the top of your panel
        'display_version'      => CST_VERSION,
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Coming soon', 'cs_taspristudio' ),
        'page_title'           => __( 'Coming soon', 'cs_taspristudio' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,// Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => CST_ASSETS . '/images/coming-soon.png',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'coming-soon',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => false,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',// Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                 => array(
            'icon'              => 'el el-question-sign',
            'icon_position'     => 'right',
            'icon_color'        => 'lightgray',
            'icon_size'         => 'normal',
            'tip_style'         => array(
                'color'         => 'red',
                'shadow'        => true,
                'rounded'       => false,
                'style'         => '',
            ),
            'tip_position'      => array(
                'my'            => 'top left',
                'at'            => 'bottom right',
            ),
            'tip_effect'        => array(
                'show'          => array(
                    'effect'    => 'slide',
                    'duration'  => '500',
                    'event'     => 'mouseover',
                ),
                'hide'          => array(
                    'effect'    => 'slide',
                    'duration'  => '500',
                    'event'     => 'click mouseleave',
                ),
            ),
        )
    );

    Redux::setArgs( $opt_name, $args );

    // Home page
    Redux::setSection( $opt_name, array(
        'title'                     => __( 'Home', 'cs_taspristudio' ),
        'id'                        => 'home',
        'customizer_width'          => '400px',
        'icon'                      => 'el el-home',
        'fields'                    => array(

            array(
                'id'                => 'cst_home_menu_name',
                'type'              => 'text',
                'title'             => __( 'Home Section Link Button Label', 'cs_taspristudio' ),
                'default'           => 'Home',
            ),

            array(
                'id'                => 'cst_home_title',
                'type'              => 'text',
                'title'             => __( 'Title', 'cs_taspristudio' )
            ),

            array(
                'id'                => 'cst_home_desc',
                'type'              => 'textarea',
                'title'             => __( 'Short description', 'cs_taspristudio' )
            ),
        )
    ));

    // Service page
    Redux::setSection( $opt_name, array(
        'title'                     => __( 'Service', 'cs_taspristudio' ),
        'id'                        => 'service',
        'customizer_width'          => '400px',
        'icon'                      => 'el el-screen',
        'fields'                    => array(

            array(
                'id'                => 'cst_service_status',
                'type'              => 'switch', 
                'title'             => __('Display home section', 'cs_taspristudio'),
                'on'                => __('Yes', 'cs_taspristudio'),
                'off'               => __('No', 'cs_taspristudio'),
                'default'           => true
            ),

            array(
                'id'                => 'cst_service_menu_name',
                'type'              => 'text',
                'required'          => array( 'cst_service_status', '=', '1' ),
                'title'             => __( 'Service Section Link Button Label', 'cs_taspristudio' ),
                'placeholder'       => 'service',
            ),

            array(
                'id'                => 'cst_service_title',
                'type'              => 'text',
                'required'          => array( 'cst_service_status', '=', '1' ),
                'title'             => __( 'Title', 'cs_taspristudio' )
            ),

            array(
                'id'                => 'cst_service_desc',
                'type'              => 'textarea',
                'required'          => array( 'cst_service_status', '=', '1' ),
                'title'             => __( 'Short description', 'cs_taspristudio' )
            ),

            array(
                'id'                => 'cst_service_item',
                'type'              => 'slides',
                'title'             => __( 'Service item', 'cs_taspristudio' ),
                'required'          => array( 'cst_service_status', '=', '1' ),
                'placeholder'       => array(
                    'title'         => __( 'This is a title', 'cs_taspristudio' ),
                    'description'   => __( 'Description Here', 'cs_taspristudio' ),
                ),
            ),
        )
    ));

    // Blog page
    Redux::setSection( $opt_name, array(
        'title'                     => __( 'Blog', 'cs_taspristudio' ),
        'id'                        => 'blog',
        'customizer_width'          => '400px',
        'icon'                      => 'el el-picture',
        'fields'                    => array(

            array(
                'id'                => 'cst_blog_status',
                'type'              => 'switch', 
                'title'             => __('Display Blog section', 'cs_taspristudio'),
                'on'                => __('Yes', 'cs_taspristudio'),
                'off'               => __('No', 'cs_taspristudio'),
                'default'           => true
            ),

            array(
                'id'                => 'cst_blog_menu_name',
                'type'              => 'text',
                'required'          => array( 'cst_blog_status', '=', '1' ),
                'title'             => __( 'Blog Section Link Button Label', 'cs_taspristudio' ),
                'default'           => 'Blog',
            ),

            array(
                'id'                => 'cst_blog_title',
                'type'              => 'text',
                'required'          => array( 'cst_blog_status', '=', '1' ),
                'title'             => __( 'Title', 'cs_taspristudio' )
            ),

            array(
                'id'                => 'cst_blog_desc',
                'type'              => 'textarea',
                'required'          => array( 'cst_blog_status', '=', '1' ),
                'title'             => __( 'Short description', 'cs_taspristudio' )
            ),
        )
    ));

    // Contact page
    Redux::setSection( $opt_name, array(
        'title'                     => __( 'Contact', 'cs_taspristudio' ),
        'id'                        => 'contact',
        'customizer_width'          => '400px',
        'icon'                      => 'el el-address-book',
        'fields'                    => array(

            array(
                'id'                => 'cst_contact_status',
                'type'              => 'switch', 
                'title'             => __('Display Contact section', 'cs_taspristudio'),
                'on'                => __('Yes', 'cs_taspristudio'),
                'off'               => __('No', 'cs_taspristudio'),
                'default'           => true
            ),

            array(
                'id'                => 'cst_contact_menu_name',
                'type'              => 'text',
                'required'          => array( 'cst_contact_status', '=', '1' ),
                'title'             => __( 'Contact Section Link Button Label', 'cs_taspristudio' ),
                'default'           => 'Contact',
            ),

            array(
                'id'                => 'cst_contact_title',
                'type'              => 'text',
                'required'          => array( 'cst_contact_status', '=', '1' ),
                'title'             => __( 'Title', 'cs_taspristudio' )
            ),

            array(
                'id'                => 'cst_contact_desc',
                'type'              => 'textarea',
                'required'          => array( 'cst_contact_status', '=', '1' ),
                'title'             => __( 'Short description', 'cs_taspristudio' )
            ),
        )
    ));

    // Design for coming soon page
    Redux::setSection( $opt_name, array(
        'title'                     => __( 'Design', 'cs_taspristudio' ),
        'id'                        => 'design',
        'customizer_width'          => '400px',
        'icon'                      => CST_ASSETS . '/images/painting.png',
        'fields'                    => array(
            
            array(
                'id'                => 'cst_title_color',
                'type'              => 'color',
                'title'             => __( 'Title font color', 'cs_taspristudio' ),
                'default'           => '#fff',
            ),

            array(
                'id'                => 'cst_desc_color',
                'type'              => 'color',
                'title'             => __( 'Description font color', 'cs_taspristudio' ),
                'default'           => '#fff',
            ),

            array(
                'id'                => 'cst_menu_color',
                'type'              => 'color',
                'title'             => __( 'Menu font color', 'cs_taspristudio' ),
                'default'           => '#fff',
            ),

            array(
                'id'                => 'cst_countdown_timer_color',
                'type'              => 'color',
                'title'             => __( 'Countdown timer color', 'cs_taspristudio' ),
                'default'           => '#fff',
            ),

            array(
                'id'                => 'cst_countdown_title_color',
                'type'              => 'color',
                'title'             => __( 'Countdown title color', 'cs_taspristudio' ),
                'default'           => '#fff',
            ),

            array(
                'id'                => 'cst_social_icon_color',
                'type'              => 'color',
                'title'             => __( 'Social icon color', 'cs_taspristudio' ),
                'default'           => '#fff',
            ),

            array(
                'id'                => 'cst_footer_font_color',
                'type'              => 'color',
                'title'             => __( 'Footer font color', 'cs_taspristudio' ),
                'default'           => '#fff',
            ),

            array(
                'id'                => 'cst_title_font_size',
                'type'              => 'slider',
                'title'             => __( 'Title font size', 'cs_taspristudio' ),
                'default'           => 14,
                'min'               => 1,
                'step'              => 1,
                'max'               => 100,
            ),

            array(
                'id'                => 'cst_desc_font_size',
                'type'              => 'slider',
                'title'             => __( 'Description font size', 'cs_taspristudio' ),
                'default'           => 20,
                'min'               => 1,
                'step'              => 1,
                'max'               => 100,
            ),

            array(
                'id'                => 'cst_menu_font_size',
                'type'              => 'slider',
                'title'             => __( 'Menu font size', 'cs_taspristudio' ),
                'default'           => 16,
                'min'               => 1,
                'step'              => 1,
                'max'               => 100,
            ),

            array(
                'id'                => 'cst_countdown_timer_font_size',
                'type'              => 'slider',
                'title'             => __( 'Countdown timer font size', 'cs_taspristudio' ),
                'default'           => 100,
                'min'               => 1,
                'step'              => 1,
                'max'               => 200,
            ),

            array(
                'id'                => 'cst_countdown_title_font_size',
                'type'              => 'slider',
                'title'             => __( 'Countdown title font size', 'cs_taspristudio' ),
                'default'           => 100,
                'min'               => 1,
                'step'              => 1,
                'max'               => 200,
            ),

            array(
                'id'                => 'cst_footer_font_size',
                'type'              => 'slider',
                'title'             => __( 'Footer font size', 'cs_taspristudio' ),
                'default'           => 14,
                'min'               => 1,
                'step'              => 1,
                'max'               => 100,
            ),

            array(
                'id'                => 'cst_social_social_font',
                'type'              => 'slider',
                'title'             => __( 'Social icon size', 'cs_taspristudio' ),
                'default'           => 16,
                'min'               => 1,
                'step'              => 1,
                'max'               => 100,
            )


        )
    ));

    // Footer section
    Redux::setSection( $opt_name, array(
        'title'                     => __( 'Footer', 'cs_taspristudio' ),
        'id'                        => 'footer',
        'customizer_width'          => '400px',
        'icon'                      => CST_ASSETS . '/images/footer.png',
        'fields'                    => array(
            array(
                'id'                => 'cst_copyright_text_left',
                'type'              => 'text',
                'title'             => __( 'Copyright text left', 'cs_taspristudio' ),
                'default'           => '© 2020 Taspristudio - All Rights Reserved',
            ),

            array(
                'id'                => 'cst_copyright_text_center',
                'type'              => 'textarea',
                'title'             => __( 'Copyright text center', 'cs_taspristudio' ),
                'default'           => 'Created with  by Taspristudio Team',
            ),

            array(
                'id'                => 'cst_facebook',
                'type'              => 'text',
                'title'             => __( 'Facebook', 'cs_taspristudio' ),
                'placeholder'       => 'https://facebook.com/',
            ),

            array(
                'id'                => 'cst_twitter',
                'type'              => 'text',
                'title'             => __( 'Twitter', 'cs_taspristudio' ),
                'placeholder'       => 'https://twitter.com/',
            ),

            array(
                'id'                => 'cst_linkedin',
                'type'              => 'text',
                'title'             => __( 'Linkedin', 'cs_taspristudio' ),
                'placeholder'       => 'https://linkedin.com/',
            ),

            array(
                'id'                => 'cst_tumblr',
                'type'              => 'text',
                'title'             => __( 'Tumblr', 'cs_taspristudio' ),
                'placeholder'       => 'https://tumblr.com/',
            ),

            array(
                'id'                => 'cst_instagram',
                'type'              => 'text',
                'title'             => __( 'Instagram', 'cs_taspristudio' ),
                'placeholder'       => 'https://instagram.com/',
            ),

            array(
                'id'                => 'cst_reddit',
                'type'              => 'text',
                'title'             => __( 'Reddit', 'cs_taspristudio' ),
                'placeholder'       => 'https://www.reddit.com/',
            ),

            array(
                'id'                => 'cst_youtube',
                'type'              => 'text',
                'title'             => __( 'Youtube', 'cs_taspristudio' ),
                'placeholder'       => 'https://www.youtube.com/',
            ),
        )
    ));

    // Setting section
    Redux::setSection( $opt_name, array(
        'title'                     => __( 'Setting', 'cs_taspristudio' ),
        'id'                        => 'settings',
        'customizer_width'          => '400px',
        'icon'                      => 'el el-wrench-alt'
    ));

    // Coming soon status
    Redux::setSection( $opt_name, array(
        'title'                     => __( 'Coming soon status', 'cs_taspristudio' ),
        'id'                        => 'cst_cs_status',
        'subsection'                => true,
        'fields'                    => array(
            array(
                'id'                => 'cst_cs_page_status',
                'type'              => 'switch', 
                'title'             => __('Enable', 'cs_taspristudio'),
                'on'                => __('Yes', 'cs_taspristudio'),
                'off'               => __('No', 'cs_taspristudio')
            ),
        )
    ));

    // Header setting
    Redux::setSection( $opt_name, array(
        'title'                     => __( 'Header setting', 'cs_taspristudio' ),
        'id'                        => 'cst_header_setting',
        'subsection'                => true,
        'customizer_width'          => '450px',
        'fields'                    => array(
            array(
                'id'                => 'cst_display_logo',
                'type'              => 'switch', 
                'title'             => __('Display logo', 'cs_taspristudio'),
                'on'                => __('Yes', 'cs_taspristudio'),
                'off'               => __('No', 'cs_taspristudio'),
                'default'           => true
            ),
            array(
                'id'                => 'cst_header_logo',
                'type'              => 'media',
                'url'               => true,
                'required'          => array('cst_display_logo', '=', '1'),
                'title'             => __('Logo', 'cs_taspristudio' ),
                'compiler'          => 'false',
                'subtitle'          => __('Upload your logo', 'cs_taspristudio' ),
                'default'           => array('url' => CST_ASSETS . '/images/logo.png'),
            ),

            array(
                'id'                => 'cst_fevicon',
                'type'              => 'media',
                'url'               => true,
                'required'          => array('cst_display_logo', '=', '1'),
                'title'             => __('Fevicon', 'cs_taspristudio' ),
                'compiler'          => 'false',
                'subtitle'          => __('Upload your fevicon', 'cs_taspristudio' ),
                'default'           => array('url' => CST_ASSETS . '/images/fevicon.png'),
            ),

            array(
                'id'                => 'cst_logo_width',
                'type'              => 'dimensions',
                'units'             => array( 'em', 'px', '%' ), // You can specify a unit value. Possible: px, em, %
                'units_extended'    => 'true',  // Allow users to select any type of unit
                'title'             => __( 'Logo width', 'cs_taspristudio' ),
                'height'            => false,
                'required'          => array('cst_display_logo', '=', '1'),
                'default'           => array(
                    'width'         => 200,
                    'height'        => 100,
                )
            ),

            array(
                'id'                => 'cst_logo_height',
                'type'              => 'dimensions',
                'units'             => array( 'em', 'px', '%' ), // You can specify a unit value. Possible: px, em, %
                'units_extended'    => 'true',  // Allow users to select any type of unit
                'title'             => __( 'Logo height', 'cs_taspristudio' ),
                'height'            => false,
                'required'          => array('cst_display_logo', '=', '1'),
                'default'           => array(
                    'width'         => 200,
                    'height'        => 100,
                )
            ),
        )
    ));

    // Countdown setting
    Redux::setSection( $opt_name, array(
        'title'                     => __( 'Countdown setting', 'cs_taspristudio' ),
        'id'                        => 'cst_countdown_setting',
        'subsection'                => true,
        'fields'                    => array(
            array(
                'id'                => 'cst_display_countdown',
                'type'              => 'switch', 
                'title'             => __('Enable countdown', 'cs_taspristudio'),
                'on'                => __('Yes', 'cs_taspristudio'),
                'off'               => __('No', 'cs_taspristudio'),
                'default'           => true
            ),

            array(
                'id'                => 'cst_end_date',
                'type'              => 'date',
                'required'          => array( 'cst_display_countdown', '=', '1' ),
                'title'             => __( 'End date', 'cs_taspristudio' )
            ),

            array(
                'id'                => 'cst_time_hour',
                'type'              => 'text',
                'title'             => __( 'Time', 'cs_taspristudio' ),
                'required'          => array( 'cst_display_countdown', '=', '1' ),
            ),

            array(
                'id'                => 'cst_time_minute',
                'type'              => 'text',
                'title'             => __( 'Minute', 'cs_taspristudio' ),
                'required'          => array( 'cst_display_countdown', '=', '1' ),
            ),
        )
    ));


