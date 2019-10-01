@extends('layouts.app')

@section('title','Listado de productos')

@section('body-class','profile-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/profile_city.jpg') }}')">
    
</div>


<!-- div-pricipal -->
<div class="main main-raised">
  <!-- div-contendor -->
  <div class="container">

    <div class="section text-center">
      <h1 class="title">Ingrese los datos para su evento</h1>
      <br><br>
         <form method="post" action="{{ url('/event/store')}}">
        @csrf
        <div class="row">

          <div class="offset-md-2 col-md-8">
            <!-- Campo nombre -->
            <div class="form-group label-floating">
              <label for="name">Nombre de Evento</label>
              <input type="text" class="form-control" id="name" name="name">
            </div>

          </div>

          <div class="offset-md-2 col-md-8">
            <!-- Campo Fecha -->
            <div class="form-group bmd-form-group is-filled">
			    <label class="label-control bmd-label-static">Fecha y Hora</label>
    	        <input type="text" class="form-control datetimepicker" name="date" value="{{ date('Ymd H:i:s') }}">
            </div>
          </div>

          <div class="offset-md-2 col-md-8">
            <!-- Campo Direccion -->
            <div class="form-group">
              <label for="address">Direccion</label>
              <input type="text" class="form-control" id="address" name="address">
            </div>
            <h4>Busque su ubicacion exacta, y pon el marcador en donde se realizara el evento ..</h4>
          </div>
         <?php 
            $config = array();
                
            $config['center'] = '-17.841135, -63.110573';
            $config['zoom'] = '15';
            
            $marker = array();
            $marker['position'] = '-17.841135, -63.110573';
            $marker['draggable'] = true;
            $marker['ondragend'] = 'document.getElementById("id_latitude").value = event.latLng.lat(); 
                                    document.getElementById("id_length").value = event.latLng.lng();';
            GMaps::add_marker($marker);
            GMaps::initialize($config);
            $map = GMaps::create_map();

            echo $map['js'];
            echo $map['html']; 
            ?>
        	
        
          <div class="offset-md-2 col-md-8">
          	
          	<br>
            <!-- Campo monto total -->
            <div class="form-group">
              <label for="stock">monto Total Productos</label>
              <input type="text" class="form-control" id="direccion" name="total_amount" value="{{ auth()->user()->cart->amount }}" readonly>
              <input type="hidden" id="id_latitude" name="latitude" value="-17.841135" >
              <input type="hidden" id="id_length" name="length" value="-63.110573">
              
    
            </div>
          </div>

        </div>
        <button class="btn btn-primary">Registrar evento</button>
        <a href="{{ url('/home') }}" class="btn btn-default">cancelar</a>
        
      </form>
      <p>{{ $notification }}</p>
      
    </div>
    
  </div>
</div>

<!-- footer -->
@include('includes.footer')

@endsection