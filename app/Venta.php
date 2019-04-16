<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    protected $table = 'ventas';

    protected $fillable = [ 'atleta_id', 'orden', 'monto_pago' , 'tipo_tarjeta', 'token'];

    public function Atleta(){
        return $this->belongsTo(Atleta::class);
    }
}
