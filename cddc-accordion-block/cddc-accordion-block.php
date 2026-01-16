<?php
/**
 * Plugin Name: CDDC Accordion Block
 * Description: Un bloque de acordeón interactivo usando la Interactivity API y contexto local.
 * Version: 1.0.0
 * Author: Paulo Carvajal
 * License: GPL-2.0-or-later
 * Text Domain: cddc-accordion-block
 */

function cddc_accordion_block_register_category( $categories ) {
    return array_merge(
        array(
            array(
                'slug'  => 'codedication',
                'title' => __( 'Codedication', 'cddc-accordion-block' ),
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'cddc_accordion_block_register_category' );

function cddc_accordion_block_register_block() {
    register_block_type( __DIR__ );
}
add_action( 'init', 'cddc_accordion_block_register_block' );
