<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Visitante
 *
 * @property $id
 * @property $nombres
 * @property $apellidos
 * @property $documento
 * @property $created_at
 * @property $updated_at
 *
 * @property Visita[] $visitas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Visitante extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombres', 'apellidos', 'documento'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visitas()
    {
        return $this->hasMany(\App\Models\Visita::class, 'id', 'visitante_id');
    }
    
}
