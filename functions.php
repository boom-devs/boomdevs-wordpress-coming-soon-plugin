<?php
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