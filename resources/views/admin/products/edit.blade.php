@extends('layouts.app')

@section('title','Bienvenido a App-Shop')

@section('body-class','profile-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/profile_city.jpg') }}')">
    
</div>

<!-- div-pricipal -->
<div class="main main-raised">
  <!-- div-contendor -->
  <div class="container">
  
    <div class="section text-center">
      <h2 class="title">Editar producto seleccionado</h2>

      <form method="post" action="{{ url('admin/products/'.$product->id.'/edit') }}">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <!-- Campo nombre -->
            <div class="form-group">
              <label for="name">Nombre de producto</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" placeholder="Nombre del producto">
            </div>
          </div>
          
          <div class="col-md-6">
            <!-- Campo precio -->
            <div class="form-group">
              <label for="price">Precio del producto</label>
              <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $product->price }}" placeholder="Precio del producto">
            </div>
            
            <!-- <div class="form-group label-floating">
              <label class="control-label">Precio del producto</label>
              <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}">
            </div> -->
          </div>


          
        </div>

        <!-- Campo descripcion -->
        <div class="form-group">
          <label for="description">Description corta</label>
          <input type="text" class="form-control" id="description" name="description" value="{{ $product->description }}" placeholder="Description corta..." maxlength="200">
        </div>

        <!-- Campo descripcion larga -->
        <div class="form-group">
          <label for="long_description">Descripcion larga</label>
          <textarea class="form-control" id="long_description" name="long_description" rows="3" placeholder="Descripcion larga...">{{ $product->long_description }}</textarea>
        </div>


        <button class="btn btn-primary">Guardar cambios</button>
        <a href="{{ url('/admin/products') }}" class="btn btn-default">cancelar</a>
        
      </form>
    
    </div>
    
  </div>

</div>

<!-- footer -->
@include('includes.footer')

@endsection