<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       taspristudio.com
 * @since      1.0.0
 *
 * @package    Csts
 * @subpackage Csts/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Csts
 * @subpackage Csts/public
 * @author     taspristudio <admin@tasrpistiudio.com>
 */
class Csts_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Csts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Csts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

        // Enqueue Fontawesome
		wp_enqueue_style( $this->plugin_name . '-font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array(), $this->version, 'all' );

        // Enqueue Bootstrap
        wp_enqueue_style( $this->plugin_name . '-bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );

        // Enqueue Responsive
        wp_enqueue_style( $this->plugin_name . '-responsive', plugin_dir_url( __FILE__ ) . 'css/responsive.css', array(), $this->version, 'all' );

        // Enqueue default css
        wp_enqueue_style( $this->plugin_name . '-style', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );
	}


	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Csts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Csts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//	Enqueue bootstrap js
		// wp_enqueue_script( $this->plugin_name . '-jquery', plugin_dir_url( __FILE__ ) . 'js/jquery-2.2.3.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'jquery' );

        //	Enqueue bootstrap js
        wp_enqueue_script( $this->plugin_name . '-bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, true );

        // Enqueue proper js
        wp_enqueue_script( $this->plugin_name . '-popper', plugin_dir_url( __FILE__ ) . 'js/popper.min.js', array( 'jquery' ), $this->version, true );

        // Enqueue parallax js
        wp_enqueue_script( $this->plugin_name . '-parallax', plugin_dir_url( __FILE__ ) . 'js/parallax.js', array( 'jquery' ), $this->version, true );

        // Enqueue countdown js
        wp_enqueue_script( $this->plugin_name . '-countdown', plugin_dir_url( __FILE__ ) . 'js/jquery.countdown.min.js', array( 'jquery' ), $this->version, true );

        // Enqueue custom js
        wp_enqueue_script( $this->plugin_name . '-custom', plugin_dir_url( __FILE__ ) . 'js/custom.js', array( 'jquery' ), $this->version, true );

	}

}
