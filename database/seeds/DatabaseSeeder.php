<?php

use Illuminate\Database\Seeder;
use App\Categoria;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        User::create([
            'name' => 'Juan Mellado',
            'email' => 'sebastian@torneoarena.cl',
            'password' => bcrypt('sebastianarena2019')
        ]);

        $this->call(CategoriaTableSeeder::class);
        $this->call(PolerasTableSeeder::class);
        //$this->call(AtletasTableSeeder::class);
    }
}
