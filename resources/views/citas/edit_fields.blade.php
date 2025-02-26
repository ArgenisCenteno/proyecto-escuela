<form action="{{ route('citas.update', $cita->id) }}" method="POST" id="citaForm">
    @csrf
    @method('PUT')

    <!-- Información del Representante y Paciente (Solo Lectura) -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="representante_nombre_completo">Representante:</label>
            <input type="text" id="representante_nombre_completo" name="representante_nombre_completo"
                class="form-control"
                value="{{ $cita->paciente->representante->nombre }} {{ $cita->paciente->representante->apellido }}"
                readonly>
        </div>
        <div class="col-md-6 mb-3">
            <label for="paciente_nombre_completo">Paciente:</label>
            <input type="text" id="paciente_nombre_completo" name="paciente_nombre_completo" class="form-control"
                value="{{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}" readonly>
        </div>
    </div>

    <!-- Información del Especialista (Solo Lectura) -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="especialista_nombre_completo">Especialista:</label>
            <input type="text" id="especialista_nombre_completo" name="especialista_nombre_completo"
                class="form-control" value="{{ $cita->especialista->nombre }} {{ $cita->especialista->apellido }}"
                readonly>
        </div>
        <div class="col-md-6 mb-3">
    <label for="estatus">Estado</label>
    <select name="estatus" id="estatus" class="form-control @error('estatus') is-invalid @enderror" required>
        <option value="Pendiente" {{ $cita->estatus === 'Pendiente' ? 'selected' : '' }}>Pendiente</option> 
        <option value="Completada" {{ $cita->estatus === 'Completada' ? 'selected' : '' }}>Completada</option>
        <option value="Cancelada" {{ $cita->estatus === 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
    </select>
    @error('estatus')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-6 mb-3">
    <label for="asistencia">Asistencia</label>
    <select name="asistencia" id="asistencia" class="form-control @error('asistencia') is-invalid @enderror">
        <option value="">Seleccione una opción</option>
        <option value="Tarde" {{ isset($asistencia->estado) && $asistencia->estado === 'Tarde' ? 'selected' : '' }}>Llegó tarde</option>
        <option value="Asistió" {{ isset($asistencia->estado) && $asistencia->estado === 'Asistió' ? 'selected' : '' }}>Asistió</option>
        <option value="No Asistió" {{ isset($asistencia->estado) && $asistencia->estado === 'No Asistió' ? 'selected' : '' }}>No asistió</option>
    </select>
    @error('asistencia')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div> 

    </div>

    <!-- Datos de la Cita (Editables) -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="fecha">Fecha de la Cita:</label>
            <input type="date" id="fecha" name="fecha" class="form-control" value="{{ $cita->fecha }}" required>
            <div class="invalid-feedback"></div>
            @error('fecha')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="col-md-6 mb-3">
            <label for="hora">Hora de la Cita:</label>
            <input type="text" name="hora" id="hora" value="{{ $cita->hora }}" class="form-control @error('hora') is-invalid @enderror" required>
            <div class="invalid-feedback"></div>
             <div class="invalid-feedback"></div>
            @error('hora')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Selección de Especialista y Paciente (Editables) -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="especialista_id">Especialista:</label>
            <select id="especialista_id" name="especialista_id" class="form-control select2" required>
                <option value="">Seleccione un Especialista</option>
                @foreach ($especialistas as $especialista)
                    <option value="{{ $especialista->id }}" {{ $cita->especialista_id == $especialista->id ? 'selected' : '' }}>
                        {{ $especialista->nombre }} {{ $especialista->apellido }}
                    </option>
                @endforeach
            </select>
            @error('especialista_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="paciente_id">Paciente:</label>
            <select id="paciente_id" name="paciente_id" class="form-control select2" required>
                <option value="">Seleccione un Paciente</option>
                @foreach ($pacientes as $paciente)
                    <option value="{{ $paciente->id }}" {{ $cita->paciente_id == $paciente->id ? 'selected' : '' }}>
                        {{ $paciente->nombre }} {{ $paciente->apellido }}
                    </option>
                @endforeach
            </select>
            @error('paciente_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="nota">Nota de la Cita:</label>
            <textarea name="nota_cita" id="nota" class="form-control" rows="4" required placeholder="Ingrese una nota aquí..."  
                required>{{$cita->nota ?? ''}}</textarea>
           
        </div>
        <div class="col-md-12 mb-3">
            <label for="nota">Nota Médica:</label>
            <textarea name="nota_medica" id="nota" class="form-control" rows="4" required placeholder="Ingrese una nota aquí..."  
                >{{$nota->nota ?? ''}}</textarea>
           
        </div>
        <div class="col-md-12 mb-3">
            <label for="nota">Nota de Asistencia:</label>
            <textarea name="observacion_asistencia" id="observacion_asistencia" required class="form-control" rows="4" placeholder="Ingrese una nota aquí..."  
                >{{$asistencia->observacion ?? ''}}</textarea>
           
        </div>
    </div>

    <button type="submit" class="btn btn-primary" id="btn-submit">Actualizar Cita</button>
</form>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const estatusSelect = document.getElementById("estatus");
        const asistenciaSelect = document.getElementById("asistencia");

        function actualizarOpcionesAsistencia() {
            const estado = estatusSelect.value;
            asistenciaSelect.innerHTML = ""; // Limpiar opciones

            let opciones = [];

            if (estado === "Pendiente") {
                opciones = [
                    { value: "", text: "Seleccione una opción" },
                    { value: "No Asistió", text: "No asistió" }
                ];
            } else if (estado === "Confirmada") {
                opciones = [
                    { value: "", text: "Seleccione una opción" },
                    { value: "Asistió", text: "Asistió" },
                    { value: "Tarde", text: "Llegó tarde" },
                    { value: "No Asistió", text: "No asistió" }
                ];
            } else if (estado === "Completada") {
                opciones = [
                    { value: "", text: "Seleccione una opción" },
                    { value: "Asistió", text: "Asistió" },
                    { value: "Tarde", text: "Llegó tarde" }
                ];
            } else if (estado === "Cancelada") {
                opciones = [
                    { value: "", text: "Seleccione una opción" },
                    { value: "No Asistió", text: "No asistió" }
                ];
            }

            // Insertar opciones en el select
            opciones.forEach(opcion => {
                const optionElement = document.createElement("option");
                optionElement.value = opcion.value;
                optionElement.textContent = opcion.text;

                // Si la opción coincide con el valor actual, se selecciona
                if (opcion.value === "{{ $asistencia->estado ?? '' }}") {
                    optionElement.selected = true;
                }

                asistenciaSelect.appendChild(optionElement);
            });
        }

        estatusSelect.addEventListener("change", actualizarOpcionesAsistencia);
        actualizarOpcionesAsistencia(); // Llamar para establecer las opciones correctas al cargar
    });
</script>
<link rel="stylesheet" href="{{asset('css/flatpickr.min.css')}}">
<script src="{{asset('js/flatpickr.min.js')}}"></script>
<script>
    flatpickr("#hora", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K", // Formato de 12 horas con AM/PM
        time_24hr: false
    });
</script>