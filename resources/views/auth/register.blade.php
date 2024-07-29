@extends('layouts.auth')
@section('title', 'Registro')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-xxl-11">
            <div class="card border-0">
                <div class="row g-0">
                    <div class="col-12 col-md-6">
                        <img class="img-fluid rounded w-100 h-100 my-2 object-fit-cover" loading="lazy"
                            src="{{Vite::asset("resources/media/images/prison-img.jpg")}}" alt="Prison image">
                    </div>
                    <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                        <div class="col-12 col-lg-11 col-xl-10">
                            <div class="card-body p-3 p-md-4 p-xl-5">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-5">
                                            <div class="text-center mb-4">

                                                <img src="{{Vite::asset("resources/media/images/logo.png")}}"
                                                    alt="Logo prison" width="150" height="150">

                                            </div>
                                            <h4 class="text-center">¡Bienvenido/a al registro!</h4>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row gy-3 overflow-hidden">
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input id="id" type="number"
                                                    class="form-control @error('id') is-invalid @enderror" name="id"
                                                    value="{{ old('id') }}" required autocomplete="id" autofocus>
                                                @error('id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <label for="id" class="form-label">Identificación</label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input id="nombres" type="text"
                                                    class="form-control @error('nombres') is-invalid @enderror"
                                                    name="nombres" value="{{ old('nombres') }}" required
                                                    autocomplete="nombres" autofocus>
                                                @error('nombres')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <label for="nombres" class="form-label">Nombres</label>
                                            </div>


                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input id="apellidos" type="text"
                                                    class="form-control @error('apellidos') is-invalid @enderror"
                                                    name="apellidos" value="{{ old('apellidos') }}" required
                                                    autocomplete="apellidos" autofocus>
                                                @error('apellidos')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <label for="apellidos" class="form-label">Apellidos</label>
                                            </div>


                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{$message }}</strong>
                                                </span>
                                                @enderror
                                                <label for="email" class="form-label">Correo electrónico</label>
                                            </div>


                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input id="password" type="password" class="form-control"
                                                    name="password" required autocomplete="current-password">
                                                <label for="password" class="form-label">Contraseña</label>
                                            </div>

                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input id="password-confirm" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password_confirmation" required autocomplete="new-password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <label for="password-confirm" class="form-label">Confirmar
                                                    contraseña</label>
                                            </div>

                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-dark btn-lg" type="submit">Registrarme</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-12">
                                        <div
                                            class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center mt-5">
                                            <p class="link-secondary text-decoration-none">¿Ya tienes una cuenta?</p>
                                            <a href="{{route('login')}}"
                                                class="link-secondary text-decoration-none">Iniciar sesión</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection