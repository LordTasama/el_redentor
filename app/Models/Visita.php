<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Visita
 *
 * @property $id
 * @property $visitante_id
 * @property $prisionero_id
 * @property $inicioVisita
 * @property $finVisita
 * @property $created_at
 * @property $updated_at
 *
 * @property Prisionero $prisionero
 * @property Visitante $visitante
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Visita extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['visitante_id', 'prisionero_id', 'inicioVisita', 'finVisita'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prisionero()
    {
        return $this->belongsTo(\App\Models\Prisionero::class, 'prisionero_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visitante()
    {
        return $this->belongsTo(\App\Models\Visitante::class, 'visitante_id', 'id');
    }
    
}
