<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adenda extends Model
{
  protected $table = 'adendas';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'codigo','solicitud_id','usuario_id','nombre','descripcion', 'archivo', 'estado'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];
}
