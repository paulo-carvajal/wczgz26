<?php
/**
 * Plugin Name: Demo Todo List Block
 * Description: Un bloque de lista de tareas interactivo usando la Interactivity API.
 * Version: 1.0.0
 * Author: Paulo Carvajal
 * License: GPL-2.0-or-later
 * Text Domain: demo-todo-block
 */

function demo_todo_block_register_block() {
    register_block_type( __DIR__ );
}
add_action( 'init', 'demo_todo_block_register_block' );
