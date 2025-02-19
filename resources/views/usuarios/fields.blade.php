<form action="{{ route('usuarios.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
        <div class="invalid-feedback"></div>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
        <div class="invalid-feedback"></div>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
        <div class="invalid-feedback"></div>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="dni" class="form-label">Cédula</label>
        <input type="text" id="cedula" class="form-control @error('dni') is-invalid @enderror" id="dni" name="dni" value="{{ old('dni') }}" required>
        <div class="invalid-feedback"></div>
        @error('dni')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="sector" class="form-label">Sector</label>
        <input type="text" class="form-control @error('sector') is-invalid @enderror" id="sector" name="sector" value="{{ old('sector') }}">
        <div class="invalid-feedback"></div>
        @error('sector')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="calle" class="form-label">Calle</label>
        <input type="text" class="form-control @error('calle') is-invalid @enderror" id="calle" name="calle" value="{{ old('calle') }}">
        <div class="invalid-feedback"></div>
        @error('calle')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="casa" class="form-label">Casa</label>
        <input type="text" class="form-control @error('casa') is-invalid @enderror" id="casa" name="casa" value="{{ old('casa') }}">
        <div class="invalid-feedback"></div>
        @error('casa')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="role" class="form-label">Rol</label>
        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
            <option value="">Selecciona un rol</option>
            @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                    {{ ucfirst($role->name) }}
                </option>
            @endforeach
        </select>
        @error('role')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Estado</label>
        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
            <option value="Activo" {{ old('status') == 'Activo' ? 'selected' : '' }}>Activo</option>
            <option value="Inactivo" {{ old('status') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
        </select>
        <div class="invalid-feedback"></div>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary" id="btn-submit">Crear Usuario</button>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
