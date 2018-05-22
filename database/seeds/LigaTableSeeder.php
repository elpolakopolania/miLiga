<?php

use Illuminate\Database\Seeder;

class LigaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear 2 Ligas para cada usuario
        $users = App\User::all();
        foreach($users as $i => $user){
            factory(App\Liga::class, 1)->create([
                'usuario_id' => $user->id
            ]);
        }
    }
}
