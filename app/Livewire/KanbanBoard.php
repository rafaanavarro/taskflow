<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Board;
use App\Models\Task; // Asegúrate de importar tu modelo Task
use Illuminate\Support\Facades\Auth;

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

    // Método extraído para recargar el tablero fácilmente después de añadir una tarea
    public function loadBoard()
    {
        $this->board = Board::with(['columns.tasks'])
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
        $this->validate(); // revisa las rules de arriba

        Task::create([
            'column_id' => $this->column_id,
            'title' => $this->newTaskTitle,
            'description' => $this->newTaskDescription,
            // 'order' => 0 // Descomenta y ajusta si tienes un campo de ordenamiento
        ]);

        $this->closeModal();
        $this->loadBoard(); // Refrescamos el tablero para ver la nueva tarea
    }

    
    public function destroyTask($taskid) 
    {
        $task = Task::find($taskid);
        $task->delete();
        $this->loadBoard();
    }
}