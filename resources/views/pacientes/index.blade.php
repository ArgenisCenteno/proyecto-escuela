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
                            <div class="col-md-6 col-6">

                                <h3 class="p-2 bold">Alumnos</h3>

                               
                            </div>
                            <div class="col-md-6 mt-4">
                           
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                            <a href="{{ route('pacientes.export') }}" class="btn btn-success mr-2">
                                    Exportar Pacientes
                                </a>

                                <a class="btn btn-primary" href="{{route('pacientes.create')}}">Registrar</a>
                            </div>
                        </div>
                        <div class="card-body">

                            @include('pacientes.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main> <!--end::App Main--> <!--begin::Footer-->
@endsection