<form action="{{ route('representantes.update', $representante->id) }}" method="POST">
    @csrf <!-- Para la protección contra CSRF -->
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" 
                       name="nombre" value="{{ old('nombre', $representante->nombre ?? '') }}" required>
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
                       name="apellido" value="{{ old('apellido', $representante->apellido ?? '') }}" required>
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
                       id="fecha_nacimiento" name="fecha_nacimiento" 
                       value="{{ old('fecha_nacimiento', $representante->fecha_nacimiento ?? '') }}" required>
                       <div class="invalid-feedback"></div>
                       <div class="invalid-feedback"></div>
                       @error('fecha_nacimiento')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="residencia">Edad:</label>
                <input type="text" readonly class="form-control @error('edad') is-invalid @enderror" id="edad"
                       name="edad" value="{{ old('residencia', $edad ?? '') }}">
                       <div class="invalid-feedback"></div>
                       <div class="invalid-feedback"></div>
                       @error('edad')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="cedula">Cédula:</label>
                <input type="text" class="form-control @error('cedula') is-invalid @enderror" id="cedula" 
                       name="cedula" value="{{ old('cedula', $representante->cedula ?? '') }}" required>
                       <div class="invalid-feedback"></div>
                       <div class="invalid-feedback"></div>
                       @error('cedula')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" 
                       name="email" value="{{ old('email', $representante->email ?? '') }}" required>
                       <div class="invalid-feedback"></div>
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
                       name="telefono" value="{{ old('telefono', $representante->telefono ?? '') }}">
                       <div class="invalid-feedback"></div>
                       <div class="invalid-feedback"></div>
                       @error('telefono')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="profesion">Profesión / Ocupación:</label>
                <input type="text" class="form-control @error('profesion') is-invalid @enderror" id="profesion"
                       name="profesion" value="{{ old('profesion', $representante->profesion ?? '') }}">
                       <div class="invalid-feedback"></div>
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
                       name="residencia" value="{{ old('residencia', $representante->residencia ?? '') }}">
                       <div class="invalid-feedback"></div>
                       <div class="invalid-feedback"></div>
                       @error('residencia')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
         
    </div>

    

    <div class="row">
      
    </div>

    <button type="submit" class="btn btn-primary" id="btn-submit">Crear Representante</button>
</form>
