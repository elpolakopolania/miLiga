<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asig_Progra extends Model
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'asignatura_id','programa_id'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];

  public function programa(){
    $this->belongsTo('App\Programa');
  }

  public function asignatura(){
    $this->belongsTo('App\Asignatura');
  }
}
