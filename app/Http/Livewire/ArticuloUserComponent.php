<?php

namespace App\Http\Livewire;

use App\Models\ArticuloUser;
use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\User;
use Livewire\Component;
use Psy\Command\WhereamiCommand;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class ArticuloUserComponent extends Component
{
    public $lArtUser_id;
    public $itemsArtsPagina=0,$itemsArtsUserPagina=0;
    public $codigo, $descripcion, $cantidad, $precio, $articulo_id;
    protected $lArts,$lArtsUser,$usuarios;
    public $idUser;
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
        if($this->idUser==null)
        $this->idUser=Auth::user()->id;

        $this->usuarios=User::all();

        $this->reload();
        $users=$this->usuarios;
        $arts=$this->lArts;
        $artsUser=$this->lArtsUser;
        return view('livewire.articulo-user-component',compact('users','arts','artsUser'));

    }
    public function updatedIdUser()
    {
        $this->reload();
        $users=$this->usuarios;
        $arts=$this->lArts;
        $artsUser=$this->lArtsUser;
        return view('livewire.articulo-user-component',compact('users','arts','artsUser'));
    }
    public function reload(){
        $this->lArts=Articulo::Where('descripcion','LIKE',"%{$this->busquedaArt}%")
        ->paginate($this->itemsArtsPagina);

        $this->lArtsUser=ArticuloUser::where('user_id',$this->idUser)
        ->Where('descripcion','LIKE',"%{$this->busquedaArtUser}%")
        ->paginate($this->itemsArtsUserPagina);

    }
    public function store()
    {
        $this->validate();
        ArticuloUser::create([
            'user_id'=>$this->idUser,
            'articulo_id'=>$this->articulo_id,
            'codigo'=>$this->codigo,
            'descripcion'=>$this->descripcion,
            'cantidad'=>$this->cantidad,
            'precio'=>$this->precio
        ]);
        $this->reset(['codigo', 'descripcion', 'cantidad', 'precio', 'articulo_id','lArtUser_id','accion']);
        return redirect('ArticulosUser');
    }

    public function editArtUser(ArticuloUser $lArtUser)
    {
        $this->lArtUser_id=$lArtUser->id;
        $this->idUser=$lArtUser->user_id;
        $this->articulo_id=$lArtUser->articulo_id;
        $this->codigo=$lArtUser->codigo;
        $this->descripcion=$lArtUser->descripcion;
        $this->cantidad=$lArtUser->cantidad;
        $this->precio=$lArtUser->precio;

        $this->accion='update';
        
    }
    public function editArt(Articulo $art)
    {
//        $this->idUser=Auth::user()->id;

//        $this->user_id=$this->idUser;
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
            'user_id'=>$this->idUser,
            'articuloUser_id'=>$this->articulo_id,
            'codigo'=>$this->codigo,
            'descripcion'=>$this->descripcion,
            'cantidad'=>$this->cantidad,
            'precio'=>$this->precio
        ]);

        $this->reset(['codigo', 'descripcion', 'cantidad', 'precio', 'articulo_id','lArtUser_id','accion']);


        return redirect('ArticulosUser');
    }

    public function destroy($id)
    {
        $lArtUser=ArticuloUser::find($id);

        $lArtUser->delete();
        $this->reset(['codigo', 'descripcion', 'cantidad', 'precio', 'articulo_id','lArtUser_id','accion']);

        return redirect('ArticulosUser');
    }
    public function removeEdit(){
        $this->reset(['codigo', 'descripcion', 'cantidad', 'precio', 'articulo_id','lArtUser_id','accion']);
    }
    public function makePdf()
    {
        $this->lArtsUser=ArticuloUser::where('user_id',1)
        ->get();

        $artsUser=$this->lArtsUser;
        $num=ArticuloUser::where('user_id',1)->count();
        $a="cosa";
          
        $pdf = PDF::loadView('pdfs.articulosUser', compact('artsUser','num','a'));
    
        return $pdf->stream();
//        return $pdf->download('itsolutionstuff.pdf');    
    }

}
