<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticuloUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'articulo_id',
        'codigo',
        'descripcion',
        'cantidad',
        'precio',
    ];
}
