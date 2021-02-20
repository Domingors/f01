<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use App\Models\LPedido;
use Livewire\Component;
use Psy\Command\WhereamiCommand;

class PedidoComponent extends Component
{
    public $idUser;
    public $pedido_id;
    public $itemsPagina=0;
    public $codigo, $descripcion, $cantidad, $precio, $articuloUser_id,$lPedido_id;
    public $busqueda;

    public function render()
    {
        
        $lPedidos=LPedido::where('id','LIKE',"%{$this->busqueda}%")
        ->orWhere('codigo','LIKE',"%{$this->busqueda}%")
        ->orWhere('descripcion','LIKE',"%{$this->busqueda}%")
        ->orWhere('cantidad','LIKE',"%{$this->busqueda}%")
        ->orWhere('precio','LIKE',"%{$this->busqueda}%")
        ->paginate($this->itemsPagina);

        return view('livewire.pedido-component',compact('lPedidos'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        LPedido::create([
            'pedido_id'=>$this->pedido_id,
            'articuloUser_id'=>$this->articuloUser_id,
            'codigo'=>$this->codigo,
            'descripcion'=>$this->descripcion,
            'cantidad'=>$this->cantidad,
            'precio'=>$this->precio
        ]);
        return redirect('Pedidos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(LPedido $lPedi)
    {
        $this->lPedido_id=$lPedi->id;
        $this->pedido_id=$lPedi->pedido_id;
        $this->articuloUser_id=$lPedi->articuloUser_id;
        $this->codigo=$lPedi->codigo;
        $this->descripcion=$lPedi->descripcion;
        $this->cantidad=$lPedi->cantidad;
        $this->precio=$lPedi->precio;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request, $id)
    {
        $lPedi=LPedido::find($id);

        $lPedi->lPedido_id=$request->get('lPedido_id');
        $lPedi->pedido_id=$request->get('pedido_id');
        $lPedi->articuloUser_id=$request->get('articuloUser_id');
        $lPedi->codigo=$request->get('codigo');
        $lPedi->descripcion=$request->get('descripcion');
        $lPedi->cantidad=$request->get('cantidad');
        $lPedi->precio=$request->get('precio');

        $lPedi->save();

        return redirect('Pedidos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lPedi=LPedido::find($id);

        $lPedi->delete();

        return redirect('Pedidos');
    }

}
