@extends('layouts.principal')

@section('contenido')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Gestión de formularios</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_formularios') }}">Listar formularios</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('preguntas_formulario', ['id' => $formulario->id_formulario]) }}">Listar preguntas</a>
                            </li>
                            <li class="breadcrumb-item active">Añadir preguntas
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
                            <h4 class="card-title">{{ $formulario->nombre }} - Añadir preguntas</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('registrar_preguntas') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $formulario->id_formulario }}" name="id_formulario">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="formulario">Formulario (*)</label>
                                        <input type="text" value="{{ $formulario->nombre }}" readonly class="form-control border-primary">
                                    </div>
                                </div><br>
                                <div class="card">
                                    <div class="card-body border-primary">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="id_obligacion">Obligación (*)</label>
                                                <select id="id_obligacion" class="form-control border-primary">
                                                    <option value="">Seleccione la obligación</option>
                                                    @foreach ($obligaciones as $obligacion)
                                                        <option value="{{ $obligacion->id_obligacion }}">{{ $obligacion->detalle }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="pregunta_actividad">Pregunta actividad (*)</label>
                                                <input type="text" name="pregunta_actividad" id="pregunta_actividad" class="form-control border-primary @error('pregunta_actividad') is-invalid @enderror">
                                                @error('pregunta_actividad')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="pregunta_evidencia">Pregunta evidencia (*)</label>
                                                <input type="text" name="pregunta_evidencia" id="pregunta_evidencia" class="form-control border-primary @error('pregunta_evidencia') is-invalid @enderror">
                                                @error('pregunta_evidencia')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div><br>
                                        <button type="button" onclick="agregar_pregunta()" class="btn btn-versatile_reports float-right">Añadir</button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table style="width: 100%;" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                {{-- <th>Id obligacion</th> --}}
                                                <th>#</th>
                                                <th>Pregunta actividad</th>
                                                <th>Pregunta evidencia</th>
                                                <th>Opción</th>
                                            </tr>
                                        </thead>
                                        <tbody id="preguntas_ingresadas">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-actions text-center">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="la la-save"></i>
                                        Guardar
                                    </button>
                                    <a href="{{ route('preguntas_formulario', ['id' => $formulario->id_formulario]) }}" class="btn btn-warning mr-1 btn-block">
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
        let contador = 0;
        let informacion = [];
        function agregar_pregunta(){
            let id_obligacion = $('#id_obligacion option:selected').val();
            let pregunta_actividad = $('#pregunta_actividad').val();
            let pregunta_evidencia = $('#pregunta_evidencia').val();
            informacion.push([id_obligacion + ',/,.-_-,,-#p?' + pregunta_actividad + ',/,.-_-,,-#p?' + pregunta_evidencia]);
            contador = contador + 1;

            // <td>${id_obligacion}</td>
            $('#preguntas_ingresadas').append(`
            <tr id="tr-${contador}">
                <input type="hidden" name="informacion[]" value="${informacion[contador-1]}">
                    <td>${contador}</td>
                    <td>${pregunta_actividad}</td>
                    <td>${pregunta_evidencia}</td>
                    <td>
                        <button class="btn btn-danger" type="button" onclick="eliminar_pregunta('${contador}')">X</button>
                    </td>
                </tr>
            `);

            $('#pregunta_actividad').val('');
            $('#pregunta_evidencia').val('');
        }
        
        function eliminar_pregunta(contador){
            informacion.splice(contador-1, 1);
            $('#tr-'+contador).remove();
        }
    </script>
@endsection