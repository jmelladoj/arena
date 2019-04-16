<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Categoria::create([
            'nombre' => 'RX HOMBRES',
            'valor' => 35000,
            'cupos' => 20,
            'categoria' => 1,
            'nombre_categoria' => 'INDIVIDUAL',
            'link_pago' => 'https://www.mercadopago.com/mlc/checkout/pay?pref_id=416359987-d36937fd-2093-4bc6-9351-2deb1bf8731d'
        ]);

        Categoria::create([
            'nombre' => 'RX MUJERES',
            'valor' => 35000,
            'cupos' => 10,
            'categoria' => 1,
            'nombre_categoria' => 'INDIVIDUAL',
            'link_pago' => 'https://www.mercadopago.com/mlc/checkout/pay?pref_id=416359987-84b93cbd-0fcd-4166-8807-ebc5e8b00c79'
        ]);

        Categoria::create([
            'nombre' => 'SCALED HOMBRES',
            'valor' => 35000,
            'cupos' => 30,
            'categoria' => 1,
            'nombre_categoria' => 'INDIVIDUAL',
            'link_pago' => 'https://www.mercadopago.com/mlc/checkout/pay?pref_id=416359987-49f02864-90db-4c34-a71e-41f63b9325f3'
        ]);

        Categoria::create([
            'nombre' => 'SCALED MUJERES',
            'valor' => 35000,
            'cupos' => 20,
            'categoria' => 1,
            'nombre_categoria' => 'INDIVIDUAL',
            'link_pago' => 'https://www.mercadopago.com/mlc/checkout/pay?pref_id=416359987-c17b342e-83e7-4525-8424-eadb428cc980'
        ]);

    
        Categoria::create([
            'nombre' => 'MASTER +35',
            'valor' => 35000,
            'cupos' => 20,
            'categoria' => 1,
            'nombre_categoria' => 'INDIVIDUAL',
            'link_pago' => 'https://www.mercadopago.com/mlc/checkout/pay?pref_id=416359987-926c1f5e-80b7-4e08-a3db-179478826587'
        ]);

        Categoria::create([
            'nombre' => 'BÁSICO HOMBRES',
            'valor' => 70000,
            'cupos' => 40,
            'categoria' => 2,
            'nombre_categoria' => 'DUPLAS',
            'link_pago' => 'https://www.mercadopago.com/mlc/checkout/pay?pref_id=416359987-5c9ab846-a9db-41bf-92dc-bc6e8b19a4c6'
        ]);

        Categoria::create([
            'nombre' => 'BÁSICO MUJERES',
            'valor' => 70000,
            'cupos' => 40,
            'categoria' => 2,
            'nombre_categoria' => 'DUPLAS',
            'link_pago' => 'https://www.mercadopago.com/mlc/checkout/pay?pref_id=416359987-4fd03b32-7cc4-4116-8e16-3793bee3abb3'
        ]);

        Categoria::create([
            'nombre' => 'RX',
            'valor' => 105000,
            'cupos' => 30,
            'categoria' => 3,
            'nombre_categoria' => 'TRÍOS',
            'link_pago' => 'https://www.mercadopago.com/mlc/checkout/pay?pref_id=416359987-67616b2d-8d76-430a-84a9-ca670a65f41d'
        ]);

        Categoria::create([
            'nombre' => 'SCALED',
            'valor' => 105000,
            'cupos' => 30,
            'categoria' => 3,
            'nombre_categoria' => 'TRÍOS',
            'link_pago' => 'https://www.mercadopago.com/mlc/checkout/pay?pref_id=416359987-3daf4058-7897-491e-adb6-e7f56b91141d'
        ]);
    }
}
