<?php
/**
 * Plugin Name: CDDC Search Filter Block
 * Description: Un bloque de búsqueda y filtrado en tiempo real usando la Interactivity API.
 * Version: 1.0.0
 * Author: Paulo Carvajal
 * License: GPL-2.0-or-later
 * Text Domain: cddc-search-filter-block
 */

function cddc_search_filter_block_register_category( $categories ) {
    return array_merge(
        array(
            array(
                'slug'  => 'codedication',
                'title' => __( 'Codedication', 'cddc-search-filter-block' ),
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'cddc_search_filter_block_register_category' );

function cddc_search_filter_block_register_block() {
    register_block_type( __DIR__ );
}
add_action( 'init', 'cddc_search_filter_block_register_block' );
