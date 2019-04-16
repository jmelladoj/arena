<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    //
    use SoftDeletes;

    protected $table = 'categorias';

    protected $fillable = [ 'nombre', 'valor', 'cupos', 'categoria', 'nombre_categoria' , 'deleted_at'];

    public function Cantidad()
    {
        return $this->hasMany(Atleta::class)->where('pago', 1);
    }

    public function CantidadAtletas()
    {
        return $this->hasMany(Atleta::class);
    }
}
