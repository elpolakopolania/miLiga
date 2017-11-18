<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Estudio extends Model
{
  protected $table = 'tipos_estudios';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'nombre'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];
}
