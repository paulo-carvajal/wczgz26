<?php
/**
 * Plugin Name: Demo Modal Block
 * Description: Un bloque de modal interactivo usando la Interactivity API.
 * Version: 1.0.0
 * Author: Paulo Carvajal
 * License: GPL-2.0-or-later
 * Text Domain: demo-modal-block
 */

function demo_modal_block_register_block() {
    register_block_type( __DIR__ );
}
add_action( 'init', 'demo_modal_block_register_block' );
