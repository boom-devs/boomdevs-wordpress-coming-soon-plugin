<?php

/**
 * The file that defines the plugin ajax class's
 *
 * @link       https://taspristudio.com/product/ts-wordpress-coming-soon
 * @since      1.0.0
 *
 * @package    Csts
 * @subpackage Csts/includes
 */

/**
 * The core plugin ajax class.
 *
 * This class defines all necessary functions to ajax plugin ajax requests.
 *
 * @since      1.0.0
 * @package    Csts
 * @subpackage Csts/includes
 * @author     TaspriStudio <contact@tasrpistiudio.com>
 */
class Csts_Ajax {
    /**
     * Register ajax hook for getting a single post.
     *
     * @since 1.0.0
     */
    public function get_post() {
        $post_id = $_POST['id'];

        $post = get_post($post_id);

        $response = array(
            'success' => true,
            'post' => $post,
            'id' => $post_id ,
        );

        wp_send_json($response);

        exit;
    }
}