# Demo Blocks - WordPress Interactivity API

Colección de 7 bloques de Gutenberg que demuestran el uso de la **WordPress Interactivity API** (WP 6.5+).

## Bloques incluidos

| Bloque | Descripción | Características |
|--------|-------------|-----------------|
| **Accordion** | Acordeón expandible | Contexto local, múltiples items |
| **Counter** | Contador numérico | Estado global, acciones increment/decrement/reset |
| **Data Fetcher** | Cargador de datos | Fetch asíncrono, callbacks, estados de carga |
| **Modal** | Ventana modal | Estado global, apertura/cierre |
| **Search Filter** | Buscador con filtros | Getters derivados, filtrado en tiempo real |
| **Tabs** | Sistema de pestañas | Contexto por tab, estado compartido |
| **Todo List** | Lista de tareas | CRUD, estados derivados, each loops |

## Requisitos

- WordPress 6.5+ (Interactivity API)
- Node.js 18+
- npm 9+

## Instalación

```bash
cd wp-content/plugins
npm install
npm run build
```

## Desarrollo

```bash
npm run start  # Watch mode para todos los plugins
```

## Estructura

```
plugins/
├── package.json          # Workspace root
├── accordion-block/
│   ├── block.json        # Metadata del bloque
│   ├── render.php        # Template PHP (frontend)
│   ├── src/
│   │   ├── index.js      # Editor script
│   │   ├── edit.js       # Componente del editor
│   │   ├── view.js       # Interactivity API (frontend)
│   │   └── style.scss    # Estilos
│   └── build/            # Archivos compilados
├── counter-block/
├── data-fetcher-block/
├── modal-block/
├── search-filter-block/
├── tabs-block/
└── todo-block/
```

## Conceptos de Interactivity API demostrados

### Estado Global vs Contexto Local

- **Estado global** (`wp_interactivity_state`): Compartido entre todos los elementos
- **Contexto local** (`wp_interactivity_data_wp_context`): Específico por elemento

### Directivas utilizadas

| Directiva | Uso |
|-----------|-----|
| `data-wp-interactive` | Define el namespace del store |
| `data-wp-on--click` | Event handler para clicks |
| `data-wp-bind--attr` | Binding dinámico de atributos |
| `data-wp-text` | Contenido de texto reactivo |
| `data-wp-class--name` | Clases CSS condicionales |
| `data-wp-each` | Iteración sobre arrays |
| `data-wp-context` | Contexto local por elemento |

### Funciones del store

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
        init() { /* Se ejecuta al montar */ }
    }
});
```

## Licencia

ISC
