<?php

class HWY_Admin{
    function __construct(){
        add_action('admin_menu', array($this, 'register_settings_menu_page'));
        add_action('admin_enqueue_scripts', array($this, 'add_styles'));
    }
    function add_styles($hook){
        if('news_page_news-settings' != $hook) {
            return;
        }
        wp_enqueue_style(
            'news-settings-style',
            plugins_url('includes/css/settings.css', HWY_PLUGIN_FILE),
            array(),
            HWY_VERSION
        );
        wp_enqueue_script(
            'news-settings-js',
            plugins_url('includes/js/settings.js', HWY_PLUGIN_FILE),
            array('jquery'),
            HWY_VERSION,
            true
        );
    }

    function register_settings_menu_page(){
        add_submenu_page('edit.php?post_type=news','News Settings', 'Settings', 'manage_options', 'news-settings', array($this, 'render_settings_page'));
    }

    function render_settings_page(){
        if(isset($_POST['news_settings_nonce']))
            $this->save_settings();
        include dirname(__FILE__) . '/templates/admin_settings.php';
    }

    function validate_settings(){
        $valid = true;
        if( ! isset($_POST['news_related_title']) || !trim($_POST['news_related_title'])){
            $this->show_error_message('Related title is required');
            $valid = false;
        }

        // array('news_related_title')
        if( ! isset($_POST['news_related_email']) || !is_email($_POST['news_related_email'])){
            $this->show_error_message('Related email address invalid');
            $valid = false;
        }
        if( ! isset($_POST['related_news_amount'] ) || intval($_POST['related_news_amount']) <= 0 || intval($_POST['related_news_amount']) > 10){
            $this->show_error_message('Related amout value is invalid');
            $valid = false;
        }


        
        return $valid;
    }

    function save_settings(){
        if(!wp_verify_nonce($_POST['news_settings_nonce'], 'news-settings-save')){
            wp_die('Security token invalid');
        }

        if( !current_user_can('manage_options')){
            wp_die('No permission');
        }

        if(!$this-> validate_settings() ){
            return;
        }
        
        update_option('hwy_news_related_title', sanitize_text_field($_POST['news_related_title'])); 
        update_option('hwy_news_related_email', sanitize_email($_POST['news_related_email'])); 
        if( isset ($_POST['show_related']))
            update_option('hwy_show_related', true);
        else
            update_option('hwy_show_related', false);
        update_option('hwy_related_news_amount', intval($_POST['related_news_amount']));

        $this->show_success_message();
    }

    function show_error_message($message){
        ?>
        <div class="notice notice-error">
           <p><?php echo esc_html($message); ?></p>
        </div>
    <?php 
    }

    function show_success_message(){
        ?>
        <div class="notice notice-success">
           <p> Settings Saved!</p>
        </div>
    <?php 
    }
}

$hwy_admin = new HWY_Admin();