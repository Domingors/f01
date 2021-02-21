<?php

namespace App\Http\Livewire;

use App\Models\ArticuloUser;
use Illuminate\Http\Request;
use App\Models\LPedido;
use App\Models\Pedido;
use Livewire\Component;
use Psy\Command\WhereamiCommand;
use Illuminate\Support\Facades\Auth;

class PedidoComponent extends Component
{
    public $pedido_id;
    public $itemsPagina=0,$itemsArtsPagina=0;
    public $codigo, $descripcion, $cantidad, $precio, $articuloUser_id,$lPedido_id;
    public $idUser, $idCabPed;
    protected $cPedidos,$lPedidos;
    public $busqueda, $busquedaArt;
    public $accion='store';

    protected $rules=[
        'pedido_id'=>'required',
        'articuloUser_id'=>'required',
        'codigo'=>'required | max:10',
        'descripcion'=>'required | max:50',
        'cantidad'=>'required',
        'precio'=>'required',
    ];

    protected $messages=[
        'pedido_id.required'=>'el identificador de pedido es obligatorio',
        'articuloUser_id.required'=>'el identificador del artículo del usuario es obligatorio',
        'codigo.required'=>'el codigo es obligatorio',
        'codigo.max'=>'el codigo no puede tener mas de 10 caracteres',
        'descripcion.required'=>'la descripcion es obligatoria',
        'descripcion.max'=>'la descripcion no puede tener mas de 50 caracteres',
        'cantidad.required'=>'la cantidad es obligatoria',
        'precio.required'=>'el precio es obligatorio',
    ];

    public function render()
    {
        $this->idUser=Auth::user()->id;

        $this->cPedidos=Pedido::orderBy('id','desc')
        ->where('user_id',$this->idUser)
        ->Where('estado',1)
        ->get();


        if(!empty(($this->cPedidos)[0])){
            $this->idCabPed=($this->cPedidos)[0]->id;

            $this->lPedidos=LPedido::orderBy('id','desc')
            ->Where('pedido_id',$this->idCabPed)
            ->Where('descripcion','LIKE',"%{$this->busqueda}%")
//            ->orwhere('id','LIKE',"%{$this->busqueda}%")
//            ->orWhere('codigo','LIKE',"%{$this->busqueda}%")
//            ->orWhere('cantidad','LIKE',"%{$this->busqueda}%")
//            ->orWhere('precio','LIKE',"%{$this->busqueda}%")
            ->paginate($this->itemsPagina);

            $arts=ArticuloUser::where('user_id',$this->idUser)
            ->Where('descripcion','LIKE',"%{$this->busquedaArt}%")
            ->paginate($this->itemsArtsPagina);
            $lPeds=$this->lPedidos;
            $cPeds=$this->cPedidos;
                return view('livewire.pedido-component',compact('lPeds','cPeds','arts'));
        }else{
            Pedido::create([
                'user_id'=>$this->idUser,
            ]);
            $this->nuevoPedido();
            if(empty($cPedidos[0])){
                $arts=ArticuloUser::where('user_id',$this->idUser)->paginate($this->itemsArtsPagina);
                $lPeds=$this->lPedidos;
                $cPeds=$this->cPedidos;
                return view('livewire.pedido-component',compact('lPeds','cPeds'));
            }    
        }

    }
    public function nuevoPedido(){
        $this->cPedidos=Pedido::orderBy('id','desc')
        ->where('user_id',$this->idUser)
        ->Where('estado',1)
        ->paginate();


        if(!empty($cPedidos[0])){
            $this->idCabPed=($this->cPedidos)[0]->id;

            $this->lPedidos=LPedido::orderBy('id','desc')
            ->Where('pedido_id',$this->idCabPed)
            ->Where('descripcion','LIKE',"%{$this->busqueda}%")
//            ->orwhere('id','LIKE',"%{$this->busqueda}%")
//            ->orWhere('codigo','LIKE',"%{$this->busqueda}%")
//            ->orWhere('cantidad','LIKE',"%{$this->busqueda}%")
//            ->orWhere('precio','LIKE',"%{$this->busqueda}%")
            ->paginate($this->itemsPagina);
        }

    }
    public function store()
    {
        $this->validate();
        LPedido::create([
            'pedido_id'=>$this->pedido_id,
            'articuloUser_id'=>$this->articuloUser_id,
            'codigo'=>$this->codigo,
            'descripcion'=>$this->descripcion,
            'cantidad'=>$this->cantidad,
            'precio'=>$this->precio
        ]);
        $this->reset(['codigo', 'descripcion', 'cantidad', 'precio', 'articuloUser_id','lPedido_id','pedido_id','idUser','accion']);
        return redirect('Pedidos');
    }

    public function edit(LPedido $lPedi)
    {
        $this->lPedido_id=$lPedi->id;
        $this->pedido_id=$lPedi->pedido_id;
        $this->articuloUser_id=$lPedi->articuloUser_id;
        $this->codigo=$lPedi->codigo;
        $this->descripcion=$lPedi->descripcion;
        $this->cantidad=$lPedi->cantidad;
        $this->precio=$lPedi->precio;

        $this->accion='update';
        
    }
    public function editArt(ArticuloUser $art)
    {
//        $this->lPedido_id=$lPedi->id;
        $this->pedido_id=$this->idCabPed;
        $this->articuloUser_id=$art->id;
        $this->codigo=$art->codigo;
        $this->descripcion=$art->descripcion;
//        $this->cantidad=$lPedi->cantidad;
        $this->precio=$art->precio;

        $this->accion='store';
        
    }

    public function update()
    {
        $this->validate();

        $lPedi=LPedido::find($this->lPedido_id);

        $lPedi->update([
            'pedido_id'=>$this->pedido_id,
            'articuloUser_id'=>$this->articuloUser_id,
            'codigo'=>$this->codigo,
            'descripcion'=>$this->descripcion,
            'cantidad'=>$this->cantidad,
            'precio'=>$this->precio
        ]);

        $this->reset(['codigo', 'descripcion', 'cantidad', 'precio', 'articuloUser_id','lPedido_id','pedido_id','idUser','accion']);


        return redirect('Pedidos');
    }
    public function putEstadoTerminado()
    {

        $Ped=Pedido::find($this->idCabPed);

        $Ped->update([
            'estado'=>2
        ]);

        $this->reset(['codigo', 'descripcion', 'cantidad', 'precio', 'articuloUser_id','lPedido_id','pedido_id','idUser','accion']);


        return redirect('Pedidos');
    }

    public function destroy($id)
    {
        $lPedi=LPedido::find($id);

        $lPedi->delete();
        $this->reset(['codigo', 'descripcion', 'cantidad', 'precio', 'articuloUser_id','lPedido_id','pedido_id','idUser','accion']);

        return redirect('Pedidos');
    }
    public function removeEdit(){
        $this->reset(['codigo', 'descripcion', 'cantidad', 'precio', 'articuloUser_id','lPedido_id','pedido_id','idUser','accion']);
    }

}
