<?php
// app/Models/Visita.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitante_id',
        'prisionero_id',
        'inicioVisita',
        'finVisita',
    ];

    public function visitante()
    {
        return $this->belongsTo(Visitante::class);
    }

    public function prisionero()
    {
        return $this->belongsTo(Prisionero::class);
    }
}


?>