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
        factory(App\Liga::class, 20)->create();
    }
}
