<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Obligacion;
use App\Models\Proceso;
use Carbon\Carbon;
use Exception;

class ObligacionController extends Controller
{
    public function view_list(){
        return view('parametrizaciones.gestion_obligaciones.listar_obligaciones');
    }

    public function view_create(){
        $procesos = Proceso::all();
        return view('parametrizaciones.gestion_obligaciones.crear_obligaciones', compact("procesos"));
    }
    
    public function view_edit($id){
        $obligacion = Obligacion::find($id);
        $procesos = Proceso::all();
        return view('parametrizaciones.gestion_obligaciones.editar_obligaciones', compact("obligacion", "procesos"));
    }

    public function list(){
        if(request()->ajax()){
            $obligaciones = Obligacion::join('procesos', 'procesos.id_proceso', '=', 'obligaciones.id_proceso')
                ->select('obligaciones.*', 'procesos.nombre as nombre_proceso')->get();

            return DataTables::of($obligaciones)
                ->addColumn('Opciones', function ($obligacion) {
                    return '<a href="/obligaciones/editar/'.$obligacion->id_obligacion.'" class="btn btn-versatile_reports">Editar</a>';
                })
                ->rawColumns(['Opciones'])
                ->make(true);
        }
        return redirect()->route('dashboard');
    }

    public function save(Request $request){
        $this->rules($request);
        try {
            $fecha = Carbon::now();
            $fecha_creacion = $fecha->format('Y-m-d');
            $fecha_finalizacion = date('Y-m-d', strtotime($request->fecha_vencimiento));
            Obligacion::create([
                'detalle' => $request->detalle,
                'id_proceso' => $request->id_proceso,
                'fecha_creacion' => $fecha_creacion,
                'fecha_vencimiento' => $fecha_finalizacion
            ]);
            return redirect()->route('listar_obligaciones')->withSuccess('Se creo con éxito');
        } catch (Exception $e) {
            return redirect()->route('listar_obligaciones')->withErrors('Ocurrio un error\nError: '.$e->getMessage());
        }
    }

    public function update(Request $request){
        $this->rules($request);
        $obligacion = Obligacion::find($request->id_obligacion);
        if ($obligacion == null) {
            return redirect()->route('listar_obligaciones')->withErrors('No se encontro la obligacion');
        }
        try {
            $fecha_finalizacion = date('Y-m-d', strtotime($request->fecha_vencimiento));
            $obligacion->update([
                'detalle' => $request->detalle,
                'id_proceso' => $request->id_proceso,
                'fecha_vencimiento' => $fecha_finalizacion
            ]);
            return redirect()->route('listar_obligaciones')->withSuccess('Se modifico con éxito');
        } catch (Exception $e) {
            return redirect()->route('listar_obligaciones')->withErrors('Ocurrio un error\nError: '.$e->getMessage());
        }
    }

    public function rules(Request $request){
        $request->validate([
            'detalle' => 'required',
            'id_proceso' => 'required|exists:procesos,id_proceso',
            'fecha_vencimiento' => 'required|date'
        ]);
    }
}
