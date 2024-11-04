<form action="{{ route('notasmedicas.update', $notaMedica->id) }}" method="POST">
    @csrf
    @method('PUT')
  
    <div class="form-group">
        <label for="especialista_id">Especialista ID</label>
        <input type="number" name="especialista_id" id="especialista_id" class="form-control"
            value="{{ $notaMedica->especialista_id }}" required readonly>
    </div>
    <div class="form-group">
        <label for="nota">Nota</label>
        <textarea name="nota" id="nota" class="form-control" rows="3" required>{{ $notaMedica->nota }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="{{ route('notasmedicas.index') }}" class="btn btn-secondary">Cancelar</a>
</form>