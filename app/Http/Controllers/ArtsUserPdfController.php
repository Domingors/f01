<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticuloUser;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class ArtsUserPDFController extends Controller
{
    public function show($id)
    {
        $artsUser=ArticuloUser::where('user_id',$id)->get();
        $user=User::where('id',$id)->get();
        $nombreUser=$user[0]->name;
        $pdf = PDF::loadView('pdfs.articulosUser', compact('artsUser','nombreUser'));
        return $pdf->stream();
//        return $pdf->download('itsolutionstuff.pdf');    
    }
    
}
