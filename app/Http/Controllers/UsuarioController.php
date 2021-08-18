<?php

namespace App\Http\Controllers;

use App\Models\Contratista;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Persona;
use App\Models\Rol;
use App\Models\Supervisor;
use App\Models\User;
use DataTables;
use Exception;
use Faker\Provider\ar_JO\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function view_list(){
        return view('gestion_usuarios.listar_usuarios');
    }

    public function view_create(){
        $roles = Rol::all();
        $departamentos = Departamento::all();
        $municipios = Municipio::all();
        return view('gestion_usuarios.crear_usuario', compact('roles', 'departamentos', 'municipios'));
    }

    public function view_edit($id){
        $persona = Persona::join('usuarios', 'usuarios.id_persona', '=', 'personas.id_persona')
            ->join('municipios', 'municipios.id_municipio', '=', 'personas.id_municipio')
            ->select('personas.*', 'usuarios.id_rol', 'municipios.id_departamento')->where('personas.id_persona', '=', $id)->first();
        $departamentos = Departamento::all();
        $municipios = Municipio::all();
        $roles = Rol::all();
        return view('gestion_usuarios.editar_usuario', compact('persona', 'departamentos', 'municipios', 'roles'));
    }

    public function list(){
        if(request()->ajax()){
            $personas = User::join('roles', 'roles.id_rol', '=', 'usuarios.id_rol')
            ->select('usuarios.*', 'roles.nombre as nombre_rol');
            return DataTables::of($personas)
                ->editColumn('estado', function($persona){
                    if ($persona->estado == 1) {
                        return '<div class="badge badge-pill badge-success">Activo</div>';
                    }
                    return '<div class="badge badge-pill badge-danger">Inactivo</div>';
                })
                ->editColumn('Opciones', function($persona){
                    $btn_editar = '<a href="/usuarios/editar/'.$persona->id_persona.'" class="btn btn-versatile_reports">Editar</a>';
                    if ($persona->estado == 1) {
                        // $btn_estado = '<button class="btn btn-danger btn-estados" onclick="cambiar_estado('.$persona->id_persona.', 0)" type="button">Inactivar</button>';
                        $btn_estado = '<a href="/usuarios/cambiar/estado/'.$persona->id_persona.'/0" class="btn btn-danger btn-estados">Inactivar</a>';
                    }else{
                        // $btn_estado = '<button class="btn btn-success btn-estados" onclick="cambiar_estado('.$persona->id_persona.', 1)" type="button">Activar</button>';
                        $btn_estado = '<a href="/usuarios/cambiar/estado/'.$persona->id_persona.'/1" class="btn btn-success btn-estados">Activar</a>';
                    }
                    return $btn_editar . ' ' . $btn_estado;
                })
                ->rawColumns(['estado', 'Opciones'])
                ->make(true);
        }
        return redirect()->route('dashboard');
    }

    public function get_municipios(Request $request){
        if ($request->ajax()) {
            $municipios = Municipio::where('id_departamento', '=', $request->id_departamento)->get();
            foreach($municipios as $mun){
                $municipiosArray[$mun->id_municipio] = $mun->nombre;
            }
            return response()->json($municipiosArray);
        }
        return redirect()->route('listar_usuarios');
    }

    public function save(Request $request){
        $request->validate([
            'tipo_documento' => 'required',
            'documento' => 'required|string|min:7|max:11|unique:usuarios,documento|unique:personas,documento',
            'nombre' => 'required|string|min:3|max:40',
            'primer_apellido' => 'required|string|min:3|max:30',
            'segundo_apellido' => 'nullable|string|min:3|max:30',
            'correo' => 'required|email|max:200|unique:usuarios,email|unique:personas,correo',
            'celular_uno' => 'required|string|size:10',
            'celular_dos' => 'nullable|string|size:10',
            'id_municipio' => 'required|exists:municipios,id_municipio',
            'id_rol' => 'required|exists:roles,id_rol',
            'password' => 'required|string|min:8|max:20|confirmed'
        ]);

        try {
            DB::beginTransaction();
            $persona = Persona::create([
                'documento' => $request->documento,
                'tipo_documento' => $request->tipo_documento,
                'nombre' => $request->nombre,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'correo' => $request->correo,
                'celular_uno' => $request->celular_uno,
                'celular_dos' => $request->celular_dos,
                'estado' => 1,
                'id_municipio' => $request->id_municipio
            ]);

            User::create([
                'tipo_documento' => $persona->tipo_documento,
                'documento' => $persona->documento,
                'password' => Hash::make($request->password),
                'estado' => 1,
                'email' => $persona->correo,
                'id_rol' => $request->id_rol,
                'id_persona' => $persona->id_persona
            ]);

            if($request->id_rol == 2){
                Supervisor::create([
                    'estado' => 1,
                    'id_persona' => $persona->id_persona
                ]);
            }
            DB::commit();
            return redirect()->route('listar_usuarios')->with('success', 'Se registro el usuario.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('listar_usuarios')->withErrors('Ocurrio un error inesperado: '.$e->getMessage());
        }
    }

    public function update(Request $request){
        $request->validate([
            'tipo_documento' => 'required',
            'documento' => 'required|string|min:7|max:11|unique:usuarios,documento,'.$request->id_persona.',id_persona|unique:personas,documento,'.$request->id_persona.',id_persona',
            'nombre' => 'required|string|min:3|max:40',
            'primer_apellido' => 'required|string|min:3|max:30',
            'segundo_apellido' => 'nullable|string|min:3|max:30',
            'correo' => 'required|email|max:200|unique:usuarios,email,'.$request->id_persona.',id_persona|unique:personas,correo,'.$request->id_persona.',id_persona',
            'celular_uno' => 'required|string|size:10',
            'celular_dos' => 'nullable|string|size:10',
            'id_municipio' => 'required|exists:municipios,id_municipio',
            'id_rol' => 'required|exists:roles,id_rol',
        ]);

        $persona = Persona::find($request->id_persona);
        $usuario = User::select('*')->where('id_persona', '=', $persona->id_persona)->first();

        if($persona == null || $usuario == null) return redirect()->route('listar_usuarios')->withErrors('No se encontro la persona');
        
        try {
            DB::beginTransaction();

            if ($request->id_rol != 2) {
                $this->validar_supervisor($persona);
            }

            $persona->update([
                'documento' => $request->documento,
                'tipo_documento' => $request->tipo_documento,
                'nombre' => $request->nombre,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'correo' => $request->correo,
                'celular_uno' => $request->celular_uno,
                'celular_dos' => $request->celular_dos,
                'id_municipio' => $request->id_municipio
            ]);

            $usuario->update([
                'tipo_documento' => $persona->tipo_documento,
                'documento' => $persona->documento,
                'email' => $persona->correo,
                'id_rol' => $request->id_rol,
                'id_persona' => $persona->id_persona
            ]);

            if($request->id_rol == 2){
                $this->crear_actualizar_supervisor($persona);
            }
            
            DB::commit();
            return redirect()->route('listar_usuarios')->with('success', 'Se actualizo el usuario.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('listar_usuarios')->withErrors('Ocurrio un error inesperado: '.$e->getMessage());
        }
    }

    public function cambiar_estado($id, $estado){
        $persona = Persona::find($id);
        $usuario = User::select('*')->where('id_persona', '=', $persona->id_persona)->first();
        if ($usuario->id_rol == 2) {
            $supervisor = Supervisor::select('*')->where('id_persona', '=', $persona->id_persona)->first();
            if ($supervisor == null) return redirect()->route('listar_usuarios')->withErrors('No se encontro la persona');
        }
        if ($usuario == null || $persona == null) return redirect()->route('listar_usuarios')->withErrors('No se encontro la persona');
        
        try {
            DB::beginTransaction();
            $persona->update([
                'estado' => $estado
            ]);
            $usuario->update([
                'estado' => $estado
            ]);
            if ($usuario->id_rol == 2) {
                $supervisor->update([
                    'estado' => $estado
                ]);
            }
            DB::commit();
            return redirect()->route('listar_usuarios')->with('success', 'Se cambio el estado');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('listar_usuarios')->withErrors('Ocurrio un error inesperado: '.$e->getMessage());
        }
    }

    private function crear_actualizar_supervisor($persona){
        $supervisor = Supervisor::select('*')->where('id_persona', '=', $persona->id_persona)->first();
        if ($supervisor != null) {
            $supervisor->update([
                'id_persona' => $persona->id_persona,
                'estado' => $persona->estado
            ]);
        }else{
            Supervisor::create([
                'id_persona' => $persona->id_persona,
                'estado' => $persona->estado
            ]); 
        }  
    }

    private function validar_supervisor($persona){
        $supervisor = Supervisor::select('*')->where('id_persona', '=', $persona->id_persona);
        if ($supervisor != null) {
            $supervisor->update([
                'estado' => '0'
            ]);
        }
    }
}
