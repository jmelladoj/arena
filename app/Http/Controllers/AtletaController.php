<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Atleta;
use App\Categoria;
use Illuminate\Support\Facades\DB;
use App\Venta;
use App\Mail\Inscripcion;
use Illuminate\Support\Facades\Mail;
use Freshwork\Transbank\CertificationBagFactory;
use Freshwork\Transbank\TransbankServiceFactory;

class AtletaController extends Controller
{
    //
    public function index(Request $request){
        if (!$request->ajax()) return redirect('/');

        $atletas = Atleta::where('pago', 1)->with('polera')->with('categoria')->orderBy('id', 'desc')->get();
        $invitados = Atleta::where('pago', 1)->where('invitado', 1)->get()->count();
        $cantidad_atletas = count($atletas);
        $recaudado = (count($atletas) - $invitados) * 35000;

        return [
            'atletas' => $atletas,
            'cantidad_atletas' => $cantidad_atletas,
            'recaudado' => $recaudado
        ];
    }

    public function indexIndividual(Request $request){
        if (!$request->ajax()) return redirect('/');

        $atletas = Atleta::where('pago', 1)->with('categoria')->whereHas("categoria", function($q){ $q->where("categoria", 1); })->with('polera')->orderBy('id', 'desc')->get();

        return [
            'atletas' => $atletas
        ];
    }    

    public function indexDuplas(Request $request){
        if (!$request->ajax()) return redirect('/');

        $atletas = Atleta::where('pago', 1)->with('categoria')->whereHas("categoria", function($q){ $q->where("categoria", 2); })->with('polera')->orderBy('id', 'desc')->get();

        return [
            'atletas' => $atletas
        ];
    }

    public function indexTrios(Request $request){
        if (!$request->ajax()) return redirect('/');

        $atletas = Atleta::where('pago', 1)->with('categoria')->whereHas("categoria", function($q){ $q->where("categoria", 3); })->with('polera')->orderBy('id', 'desc')->get();

        return [
            'atletas' => $atletas
        ];
    }

    public function indexInvitados(Request $request){
        if (!$request->ajax()) return redirect('/');

        $atletas = Atleta::where('invitado', 1)->with('categoria')->with('polera')->orderBy('id', 'desc')->get();

        return [
            'atletas' => $atletas
        ];
    }

    public function indexPendientes(Request $request){
        if (!$request->ajax()) return redirect('/');

        $atletas = Atleta::where('pago', 0)->with('categoria')->with('polera')->orderBy('id', 'desc')->get();


        return [
            'atletas' => $atletas
        ];
    }


    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $categoria = Categoria::findOrFail($request->categoria_id);

