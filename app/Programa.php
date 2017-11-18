<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
  protected $table = 'programas';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'nombre','jefe_id'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];
}
