<div>
    @if ($board)
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $board->title }}</h2>
        </div>

        <div class="flex items-start gap-6 pb-4 overflow-x-auto">

            @foreach ($board->columns as $column)
                <div class="w-80 shrink-0 bg-gray-100 dark:bg-gray-800 rounded-lg p-4">

                    <h3 class="mb-4 font-semibold text-gray-700 dark:text-gray-200">
                        {{ $column->title }}
                    </h3>

                    <div class="flex flex-col gap-3">
                        @foreach ($column->tasks as $task)
                            <div
                                class="p-3 bg-white border border-gray-200 rounded shadow-sm cursor-pointer dark:bg-gray-700 dark:border-gray-600 hover:shadow-md transition-shadow">
                                <p class="text-sm font-medium text-gray-800 dark:text-gray-100">
                                    {{ $task->title }}
                                </p>

                                @if ($task->description)
                                    <p class="mt-1 text-xs text-gray-500 truncate dark:text-gray-400">
                                        {{ $task->description }}
                                    </p>
                                @endif
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
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
