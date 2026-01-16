# Accordion Block

Interactive accordion block for WordPress using the Interactivity API.

## Description

A simple collapsible accordion that demonstrates **local context** in WordPress Interactivity API. Each accordion item maintains its own open/closed state independently.

## Features

- Expandable/collapsible sections
- Multiple items can be open simultaneously
- Smooth toggle animation
- Local context per item (state isolation)

## Requirements

- WordPress 6.5+
- PHP 7.4+
- Node.js 18+ (for development)

## Installation

1. Upload the `accordion-block` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu
3. Add the block in the editor by searching for "Acordeón Interactivo"

## Usage

Simply add the block to your page. The accordion comes with demo items that can be clicked to expand/collapse.

### Interactivity API Concepts Demonstrated

| Concept | Implementation |
|---------|----------------|
| Local context | `data-wp-context` per accordion item |
| Toggle action | `data-wp-on--click="actions.toggle"` |
| Conditional content | `data-wp-bind--hidden="!context.isOpen"` |
| `getContext()` | Accessing local state in actions |

### Store Structure

```javascript
store('accordion', {
    actions: {
        toggle() {
            const context = getContext();
            context.isOpen = !context.isOpen;
        }
    }
});
```

## Development

```bash
cd accordion-block
npm install
npm run start   # Development mode
npm run build   # Production build
```

## File Structure

```
accordion-block/
├── block.json      # Block metadata
├── plugin.php      # Plugin registration
├── render.php      # Frontend template
├── package.json
└── src/
    ├── index.js    # Editor registration
    ├── edit.js     # Editor component
    ├── view.js     # Interactivity store
    └── style.scss  # Styles
```

## License

GPL-2.0-or-later
