<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Asignatura extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'cog_asignatura','nombre','semestre','creditos'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];

  /**
  * lista las asignaturas del estudiante.
  */
  public function asignatura_all($get,$programa_id,$adenda_id){
    // Organizar datos.
    $datos = [
      'total' => $this->get_total_asignaturas($get,$programa_id,$adenda_id),
      'asignaturas' => $this->get_asignaturas($get,$programa_id,$adenda_id)
    ];
    return $datos;
  }

  public function get_asignaturas($get,$programa_id,$adenda_id){
    // Obtener las homologaciones.
    $homologaciones = DB::table('homologaciones')
    ->whereraw('IFNULL(adendas_id, 0) = ' .$adenda_id);
    // Obtener las asignaturas.
    $asignaturas = DB::table('asig_progra AS ap')
      ->join('asignaturas AS a', 'ap.asignatura_id', '=', 'a.id')
      ->join('programas AS p', 'p.id', '=', 'ap.programa_id')
      ->select('ap.id', 'a.cog_asignatura', 'a.nombre', 'a.semestre', 'a.creditos')
      ->whereraw('ap.programa_id = ' . $programa_id);
    // Validar la condición.
    if(!empty($get->search['value'])){
      $buscar = DB::raw("'".$get->search['value']."%'");
      $buscar_all = DB::raw("'%".$get->search['value']."%'");
      $asignaturas->where(function($asignaturas) use ($buscar, $buscar_all){
        $asignaturas->orWhere(DB::raw('a.cog_asignatura'), 'like', $buscar)
        ->orWhere('a.nombre', 'like', $buscar_all);
      });
    }
    // Obtener todos los registros.
    $homo_asig = DB::table(DB::raw('('.$asignaturas->toSql().') as a'))
    ->join(DB::raw('('.$homologaciones->toSql().') as h'),'h.asig_progra_id','=','a.id', 'left outer')
    ->select('a.id', 'a.cog_asignatura', 'a.nombre', 'a.semestre', 'a.creditos', DB::raw('IFNULL(h.nota, 0) as nota'));
    // Paginar
    $homo_asig->offset($get->start)
      ->limit($get->length)
      ->orderBy(DB::raw($get->order[0]['column'] + 1), $get->order[0]['dir']);

    // Retornar registros sin los nombres de los campos.
    $registros = [];
    foreach($homo_asig->get()->toArray() as $posicion => $homo_asig_){
      $registros[] = [
        encrypt($homo_asig_->id),
        $homo_asig_->cog_asignatura,
        $homo_asig_->nombre,
        $homo_asig_->semestre,
        $homo_asig_->creditos,
        $homo_asig_->nota
      ];
    }
    // Retornar la cantidad de registros.
    return $registros;
  }
  /**
  * Obtener el total de regitros filtrados
  */
  private function get_total_asignaturas ($get,$programa_id,$adenda_id){
    // Obtener las homologaciones.
    $homologaciones = DB::table('homologaciones')
    ->whereraw('IFNULL(adendas_id, 0) = ' .$adenda_id);
    // Obtener las asignaturas.
    $asignaturas = DB::table('asig_progra AS ap')
      ->join('asignaturas AS a', 'ap.asignatura_id', '=', 'a.id')
      ->join('programas AS p', 'p.id', '=', 'ap.programa_id')
      ->select('ap.id', 'a.cog_asignatura', 'a.nombre', 'a.semestre', 'a.creditos')
      ->whereraw('ap.programa_id = ' . $programa_id);
    // Validar la condición.
    if(!empty($get->search['value'])){
      $buscar = DB::raw("'".$get->search['value']."%'");
      $buscar_all = DB::raw("'%".$get->search['value']."%'");
      $asignaturas->where(function($asignaturas) use ($buscar, $buscar_all){
        $asignaturas->orWhere(DB::raw('a.cog_asignatura'), 'like', $buscar)
        ->orWhere('a.nombre', 'like', $buscar_all);
      });
    }
    // Obtener todos los registros.
    $total = DB::table(DB::raw('('.$asignaturas->toSql().') as a'))
    ->join(DB::raw('('.$homologaciones->toSql().') as h'),'h.asig_progra_id','=','a.id', 'left outer')
    ->select(DB::raw('count(*) as total'))->get();
    // Retornar la cantidad de registros.
    return $total->first()->total;
  }

}
