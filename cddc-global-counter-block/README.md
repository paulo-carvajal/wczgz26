# Global Counter Block

Global counter display for WordPress using the Interactivity API.

## Description

A companion block to Counter Block that demonstrates **shared stores** in WordPress Interactivity API. Displays the total sum of all Counter Block instances on the page, plus a list of each counter's value.

## Features

- Shows total of all counters
- Lists each counter with its label and current value
- Real-time updates when any counter changes
- "Reset All" button to reset all counters at once
- Uses `data-wp-each` for dynamic list rendering

## Requirements

- WordPress 6.5+
- PHP 7.4+
- Node.js 18+ (for development)
- Counter Block (must be active for counters to exist)

## Installation

1. Upload the `global-counter-block` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu
3. Add the block in the editor by searching for "Contador Global"

## Usage

Add the block to a page that also contains Counter Block instances. The Global Counter will automatically display the total and individual values of all counters.

### Interactivity API Concepts Demonstrated

| Concept | Implementation |
|---------|----------------|
| Shared store | Uses same `counter` namespace as Counter Block |
| Derived state | `state.total`, `state.counterList` getters |
| `data-wp-each` | Dynamic list of counters |
| Cross-block communication | Reads state from another block's store |

### Store Structure

```javascript
// This block extends the 'counter' store from counter-block
// It doesn't define new state, just accesses existing getters:
// - state.total (sum of all counters)
// - state.counterList (array for iteration)

store('counter', {
    callbacks: {
        logMount() {
            // Optional debug callback
        }
    }
});
```

### Template with data-wp-each

```php
<ul class="counter-list">
    <template data-wp-each="state.counterList">
        <li class="counter-item">
            <span data-wp-text="context.item.label"></span>:
            <strong data-wp-text="context.item.value"></strong>
        </li>
    </template>
</ul>
```

## Development

```bash
cd global-counter-block
npm install
npm run start   # Development mode
npm run build   # Production build
```

## File Structure

```
global-counter-block/
├── block.json      # Block metadata
├── global-counter-block.php  # Plugin registration
├── render.php      # Frontend template with data-wp-each
├── package.json
└── src/
    ├── index.js    # Editor registration
    ├── edit.js     # Editor component
    ├── view.js     # Extends counter store
    └── style.scss  # Styles
```

## License

GPL-2.0-or-later
