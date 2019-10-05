@extends('layouts.app')

@section('title','Categorias')

@section('body-class','profile-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/profile_city.jpg') }}')">
    
</div>

<!-- div-pricipal -->
<div class="main main-raised">
  <!-- div-contendor -->
  <div class="container">
  
    <div class="section text-center">
      <h2 class="title">Editar categoría seleccionado</h2>

      <form method="post" action="{{ url('admin/categories/'.$category->id.'/edit') }}">
        @csrf
        <div class="row">
          <div class="offset-md-3 col-md-7">
            <!-- Campo nombre -->
            <div class="form-group">
              <label for="name">Nombre de categoria</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" placeholder="Nombre del producto" required>
            </div>
          </div>
          <br>
          <div class="offset-md-3 col-md-7">
            <!-- Campo Descripcion -->
            <div class="form-group">
              <label for="description">Descripcion del categoria</label>
              <input type="text" class="form-control" id="description" name="description" value="{{ $category->description }}" required>
            </div>
            <br>
          </div> 
          <div class="offset-md-2 col-md-8">
              
              <img src="{{ $category->image }}" alt="imagen" width="250">
            
          </div>
        </div>
        <br>

        <button class="btn btn-primary">Guardar cambios</button>
        <a href="{{ url('/admin/categories') }}" class="btn btn-default">cancelar</a>
        
      </form>
    
    </div>
    
  </div>

</div>

<!-- footer -->
@include('includes.footer')

@endsection