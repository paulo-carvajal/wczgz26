<?php
/**
 * Plugin Name: CDDC Global Counter Block
 * Description: Muestra el total de todos los contadores interactivos en la página.
 * Version: 1.0.0
 * Author: Paulo Carvajal
 * License: GPL-2.0-or-later
 * Text Domain: cddc-global-counter-block
 */

function cddc_global_counter_block_register_category( $categories ) {
    return array_merge(
        array(
            array(
                'slug'  => 'codedication',
                'title' => __( 'Codedication', 'cddc-global-counter-block' ),
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'cddc_global_counter_block_register_category' );

function cddc_global_counter_block_register_block() {
    register_block_type( __DIR__ );
}
add_action( 'init', 'cddc_global_counter_block_register_block' );
