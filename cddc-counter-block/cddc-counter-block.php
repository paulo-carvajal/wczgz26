<?php
/**
 * Plugin Name: CDDC Counter Block
 * Description: Un bloque de contador interactivo usando la Interactivity API.
 * Version: 1.0.0
 * Author: Paulo Carvajal
 * License: GPL-2.0-or-later
 * Text Domain: cddc-counter-block
 */

function cddc_counter_block_register_category( $categories ) {
    return array_merge(
        array(
            array(
                'slug'  => 'codedication',
                'title' => __( 'Codedication', 'cddc-counter-block' ),
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'cddc_counter_block_register_category' );

function cddc_counter_block_register_block() {
    register_block_type( __DIR__ );
}
add_action( 'init', 'cddc_counter_block_register_block' );
