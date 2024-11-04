<form action="{{ route('pacienteTratamientos.store') }}" method="POST" id="pacienteTratamientoForm">
    @csrf

    <div class="row">
        <!-- Selección de Paciente -->
        <div class="form-group col-md-6">
            <label for="paciente_id">Paciente</label>
            <select name="paciente_id" id="paciente_id" class="form-control" required>
                <option value="">Seleccione un paciente</option>
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id }}">{{ $paciente->nombre }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Seleccione un paciente válido.</div>
        </div>

        <!-- Selección de Tratamiento -->
        <div class="form-group col-md-6">
            <label for="tratamiento_id">Tratamiento</label>
            <select name="tratamiento_id" id="tratamiento_id" class="form-control" required>
                <option value="">Seleccione un tratamiento</option>
                @foreach($tratamientos as $tratamiento)
                    <option value="{{ $tratamiento->id }}">{{ $tratamiento->nombre }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Seleccione un tratamiento válido.</div>
        </div>
    </div>

    <div class="row">
        <!-- Selección de Especialista -->
        <div class="form-group col-md-6">
            <label for="especialista_id">Especialista</label>
            <select name="especialista_id" id="especialista_id" class="form-control" required>
                <option value="">Seleccione un especialista</option>
                @foreach($especialistas as $especialista)
                    <option value="{{ $especialista->id }}">{{ $especialista->nombre }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Seleccione un especialista válido.</div>
        </div>

        <!-- Fecha de Inicio -->
        <div class="form-group col-md-6">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
            <div class="invalid-feedback">La fecha de inicio es requerida.</div>
        </div>
    </div>

    <div class="row">
        <!-- Fecha de Fin -->
        <div class="form-group col-md-6">
            <label for="fecha_fin">Fecha de Fin</label>
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
            <div class="invalid-feedback">La fecha de fin es inválida.</div>
        </div>

        <!-- Observaciones -->
        <div class="form-group col-md-6">
            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" id="observaciones" class="form-control" rows="4"></textarea>
        </div>
    </div>

    <div class="row">
        <!-- Estatus -->
        <div class="form-group col-md-6">
            <label for="estatus">Estatus</label>
            <select name="estatus" id="estatus" class="form-control" required>
                <option value="En proceso">En proceso</option>
                <option value="Cancelado">Cancelado</option>
                <option value="Completado">Completado</option>
            </select>
            <div class="invalid-feedback">Seleccione un estatus válido.</div>
        </div>
    </div>

    <!-- Botón de Enviar -->
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Asignar Tratamiento</button>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Validación de fechas al cambiar Fecha de Inicio o Fecha de Fin
        $('#fecha_fin').on('change', function () {
            validateDates();
        });

        // Validación antes de enviar el formulario
        $('#pacienteTratamientoForm').on('submit', function (e) {
            let valid = validateDates();
            if (!valid) {
                e.preventDefault(); // Evita el envío del formulario si las fechas no son válidas
            }

            // Validate other fields if needed
            validateSelectFields();
        });

        function validateDates() {
            const fechaInicio = new Date($('#fecha_inicio').val());
            const fechaFin = new Date($('#fecha_fin').val());

            if(fechaFin != null && fechaFin != ''){
                if (fechaInicio && fechaFin && fechaInicio > fechaFin) {
                $('#fecha_inicio').addClass('is-invalid');
                $('#fecha_fin').addClass('is-invalid');
                return false;
            } else {
                $('#fecha_inicio').removeClass('is-invalid').addClass('is-valid');
                $('#fecha_fin').removeClass('is-invalid').addClass('is-valid');
                return true;
            }
            } 
           
        }

        function validateSelectFields() {
            $('#paciente_id, #tratamiento_id, #especialista_id, #estatus').each(function () {
                if ($(this).val() === '') {
                    $(this).addClass('is-invalid');
                    $(this).next('.invalid-feedback').text('Este campo es obligatorio.');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    $(this).next('.invalid-feedback').text('');
                }
            });
        }
    });
</script>
