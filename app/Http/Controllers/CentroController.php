<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Centro;

class CentroController extends Controller
{
    public function view_list(){
        return view('parametrizaciones.gestion_centros.listar_centros');
    }

    public function view_edit($id){
        $centro = Centro::find($id);
        return view('parametrizaciones.gestion_centros.editar_centros', compact("centro"));
    }

    public function view_create(){
        return view('parametrizaciones.gestion_centros.crear_centros');
    }

    public function list(){
        if(request()->ajax()){
            $centros = Centro::all();
            return DataTables::of($centros)
                ->addColumn('Opciones', function ($centro) {
                    return '<a style="width: 70px;" href="/centros/editar/'.$centro->id_centro.'" class="btn btn-versatile_reports">Editar</a>';
                })
                ->rawColumns(['Opciones'])
                ->make(true);
        }
        return redirect()->route('dashboard');
    }

    public function save(Request $request){
        $this->validations($request);

        try {
            Centro::create([
                'nombre' => $request->nombre
            ]);
            return redirect()->route('listar_centros')->withSuccess('Se creo el centro');
        } catch (Exception $e) {
            return redirect()->route('listar_centros')->withErrors('Ocurrio un error\nError: '.$e->getMessage());
        }
    }

    public function update(Request $request){
        $this->validations($request);

        $centro = Centro::find($request->id_centro);

        if ($centro == null) {
            return redirect()->route('listar_centros')->withErrors('El centro no se encontro');
        }
        try {
            $centro->update([
                'nombre' => $request->nombre
            ]);
            return redirect()->route('listar_centros')->withSuccess('Se modifico el centro');
        } catch (Exception $e) {
            return redirect()->route('listar_centros')->withErrors('Ocurrio un error\nError: '.$e->getMessage());
        }
    }

    public function validations(Request $request){
        $request->validate([
            'nombre' => 'required|string|min:3|max:100'
        ]);
    }
}
