@extends('layouts.principal')

@section('contenido')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Gestión de plantillas y párrafos</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_plantillas') }}">Listar plantillas</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_parrafos', ['id' => $plantilla->id_plantilla]) }}">Listar parrafos</a>
                            </li>
                            <li class="breadcrumb-item active">Añadir parrafos
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
                            <h4 class="card-title">{{ $plantilla->nombre }} - Añadir parrafos</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('guardar_parrafos') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $plantilla->id_plantilla }}" name="id_plantilla">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="plantilla">Plantilla (*)</label>
                                        <input type="text" value="{{ $plantilla->nombre }}" readonly class="form-control border-primary">
                                    </div>
                                </div><br>
                                <div class="card">
                                    <div class="card-body border-primary">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <label for="texto">Texto (*)</label>
                                                <textarea id="texto" class="form-control border-primary @error('texto') is-invalid @enderror" cols="30" rows="2"></textarea>
                                                @error('texto')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="numero_parrafo">Numero de parrafo (*)</label>
                                                <input type="text" id="numero_parrafo" class="form-control border-primary @error('numero_parrafo') is-invalid @enderror">
                                                @error('numero_parrafo')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div><br>
                                        <button type="button" onclick="agregar_parrafo()" class="btn btn-versatile_reports float-right">Añadir</button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table style="width: 100%;" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Texto</th>
                                                <th>Numero de parrafo</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="parrafos_ingresados">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-actions text-center">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="la la-save"></i>
                                        Guardar
                                    </button>
                                    <a href="{{ route('listar_parrafos', ['id' => $plantilla->id_plantilla]) }}" class="btn btn-warning mr-1 btn-block">
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
        function agregar_parrafo(){
            let texto = $('#texto').val();
            let numero_parrafo = $('#numero_parrafo').val();
            informacion.push([texto + ',/,.-_-,,-#p?' + numero_parrafo]);
            contador = contador + 1;

            // <td>${id_obligacion}</td>
            $('#parrafos_ingresados').append(`
                <tr id="tr-${contador}">
                    <input type="hidden" name="informacion[]" value="${informacion[contador-1]}">
                    <td>${contador}</td>
                    <td>${texto}</td>
                    <td>${numero_parrafo}</td>
                    <td>
                        <button class="btn btn-danger" type="button" onclick="eliminar_parrafo('${contador}')">X</button>
                    </td>
                </tr>
            `);

            $('#texto').val('');
            $('#numero_parrafo').val('');
        }
        
        function eliminar_parrafo(contador){
            informacion.splice(contador-1, 1);
            $('#tr-'+contador).remove();
        }
    </script>
@endsection