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
                    'title'     => __('Trun On Edit Mode', 'csts'),
                    'fields'    => array(
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
                'title'         => __('SEO Meta', 'csts'),
                'parent'        => $prefix . '_settings',
                'fields'        => array(
                    array(
                        'id'            => 'seo_title',
                        'type'          => 'text',
                        'title'         => __('Title','csts'),
                    ),
                    array(
                        'id'            => 'seo_description',
                        'type'          => 'textarea',
                        'title'         => __('Description', 'csts'),
                    ),
                    array(
                        'id'            => 'seo_keywords',
                        'type'          => 'textarea',
                        'title'         => __('Keywords', 'csts'),
                        'desc'          => __('Separate different keywords with trailing `,`', 'csts'),
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
                    array(
                        'id'            => 'home_enable_disable',
                        'type'          => 'switcher',
                        'title'         => __('Enable or Disable', 'csts'),
                        'default'       => true,
                    ),
                    array(
                        'id'            => 'home_menu_title',
                        'type'          => 'text',
                        'title'         => __('Menu title','csts'),
                    ),
                    array(
                        'id'            => 'home_title',
                        'type'          => 'text',
                        'title'         => __('Title','csts'),
                    ),
                    array(
                        'id'            => 'home_description',
                        'type'          => 'wp_editor',
                        'title'         => __('Description', 'csts'),
                    ),
                    array(
                        'type'          => 'heading',
                        'content'       => 'Countdown setting',
                    ),
                    array(
                        'id'            => 'count_down_date',
                        'type'          => 'date',
                        'title'         => __('Date', 'csts'),
                    ),
                    array(
                        'id'            => 'count_down_time',
                        'type'          => 'text',
                        'title'         => __('Time', 'csts'),
                        'desc'          => __('Enter countdown time (h:m:s)(12:30:00)', 'csts')
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
                    array(
                        'id'            => 'service_enable_disable',
                        'type'          => 'switcher',
                        'title'         => __('Enable or Disable', 'csts'),
                        'default'       => true,
                    ),
                    array(
                        'id'            => 'service_menu_title',
                        'type'          => 'text',
                        'title'         => __('Menu title','csts'),
                    ),
                    array(
                        'id'            => 'service_title',
                        'type'          => 'text',
                        'title'         => __('Title','csts'),
                    ),
                    array(
                        'id'            => 'service_description',
                        'type'          => 'wp_editor',
                        'title'         => __('Description', 'csts'),
                    ),
                    array(
                        'id'        => 'service_box',
                        'type'      => 'repeater',
                        'title'     => __('Service item list'),
                        'fields'    => array(
                            array(
                                'id'            => 'icon',
                                'type'          => 'icon',
                                'title'         => __('Icon', 'csts'),
                            ),
                            array(
                                'id'            => 'title',
                                'type'          => 'text',
                                'title'         => __('Title', 'csts'),
                            ),
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
                    array(
                        'id'            => 'blog_enable_disable',
                        'type'          => 'switcher',
                        'title'         => __('Blog page enable or disable', 'csts'),
                        'default'       => true,
                    ),
                    array(
                        'id'            => 'blog_menu_title',
                        'type'          => 'text',
                        'title'         => __('Menu title','csts'),
                    ),
                    array(
                        'id'            => 'blog_title',
                        'type'          => 'text',
                        'title'         => __('Title','csts'),
                    ),
                    array(
                        'id'            => 'blog_description',
                        'type'          => 'wp_editor',
                        'title'         => __('Description', 'csts'),
                    ),
                    array(
                        'id'            => 'blog_category',
                        'type'          => 'select',
                        'title'         => __('Selec post category', 'csts'),
                        'placeholder'   => __('Selec post category', 'csts'),
                        'options'       => 'categories',
                        'query_args'  => array(
                            'taxonomy'    => 'category',
                        ),
                    ),
                    array(
                        'id'            => 'blog_grid_list',
                        'type'          => 'select',
                        'title'         => 'Select',
                        'placeholder'   => __('Select blog column', 'csts'),
                        'options'       => array(
                            '2'         => '2 Column',
                            '3'         => '3 Column',
                            '4'         => '4 Column',
                        ),
                        '3'             => '3 Column'
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
                    array(
                        'id'            => 'contact_enable_disable',
                        'type'          => 'switcher',
                        'title'         => __('Enable or disable', 'csts'),
                        'default'       => true,
                    ),
                    array(
                        'id'            => 'contact_menu_title',
                        'type'          => 'text',
                        'title'         => __('Menu title','csts'),
                    ),
                    array(
                        'id'            => 'contact_title',
                        'type'          => 'text',
                        'title'         => __('Title','csts'),
                    ),
                    array(
                        'id'            => 'contact_description',
                        'type'          => 'wp_editor',
                        'title'         => __('Description', 'csts'),
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
                    array(
                        'id'            => 'copyright_left_text',
                        'type'          => 'text',
                        'title'         => __('Copyright text', 'csts'),
                    ),
                    array(
                        'id'        => 'footer_social_icons',
                        'type'      => 'repeater',
                        'title'     => __('Social icons'),
                        'fields'    => array(
                            array(
                                'id'        => 'social_icon',
                                'type'      => 'icon',
                                'title'     => 'Icon',
                            ),
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
                'title'         => __('Typography', 'csts'),
                'parent'        => $prefix . '_settings',
                'fields'        => array(
                    array(
                        'type'                  => 'heading',
                        'content'               => 'Title Typography',
                    ),
                    array(
                        'id'                    => 'title_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Title typography', 'csts'),
                        'output'                => array( '.csts-page-wrapper .s-title h2', '.csts-page-wrapper .coming-soon-content h2' ),
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => 'Content Typography',
                    ),
                    array(
                        'id'                    => 'content_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Content typography', 'csts'),
                        'output'                => array('.csts-page-wrapper .s-title p', '.csts-page-wrapper .coming-soon-content p', ),
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => 'Background Setting',
                    ),
                    array(
                        'id'                    => 'bg_image',
                        'type'                  => 'media',
                        'title'                 =>  __('Background image', 'csts'),
                    ),
                    array(
                        'id'                    => 'bg_image_style',
                        'type'                  => 'background',
                        'title'                 => __('Background image style', 'csts'),
                        'output'                => '.csts-page-wrapper.page-wrapper',
                      ),
                    array(
                        'id'                    => 'bg_color',
                        'type'                  => 'color',
                        'title'                 => __('Background color', 'csts'),
                        'output'                => array('.csts-page-wrapper.page-wrapper'),
                        'output_mode'           => 'background',
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => 'Button Typography',
                    ),
                    array(
                        'id'                    => 'button_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Button typography', 'csts'),
                        'output'                => array('.csts-page-wrapper .newsletter .btn', '.csts-page-wrapper .blog-post .post-thumb .overlay-btn a'),
                    ),
                    array(
                        'id'                    => 'button_bg_color',
                        'type'                  => 'color',
                        'title'                 => __('Button background color', 'csts'),
                        'output'                => array('.csts-page-wrapper .newsletter .btn', '.csts-page-wrapper .blog-post .post-thumb .overlay-btn a'),
                        'output_mode'           => 'background-color',
                    ),
                    array(
                        'id'                    => 'input_bg_color',
                        'type'                  => 'color',
                        'title'                 => __('Input background color', 'csts'),
                        'output_mode'           => 'background-color',
                        'output'                => array('.csts-page-wrapper .newsletter .form-control'),
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => 'Menu typography',
                    ),
                    array(
                        'id'                    => 'menu_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Menu typography', 'csts'),
                        'output'                => array('.csts-page-wrapper .navbar-nav li a'),
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => 'Countdown Typography',
                    ),
                    array(
                        'id'                    => 'countdown_count_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Countdown count typography', 'csts'),
                        'output'                => array('.csts-page-wrapper .countdown-box .number'),
                    ),
                    array(
                        'id'                    => 'countdown_title_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Countdown title typography', 'csts'),
                        'output'                => array('.csts-page-wrapper .countdown-box span'),
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => 'Service Page Typography',
                    ),
                    array(
                        'id'                    => 'service_item_background_color',
                        'type'                  => 'color',
                        'title'                 => __('Background color', 'csts'),
                        'output_mode'           => 'background-color',
                        'output'                => array('.csts-page-wrapper .service-item::before')
                    ),
                    array(
                        'id'                    => 'service_item_background_hover_color',
                        'type'                  => 'color',
                        'title'                 => __('Background hover color', 'csts'),
                        'output_mode'           => 'background',
                        'output'                => array('.csts-page-wrapper .service-item::after'),
                    ),
                    array(
                        'id'                    => 'service_item_icon_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Service item icon typography', 'csts'),
                        'output'                => array('.csts-page-wrapper .service-item .item-icon i'),
                    ),
                    array(
                        'id'                    => 'service_item_icon_hover_color',
                        'type'                  => 'color',
                        'title'                 => __('Icon hover color', 'csts'),
                        'output_mode'           => 'color',
                        'output'                => '.csts-page-wrapper .service-item:hover i',
                    ),
                    array(
                        'id'                    => 'service_item_title_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Service item title typography', 'csts'),
                        'output'                => '.csts-page-wrapper .service-item .item-title',
                    ),
                    array(
                        'id'                    => 'service_item_title_hover_color',
                        'type'                  => 'color',
                        'title'                 => __('Title hover color', 'csts'),
                        'output_mode'           => 'color',
                        'output'                => array('.csts-page-wrapper .service-item:hover .item-title'),
                    ),
                    array(
                        'id'                    => 'service_item_content_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Service item content typography', 'csts'),
                        'output'                => array('.csts-page-wrapper .service-item p'),
                    ),
                    array(
                        'id'                    => 'service_item_content_hover_color',
                        'type'                  => 'color',
                        'title'                 => __('Content hover color', 'csts'),
                        'output_mode'           => 'color',
                        'output'                => array('.csts-page-wrapper .service-item:hover p'),
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => 'Footer Typography',
                    ),
                    array(
                        'id'                    => 'footer_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Footer typography', 'csts'),
                        'output'                => array('.csts-page-wrapper .social-profile li a', '.csts-page-wrapper .copyright'),
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