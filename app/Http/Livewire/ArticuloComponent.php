<?php

namespace App\Http\Livewire;

use App\Models\Articulo;
use App\Models\ArticuloUser;
use Illuminate\Http\Request;
use App\Models\LPedido;
use App\Models\Pedido;
use Livewire\Component;
use Psy\Command\WhereamiCommand;
use Illuminate\Support\Facades\Auth;

class ArticuloComponent extends Component
{
    public $idArt;
    public $itemsArtsPagina=0;
    public $codigo, $descripcion, $cantidad, $precio;
    public $busquedaArt;
    public $accion='store';

    protected $rules=[
        'codigo'=>'required | max:10',
        'descripcion'=>'required | max:50',
        'precio'=>'required',
    ];

    protected $messages=[
        'codigo.required'=>'el codigo es obligatorio',
        'codigo.max'=>'el codigo no puede tener mas de 10 caracteres',
        'descripcion.required'=>'la descripcion es obligatoria',
        'descripcion.max'=>'la descripcion no puede tener mas de 50 caracteres',
        'precio.required'=>'el precio es obligatorio',
    ];

    public function render()
    {
        //$this->idUser=Auth::user()->id;

        $arts=Articulo::Where('descripcion','LIKE',"%{$this->busquedaArt}%")
        ->paginate($this->itemsArtsPagina);
        return view('livewire.articulo-component',compact('arts'));

    }
    public function store()
    {
        $this->validate();
        $as=Articulo::where('codigo',$this->codigo)
        ->orWhere('descripcion',$this->descripcion)
        ->get();
        if(!empty($as)){
            Articulo::create([
                'codigo'=>$this->codigo,
                'descripcion'=>$this->descripcion,
                'precio'=>$this->precio
            ]);
            $this->reset(['codigo', 'descripcion', 'cantidad', 'precio', 'idArt','accion']);
            return redirect('Articulos');
        }
    }

    public function edit(Articulo $art)
    {
        $this->idArt=$art->id;
        $this->codigo=$art->codigo;
        $this->descripcion=$art->descripcion;
        $this->cantidad=$art->cantidad;
        $this->precio=$art->precio;

        $this->accion='update';
        
    }

    public function update()
    {
        $this->validate();

        $art=Articulo::find($this->idArt);

        $art->update([
            'codigo'=>$this->codigo,
            'descripcion'=>$this->descripcion,
            'cantidad'=>$this->cantidad,
            'precio'=>$this->precio
        ]);

        $this->reset(['codigo', 'descripcion', 'cantidad', 'precio','idArt','accion']);


        return redirect('Articulos');
    }

    public function destroy($id)
    {
        $art=Articulo::find($id);

        $art->delete();
        $this->reset(['codigo', 'descripcion', 'cantidad', 'precio','idArt','accion']);

        return redirect('Articulos');
    }
    public function removeEdit(){
        $this->reset(['codigo', 'descripcion', 'cantidad', 'precio','idArt','accion']);
    }

}
