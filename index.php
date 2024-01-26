<?php

/**
 * Plugin Name: Dynamic Block
 * Plugin URI: https://github.com/PiotrPress/wordpress-dynamic-block
 * Description: This WordPress plugin adds a dynamic block which renders an output of a selected php callback function added via a filter hook.
 * Version: 0.2.0
 * Requires at least: 6.2.2
 * Requires PHP: 7.4
 * Author: Piotr Niewiadomski
 * Author URI: https://piotr.press
 * License: GPL v3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: piotrpress-dynamic-block
 * Domain Path: /languages
 * Update URI: false
 */

defined( 'ABSPATH' ) or exit;

add_action( 'init', function() {
    $callbacks = apply_filters( 'piotrpress/dynamic_block/callbacks', [] );

    register_block_type( __DIR__, [
        'render_callback' => function( $attributes, $content ) use( $callbacks ) {
            if( $attributes[ 'callback' ] and
                isset( $callbacks[ $attributes[ 'callback' ] ] ) and
                is_callable( $callbacks[ $attributes[ 'callback' ] ] ) )
                return call_user_func( $callbacks[ $attributes[ 'callback' ] ] );
        },
        'attributes' => [
            'callback' => [
                'type' => 'string',
                'default' => ''
            ],
            'callbacks' => [
                'type' => 'array',
                'default' => ( function() use( $callbacks ) {
                    $options = [ [
                        'label' => __( 'Select callback', 'piotrpress-dynamic-block' ),
                        'value' => '',
                        'disabled' => true
                    ] ];
                    foreach( $callbacks as $label => $callback )
                        $options[] = [
                            'label' => $label,
                            'value' => $label
                        ];
                    return $options;
                } )()
            ]
        ]
    ] );
}, 9999 );