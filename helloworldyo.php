<?php
/*
Plugin Name: Hello World, Yo
Description: My first wordpress plugin
Version: 1.0
Author: Yash Tingre
Author URI: https://automattic.com/wordpress-plugins/
License: GPLv2 or later
Text Domain: hello-world-yo
*/
if( !defined('ABSPATH') ) 
    die('No scripts please');

    define ('HWY_PLUGIN_FILE', __FILE__);
    define ('HWY_VERSION', '1.0');

    require_once dirname(__FILE__) . '/includes/wp_requirements.php';
    $plugin_checks= new HWY_Requirements('Hello World YO', HWY_PLUGIN_FILE, array(
        'PHP' => '7.4.1',
        'WordPress' => '6.3.1',
    ));
    if(false===$plugin_checks->pass()){
        $plugin_checks->halt();
        return;
    }

    require_once dirname(__FILE__) . '/includes/news_meta_box.php';
    require_once dirname(__FILE__) . '/includes/shortcode.php';
    require_once dirname(__FILE__) . '/includes/custom_post_type.php';
    require_once dirname(__FILE__) . '/includes/admin_settings.php';
    require_once dirname(__FILE__) . '/includes/news_content.php';
    require_once dirname(__FILE__) . '/includes/add_content.php';
    require_once dirname(__FILE__) . '/includes/enqueue.php';
    require_once dirname(__FILE__) . '/includes/news_location.php';
    // require_once dirname(__FILE__) . '/includes/test_api_calls.php';
    require_once dirname(__FILE__) . '/includes/welcome_screen.php';


   

    