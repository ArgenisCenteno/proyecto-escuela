<form action="{{ route('especialistas.store') }}" method="POST" id="especialistaForm">
    @csrf <!-- Include CSRF token for security -->

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre"  class="form-control @error('nombre') is-invalid @enderror"   value="{{ old('nombre') }}" required>
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" class="form-control @error('apellido') is-invalid @enderror"   value="{{ old('apellido') }}"  required>
            @error('apellido')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"  class="form-control @error('email') is-invalid @enderror"   value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono"  class="form-control @error('telefono') is-invalid @enderror"   value="{{ old('telefono') }}" required>
            @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" class="form-control @error('cedula') is-invalid @enderror"
                value="{{ old('cedula') }}">
            @error('cedula')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        <div class="col-md-6 mb-3">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror"   value="{{ old('fecha_nacimiento') }}"  required>
            @error('fecha_nacimiento')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="especialidad">Especialidad:</label>
            <input type="text" id="especialidad" name="especialidad"   value="{{ old('especialidad') }}" class="form-control" required>
            @error('especialidad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="nota">Nota:</label>
            <textarea id="nota" name="nota" class="form-control"   value="{{ old('nota') }}"></textarea>
            @error('nota')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="residencia">Residencia:</label>
            <input type="text" id="residencia" name="residencia"   value="{{ old('residencia') }}" class="form-control">
            @error('residencia')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Registrar Especialista</button>
</form>