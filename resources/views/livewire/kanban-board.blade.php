<div>
    @if ($board)
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $board->title }}</h2>
        </div>

        <div class="flex items-start gap-6 pb-4 overflow-x-auto">

            @foreach ($board->columns as $column)
                <div wire:key="column-{{ $column->id }}" class="w-80 shrink-0 bg-gray-100 dark:bg-gray-800 rounded-lg p-4">

                    <h3 class="mb-4 font-semibold text-gray-700 dark:text-gray-200">
                        {{ $column->title }}
                    </h3>

                    <!-- el x-data es de Alpine.js y se usa para especificar que vamos a poner codigo js y el x-init es para inicializar el script de Sortable.js-->
                    <div wire:key="task-list-{{ $column->id }}" data-column-id="{{ $column->id }}"
                        class="flex flex-col gap-3 task-list" style="min-height: 50px;" x-data
                        x-init="
                                                                                                                                        // $el es como el this basicamente
                                                                                                                                            Sortable.create($el, {
                                                                                                                                                group: 'kanban', // obligatorio si queremos que poder mover tareas entre columnas
                                                                                                                                                animation: 150, 
                                                                                                                                                ghostClass: 'opacity-50', // como la vista previa por decirlo asi
                                                                                                                                                draggable: '[data-task-id]', // le dice a sortable que solo puede mover elementos que tengan este atributo

                                                                                                                                                // función que se ejecuta cuando termina de mover una tarea
                                                                                                                                                // evt es un objeto que contiene información sobre el movimiento
                                                                                                                                                onEnd: (evt) => {

                                                                                                                                                    const toColumnId = evt.to.dataset.columnId;
                                                                                                                                                    // Recorremos todos los elementos que tengan el atributo data-task-id y los guardamos en un array (guardamos las ids)
                                                                                                                                                    const toTaskIds = [...evt.to.querySelectorAll('[data-task-id]')]
                                                                                                                                                        .map(el => el.dataset.taskId);

                                                                                                                                                    // en esta linea lo que hacemos es revertir el movimiento a ojos de livewire para que no entre en conflicto
                                                                                                                                                    evt.from.insertBefore(evt.item, evt.from.children[evt.oldIndex] || null);

                                                                                                                                                    // y se llamamos a la funcion del controlador
                                                                                                                                                    $wire.updateTaskOrder(toTaskIds, toColumnId);
                                                                                                                                                }
                                                                                                                                            });
                                                                                                                                        ">

                        @foreach ($column->tasks as $task)
                            <div wire:key="task-{{ $task->id }}" data-task-id="{{ $task->id }}"
                                class="select-none relative p-4 bg-white border border-gray-200 rounded-lg shadow-sm cursor-grab active:cursor-grabbing dark:bg-gray-700 dark:border-gray-600 hover:shadow-md transition-shadow group">

                                <p class="text-sm font-medium text-gray-800 dark:text-gray-100 pr-6">
                                    {{ $task->title }}
                                </p>

                                @if ($task->description)
                                    <p class="mt-2 text-xs text-gray-500 truncate dark:text-gray-400">
                                        {{ $task->description }}
                                    </p>
                                @endif

                                <button wire:click="destroyTask({{ $task->id }})"
                                    class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-4 h-4 text-gray-400 transition-colors hover:text-red-500 cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <button wire:click="openModal({{ $column->id }})"
                        class="flex items-center gap-1 mt-4 text-sm text-gray-500 transition-colors dark:text-gray-400 hover:text-gray-800 dark:hover:text-white">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Añadir tarea
                    </button>
                </div>
            @endforeach

        </div>
    @else
        <div class="py-12 text-center">
            <p class="text-gray-500 dark:text-gray-400">No tienes ningún tablero asignado todavía.</p>
        </div>
    @endif

    @if ($isModalOpen)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black bg-opacity-50 transition-opacity">
            <div class="relative w-full max-w-md p-4">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">

                    <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Nueva Tarea
                        </h3>
                        <button wire:click="closeModal" type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Cerrar modal</span>
                        </button>
                    </div>

                    <form wire:submit.prevent="addTask" class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-1">
                            <div>
                                <label for="title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
                                <input type="text" wire:model="newTaskTitle" id="title"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                    required>
                                @error('newTaskTitle')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción
                                    (Opcional)</label>
                                <textarea id="description" wire:model="newTaskDescription" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"></textarea>
                                @error('newTaskDescription')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="button" wire:click="closeModal"
                                class="mr-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                Guardar Tarea
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endif
</div>