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

                                    <h3 class="p-2 bold">Editar Cita</h3>


                                </div>
                                <div class="col-md-6 mt-4">

                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                </div>
                            </div>
                            <div class="card-body">

                                @include('citas.edit_fields')
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

        })
    </script>
<script>
    $(document).ready(function () {
        var today = new Date().toISOString().split('T')[0];
        $('#fecha').attr('min', today);

        function checkFormValidity() {
            if ($('.is-invalid').length > 0) {
                $('#btn-submit').prop('disabled', true);
            } else {
                $('#btn-submit').prop('disabled', false);
            }
        }

        // Validación de la fecha en tiempo real
        $('#fecha').on('input', function () {
            var selectedDate = $(this).val();
            var currentDate = new Date().toISOString().split('T')[0];
            var dayOfWeek = new Date(selectedDate).getDay();

            if (selectedDate < currentDate) {
                $(this).removeClass('is-valid').addClass('is-invalid');
                if (!$(this).next('.invalid-feedback').length) {
                    $(this).after('<div class="invalid-feedback">La fecha no puede ser menor a hoy.</div>');
                } else {
                    $(this).next('.invalid-feedback').text('La fecha no puede ser menor a hoy.');
                }
            } else if (dayOfWeek === 5 || dayOfWeek === 6) {
                $(this).removeClass('is-valid').addClass('is-invalid');
                if (!$(this).next('.invalid-feedback').length) {
                    $(this).after('<div class="invalid-feedback">No se puede pedir cita para un sábado o un domingo.</div>');
                } else {
                    $(this).next('.invalid-feedback').text('No se puede pedir cita para un sábado o un domingo.');
                }
            } else {
                $(this).removeClass('is-invalid').addClass('is-valid');
                $(this).next('.invalid-feedback').text('');
            }

            checkFormValidity();
        });

        // Validación de la hora en tiempo real
        $('#hora').on('input', function () {
            var selectedTime = $(this).val().trim();
            var regex = /^(0?[7-9]|1[0-2]):([0-5][0-9])\s?(AM|PM)$/i;

            console.log(selectedTime)
            if (!regex.test(selectedTime) || selectedTime.match(/^1:/i)) {
                $(this).removeClass('is-valid').addClass('is-invalid');
                if (!$(this).next('.invalid-feedback').length) {
                    $(this).after('<div class="invalid-feedback">La hora debe ser entre 07:00 AM y 01:00 PM.</div>');
                } else {
                    $(this).next('.invalid-feedback').text('La hora debe ser entre 07:00 AM y 01:00 PM.');
                }
                checkFormValidity();
                return;
            }

            let [, hour, minute, period] = selectedTime.match(regex);
            hour = parseInt(hour, 10);
            minute = parseInt(minute, 10);
            period = period.toUpperCase();

            if (period === 'PM' && hour !== 12) {
                hour += 12;
            } else if (period === 'AM' && hour === 12) {
                hour = 0;
            }

            let totalMinutes = hour * 60 + minute;
            let startTime = 7 * 60;
            let endTime = 13 * 60;
            

            if (totalMinutes >= startTime && totalMinutes <= endTime) {
                $(this).removeClass('is-invalid').addClass('is-valid');
                $(this).next('.invalid-feedback').text('');
            } else {
                $(this).removeClass('is-valid').addClass('is-invalid');
                if (!$(this).next('.invalid-feedback').length) {
                    $(this).after('<div class="invalid-feedback">La hora debe estar entre 07:00 AM y 01:00 PM.</div>');
                } else {
                    $(this).next('.invalid-feedback').text('La hora debe estar entre 07:00 AM y 01:00 PM.');
                }
            }

            checkFormValidity();
        });

        // Inicializar Select2
        $('#especialista_id').select2({
            placeholder: "Seleccione un Especialista",
            allowClear: true
        });

        $('#paciente_id').select2({
            placeholder: "Seleccione un Paciente",
            allowClear: true
        });

        // Inicializar el botón deshabilitado
        checkFormValidity();
    });
</script>


    <script>
        $(document).ready(function () {
            function toggleFieldsBasedOnStatus() {
                var estatus = $('#estatus').val();

                // Si el estatus no es 'Pendiente', habilitar los campos
                if (estatus !== 'Pendiente' && estatus !== 'Cancelada') {
                    $('#asistencia').prop('disabled', false);
                    $('#observacion_asistencia').prop('disabled', false);
                } else {
                    $('#asistencia').prop('disabled', true);
                    $('#observacion_asistencia').prop('disabled', true);
                }
            }

            // Ejecutar la función al cargar la página para el estado actual
            toggleFieldsBasedOnStatus();

            // Ejecutar la función cada vez que el valor del estatus cambie
            $('#estatus').on('change', function () {
                toggleFieldsBasedOnStatus();
            });
        });

    </script>
@endsection