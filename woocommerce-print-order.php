<?php

/*
    Plugin Name: WooCommerce Print Order
    Plugin URI: ...
    Description: The plugin that adds a print button to the admin panel.
    Version: 0.0.1
    Author: Naman Modi
    Author URI: https://digitaliz.in
*/

$wcpo_path = plugin_dir_path(__FILE__);
$wcpo_url = plugin_dir_url(__FILE__);

// include functions for add "wcpo" assets
include_once($wcpo_path . 'includes/includes-add-assets.php');

// include functions for add "wcpo" iframe
include_once($wcpo_path . 'includes/includes-add-iframe.php');

/*
    ___________________________
    | q w e r t y u i o p [ ] |
    |  a s d f g h j k l ; '  |
    |   z x c v b n m , . /   |
    |=========================|
*/