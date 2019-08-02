@extends('layouts.app')

@section('title','App-Shop | Dashboard')

@section('body-class','profile-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/profile_city.jpg') }}')">
    
</div>

<!-- div-pricipal -->
<div class="main main-raised">
  <!-- div-contendor -->
  <div class="container">
  
    <div class="section text-center">
      <h2 class="title">Dashboard</h2>
        <br>
        @if (session('notification') && session('notification') )
          <div class="alert alert-warning">
            <div class="container">
              <div class="alert-icon">
                <i class="material-icons">warning</i>
              </div>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="material-icons">clear</i></span>
              </button>
              <b>Warning :  </b> {{ session('notification') }}
            </div>
          </div>
        @elseif(session('notification'))
          <div class="alert alert-success">
            <div class="container">
              <div class="alert-icon">
                <i class="material-icons">check</i>
              </div>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="material-icons">clear</i></span>
              </button>
              <b>Exito:  </b> {{ session('notification') }}
            </div>
          </div>
        @endif
          <ul class="nav nav-pills nav-pills-success nav-pills-icons" role="tablist">
          <!--
                          color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                      -->
          <li class="nav-item ">
            <a class="nav-link active show" href="#" role="tab" data-toggle="tab" aria-selected="true">
              <i class="material-icons">shopping_cart</i> Carrito compra
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" role="tab" data-toggle="tab" aria-selected="false">
              <i class="material-icons">schedule</i> Schedule
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#tasks-1" role="tab" data-toggle="tab" aria-selected="false">
              <i class="material-icons">list</i> Pedidos realizados
            </a>
          </li>
        </ul>
        <hr>
        <h4>Tu carrito de compras presenta {{ auth()->user()->cart->details->count() }} productos</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th >Cantidad</th>
                    <th>Precio</th>
                    <th>SubTotal</th>
                    <th class="text-right">Operaciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach (auth()->user()->cart->details as $detail)
                <tr>
                    <td >
                      <img src="{{ $detail->product->featured_image_url }}" height="50">
                    </td>
                    <td> <a href="{{ url('/products/'.$detail->product->id ) }}" target="_blank"> {{ $detail->product->name}}</a></td>
                    <td >{{ $detail->quantity }}</td>
                    <td>$ {{ $detail->product->price }}</td>
                    <td >$ {{ $detail->quantity * $detail->product->price }}</td>
                    <td class="td-actions">
                      
                        <form style="display: inline" method="post" action="{{ url('/cart/delete') }}">
                          @csrf
                          <a href="{{ url('/products/'.$detail->product->id ) }}" target="_blank"  data-toggle="tooltip" data-placement="top" title="ver info" class="btn btn-info btn-round btn-sm">
                              <i class="material-icons md-36">info</i>
                          </a>
                          <input type="hidden" name="cart_detail_id" value="{{ $detail->id }}">
                          <button type="submit" data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-danger btn-round btn-sm">
                              <i class="material-icons md-36">delete_forever</i>
                          </button>
                          
                        </form>
                      
                    </td>
                </tr>
                @endforeach

               
            </tbody>

          </table>
        <form method="post" action="{{url('/order')}}">
          @csrf
          <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#ModalProductAdd">
                        <i class="material-icons">done</i> Realizar Pedido
          </button>
        </form>
    </div>
    
  </div>



</div>

<!-- footer -->
@include('includes.footer')

@endsection