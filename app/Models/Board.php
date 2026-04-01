<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = ['user_id', 'title', 'color_bg'];

    // Falta esta: A qué usuario pertenece el tablero
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function columns()
    {
        return $this->hasMany(Column::class)->orderBy('order_position');
    }
}