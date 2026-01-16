# Counter Block

Interactive counter block for WordPress using the Interactivity API.

## Description

A numeric counter that demonstrates **instance-based state** in WordPress Interactivity API. Each counter instance maintains its own value while sharing state through a global store, enabling features like a global total across all counters.

## Features

- Increment/decrement buttons
- Reset individual counter
- Multiple instances on same page
- Shared store for cross-block communication
- Each instance has unique ID and label

## Requirements

- WordPress 6.5+
- PHP 7.4+
- Node.js 18+ (for development)

## Installation

1. Upload the `counter-block` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu
3. Add the block in the editor by searching for "Contador Interactivo"

## Usage

Add multiple counter blocks to your page. Each counter operates independently but shares state with other counters and the Global Counter Block.

### Interactivity API Concepts Demonstrated

| Concept | Implementation |
|---------|----------------|
| Instance context | `data-wp-context` with unique ID per block |
| Shared state | Global `counters` object in store |
| Derived state | `get total()`, `get counterList()` getters |
| Callbacks | `init()` to register counter on mount |
| `getContext()` | Access instance data in actions |

### Store Structure

```javascript
const { state } = store('counter', {
    state: {
        counters: {},  // { id: { value, label } }

        get total() {
            return Object.values(state.counters)
                .reduce((sum, c) => sum + c.value, 0);
        },

        get value() {
            const ctx = getContext();
            return state.counters[ctx.id]?.value ?? 0;
        }
    },
    actions: {
        increment() {
            const ctx = getContext();
            state.counters[ctx.id].value += 1;
        },
        decrement() { /* ... */ },
        reset() { /* ... */ },
        resetAll() { /* ... */ }
    },
    callbacks: {
        init() {
            const ctx = getContext();
            state.counters[ctx.id] = {
                value: ctx.initialValue ?? 0,
                label: ctx.label ?? ctx.id
            };
        }
    }
});
```

## Integration with Global Counter Block

This block shares its store namespace (`counter`) with the Global Counter Block, allowing it to display:
- Total sum of all counters
- List of individual counter values

## Development

```bash
cd counter-block
npm install
npm run start   # Development mode
npm run build   # Production build
```

## File Structure

```
counter-block/
├── block.json      # Block metadata
├── plugin.php      # Plugin registration
├── render.php      # Frontend template (with unique ID generation)
├── package.json
└── src/
    ├── index.js    # Editor registration
    ├── edit.js     # Editor component
    ├── view.js     # Interactivity store
    └── style.scss  # Styles
```

## License

GPL-2.0-or-later
