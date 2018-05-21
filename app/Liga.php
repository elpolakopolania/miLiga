<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Liga extends Model
{
    protected $table = 'ligas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id','nombre','img','descripcion','fecha_ini','fecha_fin',
        'telefono','direccion','categoria','valor_inscrip','valor_ama',
        'valor_roja','campeon_id','subcampeon_id','reglas','estado'
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
  public function listar_ligas($get, $user_id){
    // Organizar datos.
    $datos = [
      'total' => $this->get_total_ligas($get, $user_id),
      'ligas' => $this->get_ligas($get, $user_id)
    ];
    return $datos;
  }

  /**
  * Obtener el total de regitros filtrados
  */
  private function get_total_ligas ($get, $user_id){
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
  * Obtener las solicitudes.
  */
  private function get_ligas($get, $user_id){
    // Obtener todas las solicitudes.
    $consulta = DB::table('ligas as l')
        ->where('l.usuario_id',$user_id)
        ->select(
            'id',
            'nombre',
            'descripcion',
            'fecha_ini',
            'fecha_fin',
            'telefono',
            'direccion',
            'categoria',
            'valor_inscrip',
            'valor_ama',
            'valor_roja',
            'reglas',
            'created_at'
          );
    if(!empty($get->search['value'])){
        $buscar = DB::raw("'".$get->search['value']."%'");
        $buscar_all = DB::raw("'%".$get->search['value']."%'");
        $consulta->where(function($consulta) use ($buscar, $buscar_all){
            $consulta->orWhere('l.nombre', 'like', $buscar)
            ->orWhere('l.fecha_ini', 'like', $buscar)
            ->orWhere('l.fecha_fin', 'like', $buscar)
            ->orWhere('l.descripcion', 'like', $buscar_all)
            ->orWhere(Db::raw('DATE_FORMAT( l.created_at , "%Y/%m/%d")'), 'like', $buscar);
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
        encrypt($fila->id),
        $fila->nombre,
        $fila->descripcion,
        $fila->fecha_ini,
        $fila->fecha_fin,
        $fila->telefono,
        $fila->direccion,
        $fila->categoria,
        $fila->valor_inscrip,
        $fila->valor_ama,
        $fila->valor_roja,
        $fila->reglas,
        $fila->created_at, 
        ''
      ];
    }
    // Retornar registros en arreglos.
    return $registros;
  }
  
}
