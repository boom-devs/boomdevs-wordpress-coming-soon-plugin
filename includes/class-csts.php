<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       taspristudio.com
 * @since      1.0.0
 *
 * @package    Csts
 * @subpackage Csts/includes
 */

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
class Csts {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Csts_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		if ( defined( 'CSTS_VERSION' ) ) {
			$this->version = CSTS_VERSION;
		} else {
			$this->version = '1.0.0';
		}

		if ( defined( 'CSTS_FULL_NAME' ) ) {
            $this->plugin_full_name = CSTS_FULL_NAME;
        } else {
            $this->plugin_full_name = 'Coming Sooon Template by TaspriStudio';
        }

        if ( defined( 'CSTS_NAME' ) ) {
            $this->plugin_name = CSTS_NAME;
        } else {
            $this->plugin_name = 'csts';
        }

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->register_settings();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Csts_Loader. Orchestrates the hooks of the plugin.
	 * - Csts_i18n. Defines internationalization functionality.
	 * - Csts_Admin. Defines all hooks for the admin area.
	 * - Csts_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once CSTS_DIR . 'includes/class-csts-loader.php';

		/**
         * Codestar library
         */
        require_once CSTS_DIR . 'libs/codestar-framework/codestar-framework.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once CSTS_DIR . 'includes/class-csts-i18n.php';

		/**
         * The class responsible for loading all the admin settings of the plugin.
         */
        require_once CSTS_DIR . 'includes/class-csts-settings.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once CSTS_DIR . 'admin/class-csts-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once CSTS_DIR . 'public/class-csts-public.php';


		$this->call_redirect_template_hook_function();


		$this->loader = new Csts_Loader();

	}

    /**
     * Register plugin settings.
     *
     * @access   private
     */
    private function register_settings() {
        $plugin_settings = new Csts_Settings( $this->plugin_full_name );
        $plugin_settings->csts_customization_settings();
    }


	/**
	 * Register plugin template
	 * 
	 * @access public
	 */
	public function get_template() {

		// Check if user is logged in or user role.
		$wp_get_current_user =  wp_get_current_user();
		$LoggedInUserID = $wp_get_current_user->ID;
		$UserData = get_userdata( $LoggedInUserID );

		if( !is_user_logged_in() || $UserData->roles[0] = "administrator") { 
			$settings = Csts_Settings::get_settings();
			if( $settings['enable_plugin_edit'] == true ) {
				require_once CSTS_DIR . 'public/template/template.php';
				exit();
			}

			// Dequeue unnecessary styles function
			$this->load_wp_dequeue_scripts();
		}

	}


	public function load_template() {

		// Exit if a custom login page
		if( preg_match( "/login|admin|dashboard|account/i", $_SERVER['REQUEST_URI'] ) > 0 ) {
			return false;
		}

		$this->get_template();
		
	}

	// Dequeue unnecessary styles
	public function load_wp_dequeue_scripts () {

		//call in my object
		add_action( 'wp_enqueue_scripts', array( $this , "clean_unnecessary_styles" ), 9999 );
	}

	public function clean_unnecessary_styles(){

		wp_debug_log();
		global $wp_styles;
		foreach( $wp_styles->queue as $style ) :
			//List the css src and handle
			$handle = $wp_styles->registered[$style]->handle;
			//array of css I want to keep
			$css_exception = [ "csts_font-awesome", "csts__bootstrap", "csts_responsive", "csts_style",  ];
			if( !in_array( $handle, $css_exception ) ){
				wp_dequeue_style( $handle );
				wp_deregister_style( $handle );
			}
		endforeach;
	}

	// Call template redirect function by template redirect hook
	public function call_redirect_template_hook_function() {
		add_action('template_redirect', array($this, 'load_template'));
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Csts_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Csts_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Csts_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Csts_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Csts_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}