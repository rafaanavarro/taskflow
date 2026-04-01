<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Board;
use Illuminate\Support\Facades\Auth;

class KanbanBoard extends Component
{
    public $board; // variable publica

    // funcion que se ejecuta al iniciar el componente, es como el constructor
    public function mount()
    {
        // cargamos el tablero del usuario autenticado
        $this->board = Board::with(['columns.tasks'])
            ->where('user_id', Auth::id())
            ->first();
    }

    public function render()
    {
        return view('livewire.kanban-board');
    }
}