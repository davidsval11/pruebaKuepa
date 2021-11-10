<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = "estudiantes";

    protected $fillable = [
        "nombres",
        "apellidos",
        "email",
        "tel",
        "programa_id",
        "estado_llamada"
    ];

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'programa_id');
    }
}
