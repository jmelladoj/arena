<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Polera;

class PoleraController extends Controller
{
    //
    public function index(Request $request){
        if (!$request->ajax()) return redirect('/');
        
        $poleras = Polera::withCount('cantidad')->withCount('hombres')->withCount('mujeres')->orderBy('id', 'desc')->get();

        return [
            'poleras' => $poleras
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $polera = new Polera();
        $polera->talla = $request->talla;
        $polera->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $polera = Polera::findOrFail($request->id);
        $polera->talla = $request->talla;
        $polera->save();
    }

    public function destroy(Request $request){
        if (!$request->ajax()) return redirect('/');
        
        $polera = Polera::findOrFail($request->id);
        $polera->delete(); 
    }

    public function seleccionarPolera(Request $request){
        if (!$request->ajax()) return redirect('/');
        $poleras = Polera::orderBy('talla')->get();
        return ['poleras' => $poleras];
    }

    public function show(Request $request){
        if (!$request->ajax()) return redirect('/');

        $poleras = Polera::orderBy('talla')->get();
        return [ 'poleras' => $poleras ];
    }
}
