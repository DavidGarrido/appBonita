<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportadora extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'logo'];

    public function Envios()
    {
        return $this->hasMany(Envio::class);
    }
}
