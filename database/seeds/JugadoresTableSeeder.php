<?php

use Illuminate\Database\Seeder;

class JugadoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear 1 delegado para cada equipo
        $equiposGrupos = App\EquipoGrupo::all();
        foreach($equiposGrupos as $i => $equipoGrupo){
            factory(App\Participante::class, 11)->create([
                'liga_id' => $equipoGrupo->liga_id,
                'equipo_id' => $equipoGrupo->equipo_id,
                'tipo_usuario_id' => 3
            ]);
        }
    }
}
