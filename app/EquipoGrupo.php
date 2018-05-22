<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipoGrupo extends Model
{
    protected $table = 'grupos_equipos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'liga_id','grupo_id','equipo_id','posicion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
