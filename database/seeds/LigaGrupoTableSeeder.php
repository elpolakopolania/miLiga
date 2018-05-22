<?php

use Illuminate\Database\Seeder;

class LigaGrupoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear 8 grupos para cada liga
        $ligas = App\Liga::all();
        foreach($ligas as $i => $liga){
            factory(App\LigaGrupo::class, 4)->create([
                'liga_id' => $liga->id
            ]);
        }
    }
}
