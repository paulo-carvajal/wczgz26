# Todo Block

Interactive todo list for WordPress using the Interactivity API.

## Description

A complete CRUD task list that demonstrates **complex state management** in WordPress Interactivity API. Features adding, completing, filtering, and removing tasks with derived state for filtered views and counters.

## Features

- Add new tasks
- Toggle task completion
- Remove individual tasks
- Filter: All / Active / Completed
- Clear all completed tasks
- Active tasks counter
- Dynamic list with `data-wp-each`

## Requirements

- WordPress 6.5+
- PHP 7.4+
- Node.js 18+ (for development)

## Installation

1. Upload the `todo-block` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu
3. Add the block in the editor by searching for "Lista de Tareas"

## Usage

Type a task and press Enter or click Add. Click on a task to toggle completion. Use the filter buttons to show All/Active/Completed tasks.

### Interactivity API Concepts Demonstrated

| Concept | Implementation |
|---------|----------------|
| CRUD operations | Add, toggle, remove tasks |
| Array state | `state.tasks` array with immutable updates |
| Derived state | `filteredTasks`, `activeCount` getters |
| `data-wp-each` | Dynamic list rendering |
| `getContext()` | Access current item in loop |
| Form handling | `withSyncEvent` for form submission |
| Filter state | `state.filter` with three modes |

### Store Structure

```javascript
const { state } = store('todoList', {
    state: {
        tasks: [],
        newTaskTitle: '',
        filter: 'all',  // 'all' | 'active' | 'completed'

        get filteredTasks() {
            switch (state.filter) {
                case 'active':
                    return state.tasks.filter(t => !t.completed);
                case 'completed':
                    return state.tasks.filter(t => t.completed);
                default:
                    return state.tasks;
            }
        },

        get activeCount() {
            return state.tasks.filter(t => !t.completed).length;
        }
    },
    actions: {
        updateNewTitle(event) {
            state.newTaskTitle = event.target.value;
        },

        addTask: withSyncEvent((event) => {
            event.preventDefault();
            const title = state.newTaskTitle.trim();
            if (!title) return;

            state.tasks = [
                ...state.tasks,
                { id: Date.now(), title, completed: false }
            ];
            state.newTaskTitle = '';
        }),

        toggleTask() {
            const context = getContext();
            const id = context.item.id;

            state.tasks = state.tasks.map(task =>
                task.id === id
                    ? { ...task, completed: !task.completed }
                    : task
            );
        },

        removeTask() {
            const context = getContext();
            const id = context.item.id;
            state.tasks = state.tasks.filter(task => task.id !== id);
        },

        setFilter(event) {
            state.filter = event.target.dataset.filter;
        },

        clearCompleted() {
            state.tasks = state.tasks.filter(task => !task.completed);
        }
    }
});
```

### Template with data-wp-each

```php
<ul class="todo-list">
    <template data-wp-each="state.filteredTasks">
        <li data-wp-class--completed="context.item.completed">
            <input
                type="checkbox"
                data-wp-bind--checked="context.item.completed"
                data-wp-on--change="actions.toggleTask"
            />
            <span data-wp-text="context.item.title"></span>
            <button data-wp-on--click="actions.removeTask">×</button>
        </li>
    </template>
</ul>
```

## Development

```bash
cd todo-block
npm install
npm run start   # Development mode
npm run build   # Production build
```

## File Structure

```
todo-block/
├── block.json      # Block metadata
├── plugin.php      # Plugin registration
├── render.php      # Frontend template with form and list
├── package.json
└── src/
    ├── index.js    # Editor registration
    ├── edit.js     # Editor component
    ├── view.js     # Interactivity store with CRUD logic
    └── style.scss  # Todo list styles
```

## License

GPL-2.0-or-later
