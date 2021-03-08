<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Requests\CsvImportRequest;
use App\Models\CsvData;
use App\Models\Articulo;
use App\Models\ArticuloUser;
use App\Models\User;
use Psy\Command\WhereamiCommand;
use Livewire\WithFileUploads;

class Importaciones extends Component
{
    use WithFileUploads;

    public function render()
    {
        return view('livewire.importaciones');
    }
    public function getImportArt()
    {
        return view('livewire.importArt-component');
    }
    public function getImportArtUsr()
    {
        return view('livewire.importArtUsr-component');
    }
    public function parseImportArt(CsvImportRequest $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));
    
        $this->csv_data_file = CsvData::create([
            'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
            'csv_data' => json_encode($data)
        ]);

        $this->processImportArt();
        return redirect('/dashboard');
    }
    public function parseImportArtUsr(CsvImportRequest $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));
    
        $this->csv_data_file = CsvData::create([
            'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
            'csv_data' => json_encode($data)
        ]);

        $this->processImportArtUsr();
            return redirect('/dashboard');
    }
    public function processImportArt()
    {
        $data = CsvData::find($this->csv_data_file->id);
        $csv_data = json_decode($data->csv_data, true);
    
        foreach ($csv_data as $row) {
            $art=Articulo::where('codigo',$row[0])->first();
            if($art==null){
                Articulo::create([
                    'codigo'=>$row[0],
                    'descripcion'=>$row[1],
                    'cantidad'=>$row[2],
                    'precio'=>$row[3]
                ]);
            }else{
                $art->update([
                    'descripcion'=>$row[1],
                    'cantidad'=>$row[2],
                    'precio'=>$row[3]
                ]);
            }
        }
    
    }

    public function processImportArtUsr()
    {
        $data = CsvData::find($this->csv_data_file->id);
        $csv_data = json_decode($data->csv_data, true);
    
        foreach ($csv_data as $row) {
            $usr=User::where('name',$row[0])->first();
            $art=Articulo::where('codigo',$row[1])->first();
            if($art!=null && $usr!=null){
                $artUsr=(ArticuloUser::where('user_id',$usr->id)->where('articulo_id',$art->id))->first();
                if($artUsr==null){
                    ArticuloUser::create([
                        'user_id'=>$usr->id,
                        'articulo_id'=>$art->id,
                        'codigo'=>$row[1],
                        'descripcion'=>$row[2],
                        'cantidad'=>$row[3],
                        'precio'=>$row[4]
                    ]);
                }else{
                    $artUsr->update([
                        'descripcion'=>$row[2],
                        'cantidad'=>$row[3],
                        'precio'=>$row[4]
                    ]);
                }
            }
        }
    
    }
}
