<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Participante extends Model
{
    protected $table = 'participantes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'persona_id','liga_id','tipo_usuario_id','estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Obtener el delegado a partir del número de documento.
     * @param $num_doc Número de documento del delegado
     */
    public function delgado_doc($num_doc, $user_id){
        $delegado = Db::table('personas AS p')
            ->select('p.id', 'p.numIdent', DB::raw("CONCAT(p.nombres, '', p.apellidos) AS nombre"))
            ->join('participantes AS par', 'par.persona_id', '=', 'p.id')
            ->join('ligas AS l', 'par.liga_id', '=', 'l.id')
            ->where('l.usuario_id', $user_id)
            ->where('par.tipo_usuario_id', 4)
            ->where('p.numIdent', $num_doc)
            ->first();
        return $delegado;
    }
}
