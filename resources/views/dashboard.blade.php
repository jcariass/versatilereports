@extends('layouts.principal')

@section('titulo')
    Dashboard
@endsection

@section('contenido')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            Hola soy el dashboard
            <div class="card">
                <div class="card-header">
                    <h2>Permisos del usuarios: </h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Url</th>
                                    <th>Metodo</th>
                                    <th>Identica</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (session("permisos_rol") as $permiso_rol)
                                    <tr>
                                        <td>{{ $permiso_rol["nombre"] }}</td>
                                        <td>{{ $permiso_rol["url"] }}</td>
                                        <td>{{ $permiso_rol["method"] }}</td>
                                        <td>{{ $permiso_rol["url_identica"] == 1 ? 'True' : 'False' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection