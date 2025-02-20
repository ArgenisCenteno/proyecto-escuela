<form action="{{ route('especialistas.update', $especialista->id) }}" method="POST" id="especialistaForm">
    @csrf <!-- Include CSRF token for security -->
    @method('PUT') <!-- Use PUT method for updating -->

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control"
                value="{{ old('nombre', $especialista->nombre) }}" required>
                <div class="invalid-feedback"></div>
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" class="form-control"
                value="{{ old('apellido', $especialista->apellido) }}" required>
                <div class="invalid-feedback"></div>
            @error('apellido')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control"
                value="{{ old('email', $especialista->email) }}" required>
                <div class="invalid-feedback"></div>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" class="form-control"
                value="{{ old('telefono', $especialista->telefono) }}" required>
                <div class="invalid-feedback"></div>
            @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" class="form-control"
                value="{{ old('cedula', $especialista->cedula) }}">
                <div class="invalid-feedback"></div>
            @error('cedula')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control"
                value="{{ old('fecha_nacimiento', $especialista->fecha_nacimiento) }}" required>
                <div class="invalid-feedback"></div>
            @error('fecha_nacimiento')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="especialidad">Especialidad:</label>
            <input type="text" id="especialidad" name="especialidad" class="form-control"
                value="{{ old('especialidad', $especialista->especialidad) }}" required>
                <div class="invalid-feedback"></div>
            @error('especialidad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="nota">Nota:</label>
            <textarea id="nota" name="nota" class="form-control">{{ old('nota', $especialista->nota) }}</textarea>
            @error('nota')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="residencia">Residencia:</label>
            <input type="text" id="residencia" name="residencia" class="form-control"
                value="{{ old('residencia', $especialista->residencia) }}">
                <div class="invalid-feedback"></div>
            @error('residencia')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary" id="btn-submit">Actualizar Especialista</button>
</form>