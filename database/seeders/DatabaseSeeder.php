<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Board;
use App\Models\Column;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //Creamos un usuario de prueba
        $user = User::factory()->create([
            'name' => 'Usuario Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
        ]);

        //  Le creamos un tablero Kanban a ese usuario
        $board = Board::create([
            'user_id' => $user->id,
            'title' => 'Proyecto TaskFlow',
            'color_bg' => 'bg-blue-600',
        ]);

        // Creamos tres columnas típicas
        $colTodo = Column::create(['board_id' => $board->id, 'title' => 'Pendiente', 'order_position' => 1]);
        $colDoing = Column::create(['board_id' => $board->id, 'title' => 'En Progreso', 'order_position' => 2]);
        $colDone = Column::create(['board_id' => $board->id, 'title' => 'Completado', 'order_position' => 3]);

        // Añadimos unas cuantas tareas de ejemplo
        Task::create([
            'column_id' => $colTodo->id,
            'title' => 'Aprender Livewire',
            'description' => 'Mirar la documentación sobre los eventos.',
            'order_position' => 1
        ]);

        Task::create([
            'column_id' => $colTodo->id,
            'title' => 'Diseñar con Tailwind',
            'description' => null,
            'order_position' => 2
        ]);

        Task::create([
            'column_id' => $colDoing->id,
            'title' => 'Maquetar base de datos',
            'description' => 'Crear migraciones y relaciones de Eloquent.',
            'order_position' => 1
        ]);

        Task::create([
            'column_id' => $colDone->id,
            'title' => 'Instalar el proyecto',
            'description' => null,
            'order_position' => 1
        ]);
    }
}