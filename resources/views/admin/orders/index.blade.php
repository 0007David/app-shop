@extends('layouts.app')

@section('title','Listado de pedidos')

@section('body-class','profile-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/profile_city.jpg') }}')">
    
</div>

<!-- div-pricipal -->
<div class="main main-raised">
  <!-- div-contendor -->
  <div class="container">

    <div class="section text-center">
      <h1 class="title">Pedidos por Confirmar</h1>
      <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width:4px">#</th>
                    <th>Nombre usuario</th>
                    <th>Fecha de Solicitud</th>
                    <th>Fecha de Evento</th>
                    <th class="text-right">Operaciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($orders as $order)
                
                <tr>
                    <td style="width:4px">P0{{ $order->id }}</td>
                    <td>{{ $order->cart->user->name }}</td>
                    <td class="text-left">{{ $order->application_date }}</td>
                    <td>{{ $order->event_date }}</td>
                    <td class="td-actions text-right">
                        
                        <form style="display: inline">
                          @csrf
                        <a href="{{ url('admin/order/'.$order->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Ver Pedido" class="btn btn-success btn-round btn-sm">
                            <i class="material-icons md-36">visibility</i>
                        </a>
                          <button data-toggle="tooltip" data-placement="top" title="Denegar Pedido" class="btn btn-danger btn-round btn-sm">
                              <i class="material-icons md-36">remove_shopping_cart</i>
                          </button>
                          
                        </form>
                      
                    </td>
                </tr>
                @endforeach

               
            </tbody>

          </table>
      
    </div>
    
  </div>
</div>

<!-- footer -->
@include('includes.footer')

@endsection