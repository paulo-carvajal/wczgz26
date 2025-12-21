<?php
/**
 * PHP file to render the block on the front end.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#render
 */

$products = array(
    array( 'id' => 1, 'name' => 'Laptop Pro', 'category' => 'electronics', 'price' => 1299 ),
    array( 'id' => 2, 'name' => 'Wireless Mouse', 'category' => 'electronics', 'price' => 49 ),
    array( 'id' => 3, 'name' => 'Office Chair', 'category' => 'furniture', 'price' => 299 ),
    array( 'id' => 4, 'name' => 'Standing Desk', 'category' => 'furniture', 'price' => 599 ),
    array( 'id' => 5, 'name' => 'Mechanical Keyboard', 'category' => 'electronics', 'price' => 149 ),
    array( 'id' => 6, 'name' => 'Monitor 27"', 'category' => 'electronics', 'price' => 399 ),
    array( 'id' => 7, 'name' => 'Bookshelf', 'category' => 'furniture', 'price' => 189 ),
    array( 'id' => 8, 'name' => 'Webcam HD', 'category' => 'electronics', 'price' => 79 ),
    array( 'id' => 9, 'name' => 'Ergonomic Footrest', 'category' => 'furniture', 'price' => 45 ),
);

wp_interactivity_state( 'productSearch', array(
    'products' => $products,
    'searchQuery' => '',
    'selectedCategory' => 'all',
    'sortBy' => 'name',
) );
?>

<div data-wp-interactive="productSearch" class="wp-block-demo-search-filter-block product-search">
    <!-- Controles de búsqueda -->
    <div class="search-controls">
        <input
            type="search"
            data-wp-bind--value="state.searchQuery"
            data-wp-on--input="actions.updateSearch"
            placeholder="Buscar productos..."
        />

        <select
            data-wp-bind--value="state.selectedCategory"
            data-wp-on--change="actions.updateCategory"
        >
            <option value="all">Todas las categorías</option>
            <option value="electronics">Electrónica</option>
            <option value="furniture">Mobiliario</option>
        </select>

        <select
            data-wp-bind--value="state.sortBy"
            data-wp-on--change="actions.updateSort"
        >
            <option value="name">Nombre</option>
            <option value="price-asc">Precio: menor a mayor</option>
            <option value="price-desc">Precio: mayor a menor</option>
        </select>
    </div>

    <!-- Resultados -->
    <p class="results-count">
        Mostrando <span data-wp-text="state.resultsCount">0</span> productos
    </p>

    <div class="product-grid">
        <template data-wp-each="state.filteredProducts">
            <article class="product-card" data-wp-key="context.item.id">
                <h3 data-wp-text="context.item.name"></h3>
                <p class="category" data-wp-text="context.item.category"></p>
                <p class="price">
                    $<span data-wp-text="context.item.price"></span>
                </p>
            </article>
        </template>
    </div>

    <!-- Mensaje vacío -->
    <p
        class="no-results"
        data-wp-bind--hidden="state.hasResults"
    >
        No se encontraron productos.
    </p>
</div>
