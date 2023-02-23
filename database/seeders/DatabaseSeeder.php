<?php

namespace Database\Seeders;

use App\Models\Capitulo;
use App\Models\Categoria;
use App\Models\Obra;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //$this->call(ObraSeeder::class);
        //User::factory(10)->create();

        //$id = Obra::factory(2)->create();
        Categoria::insert([
            ['nombre' => 'Accion'],
            ['nombre' => 'Aventura'],
            ['nombre' => 'Romance'],
            ['nombre' => 'Misterio']
        ]);
        User::factory(20)->create()->each(function ($user) {

            // Create 2 obras for each category
            $obras = Obra::factory(rand(1,5))->make();
            $user->obra()->saveMany($obras)->each(function ($obra) {
                $capitulos = Capitulo::factory($obra->capitulos)->make();
                $obra->capitulo()->saveMany($capitulos);
                $categoria = Categoria::find(random_int(1,4));
                $obra->categorias()->attach($categoria);
            });

        });
    }
}
