# Search Filter Block

Interactive search and filter block for WordPress using the Interactivity API.

## Description

A product search component that demonstrates **derived state** and **real-time filtering** in WordPress Interactivity API. Combines text search, category filtering, and sorting into a reactive interface.

## Features

- Real-time text search
- Category dropdown filter
- Sort by name or price (asc/desc)
- Results counter
- Products data from PHP (server-rendered initial state)
- No results message

## Requirements

- WordPress 6.5+
- PHP 7.4+
- Node.js 18+ (for development)

## Installation

1. Upload the `search-filter-block` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu
3. Add the block in the editor by searching for "Búsqueda y Filtro"

## Usage

The block displays a search input, category filter, and sort dropdown. Results update immediately as you type or change filters.

### Interactivity API Concepts Demonstrated

| Concept | Implementation |
|---------|----------------|
| Server state | `wp_interactivity_state()` with products data |
| Derived getters | `filteredProducts`, `resultsCount`, `hasResults` |
| Input binding | `data-wp-on--input`, `data-wp-on--change` |
| Reactive filtering | Getters recompute on state changes |

### Store Structure

```javascript
const { state } = store('productSearch', {
    state: {
        // Products come from PHP via wp_interactivity_state()
        searchQuery: '',
        selectedCategory: 'all',
        sortBy: 'name',

        get filteredProducts() {
            let result = [...state.products];

            // 1. Filter by search query
            if (state.searchQuery.trim()) {
                const query = state.searchQuery.toLowerCase();
                result = result.filter(p =>
                    p.name.toLowerCase().includes(query)
                );
            }

            // 2. Filter by category
            if (state.selectedCategory !== 'all') {
                result = result.filter(p =>
                    p.category === state.selectedCategory
                );
            }

            // 3. Sort
            switch (state.sortBy) {
                case 'price-asc':
                    result.sort((a, b) => a.price - b.price);
                    break;
                case 'price-desc':
                    result.sort((a, b) => b.price - a.price);
                    break;
                default:
                    result.sort((a, b) => a.name.localeCompare(b.name));
            }

            return result;
        },

        get resultsCount() {
            return state.filteredProducts.length;
        },

        get hasResults() {
            return state.filteredProducts.length > 0;
        }
    },
    actions: {
        updateSearch(event) {
            state.searchQuery = event.target.value;
        },
        updateCategory(event) {
            state.selectedCategory = event.target.value;
        },
        updateSort(event) {
            state.sortBy = event.target.value;
        }
    }
});
```

### Server-Side State (render.php)

```php
wp_interactivity_state('productSearch', array(
    'products' => array(
        array('name' => 'Product 1', 'category' => 'electronics', 'price' => 99),
        // ...more products
    )
));
```

## Development

```bash
cd search-filter-block
npm install
npm run start   # Development mode
npm run build   # Production build
```

## File Structure

```
search-filter-block/
├── block.json      # Block metadata
├── plugin.php      # Plugin registration
├── render.php      # Frontend template with product data
├── package.json
└── src/
    ├── index.js    # Editor registration
    ├── edit.js     # Editor component
    ├── view.js     # Interactivity store with filtering logic
    └── style.scss  # Styles
```

## License

GPL-2.0-or-later
