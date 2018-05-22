<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(LigaTableSeeder::class);
        $this->call(LigaGrupoTableSeeder::class);
        $this->call(EquipoGrupoTableSeeder::class);
    }
}
