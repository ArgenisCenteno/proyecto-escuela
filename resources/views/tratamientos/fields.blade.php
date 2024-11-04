<form action="{{ route('tratamientos.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nombre">Nombre del Tratamiento</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('tratamientos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>