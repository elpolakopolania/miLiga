<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
  protected $table = 'solicitudes';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'usuario_id', 'programa_id', 'estado'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];

  /**
  * lista las solicitudes del usuario.
  */
  public function listar_solicitudes($get, $user_id){
    // Organizar datos.
    $datos = [
      'total' => $this->get_total_solicitudes($get, $user_id),
      'solicitudes' => $this->get_solicitudes($get, $user_id)
    ];
    return $datos;
  }

  /**
  * Obtener el total de regitros filtrados
  */
  private function get_total_solicitudes ($get, $user_id){
    // Obtener el total de los registros filtrados.
    $total = DB::table('solicitudes as s')
      ->join('programas as p', 'p.id', '=', 's.programa_id')
      ->join('users as u', 'u.id', '=', 's.usuario_id')
      ->join('personas as per', 'per.id', '=', 'u.persona_id')
      ->select(DB::raw('count(*) as total'))
      ->where('p.jefe_id',$user_id);
      if(!empty($get->search['value'])){
        $buscar = DB::raw("'".$get->search['value']."%'");
        $buscar_all = DB::raw("'%".$get->search['value']."%'");
        $total->where(function($total) use ($buscar, $buscar_all){
          $total->orWhere(DB::raw('CONCAT( per.nombres ," ", per.apellidos )'), 'like', $buscar_all)
          ->orWhere('per.numIdent', 'like', $buscar)
          ->orWhere('per.telefono', 'like', $buscar)
          ->orWhere('p.nombre', 'like', $buscar)
          ->orWhere('p.nombre', 'like', $buscar)
          ->orWhere(Db::raw('DATE_FORMAT( s.created_at , "%Y/%m/%d")'), 'like', $buscar);
       });
     }
    $total->get();
    // Retornar la cantidad de registros.
    return $total->first()->total;
  }

  /**
  * Obtener las solicitudes.
  */
  private function get_solicitudes($get, $user_id){
    // Obtener todas las solicitudes.
    $solicitudes = Db::table('solicitudes as s')
      ->join('programas as p', 'p.id', '=', 's.programa_id')
      ->join('users as u', 'u.id', '=', 's.usuario_id')
      ->join('personas as per', 'per.id', '=', 'u.persona_id')
      ->select(DB::raw('s.id,CONCAT( per.nombres ," ", per.apellidos ) AS estudiante, per.numIdent , per.telefono, p.nombre , DATE_FORMAT( s.created_at , "%Y/%m/%d") AS fecha, "" as editar'))
      ->where('p.jefe_id',$user_id);
      // validar la búsqueda.
    if(!empty($get->search['value'])){
      $buscar = DB::raw("'".$get->search['value']."%'");
      $buscar_all = DB::raw("'%".$get->search['value']."%'");
      $solicitudes->where(function($solicitudes) use ($buscar, $buscar_all){
        $solicitudes->orWhere(DB::raw('CONCAT( per.nombres ," ", per.apellidos )'), 'like', $buscar_all)
        ->orWhere('per.numIdent', 'like', $buscar)
        ->orWhere('per.telefono', 'like', $buscar)
        ->orWhere('p.nombre', 'like', $buscar)
        ->orWhere('p.nombre', 'like', $buscar)
        ->orWhere(Db::raw('DATE_FORMAT( s.created_at , "%Y/%m/%d")'), 'like', $buscar);
     });
    }
    // Paginar
    $solicitudes->offset($get->start)
      ->limit($get->length)
      ->orderBy(DB::raw($get->order[0]['column'] + 1), $get->order[0]['dir'])
      ->get();

    // Retornar registros sin los nombres de los campos.
    $registros = [];
    foreach($solicitudes->get()->toArray() as $posicion => $solicitud){
      $registros[] = [
        encrypt($solicitud->id),$solicitud->estudiante,$solicitud->numIdent,
        $solicitud->telefono,$solicitud->nombre,$solicitud->fecha,
        $solicitud->editar
      ];
    }
    // Retornar registros en arreglos.
    return $registros;
  }
}
