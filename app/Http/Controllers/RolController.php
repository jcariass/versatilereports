<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\menu_rol;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use App\Models\Rol;
use App\Models\Permiso;
use App\Models\permiso_rol;
use Illuminate\Support\Facades\DB;

class RolController extends Controller
{
    public function view_list(){
        return view('parametrizaciones.gestion_roles.listar_roles');
    }

    public function view_create(){
        $permisos = Permiso::all();
        $menu = Menu::all();
        return view('parametrizaciones.gestion_roles.crear_rol', compact("permisos", "menu"));
    }

    public function view_edit($id){
        $rol = Rol::findOrFail($id);
        $permisos = Permiso::all();
        $menu = Menu::all();
        $permisos_rol = permiso_rol::select('*')->where('id_rol', '=', $rol->id_rol)->get();
        $menu_rol = menu_rol::select('*')->where('id_rol', '=', $rol->id_rol)->get();
        return view('parametrizaciones.gestion_roles.editar_rol', 
                compact("rol", "permisos", "menu", "permisos_rol", "menu_rol"));
    }

    public function list(){
        if(request()->ajax()){
            $roles = Rol::all();
            return DataTables::of($roles)
                ->editColumn('Opciones', function($rol){
                    return '<a href="/roles/editar/'.$rol->id_rol.'" class="btn btn-versatile_reports">Editar</a>';;
                })
                ->rawColumns(['Opciones'])
                ->make(true);
        }
        return redirect()->route('dashboard');
    }

    public function save(Request $request){
        $request->validate([
            'nombre' => 'required|string|min:3|max:30'
        ]);

        try {
            DB::beginTransaction();
                $rol = Rol::create([
                    'nombre' => $request->nombre
                ]);

                foreach($request->permisos as $permiso){
                    permiso_rol::create([
                        'id_rol' => $rol->id_rol,
                        'id_permiso' => $permiso
                    ]);
                }

                foreach($request->menu as $menu){
                    menu_rol::create([
                        'id_rol' => $rol->id_rol,
                        'id_menu' => $menu
                    ]);
                }
            DB::commit();
            return redirect()->route('listar_roles')->with("success", "Se creo con éxito");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('listar_roles')->withErrors('Ocurrio un error inesperado: '.$e->getMessage());
        }
    }

    public function update(Request $request){
        $request->validate([
            'nombre' => 'required|string|min:3|max:30'
        ]);
        $rol = Rol::findOrFail($request->id_rol);
        $permisos_rol = permiso_rol::select('*')->where('id_rol', '=', $rol->id_rol)->get();
        $menu_rol = menu_rol::select('*')->where('id_rol', '=', $rol->id_rol)->get();
        if($rol == null) return redirect()->route('listar_roles')->withErrors('No se encontro el rol');
        try {
            DB::beginTransaction();
                $rol->update([
                    'nombre' => $request->nombre
                ]);

                foreach($permisos_rol as $permiso_rol){
                    $permiso_rol->delete();
                }

                foreach($menu_rol as $menu_rol){
                    $menu_rol->delete();
                }

                foreach($request->permisos as $permiso){
                    permiso_rol::create([
                        'id_rol' => $rol->id_rol,
                        'id_permiso' => $permiso
                    ]);
                }

                foreach($request->menu as $menu){
                    menu_rol::create([
                        'id_rol' => $rol->id_rol,
                        'id_menu' => $menu
                    ]);
                }
            DB::commit();
            return redirect()->route('listar_roles')->with("success", "Se modifico con éxito");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('listar_roles')->withErrors('Ocurrio un error inesperado: '.$e->getMessage());
        }
    }

    public static function consulta_permiso_rol($id_permiso, $id_rol){
        $permiso_rol = permiso_rol::select('id_permiso')->where('id_permiso','=' , $id_permiso)->where('id_rol', '=', $id_rol)->get()->toArray();
        return $permiso_rol;
    }

    public static function consulta_menu_rol($id_menu, $id_rol){
        $menu_rol = menu_rol::select('id_menu')->where('id_menu','=' , $id_menu)->where('id_rol', '=', $id_rol)->get()->toArray();
        return $menu_rol;
    }
}
