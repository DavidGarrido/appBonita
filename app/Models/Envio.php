<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    use HasFactory;
    protected $fillable = ['pedido_id', 'NumeroGuia', 'transportadora_id'];

    public function transportadora()
    {
        return $this->belongsTo(Transportadora::class);
    }
    public function Pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
