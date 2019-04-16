<?php

use Illuminate\Database\Seeder;
use App\Atleta;

class AtletasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        for($i = 0; $i < 240; $i++){

            $valor = rand(0,50000);

            $correo = ($valor % 2 == 0) ? Str::random(10) . '@gmail.com' : null;
            $equipo = ($valor % 2 == 0) ? Str::random(10) : null;
            $encargado = ($valor % 2 == 0) ? 1 : 0;

            Atleta::create([
                'run' => Str::random(10),
                'nombre' => Str::random(10),
                'correo' => $correo,
                'nombre_equipo' => $equipo,
                'encargado' => $encargado,
                'polera_id' => rand(1,4),
                'categoria_id' => rand(1,9)

            ]);
        }
    }
}
