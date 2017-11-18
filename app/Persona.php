<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Persona extends Model
{

  protected $table = 'personas';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'nombres','apellidos','tipoIdent_id','numIdent','telefono', 'direccion','fechaNac','genero'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];

  /*
  * Obtener toda la informacion de la persona.
  */
  public function persona($id){
    // Obtener todos loas datos de la persona.
    $persona = DB::table('personas as p')
    ->join('tipos_documentos as tp', 'p.tipoIdent_id', '=', 'tp.id')
    ->select('p.*','tp.id as id_tipodoc', 'tp.codigo as codigo_tipodoc', 'tp.nombre as nombre_tipodoc')
    ->where('p.id',$id)
    ->first();
    return $persona;
  }
}
