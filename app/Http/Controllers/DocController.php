<?php

namespace App\Http\Controllers;

use App\Imports\ProcesarHojaCálculo;
use App\Models\Envio;
use App\Models\Pedido;
use App\Models\Transportadora;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DocController extends Controller
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
        if ($request->file('documento') != null) {
            $documento = $request->file('documento');
            $name = $documento->getClientOriginalName(); // nombre original nombre

            // $resultado = Excel::load($documento, function($reader){
            //     $reader->sheet(0)->each(function($row){
            //         logger($row);
            //         return response()->json($row);
            //     });
            // });
            $datos = Excel::toArray([], $documento);
            $envios = [];
            foreach ($datos[0] as $index => $fila) {
                if ($index > 0) {
                    $pedido = Pedido::Where('NumeroPedido', $fila[0])->first();
                    if (!isset($pedido->id)) {
                        $pedido = Pedido::create([
                            'NumeroPedido' => $fila[0]
                        ]);
                    }
                    if ($pedido->envios()->count() == 0) {
                        $trans = Transportadora::where('nombre', $fila[2])->first();
                        if (isset($trans->id)) {
                            $envio = Envio::create([
                                'pedido_id' => $pedido->id,
                                'NumeroGuia' => $fila[1],
                                'transportadora_id' => $trans->id
                            ]);
                            $env = Envio::where('id', $envio->id)->with(['transportadora', 'pedido'])->first();
                            array_push($envios, $env);
                        }
                    }
                }
            }
            logger($index);
            $pedidos = Envio::orderBy('id', 'DESC')->limit(10)->get();
            return response()->json($envios);
        } else {
            return 'no hay documento';
        }
        return 'No se ha podido procesar el documento';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
