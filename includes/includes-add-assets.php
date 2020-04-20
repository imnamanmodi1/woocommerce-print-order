<?php

// add "wcpo" assets
function wcpo_assets() {
    global $post_type;
    global $wcpo_url;
    
    $screen = get_current_screen();

    // check if current page is an order page in the admin panel
    if ($post_type == 'shop_order' && $screen->base == 'post') {
        wp_enqueue_script('wcpo_script', $wcpo_url . '/assets/js/script.js');

        wp_enqueue_style('wcpo_style', $wcpo_url . '/assets/css/style.css');
    }
}

add_action('admin_head', 'wcpo_assets');