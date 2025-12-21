<?php

/**
 * Plugin Name: Demo Data Fetcher Block
 * Description: Un bloque de carga de datos asíncrona usando la Interactivity API.
 * Version: 1.0.0
 * Author: Paulo Carvajal
 * License: GPL-2.0-or-later
 * Text Domain: demo-data-fetcher-block
 */

function demo_data_fetcher_block_register_block() {
    register_block_type( __DIR__ );
}
add_action( 'init', 'demo_data_fetcher_block_register_block' );