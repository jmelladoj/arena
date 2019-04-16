<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Polera;

class PolerasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Polera::create(['talla' => 'S']);
        Polera::create(['talla' => 'M']);
        Polera::create(['talla' => 'L']);
        Polera::create(['talla' => 'XL']);
    }
}
