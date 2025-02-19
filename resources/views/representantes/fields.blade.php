<form action="{{ route('representantes.store') }}" method="POST">
    @csrf <!-- Para la protección contra CSRF -->

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre"
                    value="{{ old('nombre') }}" required>
                    <div class="invalid-feedback"></div>
                    @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido"
                    name="apellido" value="{{ old('apellido') }}" required>
                    <div class="invalid-feedback"></div>
                @error('apellido')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                    id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                    <div class="invalid-feedback"></div>
                    @error('fecha_nacimiento')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="text" class="form-control" id="edad" name="edad" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="cedula">Cédula:</label>
                <input type="text" class="form-control @error('cedula') is-invalid @enderror" id="cedula" name="cedula"
                    value="{{ old('cedula') }}" required>
                    <div class="invalid-feedback"></div>
                    @error('cedula')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                    value="{{ old('email') }}" required>
                    <div class="invalid-feedback"></div>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                    name="telefono" value="{{ old('telefono') }}">
                    <div class="invalid-feedback"></div>
                    @error('telefono')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="profesion">Profesión/ Ocupación:</label>
                <input type="text" class="form-control @error('profesion') is-invalid @enderror" id="profesion"
                    name="profesion" value="{{ old('profesion') }}">
                    <div class="invalid-feedback"></div>
                    @error('profesion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
   
 



    <div class="col-md-6">
        <div class="form-group">
            <label for="residencia">Residencia:</label>
            <input type="text" class="form-control @error('residencia') is-invalid @enderror" id="residencia"
                name="residencia" value="{{ old('residencia') }}">
                <div class="invalid-feedback"></div>
                @error('residencia')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    </div>

    <button type="submit" class="btn btn-primary" id="btn-submit">Crear Representante</button>
</form>