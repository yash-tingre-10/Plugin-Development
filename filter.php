<?php

add_filter('custom_greeting', 'modify_greeting_message', 10, 1);

function modify_greeting_message($message) {
    
    $new_message = 'Hello, ' . $message;

    return $new_message;
}


$original_greeting = 'Welcome to our website!';
$modified_greeting = apply_filters('custom_greeting', $original_greeting);

var_dump( $modified_greeting); 




// Enqueue Scripts 

wp_register_script('custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), '1.0', true);





