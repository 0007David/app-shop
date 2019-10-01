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
       <!-- Plugin FullCallender -->
 <!--  <link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/fullcalendar.print.min.css') }}" media="print">
  <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}" media="print"> -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
   <!-- CSS Files -->
   <link href="{{ asset('css/material-kit.css') }}" rel="stylesheet" />

   <!-- DataTable -->
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
   
   <link href="{{url('packages/core/main.css')}}" rel="stylesheet" />
    <link href="{{url('packages/daygrid/main.css')}}" rel="stylesheet" />
    <link href="{{url('packages/timegrid/main.css')}}" rel="stylesheet" />
    <link href="{{url('packages/list/main.css')}}" rel="stylesheet" />

    <script src="{{url('packages/core/main.js')}}"></script>
    <script src="{{url('packages/interaction/main.js')}}"></script>
    <script src="{{url('packages/daygrid/main.js')}}"></script>
    <script src="{{url('packages/timegrid/main.js')}}"></script>
    <script src="{{url('packages/list/main.js')}}"></script>



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
                      @if (!Auth::user()->admin )
                      <a href="{{ url('/') }}" class="dropdown-item">
                        <i class="material-icons">dashboard</i> Productos
                      </a>
                      <a href="{{ url('/') }}" class="dropdown-item">
                        <i class="material-icons">dashboard</i> Categorias
                      </a>
                      @endif
                      @if ( Auth::user()->admin )
                      <a href="{{ url('/admin/events') }}" class="dropdown-item">
                        <i class="material-icons">apps</i> Eventos
                      </a>
                      <a href="{{ url('/admin/order') }}" class="dropdown-item">
                        <i class="material-icons">apps</i> Pedidos
                      </a>
                      <a href="{{ url('/admin/products') }}" class="dropdown-item">
                        <i class="material-icons">apps</i> Productos
                      </a>
                      <a href="{{ url('/admin/categories') }}" class="dropdown-item">
                        <i class="material-icons">apps</i> Categorías
                      </a>
                      <a href="#" class="dropdown-item">
                        <i class="material-icons">list</i> Combos
                      </a>
                      <a href="#" class="dropdown-item">
                        <i class="material-icons">face</i> Clientes
                      </a>
                      @endif 
                      
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

  <!-- fullCalendar -->
  <!-- <script src="{{ asset('/js/plugins/moment.min.js') }}"></script> -->
  <!-- <script src="{{ asset('/js/plugins/fullcalendar.min.js') }}"></script> -->
  
   <!--  Google Maps Plugin    -->
   <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
   <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBC6Gssuae_XhHbInazo35mIcpIY3xXAJw&callback=initMap"> 
    </script>
   <!-- Jquery Sharree btn -->
   <script src="{{ asset('/js/plugins/jquery.sharrre.js') }}" type="text/javascript"></script>
   <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
   <script src="{{ asset('/js/material-kit.js') }}" type="text/javascript"></script>
 <!-- Data table JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script>
   $('.datetimepicker').datetimepicker({
    icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
    }
});

    $(document).ready(function() {
    $('.tablas').DataTable( {
        "language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)"
        }
    } );
} );

 </script>
</body>

</html>