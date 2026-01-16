<?php
/**
 * PHP file to render the block on the front end.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#render
 */

// Inicialización del estado para el store 'cddc/data-fetcher'
wp_interactivity_state( 'cddc/data-fetcher', array(
    'posts' => array(),
    'isLoading' => false,
    'error' => null,
    'currentPage' => 1,
    'hasMore' => true,
) );
?>

<div data-wp-interactive="cddc/data-fetcher" data-wp-init="callbacks.loadInitialData" class="wp-block-cddc-data-fetcher">
    <!-- Lista de posts -->
    <div class="posts-list">
        <template data-wp-each="state.posts">
            <article class="post-card" data-wp-key="context.item.id">
                <h3 data-wp-text="context.item.title.rendered"></h3>
                <div data-wp-html="context.item.excerpt.rendered"></div>
            </article>
        </template>
    </div>

    <!-- Estado de carga -->
    <div
        class="loading-indicator"
        data-wp-bind--hidden="!state.isLoading"
    >
        <span class="spinner"></span>
        Cargando...
    </div>

    <!-- Error -->
    <div
        class="error-message"
        data-wp-bind--hidden="!state.error"
    >
        <p data-wp-text="state.error"></p>
        <button data-wp-on--click="callbacks.loadInitialData">
            Reintentar
        </button>
    </div>

    <!-- Botón cargar más -->
    <button
        class="load-more"
        data-wp-on--click="actions.loadMore"
        data-wp-bind--hidden="!state.hasMore || state.isLoading"
    >
        Cargar más
    </button>
</div>
