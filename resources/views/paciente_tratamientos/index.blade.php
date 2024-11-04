@extends('layout.app')
@section('content')
<main class="app-main">
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-0 my-5">
                        <div class="px-2 row">
                            <div class="col-lg-12">
                                @include('flash::message')
                            </div>
                            <div class="col-md-6 col-6">
                                <h3 class="p-2 bold">Tratamiento de Pacientes</h3>
                            </div>
                            <div class="col-md-6 mt-4">
                                <!-- Botón para abrir el modal -->
                                
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-success mr-3" data-bs-toggle="modal" data-bs-target="#exportModal">
                                    Reporte
                                </button>
                                <a class="btn btn-primary" href="{{route('pacienteTratamientos.create')}}">Registrar</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('paciente_tratamientos.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para el formulario de exportación -->
    <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('pacienteTratamientos.export') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exportModalLabel">Exportar Tratamientos de Pacientes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de Inicio:</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_fin">Fecha de Fin:</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Generar Reporte</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
