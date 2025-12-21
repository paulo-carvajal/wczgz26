<?php
/**
 * Plugin Name: Demo Search Filter Block
 * Description: Un bloque de búsqueda y filtrado en tiempo real usando la Interactivity API.
 * Version: 1.0.0
 * Author: Paulo Carvajal
 * License: GPL-2.0-or-later
 * Text Domain: demo-search-filter-block
 */

function demo_search_filter_block_register_block() {
    register_block_type( __DIR__ );
}
add_action( 'init', 'demo_search_filter_block_register_block' );
