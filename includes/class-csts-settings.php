<?php

defined( 'ABSPATH' ) || exit;
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Csts
 * @subpackage Csts/includes
 * @author     taspristudio <admin@tasrpistiudio.com>
 */

 class Csts_Settings {
     /**
      * The real name of this plugin.
      *
      * @access   protected
      * @var      string    $plugin_full_name    The full punctual name of this plugin.
      */
     protected $plugin_full_name;

     /**
      * The ID of this plugin.
      *
      * @var      string    $plugin_name    The ID of this plugin.
      */
     public static $plugin_name = CSTS_NAME;

     /**
      * Csts_Settings constructor.
      *
      * @param string $plugin_full_name The punctual name of the plugin.
      */
     public function __construct( $plugin_full_name ) {
        $this->plugin_full_name = $plugin_full_name;
     }


     public function csts_customization_settings() {
        // Control core classes for avoid errors
        if( class_exists( 'CSF' ) ) {

            // Set a unique slug-like ID
            $prefix = Csts_Settings::$plugin_name;

            // Create customize options
            CSF::createCustomizeOptions( $prefix );

            CSF::createSection( $prefix, array(
                'id'    => $prefix . '_settings',
                'title' => $this->plugin_full_name,
            ));

            /**
             * Trun on edit mode section
             * 
             * @csts section
             */

             CSF::createSection( $prefix, array(
                    'parent'        => $prefix . '_settings',
                    'title'     => __('Trun on edit mode', 'csts'),
                    'fields'    => array(

                        // Trun on edit mode
                        array(
                            'id'            => 'enable_plugin_edit',
                            'type'          => 'switcher',
                            'title'         => __('Trun on edit mode', 'csts'),
                            'default'       => true,
                        ),
                    )
            ));

            /**
             * Seo section
             * 
             * @csts seo
             */
            CSF::createSection( $prefix, array(
                'title'         => __('Seo section', 'csts'),
                'parent'        => $prefix . '_settings',
                'fields'        => array(

                    // Seo title
                    array(
                        'id'            => 'seo_title',
                        'type'          => 'text',
                        'title'         => __('Title','csts'),
                    ),

                    // Seo description
                    array(
                        'id'            => 'seo_description',
                        'type'          => 'textarea',
                        'title'         => __('Description', 'csts'),
                    ),

                    // Seo keywords
                    array(
                        'id'            => 'seo_keywords',
                        'type'          => 'textarea',
                        'title'         => __('Keywords', 'csts'),
                        'desc'          => __('Enter your seo keywords with (,)', 'csts'),
                    ),
                )
            ));

            /**
             * Header section
             * 
             * @csts section
             */
            CSF::createSection( $prefix, array(
                'title'         => __('Header', 'csts'),
                'parent'        => $prefix . '_settings',
                'fields'        => array(
                    // Header
                    array(
                        'id'            => 'logo',
                        'type'          => 'media',
                        'title'         => __('Logo', 'csts'),
                        'desc'          => __('Please upload your logo this size (width: 100px)', 'csts')
                    ),
                )
            ));

            /**
             * Home page
             * 
             * @csts pages
             */
            CSF::createSection( $prefix, array(
                'title'     => 'Home',
                'parent'    => $prefix . '_settings',
                'fields'    => array(
                   
                    // Page title
                    array(
                        'id'            => 'home_title',
                        'type'          => 'text',
                        'title'         => __('Title','csts'),
                    ),

                    // Page description
                    array(
                        'id'            => 'home_description',
                        'type'          => 'wp_editor',
                        'title'         => __('Description', 'csts'),
                    ),

                     // Countdown Heading
                     array(
                        'type'          => 'heading',
                        'content'       => 'Countdown setting',
                    ),

                    // Countdown date
                    array(
                        'id'            => 'count_down_date',
                        'type'          => 'date',
                        'title'         => __('Date', 'csts'),
                    ),

                    // Countdown time
                    array(
                        'id'            => 'count_down_time',
                        'type'          => 'text',
                        'title'         => __('Time', 'csts'),
                        'desc'          => __('Enter countdown time (h:m:s)(12:30:00)', 'csts')
                    ),

                     // Subscribe form Heading
                     array(
                        'type'          => 'heading',
                        'content'       => __('Subscribe form', 'csts'),
                    ),

                     // Subscribe form shortcode
                     array(
                        'id'            => 'subscribe_form_shortcode',
                        'type'          => 'textarea',
                        'title'         => __('Subscribe form shortcode', 'csts'),
                        'desc'          => __('Enter form shortcode', 'csts')
                    ),
                )
            ));

            /**
             * Service page
             * 
             * @csts pages
             */
            CSF::createSection( $prefix, array(
                'title'         => __('Service', 'csts'),
                'parent'        => $prefix . '_settings',
                'fields'        => array(
                    
                    // Service page enable or disable
                    array(
                        'id'            => 'service_enable_disable',
                        'type'          => 'switcher',
                        'title'         => __('Service page enable or disable', 'csts'),
                        'default'       => true,
                    ),
            
                    // Page title
                     array(
                        'id'            => 'service_title',
                        'type'          => 'text',
                        'title'         => __('Title','csts'),
                    ),

                    // Page description
                    array(
                        'id'            => 'service_description',
                        'type'          => 'wp_editor',
                        'title'         => __('Description', 'csts'),
                    ),


                    // Service list item
                    array(
                        'id'        => 'service_box',
                        'type'      => 'repeater',
                        'title'     => __('Service item list'),
                        'fields'    => array(

                            // Icon
                            array(
                                'id'            => 'icon',
                                'type'          => 'icon',
                                'title'         => __('Icon', 'csts'),
                            ),

                            // Ttitle
                            array(
                                'id'            => 'title',
                                'type'          => 'text',
                                'title'         => __('Title', 'csts'),
                            ),

                            // Description
                            array(
                                'id'            => 'description',
                                'type'          => 'textarea',
                                'title'         => __('Short Description', 'csts'),
                            ),
                    
                        ),
                    ),
                )
            ));

            /**
             * Blog page
             * 
             * @csts pages
             */
            CSF::createSection( $prefix, array(
                'title'         => __('Blog', 'csts'),
                'parent'        => $prefix . '_settings',
                'fields'        => array(

                    // Blog page enable or disable
                    array(
                        'id'            => 'blog_enable_disable',
                        'type'          => 'switcher',
                        'title'         => __('Blog page enable or disable', 'csts'),
                        'default'       => true,
                    ),
            
                    // Page title
                    array(
                        'id'            => 'blog_title',
                        'type'          => 'text',
                        'title'         => __('Title','csts'),
                    ),

                    // Page description
                    array(
                        'id'            => 'blog_description',
                        'type'          => 'wp_editor',
                        'title'         => __('Description', 'csts'),
                    ),
                )
            ));

            /**
             * Contact page
             * 
             * @csts pages
             */
            CSF::createSection( $prefix, array(
                'title'         => __('Contact', 'csts'),
                'parent'        => $prefix . '_settings',
                'fields'        => array(

                    // Contact page enable or disable
                    array(
                        'id'            => 'contact_enable_disable',
                        'type'          => 'switcher',
                        'title'         => __('Contact page enable or disable', 'csts'),
                        'default'       => true,
                    ),
            
                    // Page title
                    array(
                        'id'            => 'contact_title',
                        'type'          => 'text',
                        'title'         => __('Title','csts'),
                    ),

                    // Page description
                    array(
                        'id'            => 'contact_description',
                        'type'          => 'wp_editor',
                        'title'         => __('Description', 'csts'),
                    ),

                    // Contact form shortcode
                    array(
                        'id'            => 'contact_form_shortcode',
                        'type'          => 'wp_editor',
                        'title'         => __('Contact form shortcode', 'csts'),
                    ),
                )
            ));

            /**
             * Footer section
             * 
             * @csts section
             */
            CSF::createSection( $prefix, array(
                'title'             => __('Footer', 'csts'),
                'parent'            => $prefix . '_settings',
                'fields'            => array(

                    // Copyright left text
                    array(
                        'id'            => 'copyright_left_text',
                        'type'          => 'text',
                        'title'         => __('Copyright left text', 'csts'),
                    ),

                    // Copyright center text
                    array(
                        'id'            => 'copyright_center_text',
                        'type'          => 'text',
                        'title'         => __('Copyright center text', 'csts'),
                    ),

                    // Social icons
                    array(
                        'id'        => 'footer_social_icons',
                        'type'      => 'repeater',
                        'title'     => __('Social icons'),
                        'fields'    => array(
                            
                            // Icon
                            array(
                                'id'        => 'social_icon',
                                'type'      => 'icon',
                                'title'     => 'Icon',
                            ),

                            // Link
                            array( 
                                'id'        => 'social_icon_link',
                                'type'      => 'text',
                                'title'     => 'Link',
                            ),
                      
                        ),
                    ),
                )
            ));

            /**
             * Settings
             * 
             * @csts pages
             */
            CSF::createSection( $prefix, array(
                'title'         => __('Settings', 'csts'),
                'parent'        => $prefix . '_settings',
                'fields'        => array(
                    
                    // Content Typography
                    array(
                        'id'                => 'content_typography',
                        'type'              => 'typography',
                        'title'             => __('Content Typography', 'csts'),
                        'default'           => array(
                            'color'           => '#ffbc00',
                            'font-family'     => 'Open Sans',
                            'font-size'       => '16',
                            'line-height'     => '20',
                            'unit'            => 'px',
                            'type'            => 'google',
                        ),
                    ),

                    // Title Typography
                    array(
                        'id'                => 'title_typography',
                        'type'              => 'typography',
                        'title'             => __('Title Typography', 'csts'),
                        'default'           => array(
                            'color'           => '#ffbc00',
                            'font-family'     => 'Open Sans',
                            'font-size'       => '16',
                            'line-height'     => '20',
                            'unit'            => 'px',
                            'type'            => 'google',
                        ),
                    ),

                    // Background color
                    array(
                        'id'            => 'bg_color',
                        'type'          => 'color',
                        'title'         => __('Background color', 'csts'),
                    ),
                )
            ));
        }
    }

     /**
     * Return plugin settings.
     *
     * @param string $key Key of the required settings.
     * @param string $default_value Default value of the required settings.
     *
     * @return string|array Settings value.
     */
    public static function get( $key = '', $default_value = null ) {
        $options = get_option( Csts_Settings::$plugin_name );

        return ( isset( $options[$key] ) ) ? $options[$key] : $default_value;
    }

    /**
     * Return plugin all settings.
     *
     * @return string|array Settings values.
     */
    public static function get_settings() {
        return get_option( Csts_Settings::$plugin_name );
    }

 }