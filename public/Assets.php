<?php

/**
 * 
 */
class Assets
{
	
	function __construct()
	{
		add_action( 'wp_enqueue_scripts', [$this, 'enqueue_style'] );
		add_action( 'wp_enqueue_scripts', [$this, 'enqueue_scripts'] );
	}

	/**
	 * Enqueue scripts
	 *
	 * @param string $handle Script name
	 * @param string $src Script url
	 * @param array $deps (optional) Array of script names on which this script depends
	 * @param string|bool $ver (optional) Script version (used for cache busting), set to null to disable
	 * @param bool $in_footer (optional) Whether to enqueue the script before </head> or before </body>
	 */
	public function enqueue_style(){
		wp_enqueue_style( 'bootstrap', CST_ASSETS.'/css/bootstrap.min.css', array(), filemtime(CST_ASSETS.'/css/bootstrap.min.css'), false );
		wp_enqueue_style( 'font-awesome', CST_ASSETS.'/css/font-awesome.min.css', array(), filemtime(CST_ASSETS.'/css/font-awesome.min.css'), false );
		wp_enqueue_style( 'responsive', CST_ASSETS.'/css/responsive.css', array(), filemtime(CST_ASSETS.'/css/responsive.css'), false );
		wp_enqueue_style( 'bootstrap', CST_ASSETS.'/css/style.css', array(), filemtime(CST_ASSETS.'/css/style.css'), false );
	}

	/**
	 * Enqueue scripts
	 *
	 * @param string $handle Script name
	 * @param string $src Script url
	 * @param array $deps (optional) Array of script names on which this script depends
	 * @param string|bool $ver (optional) Script version (used for cache busting), set to null to disable
	 * @param bool $in_footer (optional) Whether to enqueue the script before </head> or before </body>
	 */
	function enqueue_scripts() {
		wp_enqueue_script( 'jquery-js', CST_ASSETS.'/js/jquery-2.2.3.min.js', array(), filemtime(CST_ASSETS.'/js/jquery-2.2.3.min.js'), true );
		wp_enqueue_script( 'bootstrap-js', CST_ASSETS.'/js/popper.min.js', array(), filemtime(CST_ASSETS.'/js/popper.min.js'), true );
		wp_enqueue_script( 'bootstrap-js', CST_ASSETS.'/js/bootstrap.min.js', array(), filemtime(CST_ASSETS.'/js/bootstrap.min.js'), true );
		wp_enqueue_script( 'bootstrap-js', CST_ASSETS.'/js/parallax.js', array(), filemtime(CST_ASSETS.'/js/parallax.js'), true );
		wp_enqueue_script( 'bootstrap-js', CST_ASSETS.'/js/jquery.countdown.min.js', array(), filemtime(CST_ASSETS.'/js/jquery.countdown.min.js'), true );
	}
}