<?php
/**
 * Plugin Name: CDDC Modal Block
 * Description: Un bloque de modal interactivo usando la Interactivity API.
 * Version: 1.0.0
 * Author: Paulo Carvajal
 * License: GPL-2.0-or-later
 * Text Domain: cddc-modal-block
 */

function cddc_modal_block_register_category( $categories ) {
    return array_merge(
        array(
            array(
                'slug'  => 'codedication',
                'title' => __( 'Codedication', 'cddc-modal-block' ),
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'cddc_modal_block_register_category' );

function cddc_modal_block_register_block() {
    register_block_type( __DIR__ );
}
add_action( 'init', 'cddc_modal_block_register_block' );
