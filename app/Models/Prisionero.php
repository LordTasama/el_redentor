<?php
// app/Models/Prisionero.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prisionero extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres',
        'apellidos',
        'nacimiento',
        'ingreso',
        'delito',
        'celda',
    ];
}
?>