        try{
            DB::beginTransaction();

            $categoria = Categoria::findOrFail($request->categoria_id);
            $atleta = new Atleta();

            if($categoria->categoria == 1){
                $atleta = new Atleta();
                $atleta->run = $request->run[0];
                $atleta->nombre = $request->nombre[0];
                $atleta->correo = $request->email;

                if($request->fecha_nacimiento != null){
                    $atleta->fecha_nacimiento = $request->fecha_nacimiento;
                }

                
                $atleta->polera_id = $request->polera_id[0];
                $atleta->categoria_id = $request->categoria_id;
                $atleta->box = $request->box;
                $atleta->save();

                DB::commit();
            } else if($categoria->categoria == 2){

                $atletaUno = new Atleta();
                $atletaUno->run = $request->run[0];
                $atletaUno->nombre = $request->nombre[0];
                $atletaUno->correo = $request->email;
                $atletaUno->nombre_equipo = $request->nombre_equipo;
                $atletaUno->encargado = 1;
                $atletaUno->polera_id = $request->polera_id[0];
                $atletaUno->categoria_id = $request->categoria_id;
                $atletaUno->save();

                $atletaDos = new Atleta();
                $atletaDos->run = $request->run[1];
                $atletaDos->nombre = $request->nombre[1];
                $atletaDos->nombre_equipo = $request->nombre_equipo;
                $atletaDos->polera_id = $request->polera_id[1];
                $atletaDos->categoria_id = $request->categoria_id;
                $atletaDos->save();

                DB::commit();

            } else if($categoria->categoria == 3){

                $atletaUno = new Atleta();
                $atletaUno->run = $request->run[0];
                $atletaUno->nombre = $request->nombre[0];
                $atletaUno->correo = $request->email;
                $atletaUno->nombre_equipo = $request->nombre_equipo;
                $atletaUno->encargado = 1;
                $atletaUno->polera_id = $request->polera_id[0];
                $atletaUno->categoria_id = $request->categoria_id;
                $atletaUno->save();

                $atletaDos = new Atleta();
                $atletaDos->run = $request->run[1];
                $atletaDos->nombre = $request->nombre[1];
                $atletaDos->nombre_equipo = $request->nombre_equipo;
                $atletaDos->polera_id = $request->polera_id[1];
                $atletaDos->categoria_id = $request->categoria_id;
                $atletaDos->save();

                $atletaTres = new Atleta();
                $atletaTres->run = $request->run[2];
                $atletaTres->nombre = $request->nombre[2];
                $atletaTres->nombre_equipo = $request->nombre_equipo;
                $atletaTres->polera_id = $request->polera_id[2];
                $atletaTres->categoria_id = $request->categoria_id;
                $atletaTres->save();

                DB::commit();
            }

            $atletaResponsble = Atleta::where('run', $request->run[0])->get()->last();

            $venta = new Venta();
            $venta->atleta_id = $atletaResponsble->id;
            $venta->monto_pago = $categoria->valor;
            $venta->save();

            DB::commit();

            Mail::to($atletaResponsble->correo)->send(new Inscripcion($atletaResponsble));

        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function storeWebpay(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $categoria = Categoria::findOrFail($request->categoria_id);

        try{
            DB::beginTransaction();

            $categoria = Categoria::findOrFail($request->categoria_id);
            $atleta = new Atleta();

            if($categoria->categoria == 1){
                $atleta = new Atleta();
                $atleta->run = $request->run[0];
                $atleta->nombre = $request->nombre[0];
                $atleta->correo = $request->email;

                if($request->fecha_nacimiento != null){
                    $atleta->fecha_nacimiento = $request->fecha_nacimiento;
                }

                
                $atleta->polera_id = $request->polera_id[0];
                $atleta->categoria_id = $request->categoria_id;
                $atleta->box = $request->box;
                $atleta->save();

                DB::commit();
            } else if($categoria->categoria == 2){

                $atletaUno = new Atleta();
                $atletaUno->run = $request->run[0];
                $atletaUno->nombre = $request->nombre[0];
                $atletaUno->correo = $request->email;
                $atletaUno->nombre_equipo = $request->nombre_equipo;
                $atletaUno->encargado = 1;
                $atletaUno->polera_id = $request->polera_id[0];
                $atletaUno->categoria_id = $request->categoria_id;
                $atletaUno->save();

                $atletaDos = new Atleta();
                $atletaDos->run = $request->run[1];
                $atletaDos->nombre = $request->nombre[1];
                $atletaDos->nombre_equipo = $request->nombre_equipo;
                $atletaDos->polera_id = $request->polera_id[1];
                $atletaDos->categoria_id = $request->categoria_id;
                $atletaDos->save();

                DB::commit();

            } else if($categoria->categoria == 3){

                $atletaUno = new Atleta();
                $atletaUno->run = $request->run[0];
                $atletaUno->nombre = $request->nombre[0];
                $atletaUno->correo = $request->email;
                $atletaUno->nombre_equipo = $request->nombre_equipo;
                $atletaUno->encargado = 1;
                $atletaUno->polera_id = $request->polera_id[0];
                $atletaUno->categoria_id = $request->categoria_id;
                $atletaUno->save();

                $atletaDos = new Atleta();
                $atletaDos->run = $request->run[1];
                $atletaDos->nombre = $request->nombre[1];
                $atletaDos->nombre_equipo = $request->nombre_equipo;
                $atletaDos->polera_id = $request->polera_id[1];
                $atletaDos->categoria_id = $request->categoria_id;
                $atletaDos->save();

                $atletaTres = new Atleta();
                $atletaTres->run = $request->run[2];
                $atletaTres->nombre = $request->nombre[2];
                $atletaTres->nombre_equipo = $request->nombre_equipo; 
                $atletaTres->polera_id = $request->polera_id[2];
                $atletaTres->categoria_id = $request->categoria_id;
                $atletaTres->save();

                DB::commit();
            }

            $atletaResponsble = Atleta::where('run', $request->run[0])->get()->last();

            $orden = $atletaResponsble->id;
            $bag = CertificationBagFactory::integrationWebpayNormal();
            $plus = TransbankServiceFactory::normal($bag);
            $plus->addTransactionDetail($categoria->valor, $orden);
    
            $response = $plus->initTransaction(url('/venta/registrar'), url('/venta/finalizar'));

            $venta = new Venta();
            $venta->atleta_id = $atletaResponsble->id;
            $venta->monto_pago = $categoria->valor;
            $venta->token = $response->token;
            $venta->save();

            DB::commit();

            return [
                'url' => $response->url,
                'token' => $response->token
            ];

        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function registrarInvitado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $atleta = new Atleta();
            $atleta->run = $request->run;
            $atleta->nombre = $request->nombre;
            $atleta->correo = $request->correo;
            $atleta->polera_id = $request->polera_id;
            $atleta->categoria_id = $request->categoria_id;
            $atleta->box = $request->box;
            $atleta->pago = 1;
            $atleta->invitado = 1;
            $atleta->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function actualizarInvitado(Request $request){
        if (!$request->ajax()) return redirect('/');

        $atleta = Atleta::findOrFail($request->id);

        try{
            DB::beginTransaction();

            $atleta->run = $request->run;
            $atleta->nombre = $request->nombre;
            $atleta->correo = $request->correo;
            $atleta->polera_id = $request->polera_id;
            $atleta->categoria_id = $request->categoria_id;
            $atleta->invitado = 1;
            $atleta->box = $request->box;
            $atleta->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $atleta = Atleta::findOrFail($request->id);
        $atleta->nombre = $request->nombre;
        $atleta->correo = $request->correo;
        $atleta->nombre_equipo = $request->nombre_equipo;
        $atleta->polera_id = $request->polera_id;

        if($request->box != null){
            $atleta->box = $request->box;
        }

        $atleta->save();
    }

    public function destroy(Request $request){
        $atleta = Atleta::findOrFail($request->id);
        $atleta->delete(); 
    }
}
