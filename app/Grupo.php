<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Grupo extends Model
{
    protected $table = 'grupos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','clasifican'
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
    $total = DB::table('ligas as l')
        ->select(DB::raw('count(*) as total'))
        ->where('l.usuario_id',$user_id);
        if(!empty($get->search['value'])){
            $buscar = DB::raw("'".$get->search['value']."%'");
            $buscar_all = DB::raw("'%".$get->search['value']."%'");
            $total->where(function($total) use ($buscar, $buscar_all){
                $total->orWhere('l.nombre', 'like', $buscar)
                ->orWhere('l.categoria', 'like', $buscar)
                ->orWhere('l.fecha_ini', 'like', $buscar)
                ->orWhere('l.fecha_fin', 'like', $buscar)
                ->orWhere('l.descripcion', 'like', $buscar_all)
                ->orWhere(Db::raw('DATE_FORMAT( l.created_at , "%Y/%m/%d")'), 'like', $buscar);
            });
        }
    $total->get();
    // Retornar la cantidad de registros.
    return $total->first()->total;
  }

  /**
  * Obtener registros
  */
  private function get_find($get, $user_id){
    // Obtener todas las solicitudes.
    $consulta = DB::table('ligas_grupos as lg')
        ->join('ligas as l', 'lg.liga_id', '=', 'l.id')
        ->join('grupos as g', 'lg.grupo_id', '=', 'g.id')
        ->where('l.usuario_id',$user_id)
        ->select('lg.id', 'l.nombre AS liga', 'g.nombre AS grupo', 'g.clasifican', 'g.created_at','l.id AS liga_id', 'g.id AS grupo_id');
    if(!empty(session()->get('ligas'))){
      $ligas_ = [];
      foreach (session()->get('ligas') as $i => $liga) {
        if($liga['estado'] == 'active'){
          $ligas_[] = $liga['id'];
        }
      }
      $consulta->whereIn('lg.liga_id',array_values($ligas_));
    }        
    if(!empty($get->search['value'])){
        $buscar = DB::raw("'".$get->search['value']."%'");
        $buscar_all = DB::raw("'%".$get->search['value']."%'");
        $consulta->where(function($consulta) use ($buscar, $buscar_all){
            $consulta->orWhere('l.nombre', 'like', $buscar)
            ->orWhere('g.nombre', 'like', $buscar);
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
        encrypt($fila->id),$fila->liga,$fila->grupo,$fila->clasifican,
        $fila->created_at,$fila->liga_id,$fila->grupo_id,''
      ];
    }
    // Retornar registros en arreglos.
    return $registros;
  }

  /**
   * Obtener los grupos.
   */
  public function grupos($user_id, $liga_id){
    // Obtener el total de los registros filtrados.
    $consulta = DB::table('grupos AS g')
        ->select('g.*')
        ->join('ligas_grupos AS lg', 'g.id', '=', 'lg.grupo_id') 
        ->join('ligas AS l', 'lg.liga_id', '=', 'l.id') 
        ->where('l.usuario_id',$user_id)
        ->where('l.id',$liga_id)
        ->where('g.estado',1);
    // Retornar la cantidad de registros.
    return $consulta->get();
  }

  /**
   * Obtener los grupos a partir de una liga.
   */
  public function grupos_liga($liga_id){
    // Obtener el total de los registros filtrados.
    $consulta = DB::table('grupos AS g')
        ->select('g.*')
        ->join('ligas_grupos AS lg', 'g.id', '=', 'lg.grupo_id') 
        ->where('lg.liga_id',$liga_id)
        ->where('g.estado',1);
    // Retornar la cantidad de registros.
    return $consulta->get()->toArray();
  }

}
