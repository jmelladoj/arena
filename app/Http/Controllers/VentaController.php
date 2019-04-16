<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use App\Atleta;
use Freshwork\Transbank\CertificationBagFactory;
use Freshwork\Transbank\TransbankServiceFactory;
use Freshwork\Transbank\RedirectorHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
Use App\Mail\FinalizacionMail;
use App\Mail\Anular;

class VentaController extends Controller
{
    //
    public function index(Request $request){
        $titulo = "!! LO SENTIMOS ¡¡";
        $texto =  "HEMOS TENIDO ALGUNOS <br> INCONVENIENTES PARA RECIBIR <br> TU PAGO. INTÉNTELO NUEVAMENTE.";

        $venta = Venta::where('token', $request->token_ws)->first();

        if($venta != null){
            if($venta->tipo_tarjeta != null){
                $titulo = "!! MUCHAS GRACIAS ¡¡";
                $texto = "YA ESTAS INSCRITO EN EL <br> TORNEO ARENA, NO OLVIDES SEGUIR <br> NUESTRAS REDES SOCIALES PARA NO <br> PERDER DE NINGÚN DETALLE O SORPRESA.";
            }
        }

        return view('fin')->with(compact('titulo', 'texto'));
    }

    public function indexVentas(Request $request){
        if (!$request->ajax()) return redirect('/');
        
        $ventas = Venta::with('atleta')->orderBy('id', 'desc')->get();

        foreach ($ventas as $venta)
        {     
            $categoria = $venta->atleta->categoria->nombre_categoria . ' ' . $venta->atleta->categoria->nombre;
            $venta =  array_add($venta, 'categoria', $categoria);
        }

        return [
            'ventas' => $ventas
        ];
    }

    public function store(Request $request)
    {
        try{
            DB::beginTransaction();

            //Buscar primero el proveedor a modificar
            $bag = CertificationBagFactory::integrationWebpayNormal();
            $plus = TransbankServiceFactory::normal($bag);
            $response = $plus->getTransactionResult();
            $venta = Venta::where('token', $request->token_ws)->first();
            $atleta = Atleta::find($venta->atleta_id);

            if($response->detailOutput->responseCode == 0){
                $tipoTarjeta = "CRÉDITO";

                if($response->detailOutput->paymentTypeCode == 'VD'){
                    $tipoTarjeta = 'DÉBITO';
                }

                $venta->tipo_tarjeta = $tipoTarjeta;
                $venta->save();

                if($atleta->nombre_equipo == null){
                    $atleta->pago = 1;
                    $atleta->save();

                    DB::commit();
                } else {
                    $atletas = Atleta::where('nombre_equipo', $atleta->nombre_equipo)->where('created_at', $atleta->created_at)->get();

                    foreach($atletas AS $atleta){
                        $atleta->pago = 1;
                        $atleta->save();
                    }

                    DB::commit();
                }
            } else {

                if($atleta->nombre_equipo == null){
                    $atleta->pago = 1;
                    $atleta->delete();

                    DB::commit();
                } else {
                    $atletas = Atleta::where('nombre_equipo', $atleta->nombre_equipo)->get();

                    foreach($atletas AS $atleta){
                        $atleta->pago = 1;
                        $atleta->delete();
                    }

                    DB::commit();
                }

                DB::commit();

            }

            $plus->acknowledgeTransaction();
            echo RedirectorHelper::redirectBackNormal($response->urlRedirection);

        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function confirmar(Request $request){
        try{
            DB::beginTransaction();
        
            $venta = Venta::findOrFail($request->id);
            $venta->estado = 1;
            $venta->save();

            $atletaResponsable = Atleta::where('id', $venta->atleta_id)->first();

            if($atletaResponsable->categoria_id <= 5){
                $atletaResponsable->pago = 1;
                $atletaResponsable->save();

                DB::commit();
            } else {
                $atletas = Atleta::where('nombre_equipo', $atletaResponsable->nombre_equipo)->get();

                foreach($atletas AS $atleta){
                    $atleta->pago = 1;
                    $atleta->save();
                }

                DB::commit();
            }
    
            Mail::to($atletaResponsable->correo)->send(new FinalizacionMail($atletaResponsable));
            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function anular(Request $request){
        try{
            DB::beginTransaction();
        
            $venta = Venta::findOrFail($request->id);
            $venta->estado = 0;
            $venta->save();
    
            $atleta = Atleta::where('id', $venta->atleta_id)->first();

            if($atleta->nombre_equipo == null){
                $atleta->pago = 0;
                $atleta->save();

                DB::commit();
            } else {
                $atletas = Atleta::where('nombre_equipo', $atleta->nombre_equipo)->get();

                foreach($atletas AS $atleta){
                    $atleta->pago = 0;
                    $atleta->save();
                }

                DB::commit();
            }
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function eliminarAtleta(Request $request){
        try{
            DB::beginTransaction();
            
            $venta = Venta::findOrFail($request->id);
            
            $id = $venta->atleta_id;

            $venta->delete();

            $atleta = Atleta::where('id', $id)->first();

            if($atleta->categoria_id <= 5){
                Mail::to($atleta->correo)->send(new Anular($atleta));
                $atleta->delete();
            } else if($atleta->categoria_id > 4) {
                Mail::to($atleta->correo)->send(new Anular($atleta));
                $atletas = Atleta::where('nombre_equipo', $atleta->nombre_equipo)->where('created_at', $atleta->created_at)->get();

                foreach($atletas AS $atleta){
                    $atleta->delete();
                }
            }

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function eliminarVenta(Request $request){
        try{
            DB::beginTransaction();
            
            $venta = Venta::findOrFail($request->id);
            
            $id = $venta->atleta_id;

            $venta->delete();

            $atleta = Atleta::where('id', $id)->first();

            if($atleta->categoria_id <= 5){
                $atleta->delete();
            } else if($atleta->categoria_id > 4) {
                $atletas = Atleta::where('nombre_equipo', $atleta->nombre_equipo)->where('created_at', $atleta->created_at)->get();

                foreach($atletas AS $atleta){
                    $atleta->delete();
                }
                
            }

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
}