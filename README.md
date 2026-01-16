# WordPress Interactivity API - Demo Blocks

A collection of **8 Gutenberg blocks** demonstrating the **WordPress Interactivity API** (WP 6.5+).

These blocks serve as practical examples for developers learning to build reactive, interactive WordPress blocks without relying on React on the frontend.

---

## Learn More: WordPress Editor and Blocks

**Master WordPress Block Development.**

The only guide that guarantees you'll stop losing billable hours to fragmented documentation and start architecting enterprise-grade solutions.

[**Unlock your WordPress expert status — BUY NOW!**](https://wp-block-editor.com/)

---

## Blocks Included

| Block | Description | Interactivity Concepts |
|-------|-------------|------------------------|
| **Accordion** | Expandable accordion | Local context, toggle actions |
| **Counter** | Numeric counter | Instance-based state, shared store |
| **Global Counter** | Sum of all counters | Shared store, `data-wp-each` |
| **Data Fetcher** | Async data loader | Fetch, callbacks, loading states |
| **Modal** | Modal dialog (3 types) | Global state, custom events, info/confirm/prompt |
| **Search Filter** | Real-time search | Derived getters, filtering |
| **Tabs** | Tab system | Context per tab, conditional classes |
| **Todo List** | Task list with CRUD | `data-wp-each`, `withSyncEvent`, derived state |

## Requirements

- WordPress 6.5+
- PHP 7.4+
- Node.js 18+

## Installation

```bash
git clone https://github.com/paulo-carvajal/wczgz26.git
cd wczgz26/wp-content/plugins
npm install
npm run build
```

Activate desired blocks in WordPress Admin → Plugins.

## Development

```bash
npm run start   # Watch mode (all blocks)
npm run build   # Production build
```

## Project Structure

```
plugins/
├── package.json              # npm workspaces root
├── accordion-block/
├── counter-block/
├── data-fetcher-block/
├── global-counter-block/
├── modal-block/
├── search-filter-block/
├── tabs-block/
└── todo-block/
```

Each block follows the standard structure:

```
block-name/
├── block.json        # Block metadata
├── plugin.php        # Plugin registration
├── render.php        # Frontend template (PHP + directives)
├── README.md         # Block documentation
├── src/
│   ├── index.js      # Editor registration
│   ├── edit.js       # Editor component
│   ├── view.js       # Interactivity API store
│   └── style.scss    # Styles
└── build/            # Compiled assets
```

## Interactivity API Concepts

### Global State vs Local Context

- **Global state** (`wp_interactivity_state`): Shared across all block instances
- **Local context** (`data-wp-context`): Scoped to a specific element

### Directives Reference

| Directive | Purpose |
|-----------|---------|
| `data-wp-interactive` | Define store namespace |
| `data-wp-context` | Local context per element |
| `data-wp-on--click` | Click event handler |
| `data-wp-bind--attr` | Dynamic attribute binding |
| `data-wp-text` | Reactive text content |
| `data-wp-class--name` | Conditional CSS classes |
| `data-wp-each` | Array iteration |

### Store Pattern

```javascript
import { store, getContext } from '@wordpress/interactivity';

const { state } = store('namespace', {
    state: {
        value: 0,
        get derived() { return state.value * 2; }
    },
    actions: {
        update() {
            const context = getContext();
            state.value = context.newValue;
        }
    },
    callbacks: {
        init() { /* Runs on mount */ }
    }
});
```

## Resources

- [Interactivity API Documentation](https://developer.wordpress.org/block-editor/reference-guides/interactivity-api/)
- [Block Editor Handbook](https://developer.wordpress.org/block-editor/)
- [@wordpress/scripts](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-scripts/)

---

## About the Author

These demo blocks were created by [Paulo Carvajal](https://paulocarvajal.com/), author of [WP Editor and Blocks](https://wp-block-editor.com/), as companion examples for the talk **Construye experiencias dinámicas con la Interactivity API de WordPress** (Build dynamic experiences with the WordPress Interactivity API) at [WordCamp Zaragoza 2026](https://zaragoza.wordcamp.org/2026/).

## License

GPL-2.0-or-later
