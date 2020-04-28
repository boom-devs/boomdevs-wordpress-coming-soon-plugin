<?php

/**
 * Redirect class
 */
class Redirect
{
	
	function __construct()
	{
		add_action( 'template_redirect', [$this, 'cst_redirect'] );
	}

	public function cst_redirect() {

		// Exit if a custom login page
		if(preg_match("/login|admin|dashboard|account/i",$_SERVER['REQUEST_URI']) > 0 ){
			return false;
		}
		
		// Check if user is logged in.
		if ( ! is_user_logged_in() )
		{
			$file = plugin_dir_path( __FILE__ )."templates/index.php";
			include($file);
			exit();
		}
		else
		{
			if( false === current_user_can('administrator') )
			{
				$file = plugin_dir_path( __FILE__ )."templates/index.php";
				include($file);
				exit();
			}
		}	
	}
	
}
// Call the class
new Redirect;