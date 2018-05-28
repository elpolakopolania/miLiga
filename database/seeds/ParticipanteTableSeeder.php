<?php

use Illuminate\Database\Seeder;

class ParticipanteTableSeeder extends Seeder
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
            factory(App\Participante::class, 32)->create([
                'liga_id' => $equipoGrupo->liga_id,
                'equipo_id' => $equipoGrupo->equipo_id,
            ]);
        }
    }
}
