<?php

namespace App\Http\Livewire;

use App\Models\ArticuloUser;
use Illuminate\Http\Request;
use App\Models\Articulo;
use Livewire\Component;
use Psy\Command\WhereamiCommand;
use Illuminate\Support\Facades\Auth;

class ArticuloUserComponent extends Component
{
    public $lArtUser_id;
    public $itemsArtsPagina=0,$itemsArtsUserPagina=0;
    public $codigo, $descripcion, $cantidad, $precio, $articulo_id;
    public $user_id;
    public $busquedaArt, $busquedaArtUser;
    public $accion='store';

    protected $rules=[
        'codigo'=>'required | max:10',
        'descripcion'=>'required | max:50',
        'precio'=>'required',
    ];

    protected $messages=[
        'descripcion.required'=>'la descripcion es obligatoria',
        'descripcion.max'=>'la descripcion no puede tener mas de 50 caracteres',
        'precio.required'=>'el precio es obligatorio',
    ];

    public function render()
    {
        $this->idUser=Auth::user()->id;

        $arts=Articulo::Where('descripcion','LIKE',"%{$this->busquedaArt}%")
        ->paginate($this->itemsArtsPagina);

        $artsUser=ArticuloUser::where('user_id',$this->idUser)
        ->Where('descripcion','LIKE',"%{$this->busquedaArtUser}%")
        ->paginate($this->itemsArtsUserPagina);
        return view('livewire.articulo-user-component',compact('arts','artsUser'));

    }
    public function store()
    {
        $this->validate();
        ArticuloUser::create([
            'user_id'=>$this->user_id,
            'articulo_id'=>$this->articulo_id,
            'codigo'=>$this->codigo,
            'descripcion'=>$this->descripcion,
            'cantidad'=>$this->cantidad,
            'precio'=>$this->precio
        ]);
        $this->reset(['codigo', 'descripcion', 'cantidad', 'precio', 'articulo_id','user_id','lArtUser_id','accion']);
        return redirect('ArticulosUser');
    }

    public function editArtUser(ArticuloUser $lArtUser)
    {
        $this->lArtUser_id=$lArtUser->id;
        $this->user_id=$lArtUser->user_id;
        $this->articulo_id=$lArtUser->articulo_id;
        $this->codigo=$lArtUser->codigo;
        $this->descripcion=$lArtUser->descripcion;
        $this->cantidad=$lArtUser->cantidad;
        $this->precio=$lArtUser->precio;

        $this->accion='update';
        
    }
    public function editArt(Articulo $art)
    {
        $this->idUser=Auth::user()->id;

        $this->user_id=$this->idUser;
        $this->articulo_id=$art->id;
        $this->codigo=$art->codigo;
        $this->descripcion=$art->descripcion;
        $this->cantidad=$art->cantidad;
        $this->precio=$art->precio;

        $this->accion='store';
        
    }

    public function update()
    {
        $this->validate();

        $lArtUser=ArticuloUser::find($this->lArtUser_id);

        $lArtUser->update([
            'user_id'=>$this->user_id,
            'articuloUser_id'=>$this->articulo_id,
            'codigo'=>$this->codigo,
            'descripcion'=>$this->descripcion,
            'cantidad'=>$this->cantidad,
            'precio'=>$this->precio
        ]);

        $this->reset(['codigo', 'descripcion', 'cantidad', 'precio', 'articulo_id','user_id','lArtUser_id','accion']);


        return redirect('ArticulosUser');
    }

    public function destroy($id)
    {
        $lArtUser=ArticuloUser::find($id);

        $lArtUser->delete();
        $this->reset(['codigo', 'descripcion', 'cantidad', 'precio', 'articulo_id','user_id','lArtUser_id','accion']);

        return redirect('ArticulosUser');
    }
    public function removeEdit(){
        $this->reset(['codigo', 'descripcion', 'cantidad', 'precio', 'articulo_id','user_id','lArtUser_id','accion']);
    }

}
