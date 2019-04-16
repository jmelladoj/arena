<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Polera extends Model
{
    //
    use SoftDeletes;

    protected $table = 'poleras';

    protected $fillable = [ 'talla', 'total' , 'deleted_at'];

    public function Cantidad()
    {
        return $this->hasMany(Atleta::class)->where('pago', 1);
    }

    public function hombres(){
        return $this->hasMany(Atleta::class)->where('pago', 1)
                    ->whereIn('categoria_id', [1, 3, 5, 6]);
    }

    public function mujeres(){
        return $this->hasMany(Atleta::class)->where('pago', 1)
                    ->whereIn('categoria_id', [2, 4, 7]);
    }
}
