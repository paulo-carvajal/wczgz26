# Tabs Block

Interactive tabs component for WordPress using the Interactivity API.

## Description

A tab navigation system that demonstrates **shared state with context** in WordPress Interactivity API. Each tab button uses local context to identify itself, while the active tab is stored in global state.

## Features

- Multiple tab panels
- Click to switch tabs
- Active tab indicator
- Smooth content switching
- Context-based tab identification

## Requirements

- WordPress 6.5+
- PHP 7.4+
- Node.js 18+ (for development)

## Installation

1. Upload the `tabs-block` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu
3. Add the block in the editor by searching for "Pestañas Interactivas"

## Usage

The block displays a row of tab buttons with corresponding content panels. Click a tab to show its content.

### Interactivity API Concepts Demonstrated

| Concept | Implementation |
|---------|----------------|
| Global state | `state.activeTab` |
| Local context | `data-wp-context='{"tabId": "info"}'` |
| Derived getter | `isActiveTab` compares context with state |
| Conditional classes | `data-wp-class--active="state.isActiveTab"` |
| `getContext()` | Access tab ID in actions |

### Store Structure

```javascript
const { state } = store('tabsBlock', {
    state: {
        activeTab: 'info',  // Default active tab

        get isActiveTab() {
            const context = getContext();
            return state.activeTab === context.tabId;
        }
    },
    actions: {
        setTab() {
            const context = getContext();
            state.activeTab = context.tabId;
        }
    }
});
```

### Template Pattern

```php
<!-- Tab button with context -->
<button
    data-wp-context='{"tabId": "info"}'
    data-wp-on--click="actions.setTab"
    data-wp-class--active="state.isActiveTab"
>
    Info Tab
</button>

<!-- Tab content with same context -->
<div
    data-wp-context='{"tabId": "info"}'
    data-wp-bind--hidden="!state.isActiveTab"
>
    Content for Info tab
</div>
```

## Development

```bash
cd tabs-block
npm install
npm run start   # Development mode
npm run build   # Production build
```

## File Structure

```
tabs-block/
├── block.json      # Block metadata
├── plugin.php      # Plugin registration
├── render.php      # Frontend template with tabs
├── package.json
└── src/
    ├── index.js    # Editor registration
    ├── edit.js     # Editor component
    ├── view.js     # Interactivity store
    └── style.scss  # Tab styles
```

## License

GPL-2.0-or-later
