<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LPedido extends Model
{
    use HasFactory;
    protected $fillable = [
        'pedido_id',
        'articuloUser_id',
        'codigo',
        'descripcion',
        'cantidad',
        'precio',
    ];
}
