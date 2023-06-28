@extends('layouts.auth.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <a href="/"><img class="logo-img" src="{{ asset('assets/images/logo.png')}}" alt="logo"></a>
                    <span class="splash-description">Please enter your user information.</span>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-9 mx-auto">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-9 mx-auto">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Esto se usa para seleccionar el Foreign Key del User --}}
                        {{-- <div class="row mb-3">
                            <div class="col-md-9 mx-auto">
                                <input id="empresa_id" type="number" min="1" class="form-control @error('empresa_id') is-invalid @enderror" name="empresa_id" placeholder="Id de la empresa" value="{{ old('empresa_id') }}" required autocomplete="empresa_id">

                                @error('empresa_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="row mb-3">
                            <div class="col-md-9 mx-auto">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-9 mx-auto">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="col-md-6 mx-auto mb-3">
                            <div class="form-check ">
                                <input type="hidden" name="admin" value="0">
                                {{-- Lo de abajo se usó para crear el admin user --}}
                                {{-- <input type="checkbox" class="form-check-input" name="adminCheckbox" id="adminCheckbox" {{ old('adminCheckbox') ? 'checked' : '' }} onclick="this.previousElementSibling.value=1-this.previousElementSibling.value">
                                <label class="form-check-label" for="adminCheckbox">
                                    {{ __('¿Admin user?') }}
                                </label> --}}
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection