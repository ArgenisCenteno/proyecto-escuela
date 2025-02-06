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

                                <h3 class="p-2 bold">Registrar Representante</h3>


                            </div>
                            <div class="col-md-6 mt-4">

                            </div>
                            <div class="d-flex justify-content-end mt-3">
                            </div>
                        </div>
                        <div class="card-body">

                            @include('representantes.fields')
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
        $('#telefono').on('input', function () {
            let telefono = $(this).val();
            const regex = /^(0412|0424|0414|0426|0416)[0-9]{7}$/;
            if (telefono.length > 11) {
                telefono = telefono.slice(0, 11); // Limita la longitud a 9 caracteres
            }
            $(this).val(telefono); // Establece el valor limitado
            if (telefono.length > 11) {
                // Mensaje de error si tiene más de 11 dígitos
                $(this).addClass('is-invalid');
                $(this).next('.invalid-feedback').text('El número debe tener un máximo de 11 dígitos.');
            } else if (!regex.test(telefono)) {
                // Mensaje de error si no coincide con el patrón
                $(this).addClass('is-invalid');
                $(this).next('.invalid-feedback').text('El número debe comenzar con 0412, 0414, 0426 o 0416 y tener 11 dígitos en total.');
            } else {
                // Si es válido
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
                $(this).next('.invalid-feedback').text('');
            }
        });

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
            let cedula = $(this).val().replace(/\D/g, ''); // Elimina cualquier caracter no numérico
            if (cedula.length > 9) {
                cedula = cedula.slice(0, 9); // Limita la longitud a 9 caracteres
            }
            $(this).val(cedula); // Establece el valor limitado

            const regex = /^\d{7,9}$/; // Asegura que sean entre 7 y 9 números
            if (regex.test(cedula)) {
                $(this).removeClass('is-invalid').addClass('is-valid');
                $(this).next('.invalid-feedback').text('');
            } else {
                $(this).removeClass('is-valid').addClass('is-invalid');
                $(this).next('.invalid-feedback').text('La cédula debe tener entre 7 y 9 números.');
            }
        });

        $('#fecha_nacimiento').on('input', function () {
        const fecha = $(this).val(); // Obtener el valor del input
        if (!fecha) return; // Evita errores si el input está vacío

        const ahora = new Date();

        // Separar la fecha (YYYY-MM-DD)
        const [anio, mes, dia] = fecha.split('-').map(Number);
        const fechaNacimiento = new Date(anio, mes - 1, dia); // Crear objeto Date

        // Calcular edad
        let edad = ahora.getFullYear() - anio;
        const mesActual = ahora.getMonth() + 1; // Los meses son base 0 en JS
        const diaActual = ahora.getDate();

        // Ajustar la edad si aún no ha cumplido años este año
        if (mesActual < mes || (mesActual === mes && diaActual < dia)) {
            edad--;
        }

        // Establecer la edad en el input correspondiente
        $('#edad').val(edad);

        // Validación de la edad mínima
        if (edad >= 12) {
            $(this).removeClass('is-invalid').addClass('is-valid');
            $(this).next('.invalid-feedback').text('');
        } else {
            $(this).removeClass('is-valid').addClass('is-invalid');
            $(this).next('.invalid-feedback').text('El representante debe tener más de 11 años.');
        }
    });
    });
</script>

@endsection