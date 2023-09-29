<?php
function hwy_welcome_screen_page(){
    add_dashboard_page('Welcome', 'Welcome', 'read', 'hwy-plugin-welcome', 'hwy_display_welcome_page');
}
add_action('admin_menu','hwy_welcome_screen_page');

function hwy_display_welcome_page(){
    include dirname (__FILE__) . '/templates/welcome_page.php';
}

function hwy_remove_welcome_page_menu_item(){
    remove_submenu_page('index.php', 'hwy-plugin-welcome');
}
add_action('admin_head', 'hwy_remove_welcome_page_menu_item');

function hwy_welcome_screen_activate(){
    set_transient('hwy_welcome_screen_activation_redirect', true, 30);
}
register_activation_hook(HWY_PLUGIN_FILE, 'hwy_welcome_screen_activate');


function hwy_welcome_page_redirect(){

    if(!get_transient('hwy_welcome_screen_activation_redirect')){
        return;
    }

    delete_transient('hwy_welcome_screen_activation_redirect');

    if( is_network_admin() || isset($_GET['activate-multi'])){
        return;
    }
    wp_safe_redirect(admin_url('index.php?page=hwy-plugin-welcome'));
    die();
    
}
add_action('admin_init', 'hwy_welcome_page_redirect');