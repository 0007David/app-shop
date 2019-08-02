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
      <h3 class="title">Listado de productos</h3>
      <div class="team">

        <a href="{{ url('/admin/products/create') }}" class="btn btn-primary btn-round">Nuevo producto</a> <br><br>
        <div class="row">

          <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width:4px">#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th class="text-right">Precio</th>
                    <th class="text-right">Operaciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($products as $product)
                <tr>
                    <td style="width:4px">{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td class="text-left">{{ $product->description_to_show }}</td>
                    <td>{{ $product->category ? $product->category->name : 'General' }}</td>
                    <td >${{ $product->price }}</td>
                    <td class="td-actions text-right">
                      
                        <form style="display: inline" method="post" action="{{ url('/admin/products/'.$product->id.'/delete') }}">
                          @csrf
                        <button type="button" data-toggle="tooltip" data-placement="top" title="ver info" class="btn btn-info btn-round btn-sm">
                            <i class="material-icons md-36">info</i>
                        </button>
                        <a href="{{ url('/admin/products/'.$product->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-success btn-round btn-sm">
                            <i class="material-icons md-36">edit</i>
                        </a>
                        <a href="{{ url('/admin/products/'.$product->id.'/images') }}" data-toggle="tooltip" data-placement="top" title="Imagenes del producto" class="btn btn-warning btn-round btn-sm">
                            <i class="material-icons md-36">collections</i>
                        </a>
                          <button type="submit" data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-danger btn-round btn-sm">
                              <i class="material-icons md-36">delete_forever</i>
                          </button>
                          
                        </form>
                      
                    </td>
                </tr>
                @endforeach

               
            </tbody>

          </table>
          

          
        </div>
          {{ $products->links() }}          

      </div>
    </div>
    
  </div>
</div>

<!-- footer -->
@include('includes.footer')

@endsection