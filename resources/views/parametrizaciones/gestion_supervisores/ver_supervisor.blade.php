@extends('layouts.principal')

@section('contenido')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title mb-0">Gestión de supervisores</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('listar_supervisores') }}">Listar supervisores</a>
                            </li>
                            <li class="breadcrumb-item active">Detalle supervisor
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
                            <h4 class="card-title">Detalle supervisor</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-content collapse show">
                                <div class="table-responsive">
                                    <table style="width: 100%;" class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table class="table table-column">
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>Nombres: </strong><td>{{ $supervisor->nombre }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Apellidos: </strong><td>{{ $supervisor->primer_apellido . ' ' . $supervisor->segundo_apellido }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Tipo documento: </strong><td>{{ $supervisor->tipo_documento }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Documento: </strong><td>{{ $supervisor->documento }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Lugar expedición: </strong><td>{{ $supervisor->nombre_departamento . ' / ' . $supervisor->nombre_municipio }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Correo: </strong><td>{{ $supervisor->correo }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Correo Institucional: </strong><td>{{ $supervisor->correo_sena }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Celular uno: </strong><td>{{ $supervisor->celular_uno }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Celular dos: </strong><td>{{ $supervisor->celular_dos }}.</td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Firma: </strong><td><img src="{{ asset('uploads/firmas/'.$supervisor->firma.'') }}" width="80" height="80"></td></td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <div class="container">
                                                                        <div class="row justify-content-center">
                                                                            <div class="col-md-4">
                                                                                <a href="{{ route('listar_supervisores') }}" class="btn btn-gris col-8 ml-5">Regresar</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection