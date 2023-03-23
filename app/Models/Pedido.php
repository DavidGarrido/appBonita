<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable = ['NumeroPedido'];

    public function Envios()
    {
        return $this->hasMany(Envio::class)->with('transportadora');
    }
}
