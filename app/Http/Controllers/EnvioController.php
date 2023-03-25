<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return response()->json($request);
        return
            DB::transaction(function () use ($request) {
                // $request->validate([
                //     'NumeroPedido' => 'unique:pedidos,NumeroPedido'
                // ],[
                //     'NumeroPedido.unique' => 'El pedido ya tiene asignado un envio'
                // ]);
                $result = [];
                $pedido = Pedido::where('NumeroPedido',$request['NumeroPedido'])->first();
                $result['isNew'] = false;
                $result['newEnv'] = false;
                if (!isset($pedido->id)) {
                    $pedido = Pedido::create([
                        'NumeroPedido' => $request['NumeroPedido']
                    ]);
                    $result['isNew'] = true;
                }

                if($pedido->envios()->count() == 0 && isset($request['NumeroGuia']) && $request['NumeroGuia'] != ''){
                    Envio::create([
                        'pedido_id' => $pedido['id'],
                        'NumeroGuia' => $request['NumeroGuia'],
                        'transportadora_id' => $request['transportadora']
                    ]);
                    $result['newEnv'] = true;
                }
                $result['pedido'] = $pedido->with('envios')->first();
                return response()->json($result);
            });
    }

    /**
     * Display the specified resource.
     */
    public function show(Envio $envio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Envio $envio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Envio $envio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Envio $envio)
    {
        //
    }
}
