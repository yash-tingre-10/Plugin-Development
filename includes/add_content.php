<?php

function hwy_add_content_on_activation() {
    $page = get_page_by_title('Hello world confirmation');

    if (!$page) {
        $post_id = wp_insert_post(array(
            'post_title'   => __('Hello world Confirmation', 'hello-world-yo'),
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '[my-test-shortcode]',
        ));
    }
}
register_activation_hook(HWY_PLUGIN_FILE, 'hwy_add_content_on_activation');

function hwy_replace_content_on_confirm_page($content) {
    $page = get_page_by_title('Hello world confirmation');

    if ($page && is_singular() && $page->ID === get_the_ID()) {
        return '[my-test-shortcode]';
    }

    return $content;
}
add_filter('the_content', 'hwy_replace_content_on_confirm_page');





// function hwy_add_content_on_activation(){
//         if(get_page_by_title('Hello world confirmation')){
//             return;
//         }
//         $post_id = wp_insert_post( array(
//             'post_title' => __('Hello world Confirmation', 'hello-world-yo'),
//             'post_status' =>  'publish',
//             'post_type' => 'page',
//             'post_content' => '[my-test-shortcode]',
//         ) );
//     }
//     register_activation_hook(HWY_PLUGIN_FILE, 'hwy_add_content_on_activation');
