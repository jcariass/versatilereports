@extends('layouts.principal')

@section('contenido')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Gestión de formularios - Gestión de preguntas</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_formularios') }}">Listar formularios</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('preguntas_formulario', ['id' => $pregunta[0]->id_formulario]) }}">Listar preguntas</a>
                            </li>
                            <li class="breadcrumb-item active">Editar preguntas
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
                            <h4 class="card-title">Editar pregunta</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('actualizar_pregunta') }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" value="{{ $pregunta[0]->id_pregunta }}" name="id_pregunta">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="id_obligacion">Obligacion (*)</label>
                                            <select class="form-control border-primary @error('id_obligacion') is-invalid @enderror" name="id_obligacion" id="id_obligacion">
                                                <option value="">Seleccione la obligación</option>
                                                @foreach ($obligaciones as $obligacion)
                                                    <option value="{{ $obligacion->id_obligacion }}" {{ $obligacion->id_obligacion == $pregunta[0]->id_obligacion ? 'selected' : ''}}>{{ $obligacion->detalle }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pregunta_actividad">Pregunta actividad (*)</label>
                                            <input value="{{ $pregunta[0]->pregunta_actividad }}" placeholder="Pregunta actividad..." type="text" class="@error('pregunta_actividad') is-invalid @enderror form-control border-primary" name="pregunta_actividad" id="pregunta_actividad">
                                            @error('pregunta_actividad')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pregunta_evidencia">Pregunta evidencia (*)</label>
                                            <input value="{{ $pregunta[0]->pregunta_evidencia }}" placeholder="Pregunta evidencia..." type="text" class="@error('pregunta_evidencia') is-invalid @enderror form-control border-primary" name="pregunta_evidencia" id="pregunta_evidencia">
                                            @error('pregunta_evidencia')
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
                                    <a href="{{ route('preguntas_formulario', ['id' => $pregunta[0]->id_formulario]) }}" class="btn btn-warning mr-1 btn-block">
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