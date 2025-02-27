@extends('layouts.app')

@section('content')
<section class="vh-100"
  style="background-image: url('iconos/back.jpg'); background-size: cover; background-position: center;">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">

      <div class="col-md-9 col-lg-6 col-xl-4 offset-xl-1 ">
        <form method="POST" action="{{ route('user.login') }} ">
          @csrf

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0 text-white">Ingresar al sistema</p>
          </div>

          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label text-white" for="email"> <strong>Correo Electrónico</strong> </label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
              value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-3">
            <label class="form-label text-white" for="password"> <strong>Contraseña</strong> </label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
              name="password" required autocomplete="current-password">
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <!-- Enlace para recuperar contraseña -->
          <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('password.request') }}" class="text-black">¿Olvidaste tu contraseña?</a>
          </div>

          <div class="text-center text-lg-center mt-4 pt-2">
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Acceder</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
