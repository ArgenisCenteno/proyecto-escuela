@extends('layouts.app')

@section('content')
<section class="vh-100 d-flex align-items-center justify-content-center"
  style="background: linear-gradient(to right, #004e92, #000428);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-lg">
          <div class="card-header text-center bg-primary text-white">
            <h4>{{ __('Restablecer Contraseña') }}</h4>
          </div>

          <div class="card-body p-4">
            <form method="POST" action="{{ route('password.update') }}">
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">

              <div class="mb-3">
                <label for="email" class="form-label"><strong>Correo Electrónico</strong></label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                  name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="password" class="form-label"><strong>Nueva Contraseña</strong></label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" required autocomplete="new-password">

                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="password-confirm" class="form-label"><strong>Confirmar Contraseña</strong></label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                  required autocomplete="new-password">
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">
                  {{ __('Restablecer Contraseña') }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
