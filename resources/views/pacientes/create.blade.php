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

                                <h3 class="p-2 bold">Registrar Paciente</h3>


                            </div>
                            <div class="col-md-6 mt-4">

                            </div>
                            <div class="d-flex justify-content-end mt-3">
                            </div>
                        </div>
                        <div class="card-body">

                            @include('pacientes.fields')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main> <!--end::App Main--> <!--begin::Footer-->
@endsection

@section('js')
@include('layout.script')
<script src="{{ asset('js/adminlte.js') }}"></script>
<script src="{{asset('js/sweetalert2.js')}}"></script>
<script>
    $(document).ready(function () {
       

        $('#nombre').on('input', function () {
            const cedula = $(this).val();
            const regex = /^[a-zA-Z\s]+$/;

            if (regex.test(cedula)) {
                // Si es válido
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                $(this).next('.invalid-feedback').text('');
            } else {
                $(this).addClass('is-invalid');
                $(this).next('.invalid-feedback').text('Los campos de nombres no pueden tener números.');
            }
        })

        $('#apellido').on('input', function () {
            const cedula = $(this).val();
            const regex = /^[a-zA-Z\s]+$/;

            if (regex.test(cedula)) {
                // Si es válido
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                $(this).next('.invalid-feedback').text('');
            } else {
                $(this).addClass('is-invalid');
                $(this).next('.invalid-feedback').text('Los campos de nombres no pueden tener números.');
            }
        })

        $('#cedula').on('input', function () {
            const cedula = $(this).val();
            const regex = /^\d{7,8}$/;

            if (regex.test(cedula)) {
                // Si es válido
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                $(this).next('.invalid-feedback').text('');
            } else {
                $(this).addClass('is-invalid');
                $(this).next('.invalid-feedback').text('Los campos de nombres no pueden tener números.');
            }
        })

        $('#fecha_nacimiento').on('input', function () {
            const fecha = $(this).val(); // Get the input value
            const ahora = new Date();

            // Split the input date (format assumed: YYYY-MM-DD)
            const [anio, mes, dia] = fecha.split('-').map(Number);
            const fechaNacimiento = new Date(anio, mes - 1, dia); // Create a date object

            // Calculate age
            let edad = ahora.getFullYear() - anio;
            const mesActual = ahora.getMonth() + 1; // Months are zero-indexed in JavaScript
            const diaActual = ahora.getDate();

            // Adjust age if the birthday has not occurred yet this year
            if (mesActual < mes || (mesActual === mes && diaActual < dia)) {
                edad--;
            }

            // Validation for age and input content
            if (edad > 1) {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                $(this).next('.invalid-feedback').text('');
            } else {
                $(this).addClass('is-invalid');
                $(this).next('.invalid-feedback').text('El paciente debe tener más de 1 año.');
            }


        })
    });

    $('#estatura').on('input', function () {
        estatura = $(this).val();

        if ( estatura >= 40) {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                $(this).next('.invalid-feedback').text('');
            } else {
                $(this).addClass('is-invalid');
                $(this).next('.invalid-feedback').text('Estatura incongruente.');
            }
    })

    $('#peso').on('input', function () {
        estatura = $(this).val();

        if ( estatura >= 3) {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                $(this).next('.invalid-feedback').text('');
            } else {
                $(this).addClass('is-invalid');
                $(this).next('.invalid-feedback').text('Estatura incongruente.');
            }
    })
</script>
<script>
    $(document).ready(function() {
       

        $('#representante_id').select2({
            placeholder: "Seleccione un Representante",
            allowClear: true
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Escuchar cambios en el select
        $('#posee_discapacidad').on('change', function () {
            if ($(this).val() === "1") {
                $('#nota-container').show(); // Mostrar
            } else {
                $('#nota-container').hide(); // Ocultar
            }
        });
    });
</script>
@endsection