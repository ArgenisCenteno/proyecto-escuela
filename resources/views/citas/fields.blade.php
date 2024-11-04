<form action="{{ route('citas.store') }}" method="POST">
    @csrf
    <div class="row">
        <!-- Fecha Field -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror" required>
                @error('fecha')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Hora Field -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="hora">Hora</label>
                <input type="time" name="hora" id="hora" class="form-control @error('hora') is-invalid @enderror" required>
                @error('hora')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Especialista Field -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="especialista_id">Especialista</label>
                <select name="especialista_id" id="especialista_id" class="form-control @error('especialista_id') is-invalid @enderror" >
                <option value="">Seleccione un opción</option>
  
                @foreach($especialistas as $especialista)
                        <option value="{{ $especialista->id }}">{{ $especialista->nombre }} {{ $especialista->apellido }}</option>
                    @endforeach
                </select>
                @error('especialista_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Paciente Field -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="paciente_id">Paciente</label>
                <select name="paciente_id" id="paciente_id" class="form-control @error('paciente_id') is-invalid @enderror" required>
                <option value="">Seleccione un opción</option>
                @foreach($pacientes as $paciente)
                        <option value="{{ $paciente->id }}">{{ $paciente->nombre }} {{ $paciente->apellido }}</option>
                    @endforeach
                </select>
                @error('paciente_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Estado Field -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="estatus">Estado</label>
                <select name="estatus" id="estatus" class="form-control @error('estatus') is-invalid @enderror" required>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Confirmada">Confirmado</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
                @error('estatus')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Nota Field -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="nota">Nota</label>
                <textarea name="nota" id="nota" class="form-control @error('nota') is-invalid @enderror"></textarea>
                @error('nota')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Registrar Cita</button>
</form>
