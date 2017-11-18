<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\facades\DB;

class Estudio extends Model
{
  protected $table = 'estudios';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'tipo_estudio_id','solicitud_id', 'nombre_institucion', 'nombre_carrera', 'nombre_archivo'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];

  /**
  * Obtener estudio con las tablas relacionadas.
  */
  public function estudio_all($id){
    $estudios = DB::table('estudios as e')
    ->join('tipos_estudios as tpe', 'e.tipo_estudio_id', '=','tpe.id')
    ->select('e.*','tpe.nombre')
    ->where('solicitud_id',$id);

    return $estudios;
  }

}
