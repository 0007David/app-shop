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
      <h2 class="title">Registrar nuevo categoria</h2>

      <form method="post" action="{{ url('/admin/categories') }}" enctype="multipart/form-data" accept-charset="UTF-8">
        @csrf
        <div class="row text-center">
          <div class="offset-md-3 col-md-7">
            <!-- Campo nombre -->
            <div class="form-group">
              <label for="name">Nombre de categoria</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del categoria">
            </div>
          </div> 
          <div class="offset-md-3 col-md-7">   
            <!-- Campo descripcion -->
            <div class="form-group">
              <label for="description">Description</label>
              <input type="text" class="form-control" id="description" name="description" placeholder="Description.." maxlength="200">
            </div>
          </div>
          <div class="offset-md-3 col-md-7">
            <input type="file" name="photo">
          </div>
        </div>
          <hr>
        
        <button type="submit" class="btn btn-primary">Registrar categoria</button>
        <a href="{{ url('/admin/categories') }}" class="btn btn-default">cancelar</a>
        
      </form>
    
    </div>
    
  </div>

</div>

<!-- footer -->
@include('includes.footer')

@endsection