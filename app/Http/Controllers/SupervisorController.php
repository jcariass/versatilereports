<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Supervisor;

class SupervisorController extends Controller
{
    public function view_list(){
        return view('parametrizaciones.gestion_supervisores.listar_supervisores');
    }

    public function list(){
        if(request()->ajax()){
            $supervisores = Supervisor::select('personas.*', 'supervisores.estado as estado_supervisor', 'supervisores.id_supervisor')
                ->join('personas', 'personas.id_persona', '=', 'supervisores.id_persona')
                ->get();

            return DataTables::of($supervisores)
                ->editColumn('estado', function($supervisor){
                    if ($supervisor->estado_supervisor == 1) {
                        return '<div class="badge badge-success">Activo</div>';
                    }
                    return '<div class="badge badge-danger">Inactivo</div>';
                })
                ->addColumn('Opciones', function($supervisor){
                    return '<a href="/supervisores/ver/'.$supervisor->id_supervisor.'" class="btn btn-versatile_reports">Ver</a>';
                })
                ->rawColumns(['Opciones', 'estado'])
                ->make(true);
        }
        return redirect()->route('dashboard');
    }

    public function view_more($id){
        $supervisor = Supervisor::join('personas', 'personas.id_persona', '=', 'supervisores.id_persona')
            ->join('municipios', 'municipios.id_municipio', '=', 'personas.id_municipio')
            ->join('departamentos', 'municipios.id_departamento', '=', 'departamentos.id_departamento')
            ->select(
                'personas.*', 'supervisores.id_supervisor', 'supervisores.estado as estado_supervisor',
                'municipios.nombre as nombre_municipio', 'departamentos.nombre as nombre_departamento'
                )
            ->where('supervisores.id_supervisor', '=', $id)->first();
        return view('parametrizaciones.gestion_supervisores.ver_supervisor', compact("supervisor"));
    }
}
