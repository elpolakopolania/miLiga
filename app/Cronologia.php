<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cronologia extends Model
{
    protected $table = 'cronologia';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fecha_id','liga_id','equipo1_id','equipo2_id',
        'participante1_id', 'participante2_id','cod','tiempo_juego',
        'descripcion', 'estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

}
