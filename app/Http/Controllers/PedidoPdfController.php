<?php

namespace App\Http\Controllers;

use App\Models\LPedido;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PedidoPdfController extends Controller
{
    public function show($id)
    {
        $artsPedi=LPedido::where('pedido_id',$id)->get();
        $numero=$id;
        $pdf = PDF::loadView('pdfs.pedido', compact('artsPedi','numero'));
        return $pdf->stream();
    }

}
