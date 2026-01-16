# Modal Block

Interactive modal dialog for WordPress using the Interactivity API.

## Description

A modal component that demonstrates **global state management** in WordPress Interactivity API. Supports three modal types: Info, Confirm, and Prompt, each with different behaviors and button configurations.

## Features

- **Info Modal**: Simple informational dialog with close button
- **Confirm Modal**: Yes/No confirmation with result tracking
- **Prompt Modal**: Text input with confirmation
- Overlay click to close
- Body scroll lock when open
- Custom events for external integration
- Result display area

## Requirements

- WordPress 6.5+
- PHP 7.4+
- Node.js 18+ (for development)

## Installation

1. Upload the `modal-block` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu
3. Add the block in the editor by searching for "Modal Interactivo"

## Usage

The block displays three trigger buttons (Info, Confirm, Prompt). Each opens a different type of modal. Results from Confirm and Prompt modals are displayed in a results area.

### Modal Types

| Type | Buttons | Result |
|------|---------|--------|
| Info | Close | None |
| Confirm | Cancel, Confirm | Boolean (true/false) |
| Prompt | Cancel, Confirm | User input text |

### Interactivity API Concepts Demonstrated

| Concept | Implementation |
|---------|----------------|
| Global state | Modal open/closed, type, content |
| Derived getters | `isPromptModal`, `showCancelButton`, etc. |
| Event handling | `data-wp-on--click`, `data-wp-on--input` |
| Conditional rendering | `data-wp-bind--hidden` for buttons |
| Custom events | `modal:confirmed`, `modal:cancelled` |

### Store Structure

```javascript
const { state } = store('modalExample', {
    state: {
        isModalOpen: false,
        modalType: 'info',  // 'info' | 'confirm' | 'prompt'
        modalTitle: '',
        modalContent: '',
        promptValue: '',
        lastConfirmResult: null,
        lastPromptValue: null,

        get isPromptModal() {
            return state.modalType === 'prompt';
        },
        get showCancelButton() {
            return state.modalType === 'confirm' ||
                   state.modalType === 'prompt';
        },
        get hasResult() {
            return state.lastConfirmResult !== null ||
                   state.lastPromptValue !== null;
        }
    },
    actions: {
        openModal(event) {
            const { title, content, type } = event.target.dataset;
            state.modalTitle = title;
            state.modalContent = content;
            state.modalType = type;
            state.isModalOpen = true;
            document.body.style.overflow = 'hidden';
        },
        confirm() {
            if (state.modalType === 'prompt') {
                state.lastPromptValue = state.promptValue;
            } else {
                state.lastConfirmResult = true;
            }
            state.isModalOpen = false;
            document.dispatchEvent(
                new CustomEvent('modal:confirmed', {
                    detail: { type: state.modalType, value: state.promptValue }
                })
            );
        },
        cancel() { /* ... */ },
        closeModal() { /* ... */ }
    }
});
```

### Custom Events

Listen to modal results from other scripts:

```javascript
document.addEventListener('modal:confirmed', (e) => {
    console.log('Confirmed:', e.detail.type, e.detail.value);
});

document.addEventListener('modal:cancelled', (e) => {
    console.log('Cancelled:', e.detail.type);
});
```

## Development

```bash
cd modal-block
npm install
npm run start   # Development mode
npm run build   # Production build
```

## File Structure

```
modal-block/
├── block.json      # Block metadata
├── plugin.php      # Plugin registration
├── render.php      # Frontend template with modal HTML
├── package.json
└── src/
    ├── index.js    # Editor registration
    ├── edit.js     # Editor component
    ├── view.js     # Interactivity store
    └── style.scss  # Modal and button styles
```

## License

GPL-2.0-or-later
