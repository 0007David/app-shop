@extends('layouts.app')

@section('body-class','login-page sidebar-collapse')

@section('content')
<!-- Imagen de Fondo -->
<div class="page-header header-filter" style="background-image: url('{{ asset('img/bg7.jpg') }}'); background-size: cover; background-position: top center;">

    <!-- div-Contenedor -->
    <div class="container">

        <div class="row">

            <div class="col-lg-4 col-md-6 ml-auto mr-auto">

                <div class="card card-login">
                    <!-- formulario -->
                    <form class="form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="card-header card-header-primary text-center">

                            <h4 class="card-title">Registro</h4>

                            <!-- <div class="social-line">

                                <a href="#" class="btn btn-just-icon btn-link">
                                    <i class="fa fa-facebook-square"></i>
                                </a>
                                <a href="#" class="btn btn-just-icon btn-link">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-just-icon btn-link">
                                    <i class="fa fa-google-plus"></i>
                                </a>

                            </div> -->
                        </div>
                        <p class="description text-center">Completa tus datos</p>
                        <div class="card-body">
                            <!-- Nombre -->
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">face</i>
                                    </span>
                                </div>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nombre" required autocomplete="name" autofocus>
                            </div>
                            <!-- Correo electronico -->
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">mail</i>
                                    </span>
                                </div>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email..." required autocomplete="email" autofocus>
                            </div>
                            <!-- Contraseña -->
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                </div>

                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña..." required autocomplete="new-password">
                            </div>
                             <!-- Confirmar Contraseña -->
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                </div>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña..." required autocomplete="new-password">
                            </div>

                        </div>
                        <div class="footer text-center">  
                            <button type="submit" class="btn btn-primary btn-link btn-wd btn-lg">
                                {{ __('Confirmar registro') }}
                            </button>
                        </div>
                    </form>
                    <!-- formulario-end -->
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    @include('includes.footer')

</div>
@endsection
