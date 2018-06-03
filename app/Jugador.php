<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jugador extends Model
{
    protected $table = 'participantes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'persona_id', 'liga_id', 'tipo_usuario_id', 'num_camiseta','estado'
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
    public function listar_del($get, $user_id)
    {
        // Organizar datos.
        $datos = [
            'datos' => $this->get_find_del($get, $user_id),
            'total' => $this->get_total_del($get, $user_id)
        ];
        return $datos;
    }

    /**
     * Obtener el total de regitros filtrados
     */
    private function get_total_del($get, $user_id)
    {
        // Obtener el total de los registros filtrados.
        $consulta = DB::table('participantes AS p')
            ->join('personas AS per', 'per.id', '=', 'p.persona_id')
            ->join('tipos_documentos AS td', 'td.id', '=', 'per.tipoIdent_id')
            ->join('ligas AS l', 'l.id', '=', 'p.liga_id')
            ->join('equipos AS e', 'e.id', '=', 'p.equipo_id')
            ->where('l.usuario_id', $user_id)
            ->where('p.tipo_usuario_id', 3)
            ->select(DB::raw('count(*) as total'));
        if (!empty(session()->get('ligas'))) {
            $ligas_ = [];
            foreach (session()->get('ligas') as $i => $liga) {
                if ($liga['estado'] == 'active') {
                    $ligas_[] = $liga['id'];
                }
            }
            $consulta->whereIn('l.id', array_values($ligas_));
        }
        // Buscar
        if (!empty($get->search['value'])) {
            $buscar = DB::raw("'" . $get->search['value'] . "%'");
            $buscar_all = DB::raw("'%" . $get->search['value'] . "%'");
            $consulta->where(function ($consulta) use ($buscar, $buscar_all) {
                $consulta->orWhere('l.nombre', 'like', $buscar)
                    ->orWhere('e.nombre', 'like', $buscar)
                    ->orWhere('per.nombres', 'like', $buscar)
                    ->orWhere('per.apellidos', 'like', $buscar)
                    ->orWhere('per.numIdent', 'like', $buscar);
            });
        }
        $consulta->get();
        // Retornar la cantidad de registros.
        return $consulta->first()->total;
    }

    /**
     * Obtener registros
     */
    private function get_find_del($get, $user_id)
    {
        // Obtener registros
        $consulta = DB::table('participantes AS p')
            ->join('personas AS per', 'per.id', '=', 'p.persona_id')
            ->join('tipos_documentos AS td', 'td.id', '=', 'per.tipoIdent_id')
            ->join('ligas AS l', 'l.id', '=', 'p.liga_id')
            ->join('equipos AS e', 'e.id', '=', 'p.equipo_id')
            ->where('l.usuario_id', $user_id)
            ->where('p.tipo_usuario_id', 3)
            ->select(
                'p.id', 'l.nombre AS liga', 'e.nombre AS equipo', 'per.nombres', 'per.apellidos', 'td.codigo', 'per.numIdent', 'p.num_camiseta',
                'per.telefono',  'per.email', 'per.direccion', 'per.fechaNac', 'per.genero', 'p.created_at AS creada',
                'td.id AS tipo_doc_id', 'l.id AS liga_id', 'e.id AS equipo_id', 'per.id AS delegado_id'
            );
        if (!empty(session()->get('ligas'))) {
            $ligas_ = [];
            foreach (session()->get('ligas') as $i => $liga) {
                if ($liga['estado'] == 'active') {
                    $ligas_[] = $liga['id'];
                }
            }
            $consulta->whereIn('l.id', array_values($ligas_));
        }
        // Buscar
        // Buscar
        if (!empty($get->search['value'])) {
            $buscar = DB::raw("'" . $get->search['value'] . "%'");
            $buscar_all = DB::raw("'%" . $get->search['value'] . "%'");
            $consulta->where(function ($consulta) use ($buscar, $buscar_all) {
                $consulta->orWhere('l.nombre', 'like', $buscar)
                    ->orWhere('e.nombre', 'like', $buscar)
                    ->orWhere('per.nombres', 'like', $buscar)
                    ->orWhere('per.apellidos', 'like', $buscar)
                    ->orWhere('per.numIdent', 'like', $buscar);
            });
        }
        // Paginar
        $consulta->offset($get->start)
            ->limit($get->length)
            ->orderBy(DB::raw($get->order[0]['column'] + 1), $get->order[0]['dir'])
            ->get();
        // Retornar registros sin los nombres de los campos.
        $registros = [];
        foreach ($consulta->get()->toArray() as $posicion => $fila) {
            $registros[] = [
                encrypt($fila->id), $fila->liga, $fila->equipo, $fila->nombres, $fila->apellidos, $fila->codigo, $fila->numIdent, $fila->num_camiseta,
                $fila->telefono, $fila->email, $fila->direccion, $fila->fechaNac, $fila->genero, $fila->creada,
                $fila->tipo_doc_id, $fila->liga_id, $fila->equipo_id, encrypt($fila->delegado_id), ''
            ];
        }
        // Retornar registros en arreglos.
        return $registros;
    }

    /**
     * Obtener el delegado a partir del número de documento.
     * @param $num_doc Número de documento del delegado
     */
    public function delgado_doc($num_doc, $user_id)
    {
        $delegado = Db::table('personas AS p')
            ->select('p.id', 'p.numIdent', DB::raw("CONCAT(p.nombres, '', p.apellidos) AS nombre"))
            ->join('participantes AS par', 'par.persona_id', '=', 'p.id')
            ->join('ligas AS l', 'par.liga_id', '=', 'l.id')
            ->where('l.usuario_id', $user_id)
            ->where('par.tipo_usuario_id', 3)
            ->where('p.numIdent', $num_doc)
            ->first();
        return $delegado;
    }
}
