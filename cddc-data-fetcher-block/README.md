# Data Fetcher Block

Interactive data loading block for WordPress using the Interactivity API.

## Description

A block that demonstrates **async data fetching** with WordPress Interactivity API. Fetches posts from the WordPress REST API with loading states, error handling, and pagination.

## Features

- Fetches posts from WordPress REST API
- Loading indicator during fetch
- Error handling with user feedback
- "Load More" pagination
- Automatic detection of available pages

## Requirements

- WordPress 6.5+
- PHP 7.4+
- Node.js 18+ (for development)

## Installation

1. Upload the `data-fetcher-block` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu
3. Add the block in the editor by searching for "Cargador de Datos"

## Usage

Add the block to your page. It will automatically load the first batch of posts on page load. Click "Load More" to fetch additional posts.

### Interactivity API Concepts Demonstrated

| Concept | Implementation |
|---------|----------------|
| Async operations | `fetch()` in callbacks |
| Loading states | `state.isLoading` |
| Error handling | `state.error` with try/catch |
| Initial data load | `data-wp-init="callbacks.loadInitialData"` |
| Conditional rendering | `data-wp-bind--hidden` for loading/error states |

### Store Structure

```javascript
const { state, callbacks } = store('dataFetcher', {
    state: {
        posts: [],
        isLoading: false,
        error: null,
        currentPage: 1,
        hasMore: true
    },
    actions: {
        loadMore() {
            state.currentPage += 1;
            callbacks.fetchPosts();
        }
    },
    callbacks: {
        fetchPosts() {
            if (state.isLoading || !state.hasMore) return;

            state.isLoading = true;
            state.error = null;

            fetch(`/wp-json/wp/v2/posts?_embed&per_page=5&page=${state.currentPage}`)
                .then(response => {
                    const totalPages = parseInt(
                        response.headers.get('X-WP-TotalPages')
                    );
                    state.hasMore = state.currentPage < totalPages;
                    return response.json();
                })
                .then(newPosts => {
                    state.posts = [...state.posts, ...newPosts];
                })
                .catch(error => {
                    state.error = 'Error loading data';
                    state.currentPage -= 1;
                })
                .finally(() => {
                    state.isLoading = false;
                });
        },
        loadInitialData() {
            state.posts = [];
            state.currentPage = 1;
            state.hasMore = true;
            callbacks.fetchPosts();
        }
    }
});
```

## Development

```bash
cd data-fetcher-block
npm install
npm run start   # Development mode
npm run build   # Production build
```

## File Structure

```
data-fetcher-block/
├── block.json      # Block metadata
├── plugin.php      # Plugin registration
├── render.php      # Frontend template
├── package.json
└── src/
    ├── index.js    # Editor registration
    ├── edit.js     # Editor component
    ├── view.js     # Interactivity store with fetch logic
    └── style.scss  # Styles
```

## License

GPL-2.0-or-later
