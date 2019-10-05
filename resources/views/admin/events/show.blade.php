@extends('layouts.app')

@section('title','Lista de eventos')

@section('body-class','profile-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/profile_city.jpg') }}')">
    
</div>

<!-- div-pricipal -->
<div class="main main-raised">
  	<!-- div-contendor -->
  	<div class="container">
		<div class="section text-center">
      		<h1 class="title">Requerimiento del evento {{$event->name}} </h1>
      		<h2>{{$event->cart->user->name}} es el organizador</h2>
      		<br><br>
      		<h3>Productos requerido</h3>

			<div class="row">
				<div class="offset-md-2 col-md-8">
		            <table class="table table-striped">
		                  <thead>
		                      <tr>
		                          <th>Nombre</th>
		                          <th>Cantidad</th>
		                      </tr>
		                  </thead>
		                  <tbody>

		                      @foreach ($details as $detail)
		                      
		                      <tr>
		                          <td> {{ $detail->product->name }} </td>
		                          <td>{{ $detail->quantity }}</td>
		                      </tr>
		                      @endforeach

		                     
		                  </tbody>

		            </table>
		          
		        </div>
		        <div class="offset-md-2 col-md-8">
		            <!-- Campo Direccion -->
		            <div class="form-group ">
					    <label class="label-control">Direccion</label>
		    	        <input type="text" class="form-control" value="{{ $event->address }}" readonly>
		            </div>
		        </div>
		        <div class="offset-md-2 col-md-8">
		            <!-- Campo Fecha -->
		            <div class="form-group ">
					    <label class="label-control">Fecha</label>
		    	        <input type="text" class="form-control" value="{{ $event->event_date }}" readonly>
		            </div>
		        </div>

		        <div class="offset-md-2 col-md-8">
		            <!-- Campo Fecha -->
		            <div class="form-group ">
					    <label class="label-control">Ubicacion (X,Y)</label>
		    	        <input type="text" class="form-control" value="{{ $event->latitude.', '.$event->length }}" readonly>
		            </div>
		        </div>
			</div>
		        <a href="{{ url('/admin/events') }}" class="btn btn-default">Atras</a>
    	</div>
    
  	</div>
</div>

  <!-- footer -->
@include('includes.footer')

@endsection