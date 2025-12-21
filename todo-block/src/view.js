import { store, getContext, withSyncEvent } from '@wordpress/interactivity';

const { state } = store( 'todoList', {
    state: {
        tasks: [],
        newTaskTitle: '',
        filter: 'all',

        // Estado derivado: tareas filtradas
        get filteredTasks() {
            switch ( state.filter ) {
                case 'active':
                    return state.tasks.filter( t => !t.completed );
                case 'completed':
                    return state.tasks.filter( t => t.completed );
                default:
                    return state.tasks;
            }
        },

        // Estado derivado: contador de tareas activas
        get activeCount() {
            return state.tasks.filter( t => !t.completed ).length;
        }
    },

    actions: {
        updateNewTitle( event ) {
            state.newTaskTitle = event.target.value;
        },

        addTask: withSyncEvent( ( event ) => {
            event.preventDefault();

            const title = state.newTaskTitle.trim();
            if ( !title ) return;

            state.tasks = [
                ...state.tasks,
                {
                    // Usamos Date.now() para un ID único simple en el frontend
                    id: Date.now(),
                    title,
                    completed: false
                }
            ];

            state.newTaskTitle = '';
        } ),

        toggleTask() {
            // Obtener el item del contexto (dentro de data-wp-each)
            const context = getContext();
            const id = context.item.id;

            state.tasks = state.tasks.map( task =>
                task.id === id
                    ? { ...task, completed: !task.completed }
                    : task
            );
        },

        removeTask() {
            // Obtener el item del contexto (dentro de data-wp-each)
            const context = getContext();
            const id = context.item.id;
            state.tasks = state.tasks.filter( task => task.id !== id );
        },

        setFilter( event ) {
            // El filtro se pasa a través del atributo data-filter
            state.filter = event.target.dataset.filter;
        },

        clearCompleted() {
            state.tasks = state.tasks.filter( task => !task.completed );
        }
    }
} );
