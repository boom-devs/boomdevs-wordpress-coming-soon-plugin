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
            CSF::createCustomizeOptions( $prefix,array(
                'database'        => 'option',
                'transport'       => 'refresh',
                'capability'      => 'manage_options',
                'save_defaults'   => true,
                'enqueue_webfont' => true,
                'async_webfont'   => false,
                'output_css'      => true,
            ));

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
                ),
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
                        'default'       => 'Home',
                    ),
                    array(
                        'id'            => 'home_title',
                        'type'          => 'text',
                        'title'         => __('Title','csts'),
                        'default'       => 'Home',
                    ),
                    array(
                        'id'            => 'home_description',
                        'type'          => 'wp_editor',
                        'title'         => __('Description', 'csts'),
                        'default'       => 'We Create WordPress Themes, Plugins and Provides All Kind of Web Solutions For Your Business Needs.',
                    ),
                    array(
                        'type'          => 'heading',
                        'content'       => 'Countdown setting',
                    ),
                    array(
                        'id'            => 'count_down_date',
                        'type'          => 'date',
                        'title'         => __('Date', 'csts'),
                        'default'       => $this->csts_get_date_time('y'),
                    ),
                    array(
                        'id'            => 'count_down_time',
                        'type'          => 'text',
                        'title'         => __('Time', 'csts'),
                        'desc'          => __('Enter countdown time (h:m:s)(12:30:00)', 'csts'),
                        'default'       => $this->csts_get_date_time('t')
                    ),
                ),
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
                        'default'       => false,
                    ),
                    array(
                        'id'            => 'service_menu_title',
                        'type'          => 'text',
                        'title'         => __('Menu title','csts'),
                        'default'       => 'Service',
                    ),
                    array(
                        'id'            => 'service_title',
                        'type'          => 'text',
                        'title'         => __('Title','csts'),
                        'default'       => 'Service',
                    ),
                    array(
                        'id'            => 'service_description',
                        'type'          => 'wp_editor',
                        'title'         => __('Description', 'csts'),
                        'default'       => 'We Create WordPress Themes, Plugins, and provides all kinds of Web Solutions for your business needs.',
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
                        'default'       => false,
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
                        'default'       => false,
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
                        'content'               => __('Body Typography', 'csts'),
                    ),
                    array(
                        'id'                    => 'body_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Body typography', 'csts'),
                        'default'               => array(
                          'color'               => '#fff',
                          'font-family'         => 'Poppins',
                          'font-size'           => '16',
                          'font-weight'         => '400',
                          'unit'                => 'px',
                          'type'                => 'google',
                        ),
                        'output'                => array( '.csts-page-wrapper'),
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => __('Heading Tags Typography', 'csts'),
                    ),
                    array(
                        'id'                    => 'heading_h1',
                        'type'                  => 'typography',
                        'title'                 => __('Heading h1 typography', 'csts'),
                        'default'               => array(
                          'color'               => '#fff',
                          'font-family'         => 'Poppins',
                          'font-size'           => '70',
                          'font-weight'         => '800',
                          'unit'                => 'px',
                          'type'                => 'google',
                        ),
                        'output'                => array( '.csts-page-wrapper h1'),
                    ),
                    array(
                        'id'                    => 'heading_h2',
                        'type'                  => 'typography',
                        'title'                 => __('Heading h2 typography', 'csts'),
                        'default'               => array(
                          'color'               => '#fff',
                          'font-family'         => 'Poppins',
                          'font-size'           => '64',
                          'font-weight'         => '800',
                          'unit'                => 'px',
                          'type'                => 'google',
                        ),
                        'output'                => array( '.csts-page-wrapper h2'),
                    ),
                    array(
                        'id'                    => 'heading_h3',
                        'type'                  => 'typography',
                        'title'                 => __('Heading h3 typography', 'csts'),
                        'default'               => array(
                            'color'             => '#222222',
                            'font-family'       => 'Poppins',
                            'font-size'         => '30',
                            'font-weight'       => '500',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
                        'output'                => array( '.csts-page-wrapper h3'),
                    ),
                    array(
                        'id'                    => 'heading_h4',
                        'type'                  => 'typography',
                        'title'                 => __('Heading h4 typography', 'csts'),
                        'default'               => array(
                            'color'             => '#222222',
                            'font-family'       => 'Poppins',
                            'font-size'         => '20',
                            'font-weight'       => '400',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
                        'output'                => array( '.csts-page-wrapper h4'),
                    ),
                    array(
                        'id'                    => 'heading_h5',
                        'type'                  => 'typography',
                        'title'                 => __('Heading h5 typography', 'csts'),
                        'default'               => array(
                            'color'             => '#222222',
                            'font-family'       => 'Poppins',
                            'font-size'         => '18',
                            'font-weight'       => '400',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
                        'output'                => array( '.csts-page-wrapper h5'),
                    ),
                    array(
                        'id'                    => 'heading_h6',
                        'type'                  => 'typography',
                        'title'                 => __('Heading h6 typography', 'csts'),
                        'default'               => array(
                            'color'             => '#222222',
                            'font-family'       => 'Poppins',
                            'font-size'         => '16',
                            'font-weight'       => '400',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
                        'output'                => array( '.csts-page-wrapper h6'),
                    ),

                    array(
                        'type'                  => 'heading',
                        'content'               => 'Page Title Typography',
                    ),
                    array(
                        'id'                    => 'title_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Page title typography', 'csts'),
                        'default'               => array(
                            'color'             => '#fff',
                            'font-family'       => 'Poppins',
                            'font-size'         => '64',
                            'font-weight'       => '800',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
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
                        'default'               => array(
                            'color'             => '#fff',
                            'font-family'       => 'Poppins',
                            'font-size'         => '16',
                            'font-weight'       => '400',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
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
                        'default'               => '#4082f9',
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => __('Button Typography', 'csts'),
                    ),
                    array(
                        'id'                    => 'button_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Button typography', 'csts'),
                        'default'               => array(
                            'color'             => '#387CF7',
                            'font-family'       => 'Poppins',
                            'font-size'         => '16',
                            'font-weight'       => '600',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
                        'output'                => array('.csts-page-wrapper .newsletter .btn', '.csts-page-wrapper .f-s-btn'),
                    ),
                    array(
                        'id'                    => 'button_bg_color',
                        'type'                  => 'color',
                        'title'                 => __('Button background color', 'csts'),
                        'output'                => array('.csts-page-wrapper .newsletter .btn'),
                        'output_mode'           => 'background-color',
                    ),
                    array(
                        'id'                    => 'input_bg_color',
                        'type'                  => 'color',
                        'title'                 => __('Input background color', 'csts'),
                        'output_mode'           => 'background-color',
                        'default'               => '#fff',
                        'output'                => array('.csts-page-wrapper .newsletter .btn', '.csts-page-wrapper .f-s-btn'),
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => 'Menu typography',
                    ),
                    array(
                        'id'                    => 'menu_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Menu typography', 'csts'),
                        'default'               => array(
                            'color'             => '#fff',
                            'font-family'       => 'Poppins',
                            'font-size'         => '16',
                            'font-weight'       => '400',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
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
                        'default'               => array(
                            'color'             => '#fff',
                            'font-family'       => 'Poppins',
                            'font-size'         => '140',
                            'font-weight'       => '800',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
                        'output'                => array('.csts-page-wrapper .countdown-box .number'),
                    ),
                    array(
                        'id'                    => 'countdown_title_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Countdown title typography', 'csts'),
                        'default'               => array(
                            'color'             => '#fff',
                            'font-family'       => 'Poppins',
                            'font-size'         => '16',
                            'font-weight'       => '400',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
                        'output'                => array('.csts-page-wrapper .countdown-box span'),
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => __('Service Page Typography', 'csts'),
                    ),
                    array(
                        'id'                    => 'service_item_background_color',
                        'type'                  => 'color',
                        'title'                 => __('Background color', 'csts'),
                        'output_mode'           => 'background-color',
                        'default'               => '#fff',
                        'output'                => array('.csts-page-wrapper .service-item::before')
                    ),
                    array(
                        'id'                    => 'service_item_background_hover_color',
                        'type'                  => 'color',
                        'title'                 => __('Background hover color', 'csts'),
                        'output_mode'           => 'background',
                        'default'               => '#588ff3',
                        'output'                => array('.csts-page-wrapper .service-item::after'),
                    ),
                    array(
                        'id'                    => 'service_item_icon_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Service item icon typography', 'csts'),
                        'default'               => array(
                            'color'             => '#3c7ff8',
                            'font-family'       => 'Font Awesome 5 Free',
                            'font-size'         => '60',
                            'font-weight'       => '900',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
                        'output'                => array('.csts-page-wrapper .service-item .item-icon i'),
                    ),
                    array(
                        'id'                    => 'service_item_icon_hover_color',
                        'type'                  => 'color',
                        'title'                 => __('Icon hover color', 'csts'),
                        'output_mode'           => 'color',
                        'default'               => '#fff',
                        'output'                => '.csts-page-wrapper .service-item:hover i',
                    ),
                    array(
                        'id'                    => 'service_item_title_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Service item title typography', 'csts'),
                        'default'               => array(
                            'color'             => '#222222',
                            'font-family'       => 'Poppins',
                            'font-size'         => '20',
                            'font-weight'       => '400',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
                        'output'                => '.csts-page-wrapper .service-item .item-title',
                    ),
                    array(
                        'id'                    => 'service_item_title_hover_color',
                        'type'                  => 'color',
                        'title'                 => __('Title hover color', 'csts'),
                        'output_mode'           => 'color',
                        'default'               => '#fff',
                        'output'                => array('.csts-page-wrapper .service-item:hover .item-title'),
                    ),
                    array(
                        'id'                    => 'service_item_content_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Service item content typography', 'csts'),
                        'default'               => array(
                            'color'             => '#777777',
                            'font-family'       => 'Poppins',
                            'font-size'         => '14',
                            'font-weight'       => '400',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
                        'output'                => array('.csts-page-wrapper .service-item p'),
                    ),
                    array(
                        'id'                    => 'service_item_content_hover_color',
                        'type'                  => 'color',
                        'title'                 => __('Content hover color', 'csts'),
                        'output_mode'           => 'color',
                        'default'               => '#fff',
                        'output'                => array('.csts-page-wrapper .service-item:hover p'),
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => __('Blog Typography', 'csts'),
                    ),
                    array(
                        'id'                    => 'blog_meta_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Meta typography', 'csts'),
                        'default'               => array(
                            'color'             => '#8A8A8A',
                            'font-family'       => 'Poppins',
                            'font-size'         => '15',
                            'font-weight'       => '400',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
                        'output'                => array('.csts-page-wrapper .blog-post .post-des .post-meta .meta-category'),
                    ),
                    array(
                        'id'                    => 'blog_title_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Title typography', 'csts'),
                        'default'               => array(
                            'color'             => '#222',
                            'font-family'       => 'Poppins',
                            'font-size'         => '16',
                            'font-weight'       => '500',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
                        'output'                => array('.csts-page-wrapper .blog-post .post-des .post-meta .post-title'),
                    ),
                    array(
                        'id'                    => 'blog_overly_btn_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Button typography', 'csts'),
                        'default'               => array(
                            'color'             => '#222',
                            'font-family'       => 'Poppins',
                            'font-size'         => '14',
                            'font-weight'       => '500',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
                        'output'                => array('.csts-page-wrapper .blog-post .post-thumb .overlay-btn a'),
                    ),
                    array(
                        'id'                    => 'blog_overly_btn_bg_color',
                        'type'                  => 'color',
                        'title'                 => __('Button background color', 'csts'),
                        'output_mode'           => 'background-color',
                        'output'                => array('.csts-page-wrapper .blog-post .post-thumb .overlay-btn a'),
                    ),
                    array(
                        'id'                    => 'blog_bg_color',
                        'type'                  => 'color',
                        'title'                 => __('Blog background color', 'csts'),
                        'output_mode'           => 'background-color',
                        'output'                => array('.csts-page-wrapper .blog-post'),
                    ),
                    array(
                        'id'                    => 'blog_hover_bg_color',
                        'type'                  => 'color',
                        'title'                 => __('Blog hover background color', 'csts'),
                        'output_mode'           => 'background',
                        'output'                => array('.csts-page-wrapper .blog-post .post-thumb:after'),
                    ),

                    array(
                        'type'                  => 'heading',
                        'content'               => __('Single Blog Typography', 'csts'),
                    ),
                    array(
                        'id'                    => 'single_blog_date_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Date typography', 'csts'),
                        'default'               => array(
                            'color'             => '#949494',
                            'font-family'       => 'Poppins',
                            'font-size'         => '13',
                            'line-height'       => '20',
                            'font-weight'       => '400',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
                        'output'                => array('.single-blog-popup-wrapper .single-blog-content .title span'),
                    ),
                    array(
                        'id'                    => 'single_blog_title_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Single blog title typography', 'csts'),
                        'default'               => array(
                            'color'             => '#000',
                            'font-family'       => 'Poppins',
                            'font-size'         => '30',
                            'line-height'       => '20',
                            'font-weight'       => '600',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
                        'output'                => array('.single-blog-popup-wrapper .single-blog-content .title h1'),
                    ),
                    array(
                        'type'                  => 'heading',
                        'content'               => 'Footer Typography',
                    ),
                    array(
                        'id'                    => 'footer_typography',
                        'type'                  => 'typography',
                        'title'                 => __('Footer typography', 'csts'),
                        'default'               => array(
                            'color'             => '#fff',
                            'font-family'       => 'Poppins',
                            'font-size'         => '14',
                            'line-height'       => '20',
                            'font-weight'       => '400',
                            'unit'              => 'px',
                            'type'              => 'google',
                        ),
                        'output'                => array('.csts-page-wrapper .social-profile li a', '.csts-page-wrapper .copyright'),
                    ),
                )
            ));
        }
    }

    // Get plugin installed time
    public function csts_get_date_time($date_time) {
        if($date_time == 'y') {
            return current_datetime()->format('m/d/Y');
        } elseif($date_time == 't') {
            return current_datetime()->format('h:m:s');
        }else {

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