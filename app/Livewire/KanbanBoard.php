<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use App\Models\Board;
use Illuminate\Support\Facades\Auth;

class KanbanBoard extends Component
{
    public $newTaskTitle = [];

    public function render()
    {
        $board = Board::with(['columns.tasks'])
            ->where('user_id', Auth::id())
            ->first();

        return view('livewire.kanban-board', [
            'board' => $board
        ]);
    }

    public function addTask($columnId)
    {
        $title = $this->newTaskTitle[$columnId] ?? '';

        if (!empty(trim($title))) {
            Task::create([
                'column_id' => $columnId,
                'title' => trim($title),
                'order_position' => 0,
            ]);

            $this->newTaskTitle[$columnId] = '';
        }
    }
}