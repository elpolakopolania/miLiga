<?php

use Illuminate\Database\Seeder;

class EquipoGrupoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear 8 equipos para cada grupo.
        $ligasGrupos = App\LigaGrupo::all();
        foreach($ligasGrupos as $i => $ligaGrupo){
            factory(App\EquipoGrupo::class, 8)->create([
                'liga_id' => $ligaGrupo->liga_id,
                'grupo_id' => $ligaGrupo->grupo_id
            ]);
        }
    }
}
