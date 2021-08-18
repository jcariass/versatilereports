<?php

namespace App\Http\Controllers;

use App\Models\Objeto;
use DataTables;
use Exception;
use Illuminate\Http\Request;

class ObjetoController extends Controller
{
    public function view_list(){
        return view('parametrizaciones.gestion_objetos_contratos.listar_obj_contratos');
    }

    public function view_create(){
        return view('parametrizaciones.gestion_objetos_contratos.crear_obj_contrato');
    }
    
    public function view_edit($id){
        $objeto = Objeto::find($id);
        return view('parametrizaciones.gestion_objetos_contratos.editar_obj_contrato', compact('objeto'));
    }


    public function list(){
        if(request()->ajax()){
            $objetos = Objeto::all();
    
            return DataTables::of($objetos)
                ->addColumn('Opciones', function ($objeto) {
                    return '<a style="width: 70px;" href="/objetos/contratos/editar/'.$objeto->id_objeto.'" class="btn btn-versatile_reports">Editar</a>';
                })
                ->rawColumns(['Opciones'])
                ->make(true);
        }
        return redirect()->route('dashboard');
    }

    public function save(Request $request){

        $this->validations($request);

        try {
            Objeto::create([
                'nombre' => $request->nombre,
                'detalle' => $request->detalle
            ]);

            return redirect()->route('listar_objetos_contratos')->withSuccess('Se creo con éxito');
        } catch (Exception $e) {
            return redirect()->route('listar_objetos_contratos')->withErrors('Ocurrio un error\nError: '.$e->getMessage());
        }
    }


    public function update(Request $request){

        $this->validations($request);

        try {
            $objeto = Objeto::find($request->id_objeto);

            if($objeto == null) return redirect()->route('listar_objetos_contratos')->withErrors('No se encontro el objeto de contrato');
        
            $objeto->update([
                'nombre' => $request->nombre,
                'detalle' => $request->detalle
            ]);

            return redirect()->route('listar_objetos_contratos')->withSuccess('Se modifico con éxito');
        } catch (Exception $e) {
            return redirect()->route('listar_objetos_contratos')->withErrors('Ocurrio un error.\nError: '.$e->getMessage());
        }
    }

    public function validations(Request $request){
        $request->validate([
            'nombre' => 'required|string|min:3|max:40',
            'detalle' => 'required|string|min:20|max:600'
        ]);
    }
}
