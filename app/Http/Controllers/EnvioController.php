<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use App\Models\Pedido;
use Illuminate\Http\Request;

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
        $pedido = Pedido::create([
            'NumeroPedido' => $request['NumeroPedido'] 
        ]);
        $envio = Envio::create([
            'pedido_id' => $pedido['id'],
            'NumeroGuia' => $request['NumeroGuia'],
            'transportadora_id' => $request['transportadora']
        ]);
        return response()->json($envio);
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
