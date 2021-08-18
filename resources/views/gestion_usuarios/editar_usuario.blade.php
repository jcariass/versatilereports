@extends('layouts.principal')

@section('contenido')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Gestión de usuarios</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_usuarios') }}">Listar usuarios</a>
                            </li>
                            <li class="breadcrumb-item active">Editar usuario
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
                            <h4 class="card-title">Editar usuario</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('actualizar_usuario') }}" method="post">
                                @method('put')
                                @csrf
                                <input type="hidden" name="id_persona" value="{{ $persona->id_persona }}">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="tipo_documento">Tipo documento (*)</label>
                                            <select class="@error('tipo_documento') is-invalid @enderror form-control border-primary" name="tipo_documento" id="tipo_documento">
                                                <option value="">Seleccione</option>
                                                <option value="CC" {{ $persona->tipo_documento == 'CC' ? 'selected' : '' }}>Cedula Ciudadania</option>
                                                <option value="CE" {{ $persona->tipo_documento == 'CE' ? 'selected' : '' }}>Cedula Extranjera</option>
                                            </select>
                                            @error('tipo_documento')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="documento">Documento (*)</label>
                                            <input value="{{ $persona->documento }}" placeholder="Documento..." type="text" class="@error('documento') is-invalid @enderror form-control border-primary" name="documento" id="documento">
                                            @error('documento')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre (*)</label>
                                            <input value="{{ $persona->nombre }}" placeholder="Nombre..." type="text" class="@error('nombre') is-invalid @enderror form-control border-primary" name="nombre" id="nombre">
                                            @error('nombre')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="primer_apellido">Primer apellido (*)</label>
                                            <input value="{{ $persona->primer_apellido }}" placeholder="Primer apellido..." type="text" class="@error('primer_apellido') is-invalid @enderror form-control border-primary" name="primer_apellido" id="primer_apellido">
                                            @error('primer_apellido')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="segundo_apellido">Segundo apellido</label>
                                            <input value="{{ $persona->segundo_apellido }}" placeholder="Segundo apellido..." type="text" class="@error('segundo_apellido') is-invalid @enderror form-control border-primary" name="segundo_apellido" id="segundo_apellido">
                                            @error('segundo_apellido')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="correo">Correo personal (*)</label>
                                            <input value="{{ $persona->correo }}" placeholder="Correo personal..." type="text" class="@error('correo') is-invalid @enderror form-control border-primary" name="correo" id="correo">
                                            @error('correo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="celular_uno">Celular uno (*)</label>
                                            <input value="{{ $persona->celular_uno }}" placeholder="Celular uno..." type="text" class="@error('celular_uno') is-invalid @enderror form-control border-primary" name="celular_uno" id="celular_uno">
                                            @error('celular_uno')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="celular_dos">Celular dos</label>
                                            <input value="{{ $persona->celular_dos }}" placeholder="Celular dos..." type="text" class="@error('celular_dos') is-invalid @enderror form-control border-primary" name="celular_dos" id="celular_dos">
                                            @error('celular_dos')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Lugar expedición documento / Departamento / Municipio (*)</label>
                                            <div class="d-flex justify-content-between">
                                                <select id="id_departamento" class="form-control border-primary">
                                                    <option value="">Seleccion un departamento</option>
                                                    @foreach ($departamentos as $item)
                                                        <option value="{{ $item->id_departamento }}" {{ $persona->id_departamento == $item->id_departamento ? 'selected' : '' }}>{{ $item->nombre }}</option>
                                                    @endforeach
                                                </select>
                                                <select name="id_municipio" id="id_municipio" class="@error('id_municipio') is-invalid @enderror form-control border-primary">
                                                    @foreach ($municipios as $item)
                                                        <option value="{{ $item->id_municipio }}" {{ $persona->id_municipio == $item->id_municipio ? 'selected' : '' }}>{{ $item->nombre }}</option>
                                                    @endforeach
                                                </select>
                                                @error('id_municipio')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="id_rol">Rol (*)</label>
                                            <select name="id_rol" id="id_rol" class="@error('id_rol') is-invalid @enderror form-control border-primary">
                                                <option value="">Seleccione</option>
                                                @foreach ($roles as $item)
                                                    <option value="{{ $item->id_rol }}" {{ $persona->id_rol == $item->id_rol ? 'selected' : '' }}>{{ $item->nombre }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_rol')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions text-center">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="la la-save"></i>
                                        Actualizar
                                    </button>
                                    <a href="{{ route('listar_usuarios') }}" class="btn btn-warning mr-1 btn-block">
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
    <script>
        $(document).ready(function(){
            $('#id_departamento').on('change', function(){
                let id_departamento = $(this).val();
                if($.trim(id_departamento) != null){
                    $.get('/usuarios/listar/municipios', {id_departamento: id_departamento}, function(municipios){
                        $('#id_municipio').empty();
                        $('#id_municipio').append("<option value=''>Seleccione el municipio</option>");
                        $.each(municipios, function (id, nombre){
                            $('#id_municipio').append("<option value='"+ id +"'>"+ nombre +"</option>")
                        })
                    })
                }
            })
        });
    </script>
@endsection