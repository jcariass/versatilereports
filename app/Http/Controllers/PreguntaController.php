<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Formulario;
use App\Models\formulario_pregunta;
use App\Models\Obligacion;
use App\Models\Pregunta;
use Exception;
use Illuminate\Support\Facades\DB;

class PreguntaController extends Controller
{
    private function getFormulario($id){
        $formulario = Formulario::findOrFail($id);
        return $formulario;
    }

    public function view_list($id){
        $formulario = $this->getFormulario($id);
        return view('parametrizaciones.gestion_formularios.gestion_preguntas.listar_preguntas', compact('formulario'));
    }

    public function view_store($id){
        $formulario = $this->getFormulario($id);
        $obligaciones = Obligacion::all();
        return view('parametrizaciones.gestion_formularios.gestion_preguntas.añadir_preguntas', compact("formulario", "obligaciones")); 
    }

    public function view_edit($id){ 
        $pregunta = Pregunta::join('formulario_pregunta', 'formulario_pregunta.id_pregunta', '=', 'preguntas.id_pregunta')
                ->select('formulario_pregunta.id_formulario', 'formulario_pregunta.id_obligacion', 'preguntas.*')
                ->where('formulario_pregunta.id_pregunta', '=', $id)->get();
        $obligaciones = Obligacion::all();
        // dd($pregunta, $formulario, $obligaciones);
        return view('parametrizaciones.gestion_formularios.gestion_preguntas.editar_pregunta', compact("pregunta", "obligaciones"));
    }   

    public function list($id){
        $formulario = Formulario::findOrFail($id);
        $preguntas = Pregunta::select('preguntas.*')
                ->join('formulario_pregunta', 'formulario_pregunta.id_pregunta', '=', 'preguntas.id_pregunta')
                ->where('formulario_pregunta.id_formulario', '=', $formulario->id_formulario)
                ->where('preguntas.estado', '=', '1')->get();
        return DataTables::of($preguntas)
            ->editColumn('Opciones', function($pregunta) use ($formulario){
                $btn_eliminar = '<a href="/formularios/eliminar/pregunta/'.$pregunta->id_pregunta.'/'.$formulario->id_formulario.'" class="btn btn-gris">Eliminar</a>';
                $btn_editar = '<a href="/formularios/editar/pregunta/'.$pregunta->id_pregunta.'" class="btn btn-versatile_reports">Editar</a>';
                return $btn_editar . ' ' . $btn_eliminar; 
            })
            ->rawColumns(['Opciones'])
            ->make(true);
    }

    public function save(Request $request){
        $formulario = Formulario::findOrFail($request->id_formulario);
        if($formulario == null) return redirect()->route('listar_formularios')->withErrors('No se encontro el formulario, por lo tanto no se pudieron asignar las preguntas.');
        try {
            DB::beginTransaction();
            foreach($request->informacion as $item){
                $item = explode(',/,.-_-,,-#p?', $item);
                $pregunta = Pregunta::create([
                    'pregunta_actividad' => $item[1],
                    'pregunta_evidencia' => $item[2]
                ]);

                formulario_pregunta::create([
                    'id_obligacion' => $item[0],
                    'id_pregunta' => $pregunta->id_pregunta,
                    'id_formulario' => $formulario->id_formulario
                ]);
            }
            DB::commit();
            return redirect()->route('preguntas_formulario', ['id' => $formulario->id_formulario])->with('success', 'Se añadieron las preguntas.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('preguntas_formulario', ['id' => $formulario->id_formulario])->withErrors('Ocurrio un error: '.$e->getMessage());
        }
    }

    public function update(Request $request){
        $pregunta = Pregunta::findOrFail($request->id_pregunta);
        $formulario = Pregunta::join('formulario_pregunta', 'formulario_pregunta.id_pregunta', '=', 'preguntas.id_pregunta')
                ->select('formulario_pregunta.id_formulario')
                ->where('formulario_pregunta.id_pregunta', '=', $pregunta->id_pregunta)->get();
        if ($pregunta == null) if($pregunta == null) return redirect()->route('preguntas_formulario', ['id' => $formulario[0]->id_formulario])->withErrors('Ocurrio un error al eliminar la pregunta');
        try {
            $pregunta->update([
                'id_obligacion' => $request->id_obligacion,
                'pregunta_actividad' => $request->pregunta_actividad,
                'pregunta_evidencia' => $request->pregunta_evidencia
            ]);
            return redirect()->route('preguntas_formulario', ['id' => $formulario[0]->id_formulario])->with('success', 'Se modifico con exito.');
        } catch (Exception $e) {
            return redirect()->route('listar_formularios')->withErrors('Ocurrio un error: '.$e->getMessage());
        }
    }

    public function state_update($id_pregunta, $id_formulario){
        $formulario = Formulario::findOrFail($id_formulario);
        if($formulario == null) return redirect()->route('listar_formularios')->withErrors('Ocurrio un error al eliminar la pregunta');
        
        $pregunta = Pregunta::findOrFail($id_pregunta);
        if($pregunta == null) return redirect()->route('preguntas_formulario', ['id' => $formulario->id_formulario])->withErrors('Ocurrio un error al eliminar la pregunta');
        
        try {
            $pregunta->update([
                'estado' => '0'
            ]);
            return redirect()->route('preguntas_formulario', ['id' => $formulario->id_formulario])->with('success', 'Se elimino con exito.');
        } catch (Exception $e) {
            return redirect()->route('listar_formularios')->withErrors('Ocurrio un error: '.$e->getMessage());
        }
    }
}
