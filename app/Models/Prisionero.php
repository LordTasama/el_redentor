<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Prisionero
 *
 * @property $id
 * @property $nombres
 * @property $apellidos
 * @property $nacimiento
 * @property $ingreso
 * @property $delito
 * @property $celda
 * @property $created_at
 * @property $updated_at
 *
 * @property Visita[] $visitas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Prisionero extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombres', 'apellidos', 'nacimiento', 'ingreso', 'delito', 'celda'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visitas()
    {
        return $this->hasMany(\App\Models\Visita::class, 'id', 'prisionero_id');
    }
    
}
