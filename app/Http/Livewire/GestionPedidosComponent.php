<?php

namespace App\Http\Livewire;

use App\Models\LPedido;
use App\Models\Pedido;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class GestionPedidosComponent extends Component
{
    public $idUser;
    public $is_admin;
    public $idCabPed;
    public $estado=2;
    public $itemsPagina=0;
    protected $usuarios, $cPedidos, $estados;

    public function render()
    {
        if($this->idUser==null)
        $this->idUser=Auth::user()->id;
        $this->is_admin=Auth::user()->is_admin;

        $this->usuarios=User::all();

        $this->reloadPeds();
        $isAdmin=$this->is_admin;
        $users=$this->usuarios;
        $estads=$this->estados;
        $cPeds=$this->cPedidos;

        return view('livewire.gestion-pedidos-component',compact('isAdmin','users','estads','cPeds'));
    }
    public function updatedIdUser()
    {
        $this->reloadPeds();
        $isAdmin=$this->is_admin;
        $users=$this->usuarios;
        $estads=$this->estados;
        $cPeds=$this->cPedidos;

        return view('livewire.gestion-pedidos-component',compact('isAdmin','users','estads','cPeds'));
    }
    public function updatedEstado()
    {
        $this->reloadPeds();
        $isAdmin=$this->is_admin;
        $users=$this->usuarios;
        $estads=$this->estados;
        $cPeds=$this->cPedidos;

        return view('livewire.gestion-pedidos-component',compact('isAdmin','users','estads','cPeds'));
    }
    public function reloadPeds(){
        $this->estados=[[1,'Incompleto'],[2,'Terminado'],[3,'Entregado']];

        $this->cPedidos=Pedido::orderBy('id','desc')
        ->where('user_id',$this->idUser)
        ->Where('estado',$this->estado)
        ->paginate();

        if(!empty(($this->cPedidos)[0])){
            if($this->idCabPed==null)
            $this->idCabPed=($this->cPedidos)[0]->id;
        }

    }
    public function putEstadoEntregado($id)
    {
        $ped=Pedido::find($id);
        $ped->update([
            'estado'=>3
        ]);
        $this->reloadPeds();
//        return redirect('GestionPedidos');
    }
    public function putEstadoTerminado($id)
    {
        $ped=Pedido::find($id);
        $ped->update([
            'estado'=>2
        ]);
        $this->reloadPeds();
//        return redirect('GestionPedidos');
    }
    public function putEstadoIncompleto($id)
    {
        $ped=Pedido::find($id);
        $ped->update([
            'estado'=>1
        ]);
        $this->reloadPeds();
//        return redirect('GestionPedidos');
    }
    public function makePdf($id)
    {
    }
    public function destroy($id)
    {
        $Pedi=Pedido::find($id);

        $Pedi->delete();
        return redirect('GestionPedidos');
    }
}
