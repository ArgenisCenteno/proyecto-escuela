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

                                <h3 class="p-2 bold">Editar Estudiante</h3>


                            </div>
                            <div class="col-md-6 mt-4">

                            </div>
                            <div class="d-flex justify-content-end mt-3">
                            </div>
                        </div>
                        <div class="card-body">

                            @include('pacientes.edit_fields')
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
       
       $(document).ready(function () {
   function validarFormulario() {
       if ($('.is-invalid').length > 0) {
           $('#submit-btn').prop('disabled', true);
       } else {
           $('#submit-btn').prop('disabled', false);
       }
   }

   function validarCampo(selector, regex, mensaje) {
       $(selector).on('input', function () {
           const valor = $(this).val();
           if (regex.test(valor)) {
               $(this).removeClass('is-invalid').addClass('is-valid');
               $(this).next('.invalid-feedback').text('');
           } else {
               $(this).addClass('is-invalid').removeClass('is-valid');
               $(this).next('.invalid-feedback').text(mensaje);
           }
           validarFormulario();
       });
   }

   validarCampo('#nombre', /^[a-zA-Z\s]+$/, 'Los nombres no pueden tener números.');
   validarCampo('#apellido', /^[a-zA-Z\s]+$/, 'Los apellidos no pueden tener números.');
   validarCampo('#cedula', /^\d{7,8}$/, 'La cédula debe tener entre 7 y 8 números.');

   $('#fecha_nacimiento').on('input', function () {
       const fecha = $(this).val();
       const ahora = new Date();
       const [anio, mes, dia] = fecha.split('-').map(Number);
       const fechaNacimiento = new Date(anio, mes - 1, dia);

       let edad = ahora.getFullYear() - anio;
       const mesActual = ahora.getMonth() + 1;
       const diaActual = ahora.getDate();

       if (mesActual < mes || (mesActual === mes && diaActual < dia)) {
           edad--;
       }

       if (edad >= 1) {
           $(this).removeClass('is-invalid').addClass('is-valid');
           $(this).next('.invalid-feedback').text('');
       } else {
           $(this).addClass('is-invalid').removeClass('is-valid');
           $(this).next('.invalid-feedback').text('El paciente debe tener más de 1 año.');
       }
       validarFormulario();
   });

   function validarRango(selector, min, mensaje, max) {
        $(selector).on('input', function () {
            const valor = parseFloat($(this).val());
            if (valor >= min && valor < max) {
                $(this).removeClass('is-invalid').addClass('is-valid');
                $(this).next('.invalid-feedback').text('');
            } else {
                $(this).addClass('is-invalid').removeClass('is-valid');
                $(this).next('.invalid-feedback').text(mensaje);
            }
            validarFormulario();
        });
    }

    validarRango('#estatura', 40, 'Estatura incongruente.', 250);
    validarRango('#peso', 3, 'Peso incongruente.', 200);
   // Deshabilitar el botón al cargar la página
   validarFormulario();
});

      
   });

   
</script>
<script>
    $(document).ready(function() {
       

        $('#representante_id').select2({
            placeholder: "Seleccione un Representante",
            allowClear: true
        });
    });
</script>
@endsection