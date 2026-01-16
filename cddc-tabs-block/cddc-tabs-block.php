<?php
/**
 * Plugin Name: CDDC Tabs Block
 * Description: Un bloque de pestañas interactivo usando la Interactivity API.
 * Version: 1.0.0
 * Author: Paulo Carvajal
 * License: GPL-2.0-or-later
 * Text Domain: cddc-tabs-block
 */

function cddc_tabs_block_register_category( $categories ) {
    return array_merge(
        array(
            array(
                'slug'  => 'codedication',
                'title' => __( 'Codedication', 'cddc-tabs-block' ),
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'cddc_tabs_block_register_category' );

function cddc_tabs_block_register_block() {
    register_block_type( __DIR__ );
}
add_action( 'init', 'cddc_tabs_block_register_block' );
