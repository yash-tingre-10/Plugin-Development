<?php
function hwy_add_styles(){
        if( is_singular('news') ){
            wp_enqueue_style(
                'news-frontend-style',
                plugins_url('includes/css/frontend.css', HWY_PLUGIN_FILE),
                array(),
                HWY_VERSION
            );
        } 
    }
    add_action('wp_enqueue_scripts', 'hwy_add_styles');