<div class="row">
    <div class="col-md-6 mb-3">
        <label for="nombre">Representante:</label>
        <input type="text" class="form-control"
            value="{{$paciente->representante->nombre . $paciente->representante->apellido}}" readonly>
        @error('nombre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="nombre">Cédula:</label>
        <input type="text" class="form-control" value="{{$paciente->representante->cedula }}" readonly>
        @error('nombre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="nombre">Telefono:</label>
        <input type="text" class="form-control" value="{{$paciente->representante->telefono}}" readonly>
        @error('nombre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="nombre">Dirección:</label>
        <input type="text" class="form-control" value="{{$paciente->representante->residencia}}" readonly>
        @error('nombre')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<form action="{{ route('pacientes.update', $paciente->id) }}" method="POST" id="pacienteForm">
    @csrf <!-- Include CSRF token for security -->
    @method('PUT') <!-- Use PUT method for updating -->

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control"
                value="{{ old('nombre', $paciente->nombre) }}" required>
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" class="form-control"
                value="{{ old('apellido', $paciente->apellido) }}" required>
            @error('apellido')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control"
                value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento) }}" required>
            @error('fecha_nacimiento')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

      
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="estatura">Peso (kg):</label>
            <input type="number" step="any" id="peso" name="peso" class="form-control"
                value="{{ old('peso', $paciente->peso) }}" required>
            @error('estatura')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="estatura">Estatura (cm):</label>
            <input type="number" step="any" id="estatura" name="estatura" class="form-control"
                value="{{ old('estatura', $paciente->estatura) }}" required>
            @error('estatura')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="tipo_sangre">Tipo de Sangre:</label>
            <select id="tipo_sangre" name="tipo_sangre" class="form-control" required>
                <option value="">Seleccione</option>
                <option value="A+" {{ old('tipo_sangre', $paciente->tipo_sangre) == 'A+' ? 'selected' : '' }}>A+</option>
                <option value="A-" {{ old('tipo_sangre', $paciente->tipo_sangre) == 'A-' ? 'selected' : '' }}>A-</option>
                <option value="B+" {{ old('tipo_sangre', $paciente->tipo_sangre) == 'B+' ? 'selected' : '' }}>B+</option>
                <option value="B-" {{ old('tipo_sangre', $paciente->tipo_sangre) == 'B-' ? 'selected' : '' }}>B-</option>
                <option value="AB+" {{ old('tipo_sangre', $paciente->tipo_sangre) == 'AB+' ? 'selected' : '' }}>AB+
                </option>
                <option value="AB-" {{ old('tipo_sangre', $paciente->tipo_sangre) == 'AB-' ? 'selected' : '' }}>AB-
                </option>
                <option value="O+" {{ old('tipo_sangre', $paciente->tipo_sangre) == 'O+' ? 'selected' : '' }}>O+</option>
                <option value="O-" {{ old('tipo_sangre', $paciente->tipo_sangre) == 'O-' ? 'selected' : '' }}>O-</option>
            </select>
            @error('tipo_sangre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="genero">Genero:</label>
            <select id="genero" name="genero" class="form-control" required>
                <option value="">Seleccione</option>
                <option value="MASCULINO" {{ old('genero', $paciente->genero) == 'MASCULINO' ? 'selected' : '' }}>
                    MASCULINO</option>
                <option value="FEMENINO" {{ old('genero', $paciente->genero) == 'FEMENINO' ? 'selected' : '' }}>FEMENINO
                </option>
            </select>
            @error('genero')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="lateralidad">Lateralidad:</label>
            <select id="lateralidad" name="lateralidad" class="form-control" required>
                <option value="">Seleccione</option>
                <option value="diestro" {{ old('lateralidad', $paciente->lateralidad) == 'diestro' ? 'selected' : '' }}>
                    Diestro</option>
                <option value="zurdo" {{ old('lateralidad', $paciente->lateralidad) == 'zurdo' ? 'selected' : '' }}>Zurdo
                </option>
                <option value="no aplica" {{ old('lateralidad', $paciente->lateralidad) == 'no aplica' ? 'selected' : '' }}>No Aplica
                </option>
            </select>
            @error('lateralidad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="posee_discapacidad">¿Posee Discapacidad?</label>
            <select id="posee_discapacidad" name="posee_discapacidad" class="form-control" required>
                <option value="1" {{ old('posee_discapacidad', $paciente->posee_discapacidad) == 1 ? 'selected' : '' }}>Sí
                </option>
                <option value="0" {{ old('posee_discapacidad', $paciente->posee_discapacidad) == 0 ? 'selected' : '' }}>No
                </option>
            </select>
            @error('posee_discapacidad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nota">Observaciones:</label>
            <textarea id="nota" name="nota" class="form-control">{{ old('nota', $paciente->nota) }}</textarea>
            @error('nota')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="representante_id">Representante:</label>
            <select id="representante_id" name="representante_id" class="form-control select2" required>
                <option value="">Seleccione un Representante</option>
                @foreach ($representantes as $representante)
                    <option value="{{ $representante->id }}" {{ old('representante_id', $paciente->representante_id) == $representante->id ? 'selected' : '' }}>
                        {{ $representante->nombre }} {{ $representante->apellido }}
                    </option>
                @endforeach
            </select>
            @error('representante_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="colegio">Colegio:</label>
            <input type="text" id="colegio" name="colegio" class="form-control"
                value="{{ old('colegio', $paciente->colegio) }}" required>
            @error('colegio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="grado">Grado / Nivel:</label>
            <input type="text" id="grado" name="grado" class="form-control" value="{{ old('grado', $paciente->grado) }}"
                required>
            @error('grado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Estudiante</button>
</form>