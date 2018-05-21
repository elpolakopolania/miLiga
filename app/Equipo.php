<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Equipo extends Model
{
    protected $table = 'equipos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','escudo','delegado_id','liga_id','estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

      /**
  * Listar registros
  */
  public function listar($get, $user_id){
    // Organizar datos.
    $datos = [
      //'total' => $this->get_total($get, $user_id),
      'ligas' => $this->get_find($get, $user_id),
      'total' => $this->get_total($get, $user_id)
      
    ];
    return $datos;
  }

  /**
  * Obtener el total de regitros filtrados
  */
  private function get_total($get, $user_id){
    // Obtener el total de los registros filtrados.
    $consulta = DB::table('equipos AS e')
        ->join('grupos_equipos AS gpl', 'gpl.equipo_id', '=', 'e.id')
        ->join('ligas AS l', 'l.id', '=', 'gpl.liga_id')
        ->join('grupos AS g', 'g.id', '=', 'gpl.grupo_id')
        ->select(DB::raw('count(*) as total'))
        ->where('l.usuario_id',$user_id);
    if(!empty(session()->get('ligas'))){
        $ligas_ = [];
        foreach (session()->get('ligas') as $i => $liga) {
            if($liga['estado'] == 'active'){
            $ligas_[] = $liga['id'];
            }
        }
        $consulta->whereIn('l.id',array_values($ligas_));
    }
    // Buscar 
    if(!empty($get->search['value'])){
        $buscar = DB::raw("'".$get->search['value']."%'");
        $buscar_all = DB::raw("'%".$get->search['value']."%'");
        $consulta->where(function($consulta) use ($buscar, $buscar_all){
            $consulta->orWhere('l.nombre', 'like', $buscar)
            ->orWhere('g.nombre', 'like', $buscar)
            ->orWhere('e.nombre', 'like', $buscar);
        });
    }
    $consulta->get();
    // Retornar la cantidad de registros.
    return $consulta->first()->total;
  }

  /**
  * Obtener registros
  */
  private function get_find($get, $user_id){
    // Obtener todas las solicitudes.
    $consulta = DB::table('equipos AS e')
        ->join('grupos_equipos AS gpl', 'gpl.equipo_id', '=', 'e.id')
        ->join('ligas AS l', 'l.id', '=', 'gpl.liga_id')
        ->join('grupos AS g', 'g.id', '=', 'gpl.grupo_id')
        ->where('l.usuario_id',$user_id)
        ->select('gpl.id','l.nombre AS liga','g.nombre AS grupo','e.nombre AS equipo',
        'e.created_at AS creada', 'e.id AS equipo_id','l.id AS liga_id','g.id AS grupo_id');
    if(!empty(session()->get('ligas'))){
      $ligas_ = [];
      foreach (session()->get('ligas') as $i => $liga) {
        if($liga['estado'] == 'active'){
          $ligas_[] = $liga['id'];
        }
      }
      $consulta->whereIn('l.id',array_values($ligas_));
    }
    // Buscar    
    if(!empty($get->search['value'])){
        $buscar = DB::raw("'".$get->search['value']."%'");
        $buscar_all = DB::raw("'%".$get->search['value']."%'");
        $consulta->where(function($consulta) use ($buscar, $buscar_all){
            $consulta->orWhere('l.nombre', 'like', $buscar)
            ->orWhere('g.nombre', 'like', $buscar)
            ->orWhere('e.nombre', 'like', $buscar);
        });
    }
    // Paginar
    $consulta->offset($get->start)
      ->limit($get->length)
      ->orderBy(DB::raw($get->order[0]['column'] + 1), $get->order[0]['dir'])
      ->get();
      
    // Retornar registros sin los nombres de los campos.
    $registros = [];
    foreach($consulta->get()->toArray() as $posicion => $fila){
      $registros[] = [
        encrypt($fila->id), $fila->equipo, $fila->grupo, $fila->liga,
        $fila->creada, $fila->equipo_id, $fila->liga_id, $fila->grupo_id,''
      ];
    }
    // Retornar registros en arreglos.
    return $registros;
  }

}
