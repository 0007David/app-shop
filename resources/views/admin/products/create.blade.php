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
      <h2 class="title">Registrar nuevo producto</h2>
      <br><br>
      <form method="post" action="{{ url('admin/products') }}">
        @csrf
        <div class="row">
          <div class="offset-md-2 col-md-7">
            <!-- Campo Categoria -->
            <div class="form-group ">
              <label for="sel1">Selecione Categoria </label>
              <select class="form-control" id="sel1" name="category_id" required>
              @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
              </select>
          </div>
        </div>

          
        </div>
        <div class="row">
          <div class="offset-md-2 col-md-4">
            <!-- Campo nombre -->
            <div class="form-group label-floating">
              <label for="name">Nombre de producto</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>

          </div>
          
          <div class="col-md-1">
            <!-- Campo precio -->
            <div class="form-group">
              <label for="price">Precio</label>
              <input type="number" step="0.01" class="form-control" id="price" name="price" min="0" value="" required>
            </div>
          </div>
          <div class="col-md-1">
            <!-- Campo Cantidad -->
            <div class="form-group">
              <label for="base_quantity">Cantidad</label>
              <input type="number" class="form-control" id="base_quantity" name="base_quantity" min="0" value="0" required>
            </div>
          </div>
          <div class="col-md-1">
            <!-- Campo Stock -->
            <div class="form-group">
              <label for="stock">Stock</label>
              <input type="number" class="form-control" id="stock" name="stock" min="0" value="0">
            </div>
          </div>

        </div>

        <!-- Campo descripcion -->
        <div class="form-group offset-md-2 col-md-7" >
          <label for="description">Description corta</label>
          <input type="text" class="form-control" id="description" name="description" placeholder="Description corta..." maxlength="200" required>
        </div>

        <!-- Campo descripcion larga -->
        <div class="form-group offset-md-2 col-md-7">
          <label for="long_description">Descripcion larga</label>
          <textarea class="form-control" id="long_description" name="long_description" rows="3" placeholder="Descripcion larga..."></textarea>
        </div>


        <button class="btn btn-primary">Registrar producto</button>
        <a href="{{ url('/admin/products') }}" class="btn btn-default">cancelar</a>
        
      </form>
    
    </div>
    
  </div>

</div>

<!-- footer -->
@include('includes.footer')

@endsection