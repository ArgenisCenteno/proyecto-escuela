@extends('layout.app')
@section('content')
<main class="app-main"> <!--begin::App Content Header-->
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-0 my-5">
                        <div class="px-2 row">
                            <div class="col-lg-12">
                                @include('flash::message')
                            </div>
                            <div class="col-md-12 col-12">
                                <h3 class="p-2 bold">Citas</h3>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <!-- Botón para abrir el modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#reportModal">
                                    Reporte
                                </button>
                                <a class="btn btn-primary ms-2" href="{{ route('citas.create') }}">Registrar</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('citas.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main> <!--end::App Main--> <!--begin::Footer-->

<!-- Modal para generar reporte -->
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportModalLabel">Generar Reporte de Citas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('citas.export') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="fecha_inicio">Fecha de Inicio:</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="fecha_fin">Fecha de Fin:</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Generar Reporte</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
