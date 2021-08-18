<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Formulario;
use App\Models\formulario_pregunta;
use App\Models\Pregunta;
use Exception;
use Illuminate\Support\Facades\DB;

class FormularioController extends Controller
{
    public function view_list(){
        return view('parametrizaciones.gestion_formularios.listar_formularios');
    }

    public function view_create(){
        return view('parametrizaciones.gestion_formularios.crear_formulario');
    }

    public function view_edit($id){
        $formulario = Formulario::findOrFail($id);
        return view('parametrizaciones.gestion_formularios.editar_formulario', compact("formulario"));
    }

    public function list(){
        if(!request()->ajax()){
            // abort('403', 'NO AUTORIZADO');
            return redirect()->route('dashboard');
        }

        $formularios = Formulario::all();
        return DataTables::of($formularios)
                ->editColumn('Opciones', function($formulario){
                    $btn_duplicar = '<a href="/formularios/duplicar/'.$formulario->id_formulario.'" class="btn btn-info">Duplicar</a>';
                    $btn_editar = '<a href="/formularios/editar/'.$formulario->id_formulario.'" class="btn btn-versatile_reports">Editar</a>';
                    $btn_ver = '<a href="/formularios/preguntas/'.$formulario->id_formulario.'" class="btn btn-gris">Ver</a>';
                    return $btn_editar . ' ' . $btn_ver . ' ' . $btn_duplicar;
                })
                ->rawColumns(['Opciones'])
                ->make(true);
    }

    public function save(Request $request){
        $request->validate([
            'nombre' => 'required|string|min:3|max:100'
        ]);
        try {
            Formulario::create([
                'nombre' => $request->nombre
            ]);
            return redirect()->route('listar_formularios')->with("success", "Se creo con éxito");
        } catch (Exception $e) {
            return redirect()->route('listar_formularios')->withErrors('Ocurrio un error inesperado: '.$e->getMessage());
        }  
    }

    public function update(Request $request){
        $request->validate([
            'nombre' => 'required|string|min:3|max:100'
        ]);
        $formulario = Formulario::findOrFail($request->id_formulario);
        try {
            $formulario->update([
                'nombre' => $request->nombre
            ]);
            return redirect()->route('listar_formularios')->with("success", "Se modifico con éxito");
        } catch (Exception $e) {
            return redirect()->route('listar_formularios')->withErrors('Ocurrio un error inesperado: '.$e->getMessage());
        }  
    }

    public function duplicar($id){
        $formulario = Formulario::findOrFail($id);
        if ($formulario == null) {
            return redirect()->route('listar_formularios')->withErrors('No se pudo duplicar el formulario.');
        }
        $preguntas_formulario = formulario_pregunta::select('*')
        ->where('id_formulario', '=', $formulario->id_formulario)->get();
        try {
            DB::beginTransaction();
            $formulario_duplicado = Formulario::create([
                'nombre' => $formulario->nombre . ' (Duplicado)'
            ]);
            if (count($preguntas_formulario) > 0) {
                foreach($preguntas_formulario as $value){
                    $pregunta = Pregunta::select('*')->where('id_pregunta', '=', $value->id_pregunta)
                                ->where('estado', '=', '1')->first();
                    if ($pregunta != null) {
                        $pregunta_duplicada = Pregunta::create([
                            'pregunta_actividad' => $pregunta->pregunta_actividad,
                            'pregunta_evidencia' => $pregunta->pregunta_evidencia,
                        ]);
                        
                        formulario_pregunta::create([
                            'id_obligacion' => $value->id_obligacion,
                            'id_pregunta' => $pregunta_duplicada->id_pregunta,
                            'id_formulario' => $formulario_duplicado->id_formulario
                        ]);
                    }
                }
            }
            DB::commit();
            return redirect()->route('listar_formularios')->with("success", "Se duplico el formulario con éxito");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('listar_formularios')->withErrors('Ocurrio un error inesperado: '.$e->getMessage());
        }
        
    }
}
