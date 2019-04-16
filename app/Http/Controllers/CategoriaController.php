<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

class CategoriaController extends Controller
{
    //
    public function index(Request $request){
        if (!$request->ajax()) return redirect('/');
        
        $categorias = Categoria::withCount('cantidad')->orderBy('id', 'desc')->get();
     
        return [
            'categorias' => $categorias
        ];
    }

    public function show(Request $request){
        if (!$request->ajax()) return redirect('/');

        $categoriasBasicas = Categoria::withCount('cantidadAtletas')->where('categoria', 1)->orderBy('id')->get();
        $categoriasDuplas = Categoria::withCount('cantidadAtletas')->where('categoria', 2)->orderBy('id')->get();
        $categoriasTrios = Categoria::withCount('cantidadAtletas')->where('categoria', 3)->orderBy('id')->get();

        $categoriasBasicas = $categoriasBasicas->reject(function ($categoria, $key) {
            return  $categoria->cantidad_atletas_count >= $categoria->cupos;
        });

        $categoriasDuplas = $categoriasDuplas->reject(function ($categoria, $key) {
            return  $categoria->cantidad_atletas_count >= $categoria->cupos;
        });

        $categoriasTrios = $categoriasTrios->reject(function ($categoria, $key) {
            return  $categoria->cantidad_atletas_count >= $categoria->cupos;
        });

        return [ 'categoriasBasicas' => $categoriasBasicas, 'categoriasDuplas' => $categoriasDuplas, 'categoriasTrios' =>  $categoriasTrios ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nombre_categoria = "";
        
        if($request->categoria == 1){
            $nombre_categoria = 'INDIVIDUAL';
        } else if($request->categoria == 2) {
            $nombre_categoria = 'DUPLAS';
        } else if($request->categoria == 2){
            $nombre_categoria = 'TRÍOS';
        }

        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->valor = $request->valor;
        $categoria->cupos = $request->cupos;
        $categoria->categoria = $request->categoria;
        $categoria->nombre_categoria = $nombre_categoria;
        $categoria->link_pago = $request->link_pago;
        $categoria->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $nombre_categoria = "";

        if($request->categoria == 1){
            $nombre_categoria = 'INDIVIDUAL';
        } else if($request->categoria == 2) {
            $nombre_categoria = 'DUPLAS';
        } else if($request->categoria == 3){
            $nombre_categoria = 'TRÍOS';
        }

        $categoria = Categoria::findOrFail($request->id);
        $categoria->nombre = $request->nombre;
        $categoria->valor = $request->valor;
        $categoria->cupos = $request->cupos;
        $categoria->categoria = $request->categoria;
        $categoria->nombre_categoria = $nombre_categoria;
        $categoria->link_pago = $request->link_pago;
        $categoria->save();
    }

    public function destroy(Request $request){
        $categoria = Categoria::findOrFail($request->id);
        $categoria->delete(); 
    }
}
