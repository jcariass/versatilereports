@extends('layouts.principal')

@section('contenido')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Gestión de plantillas</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_plantillas') }}">Listar plantillas</a>
                            </li>
                            <li class="breadcrumb-item active">Crear plantilla
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
                            <h4 class="card-title">Crear plantilla</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('registrar_plantilla') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre (*)</label>
                                            <input placeholder="Nombre..." type="text" class="@error('nombre') is-invalid @enderror form-control border-primary" name="nombre" id="nombre">
                                            @error('nombre')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="fecha_finalizacion">Fecha finalización (*)</label>
                                            <input type="date" class="@error('fecha_finalizacion') is-invalid @enderror form-control border-primary" name="fecha_finalizacion" id="fecha_finalizacion">
                                            @error('fecha_finalizacion')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="descripcion">Descripcion (*)</label>
                                            <textarea class="@error('descripcion') is-invalid @enderror form-control border-primary" name="descripcion" id="descripcion" cols="30" rows="6"></textarea>
                                            @error('descripcion')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="ciudad">Ciudad (*)</label>
                                            <input placeholder="Ciudad..." type="text" class="@error('ciudad') is-invalid @enderror form-control border-primary" name="ciudad" id="ciudad">
                                            @error('ciudad')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="id_proceso">Proceso (*)</label>
                                            <select class="@error('id_proceso') is-invalid @enderror form-control border-primary" name="id_proceso" id="id_proceso">
                                                <option value="">Seleccion un proceso</option>
                                                @foreach ($procesos as $proceso)
                                                    <option value="{{ $proceso->id_proceso }}">{{ $proceso->nombre }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_proceso')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions text-center">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="la la-save"></i>
                                        Guardar
                                    </button>
                                    <a href="{{ route('listar_plantillas') }}" class="btn btn-warning mr-1 btn-block">
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