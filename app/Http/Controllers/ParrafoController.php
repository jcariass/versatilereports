<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use DataTables;
use App\Models\Parrafo;
use App\Models\Plantilla;

class ParrafoController extends Controller
{
    public function view_list($id){
        $plantilla = Plantilla::findOrFail($id);
        return view('parametrizaciones.gestion_plantillas.gestion_parrafos.listar_parrafos', compact('plantilla'));
    }
    
    public function view_create($id){
        $plantilla = Plantilla::findOrFail($id);
        return view('parametrizaciones.gestion_plantillas.gestion_parrafos.añadir_parrafos', compact('plantilla'));
    }

    public function view_edit($id){
        $parrafo = Parrafo::findOrFail($id);
        // $plantilla = Plantilla::where('id_plantilla', '=', $parrafo->id_plantilla)->first();
        return view('parametrizaciones.gestion_plantillas.gestion_parrafos.editar_parrafo', compact('parrafo'));
    }

    public function list($id){
        if(request()->ajax()){
            $parrafos = Parrafo::where('id_plantilla', '=', $id)->where('estado', '=', '1')->get();
            return DataTables::of($parrafos)
                ->editColumn('Opciones', function($parrafos){
                    $btn_editar = '<a href="/plantillas/parrafos/editar/'.$parrafos->id_parrafo.'" class="btn btn-versatile_reports">Editar</a>';
                    $btn_delete = '<a href="/plantillas/parrafos/eliminar/'.$parrafos->id_parrafo.'" class="btn btn-gris">Eliminar</a>';
                    return $btn_editar . ' ' . $btn_delete;
                })
                ->rawColumns(['Opciones'])
                ->make(true);
        }
        return redirect()->route('dashboard');
    }

    public function save(Request $request){
        $plantilla = Plantilla::findOrFail($request->id_plantilla);
        if($plantilla == null) return redirect()->route('listar_plantillas')->withErrors('No se encontro la plantilla, por lo tanto no se pudieron asignar los parrafos.');
        try {
            DB::beginTransaction();
            // dd($request->informacion);
            foreach($request->informacion as $item){
                $item = explode(',/,.-_-,,-#p?', $item);
                // dd($item);
                Parrafo::create([
                    'texto' => $item[0],
                    'numero_parrafo' => $item[1],
                    'id_plantilla' => $plantilla->id_plantilla
                ]);
            }
            DB::commit();
            return redirect()->route('listar_parrafos', ['id' => $plantilla->id_plantilla])->with('success', 'Se añadieron los parrafos.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('listar_parrafos', ['id' => $plantilla->id_plantilla])->withErrors('Ocurrio un error: '.$e->getMessage());
        }
    }

    public function update(Request $request){
        $parrafo = Parrafo::findOrFail($request->id_parrafo);
        if($parrafo == null) return redirect()->route('listar_plantillas')->withErrors('No se pudo editar el parrafo, intente de nuevo.');
        try {
            $parrafo->update([
                'texto' => $request->texto,
                'numero_parrafo' => $request->numero_parrafo,
            ]);
            return redirect()->route('listar_parrafos', ['id' => $parrafo->id_plantilla])->with('success', 'Se modifico el parrafo.');
        } catch (Exception $e) {
            return redirect()->route('listar_parrafos', ['id' => $parrafo->id_plantilla])->withErrors('Ocurrio un error: '.$e->getMessage());
        }
    }
    
    public function update_state($id){
        $parrafo = Parrafo::findOrFail($id);
        if($parrafo == null) return redirect()->route('listar_plantillas')->withErrors('No se pudo editar el parrafo, intente de nuevo.');
        try {
            $parrafo->update([
                'estado' => 0
            ]);
            return redirect()->route('listar_parrafos', ['id' => $parrafo->id_plantilla])->with('success', 'Se elimino el parrafo.');
        } catch (Exception $e) {
            return redirect()->route('listar_parrafos', ['id' => $parrafo->id_plantilla])->withErrors('Ocurrio un error: '.$e->getMessage());
        }
    }
}
