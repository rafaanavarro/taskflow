<div>
    @if($board)
        <div class="flex items-start gap-6 pb-4 overflow-x-auto">
            @foreach($board->columns as $column)
                <div wire:key="col-{{ $column->id }}" class="w-80 shrink-0 bg-gray-100 dark:bg-gray-800 rounded-lg p-4">

                    <h3 class="mb-4 font-semibold text-gray-700 dark:text-gray-200">
                        {{ $column->title }}
                    </h3>

                    <div class="flex flex-col gap-3">
                        @foreach($column->tasks as $task)
                            <div wire:key="task-{{ $task->id }}"
                                class="p-3 bg-white border border-gray-200 rounded shadow-sm cursor-pointer dark:bg-gray-700 dark:border-gray-600 hover:shadow-md transition-shadow">
                                <p class="text-sm font-medium text-gray-800 dark:text-gray-100">
                                    {{ $task->title }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        <input type="text" wire:model="newTaskTitle.{{ $column->id }}"
                            placeholder="Título de la tarea"
                            class="w-full px-2 py-1 text-sm rounded border-gray-300 dark:bg-gray-700 dark:text-white"
                            wire:keydown.enter="addTask({{ $column->id }})">

                        <button wire:click="addTask({{ $column->id }})"
                            class="flex items-center gap-1 mt-4 text-sm text-gray-500 transition-colors dark:text-gray-400 hover:text-gray-800 dark:hover:text-white">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Añadir tarea
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
    @endif
</div>