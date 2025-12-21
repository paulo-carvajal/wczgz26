<?php
/**
 * Plugin Name: Demo Accordion Block
 * Description: Un bloque de acordeón interactivo usando la Interactivity API y contexto local.
 * Version: 1.0.0
 * Author: Paulo Carvajal
 * License: GPL-2.0-or-later
 * Text Domain: demo-accordion-block
 */

function demo_accordion_block_register_block() {
    register_block_type( __DIR__ );
}
add_action( 'init', 'demo_accordion_block_register_block' );
