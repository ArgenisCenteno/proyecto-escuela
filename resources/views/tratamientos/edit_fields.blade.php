<form action="{{ route('tratamientos.update', $tratamiento->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nombre">Nombre del Tratamiento</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $tratamiento->nombre }}" required>
    </div>

    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="form-control" rows="3"
            required>{{ $tratamiento->descripcion }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="{{ route('tratamientos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>