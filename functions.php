<?php
require_once CSTS_DIR . 'includes/class-csts-settings.php';

// Get single post content by id
add_action('wp_ajax_nopriv_ajax_request', 'csts_ajax_handle_request');
add_action('wp_ajax_ajax_request', 'csts_ajax_handle_request');

function csts_ajax_handle_request(){
    $postID = $_POST['id'];
    if (isset($_POST['id'])){
        $post_id = $_POST['id'];
    }else{
        $post_id = "";
    }
    global $post;
    $post = get_post($postID);
    $response = array(
        'sucess' => true,
        'post' => $post,
        'id' => $postID ,
    );
    // generate the response
    wp_send_json($response);
    // IMPORTANT: don't forget to "exit"
    exit;
}

// Added credit
function csts_credit( $example ) {
    $settings = Csts_Settings::get_settings();
    // Maybe modify $example in some way.
    return '<p class="copyright">'.$settings["credit_text"].'</p>';
}
add_filter( 'white_label_filter', 'csts_credit' );

/**
 * Check credit
 */
function csts_add_redirect_js() { ?>
    <script>
        jQuery(window).load(function(){
            var shouldRedirect = false;
            if( jQuery("p#csts_credit").length ) {
                if( jQuery('p#csts_credit').text() !== 'Made with love 💓 by TaspriStudio' ) {
                    if( jQuery('p#csts_credit').css('display') !== 'block' ) {
                        shouldRedirect = true;
                    }
                }
            } else {
                shouldRedirect = false;
            }

            if ( shouldRedirect ) {
                window.location.href = 'https://taspristudio.com/';
            }
        });
    </script>
<?php }
add_action('wp_footer', 'csts_add_redirect_js');