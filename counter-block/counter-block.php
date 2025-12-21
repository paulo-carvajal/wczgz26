<?php

/**
 * Plugin Name: Demo Counter Block
 * Description: Un bloque de contador interactivo usando la Interactivity API.
 * Version: 1.0.0
 * Author: Paulo Carvajal
 * License: GPL-2.0-or-later
 * Text Domain: demo-counter-block
 */

function demo_counter_block_register_block() {
    register_block_type( __DIR__ );
}
add_action( 'init', 'demo_counter_block_register_block' );
