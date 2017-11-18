<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homologacion extends Model
{
  protected $table = 'homologaciones';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'adendas_id','asig_progra_id','nota'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];
}
