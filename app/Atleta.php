<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atleta extends Model
{
    //
    //use SoftDeletes;

    protected $table = 'atletas';

    protected $fillable = [ 'id', 'run', 'nombre' , 'correo', 'nombre_equipo', 'encargado', 'polera_id', 'categoria_id'];
    
    public function Polera(){
        return $this->belongsTo(Polera::class, 'polera_id');
    }

    public function Categoria(){
        return $this->belongsTo(Categoria::class);
    }
}
