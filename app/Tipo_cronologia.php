<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_cronologia extends Model
{
    protected $table = 'tipo_cronologia';

    /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'cod','nombre', 'estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
