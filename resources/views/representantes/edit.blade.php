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

                                <h3 class="p-2 bold">Editar Representante</h3>


                            </div>
                            <div class="col-md-6 mt-4">

                            </div>
                            <div class="d-flex justify-content-end mt-3">
                            </div>
                        </div>
                        <div class="card-body">

                            @include('representantes.edit_fields')
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
    function validarFormulario() {
        if ($('.is-invalid').length > 0) {
            $('#btn-submit').prop('disabled', true);
        } else {
            $('#btn-submit').prop('disabled', false);
        }
    }

    $('#telefono').on('input', function () {
        let telefono = $(this).val();
        const regex = /^(0412|0424|0414|0426|0416)[0-9]{7}$/;

        telefono = telefono.slice(0, 11);
        $(this).val(telefono);

        if (!regex.test(telefono)) {
            $(this).addClass('is-invalid').removeClass('is-valid');
            $(this).next('.invalid-feedback').text('Formato incorrecto. Debe comenzar con 0412, 0414, 0426 o 0416 y tener 11 dígitos.');
        } else {
            $(this).removeClass('is-invalid').addClass('is-valid');
            $(this).next('.invalid-feedback').text('');
        }
        validarFormulario();
    });

    function validarTexto(input) {
        const regex = /^[a-zA-Z\s]+$/;
        if (regex.test($(input).val())) {
            $(input).removeClass('is-invalid').addClass('is-valid');
            $(input).next('.invalid-feedback').text('');
        } else {
            $(input).addClass('is-invalid').removeClass('is-valid');
            $(input).next('.invalid-feedback').text('Este campo solo puede contener letras.');
        }
        validarFormulario();
    }

    $('#nombre, #apellido').on('input', function () {
        validarTexto(this);
    });

    $('#cedula').on('input', function () {
        let cedula = $(this).val().replace(/\D/g, '').slice(0, 9);
        $(this).val(cedula);

        if (/^\d{7,9}$/.test(cedula)) {
            $(this).removeClass('is-invalid').addClass('is-valid');
            $(this).next('.invalid-feedback').text('');
        } else {
            $(this).addClass('is-invalid').removeClass('is-valid');
            $(this).next('.invalid-feedback').text('Debe tener entre 7 y 9 números.');
        }
        validarFormulario();
    });

    $('#fecha_nacimiento').on('input', function () {
        const fecha = $(this).val();
        if (!fecha) return;

        const ahora = new Date();
        const [anio, mes, dia] = fecha.split('-').map(Number);
        const fechaNacimiento = new Date(anio, mes - 1, dia);

        let edad = ahora.getFullYear() - anio;
        if (ahora.getMonth() + 1 < mes || (ahora.getMonth() + 1 === mes && ahora.getDate() < dia)) {
            edad--;
        }

        $('#edad').val(edad);

        if (edad >= 12) {
            $(this).removeClass('is-invalid').addClass('is-valid');
            $(this).next('.invalid-feedback').text('');
        } else {
            $(this).addClass('is-invalid').removeClass('is-valid');
            $(this).next('.invalid-feedback').text('Debe tener más de 11 años.');
        }
        validarFormulario();
    });

    // Deshabilitar el botón al cargar la página si hay errores
    validarFormulario();
});

</script>

@endsection