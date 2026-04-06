<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Board;
use App\Models\Task; // Asegúrate de importar tu modelo Task
use Illuminate\Support\Facades\Auth;
use App\Models\Column;

class KanbanBoard extends Component
{
    public $board;

    // Variables para el modal y el formulario
    public $isModalOpen = false;
    public $column_id;
    public $newTaskTitle = '';
    public $newTaskDescription = '';

    // Reglas de validación para el formulario
    protected $rules = [
        'newTaskTitle' => 'required|string|max:255',
        'newTaskDescription' => 'nullable|string',
        'column_id' => 'required|exists:columns,id'
    ];

    public function mount()
    {
        $this->loadBoard();
    }


    public function loadBoard()
    {
        // Cargamos el tablero del usuario, pero le decimos que nos traiga
        // las columnas y las tareas ORDENADAS por la columna 'order_position'
        $this->board = Board::with([
            'columns' => function ($query) {
                $query->orderBy('order_position');
            },
            'columns.tasks' => function ($query) {
                $query->orderBy('order_position');
            }
        ])
            ->where('user_id', Auth::id())
            ->first();
    }

    public function render()
    {
        return view('livewire.kanban-board');
    }

    // Abre el modal y guarda a qué columna vamos a añadir la tarea
    public function openModal($columnId)
    {
        $this->resetValidation(); // resetea los errores de las validaciones anteriores
        $this->column_id = $columnId;
        $this->newTaskTitle = '';
        $this->newTaskDescription = '';
        $this->isModalOpen = true;
    }

    // Cierra el modal y limpia las variables
    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->reset(['newTaskTitle', 'newTaskDescription', 'column_id']);
    }

    // Función para crear la tarea
    public function addTask()
    {
        $this->validate();

        // Buscamos cuál es la posición más alta actual en esa columna
        $maxPosition = Task::where('column_id', $this->column_id)->max('order_position');

        Task::create([
            'column_id' => $this->column_id,
            'title' => $this->newTaskTitle,
            'description' => $this->newTaskDescription,
            'order_position' => $maxPosition !== null ? $maxPosition + 1 : 0 // Lo ponemos al final
        ]);

        $this->closeModal();
        $this->loadBoard();
    }


    public function destroyTask($taskid)
    {
        $task = Task::find($taskid);
        $task->delete();
        $this->loadBoard();
    }

    public function updateTaskOrder($orderedIds, $columnId)
    {
        // Si por lo que sea no nos llegan IDs, no hacemos nada para que no pete
        if (empty($orderedIds)) {
            return;
        }

        // Recorremos el array
        foreach ($orderedIds as $index => $taskId) {

            // Hacemos el update directo a la base de datos
            Task::where('id', $taskId)->update([
                'column_id' => $columnId,
                'order_position' => $index // el orden es el index porque la lista de las tareas viene ya ordenada por Sortable.js
            ]);
        }

        // Recargamos el tablero entero para ver el resultado oficial
        $this->loadBoard();
    }

    public function createDefaultBoard()
    {
        $newBoard = Board::create([
            'user_id' => Auth::id(),
            'title' => 'Mi Tablero Principal'
        ]);


        $columns = [
            ['board_id' => $newBoard->id, 'title' => 'Pendiente', 'order_position' => 0],
            ['board_id' => $newBoard->id, 'title' => 'En progreso', 'order_position' => 1],
            ['board_id' => $newBoard->id, 'title' => 'Hecho', 'order_position' => 2],
        ];

        foreach ($columns as $column) {
            Column::create($column);
        }


        $this->loadBoard();
    }
}