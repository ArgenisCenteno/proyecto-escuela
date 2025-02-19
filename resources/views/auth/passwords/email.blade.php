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
            @if (session('status'))
              <div class="alert alert-success text-center" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
              @csrf

              <div class="mb-3">
                <label for="email" class="form-label"><strong>Correo Electrónico</strong></label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">
                  {{ __('Enviar enlace de recuperación') }}
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
