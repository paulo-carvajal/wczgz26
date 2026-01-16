<?php
/**
 * Plugin Name: CDDC Data Fetcher Block
 * Description: Un bloque de carga de datos asíncrona usando la Interactivity API.
 * Version: 1.0.0
 * Author: Paulo Carvajal
 * License: GPL-2.0-or-later
 * Text Domain: cddc-data-fetcher-block
 */

function cddc_data_fetcher_block_register_category( $categories ) {
    return array_merge(
        array(
            array(
                'slug'  => 'codedication',
                'title' => __( 'Codedication', 'cddc-data-fetcher-block' ),
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'cddc_data_fetcher_block_register_category' );

function cddc_data_fetcher_block_register_block() {
    register_block_type( __DIR__ );
}
add_action( 'init', 'cddc_data_fetcher_block_register_block' );
