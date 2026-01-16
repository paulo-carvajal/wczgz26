<?php
/**
 * PHP file to render the block on the front end.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#render
 */

// Inicialización del estado para el store 'cddc/todo'
wp_interactivity_state( 'cddc/todo', array(
    'tasks' => array(
        array( 'id' => 1, 'title' => 'Aprender Interactivity API', 'completed' => false ),
        array( 'id' => 2, 'title' => 'Crear un bloque interactivo', 'completed' => false ),
    ),
    'newTaskTitle' => '',
    'filter' => 'all',
) );
?>

<div data-wp-interactive="cddc/todo" class="wp-block-cddc-todo todo-app">
    <!-- Formulario para añadir tareas -->
    <form data-wp-on--submit="actions.addTask">
        <input
            type="text"
            data-wp-bind--value="state.newTaskTitle"
            data-wp-on--input="actions.updateNewTitle"
            placeholder="Nueva tarea..."
        />
        <button type="submit">Añadir</button>
    </form>

    <!-- Filtros -->
    <div class="filters">
        <button
            data-filter="all"
            data-wp-on--click="actions.setFilter"
            data-wp-class--active="state.filter === 'all'"
        >Todas</button>
        <button
            data-filter="active"
            data-wp-on--click="actions.setFilter"
            data-wp-class--active="state.filter === 'active'"
        >Activas</button>
        <button
            data-filter="completed"
            data-wp-on--click="actions.setFilter"
            data-wp-class--active="state.filter === 'completed'"
        >Completadas</button>
    </div>

    <!-- Contador -->
    <p>
        <span data-wp-text="state.activeCount">0</span> tareas pendientes
    </p>

    <!-- Lista -->
    <ul class="task-list">
        <template data-wp-each="state.filteredTasks">
            <li data-wp-key="context.item.id" data-wp-class--completed="context.item.completed">
                <input
                    type="checkbox"
                    data-wp-bind--checked="context.item.completed"
                    data-wp-on--change="actions.toggleTask"
                    data-wp-bind--data-task-id="context.item.id"
                />
                <span data-wp-text="context.item.title"></span>
                <button
                    data-wp-on--click="actions.removeTask"
                    data-wp-bind--data-task-id="context.item.id"
                >×</button>
            </li>
        </template>
    </ul>

    <!-- Acciones masivas -->
    <div class="bulk-actions">
        <button data-wp-on--click="actions.clearCompleted">
            Limpiar completadas
        </button>
    </div>
</div>
