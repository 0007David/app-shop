<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="utf-8" />
   <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
   <link rel="icon" type="image/png" href="../assets/img/favicon.png">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
   <title> @yield('title','App Shop')</title>
   <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
   <!--     Fonts and icons     -->
   <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
   <!-- CSS Files -->
   <link href="{{ asset('css/material-kit.css?v=2.0.5') }}" rel="stylesheet" />
   <!-- CSS Just for demo purpose, don't include it in your project -->
   <link href="{{ asset('demo/demo.css') }}" rel="stylesheet" />
</head>

<body class="@yield('body-class')">

   <!-- NavBar -->
   <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
      <div class="container">
         <div class="navbar-translate">
            <a class="navbar-brand" href="{{ url('/')}}"> App Shop </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
               <span class="sr-only">Toggle navigation</span>
               <span class="navbar-toggler-icon"></span>
               <span class="navbar-toggler-icon"></span>
               <span class="navbar-toggler-icon"></span>
            </button>
         </div>
         <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
               <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                        </li>
                    @endif
                @else
                  <li class="dropdown nav-item">

                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false">
                      <i class="material-icons md-36">face</i> {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-with-icons">
                      <!-- <a href="{{ url('/home') }}" class="dropdown-item">
                        <i class="material-icons">dasboard</i> Dasboard
                      </a> -->
                      <a href="{{ url('/home') }}" class="dropdown-item">
                        <i class="material-icons">dashboard</i> Dashboard
                      </a>
                      @if ( Auth::user()->admin )
                      <a href="{{ url('/admin/products') }}" class="dropdown-item">
                        <i class="material-icons">apps</i> Gestionar Productos
                      </a>
                      @endif 
                      <a href="#" class="dropdown-item">
                        <i class="material-icons">list</i> Categoría
                      </a>
                      <a href="#" class="dropdown-item">
                        <i class="material-icons">face</i> Cliente
                      </a>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i class="material-icons">layers</i>
                                {{ __('Cerrar sesión') }}
                            </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                    </div>
                   </li>
                
                    
                @endguest

               <!-- <li class="nav-item">
                  <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank" data-original-title="Follow us on Twitter">
                     <i class="fa fa-twitter"></i>
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://www.facebook.com/CreativeTim" target="_blank" data-original-title="Like us on Facebook">
                     <i class="fa fa-facebook-square"></i>
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" rel="tooltip" title="" data-placement="bottom" href="https://www.instagram.com/CreativeTimOfficial" target="_blank" data-original-title="Follow us on Instagram">
                     <i class="fa fa-instagram"></i>
                  </a>
               </li> -->
            </ul>
         </div>
      </div>
   </nav>
   <!-- Aqui va el Contenido Central -->
   @yield('content')


   <!-- --------- -->
    <!--   Core JS Files   -->
   <script src="{{ asset('/js/core/jquery.min.js') }}"  type="text/javascript"></script>
   <script src="{{ asset('/js/core/popper.min.js') }}"  type="text/javascript"></script>
   <script src="{{ asset('/js/core/bootstrap-material-design.min.js') }}" type="text/javascript"></script>
   <script src="{{ asset('/js/plugins/moment.min.js') }}"></script>
   <!--   Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
   <script src="{{ asset('/js/plugins/bootstrap-datetimepicker.js') }}"  type="text/javascript"></script>
   <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
   <script src="{{ asset('/js/plugins/nouislider.min.js') }}"  type="text/javascript"></script>
   <!--  Google Maps Plugin    -->
   <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
   <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
   <script src="{{ asset('/js/material-kit.js?v=2.0.5') }}" type="text/javascript"></script>
</body>

</html>