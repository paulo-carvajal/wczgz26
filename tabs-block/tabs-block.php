<?php
/**
 * Plugin Name: Demo Tabs Block
 * Description: Un bloque de pestañas interactivo usando la Interactivity API.
 * Version: 1.0.0
 * Author: Paulo Carvajal
 * License: GPL-2.0-or-later
 * Text Domain: demo-tabs-block
 */

function demo_tabs_block_register_block() {
    register_block_type( __DIR__ );
}
add_action( 'init', 'demo_tabs_block_register_block' );
