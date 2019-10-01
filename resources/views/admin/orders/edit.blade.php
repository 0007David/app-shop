@extends('layouts.app')

@section('title','Listado de productos')

@section('body-class','profile-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/profile_city.jpg') }}')">
    
</div>

<!-- Classic Modal -->
  <div class="modal fade" id="ModalAvailabilityProduct" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title text-center">Lista de Productos</h3>
          
        </div>
          <div class="modal-body">

            <table class="table table-striped tablas" style="width:100%">
                  <thead>
                      <tr>
                          <th>Categorias</th>
                          <th>Nombre</th>
                          <th>Stock Disponible</th>
                          
                          
                      </tr>
                  </thead>
                  <tbody>

                      @foreach ($products as $product)
                      
                      <tr>
                          <td>{{ $product->category ? $product->category->name : 'General' }} </td>
                          <td>{{ $product->name }}</td>
                          <td>{{ $product->available }}</td>
                          
                      </tr>
                      @endforeach

                     
                  </tbody>

              </table>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-link">Añadir al carrito</button>
          </div>
      </div>
    </div>
  </div>
  <!--  End Modal -->

<!-- div-pricipal -->
<div class="main main-raised">
  <!-- div-contendor -->
  <div class="container">
	<div class="section text-center">
      <h1 class="title">Lista de Productos del </h1>
      <h3>Usuario {{ $order->cart->user->name }} que organizara un {{ $order->name }}</h3>
      <br>
      <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#ModalAvailabilityProduct">
         <i class="material-icons">add_shopping_cart</i> Ver Productos Disponibles
      </button>
         <form method="post" action="{{url('admin/order/'.$order->id.'/approve')}}">
        @csrf
      <div class="row">
        <div class="offset-md-2 col-md-8">
            <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>Nombre</th>
                          <th>Cantidad</th>
                          <th>Precion</th>
                          <th>Monto</th>
                          
                      </tr>
                  </thead>
                  <tbody>

                      @foreach ($details as $detail)
                      
                      <tr>
                          <td> {{ $detail->product->name }} </td>
                          <td>{{ $detail->quantity }}</td>
                          <td>{{ $detail->product->price }}</td>
                          <td>{{ $detail->product->price * $detail->quantity }}</td>
                          
                      </tr>
                      @endforeach

                     
                  </tbody>

                </table>
          
        </div>
          <div class="offset-md-2 col-md-8">
            <!-- Campo Fecha -->
            <div class="form-group bmd-form-group is-filled">
			    <label class="label-control">Fecha y Hora</label>
    	        <input type="text" class="form-control" value="{{ $order->date }}" readonly>
            </div>
          </div>
          <br><br>

          <div class="offset-md-2 col-md-8">
            <!-- Campo Direccion -->
            <div class="form-group">
              <label for="address">Direccion</label>
              <input type="text" class="form-control" id="address" value="{{ $order->address}}" readonly>
            </div>
            <h4>La ubicacion del evento se representa por el marcador rojo..</h4>
          </div>
          <br><br>
         <?php 
            $config = array();
                
            $config['center'] = '-17.841135, -63.110573';
            $config['zoom'] = '15';
            $config['directions'] = true;
            $config['directionsStart'] = '-17.776810, -63.196121';
            $config['directionsMode'] = 'DRIVING';

            $marker = array();
			      $marker['position'] = '-17.776810, -63.196121';
			      $marker['infowindow_content'] = 'Mi Ubicacion!';
			      $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
            GMaps::add_marker($marker);

            //marker 2 
            $position = $order->latitude.", ". $order->length;
            $marker = array();
            $marker['position'] = $position;
            $marker['infowindow_content'] = 'Ubicacion del '. $order->name. '!';
            
            GMaps::add_marker($marker);

            GMaps::initialize($config);
            $map = GMaps::create_map();

            echo $map['js'];
            echo $map['html']; 
            ?>
            <div id="directionsDiv"></div>
            <br><br>
        	
        
          <div class="offset-md-2 col-md-8">
          	
          	<br>
            <!-- Campo monto total -->
            <div class="form-group">
              <label for="stock">monto Total Productos</label>
              <input type="text" class="form-control" value="{{$order->total_amount}}" readonly>
              
    
            </div>
              <br>
            <!-- Campo Costo de Transporte -->
            <div class="form-group">
              <label for="stock">Costo de Transporte del Producto</label>
              <input type="text" class="form-control" name="transport_cost" value="" required>
    
            </div>
          </div>

        </div>
        <button class="btn btn-primary">Aceptar evento</button>
        <a href="{{url('admin/order/'.$order->id.'/deny')}}" class="btn btn-danger">Rechazar evento</a>
        <a href="{{ url('/admin/order') }}" class="btn btn-default">cancelar</a>
      </form>
      
        
      
      
    </div>


  </div>

</div>
<script>
 
</script>

<!-- footer -->
@include('includes.footer')

@endsection