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

                                <h3 class="p-2 bold">Registrar Cita</h3>


                            </div>
                            <div class="col-md-6 mt-4">

                            </div>
                            <div class="d-flex justify-content-end mt-3">
                            </div>
                        </div>
                        <div class="card-body">

                            @include('citas.fields')
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



        $('#fecha').on('change', function () {
            var selectedDate = $(this).val();
            if (!selectedDate) return; // Si no hay fecha seleccionada, no hacer nada

            var currentDate = new Date().toISOString().split('T')[0];
            var dayOfWeek = new Date(selectedDate + 'T00:00:00').getDay(); // Asegura formato correcto

            if (selectedDate < currentDate) {
                // Fecha inválida: menor a hoy
                $(this).removeClass('is-valid').addClass('is-invalid');
                showErrorMessage($(this), 'La fecha no puede ser menor a hoy.');
            } else if (dayOfWeek === 0 || dayOfWeek === 6) {
                // Fecha inválida: sábado (6) o domingo (0)
                $(this).removeClass('is-valid').addClass('is-invalid');
                showErrorMessage($(this), 'No se puede pedir cita para un sábado o un domingo.');
            } else {
                // Fecha válida
                $(this).removeClass('is-invalid').addClass('is-valid');
                removeErrorMessage($(this));
            }
        });

        // Función para mostrar mensaje de error
        function showErrorMessage(element, message) {
            if (!element.next('.invalid-feedback').length) {
                element.after('<div class="invalid-feedback">' + message + '</div>');
            } else {
                element.next('.invalid-feedback').text(message);
            }
        }

        // Función para remover mensaje de error
        function removeErrorMessage(element) {
            element.next('.invalid-feedback').remove();
        }



        $('#hora').on('input', function () {
    var selectedTime = $(this).val().trim(); // Obtener y limpiar el input
    var regex = /^(0?[1-9]|1[0-2]):([0-5][0-9])\s?(AM|PM)$/i;


    console.log(selectedTime)
    // Verificar si el formato es correcto
    if (!regex.test(selectedTime)) {
        $(this).removeClass('is-valid').addClass('is-invalid');
        $(this).next('.invalid-feedback').text('Formato inválido. Use hh:mm AM/PM.');
        return;
    }

    // Extraer hora, minutos y AM/PM
    let [, hour, minute, period] = selectedTime.match(regex);
    hour = parseInt(hour);
    minute = parseInt(minute);

    // Imprimir valores para depuración
    console.log(`Hora: ${hour}, Minutos: ${minute}, Periodo: ${period}`);

    // Convertir a formato 24 horas para la comparación
    if (period.toUpperCase() === 'PM' && hour !== 12) {
        hour += 12; // Para convertir 1 PM en 13, 2 PM en 14, etc.
    } else if (period.toUpperCase() === 'AM' && hour === 12) {
        hour = 0; // 12 AM se convierte en 00
    }

    // Imprimir la hora convertida para ver si la conversión fue correcta
    console.log(`Hora convertida a 24h: ${hour}:${minute}`);

    // Calcular los minutos totales
    let totalMinutes = hour * 60 + minute;
    console.log(`Total en minutos: ${totalMinutes}`);

    // Definir los rangos de horas en minutos
    let startTime = 7 * 60;  // 07:00 AM en minutos (420)
    let endTime = 13 * 60;   // 01:00 PM en minutos (780)

    // Validar si la hora está en el rango permitido
    if (totalMinutes >= startTime && totalMinutes <= endTime) {
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).next('.invalid-feedback').text('');
    } else {
        $(this).removeClass('is-valid').addClass('is-invalid');
        $(this).next('.invalid-feedback').text('La hora debe estar entre las 07:00 AM y la 01:00 PM.');
    }
});



        $('#especialista_id').select2({
            placeholder: "Seleccione un Especialista",
            allowClear: true
        });

        $('#paciente_id').select2({
            placeholder: "Seleccione un Paciente",
            allowClear: true
        });
    });

</script>
@endsection