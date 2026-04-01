<div>
    @if($board)
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $board->title }}</h2>
        </div>

        <div class="flex items-start gap-6 pb-4 overflow-x-auto">

            @foreach($board->columns as $column)

                <div class="w-80 shrink-0 bg-gray-100 dark:bg-gray-800 rounded-lg p-4">

                    <h3 class="mb-4 font-semibold text-gray-700 dark:text-gray-200">
                        {{ $column->title }}
                    </h3>

                    <div class="flex flex-col gap-3">

                        @foreach($column->tasks as $task)

                            <div
                                class="p-3 bg-white border border-gray-200 rounded shadow-sm cursor-pointer dark:bg-gray-700 dark:border-gray-600 hover:shadow-md transition-shadow">
                                <p class="text-sm font-medium text-gray-800 dark:text-gray-100">
                                    {{ $task->title }}
                                </p>

                                @if($task->description)
                                    <p class="mt-1 text-xs text-gray-500 truncate dark:text-gray-400">
                                        {{ $task->description }}
                                    </p>
                                @endif
                            </div>

                        @endforeach
                    </div>

                    <button
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
</div>