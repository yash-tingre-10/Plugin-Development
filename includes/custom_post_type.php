<?php

if( !defined('ABSPATH') ) 
    die('No scripts please');

function hwy_add_news_post_type(){
    $args =array(
        'public' => true,
        'label' => 'News',
        'has_archive' => true,
        'supports' => array('title', 'editor', 'excerpt','thumbnail')
    );
    register_post_type('news', $args);
    register_taxonomy('news_category', 'news', array(
        'hierarchical' => true,
        'label' => 'News Categories'
    ));
}
add_action('init', 'hwy_add_news_post_type');

function hwy_activate(){
    hwy_add_news_post_type();
    flush_rewrite_rules();
}
register_activation_hook(HWY_PLUGIN_FILE, 'hwy_activate');