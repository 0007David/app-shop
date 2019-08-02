@extends('layouts.app')

@section('title','Imagenes de productos')

@section('body-class','profile-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/profile_city.jpg') }}')">
    
</div>

<!-- div-pricipal -->
<div class="main main-raised">
  <!-- div-contendor -->
  <div class="container">

    <div class="section text-center">
      <h2 class="title">Imágenes del producto "{{$product->name}}"</h2>
      <div class="team">
        <br><hr>
        <form method="post" action="{{ url('admin/products/'.$product->id.'/images/store') }}" enctype="multipart/form-data" accept-charset="UTF-8">
          @csrf
            <input type="file"  name="photo" required>
          <br> <br>
          <button type="submit" class="btn btn-primary btn-round">Subir nueva imagen</button>
          <a href="{{ url('/admin/products') }}" class="btn btn-default btn-round">Volver al listado de productos</a>
        </form>
         <br><hr>
        <div class="row">
          @foreach ($images as $image)
          <div class="col-md-4">
            <div class="card bg-light">
              <img src="{{ $image->url }}"> 
              <div class="card-body"> 
              <form method="post" action="">
                @csrf
                <input type="hidden" name="image_id" value="{{ $image->id }}">
                <button type="submit" class="btn btn-danger btn-round">Eliminar imagen</button>
                @if ($image->featured)
                  <button type="button" class="btn btn-danger btn-fab btn-round" data-toggle="tooltip" data-placement="top" title="Imagen destacada" data-container="body" data-original-title="Tooltip on top">
                  <i class="material-icons">favorite</i>
                  </button>
                  <!-- <button type="button" class="btn" data-toggle="tooltip" data-placement="top" title="Imagen destacada" data-container="body" data-original-title="Tooltip on top">On top</button> -->
                @else
                  <a href="{{ url('/admin/products/'.$product->id.'/images/select/'.$image->id) }}" class="btn btn-primary btn-fab btn-round">
                    <i class="material-icons">favorite</i>
                  </a>
                @endif
              </form> 
              </div>
            </div>
          </div>
          @endforeach
          
        </div>

      </div>
    </div>
    
  </div>
</div>

<!-- footer -->
@include('includes.footer')

@endsection