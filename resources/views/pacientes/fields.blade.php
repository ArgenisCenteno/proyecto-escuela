<form action="{{ route('pacientes.store') }}" method="POST" id="pacienteForm">
    @csrf <!-- Include CSRF token for security -->



    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" class="form-control" required>
            @error('apellido')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required>
            @error('fecha_nacimiento')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" class="form-control">
            @error('cedula')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="estatura">Peso (kg):</label>
            <input type="number" step="any" id="peso" name="peso" class="form-control" required>
            @error('estatura')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="estatura">Estatura (cm):</label>
            <input type="number" step="any" id="estatura" name="estatura" class="form-control" required>
            @error('estatura')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="tipo_sangre">Tipo de Sangre:</label>
            <select id="tipo_sangre" name="tipo_sangre" class="form-control" required>
                <option value="">Seleccione</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
            @error('tipo_sangre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="lateralidad">Genero:</label>
            <select id="genero" name="genero" class="form-control" required>
                <option value="">Seleccione</option>
                <option value="MASCULINO">MASCULINO</option>
                <option value="FEMENINO">FEMENINO</option>
            </select>
            @error('lateralidad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="lateralidad">Lateralidad:</label>
            <select id="lateralidad" name="lateralidad" class="form-control" required>
                <option value="">Seleccione</option>
                <option value="diestro">Diestro</option>
                <option value="zurdo">Zurdo</option>
            </select>
            @error('lateralidad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
    <label for="posee_discapacidad">¿Posee Discapacidad?</label>
    <select id="posee_discapacidad" name="posee_discapacidad" class="form-control" required>
        <option value="">Seleccione</option>
        <option value="1">Sí</option>
        <option value="0">No</option>
    </select>
    @error('posee_discapacidad')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
    </div>

    <div class="row">
    <div class="col-md-6 mb-3" id="nota-container" style="display: none;">
    <label for="nota">Nota:</label>
    <textarea id="nota" name="nota" class="form-control"></textarea>
    @error('nota')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

        <div class="col-md-6 mb-3">
            <label for="representante_id">Representante:</label>
            <select id="representante_id" name="representante_id" class="form-control select2" required>
                <option value="">Seleccione un Representante</option>
                @foreach ($representantes as $representante)
                    <option value="{{ $representante->id }}">
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
            <input type="text" id="colegio" name="colegio" class="form-control" required>
            @error('colegio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="grado">Grado:</label>
            <input type="text" id="grado" name="grado" class="form-control" required>
            @error('grado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Registrar Paciente</button>

</form>