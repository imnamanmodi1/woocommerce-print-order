<?php

// add "wcpo" iframe
function wcpo_iframe() {
    global $post_type;
    global $post;

    global $wcpo_url;
    
    $screen = get_current_screen();

    // check if current page is an order page in the admin panel
    if ($post_type == 'shop_order' && $screen->base == 'post') {
        // get woocommerce order object
        $order_object = wc_get_order($post->ID);
        $order_data = $order_object->get_data();
        $order_type = get_post_type_object($post->post_type);

        // create "wcpo" array for print template (from woocommerce order object)
        $wcpo_iframe_data = array(
            'date' => esc_attr(date_i18n('Y-F-d', strtotime($post->post_date))),
            'title' => esc_html($order_type->labels->singular_name) . ' #' . esc_html($order_object->get_order_number()),
            'status' => wc_get_order_status_name($order_data['status']),
            'client' => $order_data['billing']['first_name'] . ' ' . $order_data['billing']['last_name'],

            'billing' => array(
                'first_name' => $order_data['billing']['first_name'],
                'last_name' => $order_data['billing']['last_name'],
                'company' => $order_data['billing']['company'],

                'address_1' => $order_data['billing']['address_1'],
                'address_2' => $order_data['billing']['address_2'],
                'postcode' => $order_data['billing']['postcode'],
                'country' => $order_data['billing']['country'],
                'state' => $order_data['billing']['state'],
                'city' => $order_data['billing']['city'],

                'email' => $order_data['billing']['email'],
                'phone' => $order_data['billing']['phone']
            ),

            'shipping' => array(
                'first_name' => $order_data['shipping']['first_name'],
                'last_name' => $order_data['shipping']['last_name'],
                'company' => $order_data['shipping']['company'],

                'address_1' => $order_data['shipping']['address_1'],
                'address_2' => $order_data['shipping']['address_2'],
                'postcode' => $order_data['shipping']['postcode'],
                'country' => $order_data['shipping']['country'],
                'state' => $order_data['shipping']['state'],
                'city' => $order_data['shipping']['city']
            ),

            'products' => array(),

            'currency' => get_woocommerce_currency(),
            'currency_symbol' => get_woocommerce_currency_symbol()
        );

        // get woocommerce products data and set it into the "wcpo" array
        foreach ($order_object->get_items() as $item_key => $product) {
            $product_object = $product->get_product();
            $product_data = $product->get_data();

            $product_image_object = wp_get_attachment_image_src($product_object->get_image_id(), 'single-post-thumbnail');

            // get product attributees
            $product_attributes = array();

            foreach($product_data['meta_data'] as $data) {
                $product_attributes[] = array(
                    'label' => wc_attribute_label($data->get_data()['key'], $product_object),
                    'value' => wc_attribute_label($data->get_data()['value'], $product_object)
                );
            }

            // product array
            $wcpo_iframe_data['products'][] = array(
                'id' => $product_data['id'],
                'name' => $product_data['name'],
                'image' => $product_image_object,
                'product_id' => $product_data['product_id'],
                'variation_id' => $product_data['variation_id'],
                'quantity' => $product_data['quantity'],
                'tax_class' => $product_data['tax_class'],
                'subtotal' => $product_data['subtotal'],
                'subtotal_tax' => $product_data['subtotal_tax'],
                'total' => $product_data['total'],
                'total_tax' => $product_data['total_tax'],
                'price' => $product_object->get_price(),
                'attributes' => $product_attributes
            );
        }

        // create data for iframe link
        $wcpo_iframe_json = json_encode($wcpo_iframe_data);

        $wcpo_iframe_url = $wcpo_url . '/iframes/iframes-data.php?wcpo_data=' . urlencode($wcpo_iframe_json);

        // create and include iframe
        echo '<iframe id="wcpo-iframe" src="' . $wcpo_iframe_url . '"></iframe>';
    }
}

add_action('admin_footer', 'wcpo_iframe');