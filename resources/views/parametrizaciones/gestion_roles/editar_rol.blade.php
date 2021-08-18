@extends('layouts.principal')

@section('contenido')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Gestión de roles</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_roles') }}">Listar roles</a>
                            </li>
                            <li class="breadcrumb-item active">Editar rol
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body"> 
            <!-- Inicio tabla hoverable -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Editar rol</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="form_edit_rol" action="{{ route('actualizar_rol') }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id_rol" value="{{ $rol->id_rol }}">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="nombre">Nombre (*)</label>
                                            <input value="{{ $rol->nombre }}" placeholder="Nombre..." type="text" class="@error('nombre') is-invalid @enderror form-control border-primary" name="nombre" id="nombre">
                                            @error('nombre')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Permisos (*)</label>
                                        @foreach ($permisos as $permiso)
                                            @php
                                                $permiso_rol = \App\Http\Controllers\RolController::consulta_permiso_rol($permiso->id_permiso, $rol->id_rol);
                                            @endphp
                                            @if (count($permiso_rol) > 0)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" value="{{ $permiso->id_permiso }}" name="permisos[]" {{ $permiso->id_permiso == $permiso_rol[0]["id_permiso"] ? 'checked' : '' }}><label class="form-check-label">{{ $permiso->nombre }}</label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" value="{{ $permiso->id_permiso }}" name="permisos[]"><label class="form-check-label">{{ $permiso->nombre }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Menu (*)</label>
                                        @foreach ($menu as $menu)
                                            @php
                                                $menu_rol = \App\Http\Controllers\RolController::consulta_menu_rol($menu->id_menu, $rol->id_rol);
                                            @endphp
                                            @if (count($menu_rol) > 0)
                                                <div class="form-check">
                                                    <input {{ $menu->id_menu == $menu_rol[0]["id_menu"] ? 'checked' : '' }} type="checkbox" class="form-check-input" value="{{ $menu->id_menu }}" name="menu[]"><label class="form-check-label">{{ $menu->nombre }}</label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" value="{{ $menu->id_menu }}" name="menu[]"><label class="form-check-label">{{ $menu->nombre }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-actions text-center">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="la la-save"></i>
                                        Guardar
                                    </button>
                                    <a href="{{ route('listar_roles') }}" class="btn btn-warning mr-1 btn-block">
                                        <i class="la la-close"></i>
                                        Cancelar
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin tabla hoverable -->
        </div>
    </div>
</div>
@endsection


@section('javascript')
<!-- Inicio de validación/////////////////////////////////////////////////////////////////////////////////////-->
<script>
    $(document).ready(function() {

        /* Metodo para letras */
        jQuery.validator.addMethod("letras", function(value, element) {
            return this.optional(element) || /^[a-zA-Z]+(([\'\,\.\-][a-zA-Z])?[ a-zA-Z]*)*$/.test(value);
        });

        $("#form_edit_rol").validate({

            onfocusin: function(element) { $(element).valid(); },
            onfocusout: function(element) { $(element).valid(); },
            onclick: function(element) { $(element).valid(); },
            onkeyup: function(element) { $(element).valid(); },

            rules: {
                nombre : {
                required: true,
                letras: true,
                minlength: 3,
                maxlength: 30
                }
            },
            messages : {
                nombre: {
                    required: "Este campo es obligatorio",
                    letras: "Solo se admiten letras",
                    minlength: "El nombre del rol debe tener minimo 3 caracteres",
                    maxlength: "El nombre del rol puede tener máximo 30 caracteres"
                }
            }
        });
});
</script>
<!-- Inicio de validación/////////////////////////////////////////////////////////////////////////////////////-->
@endsection