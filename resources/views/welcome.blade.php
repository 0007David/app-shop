@extends('layouts.app')

@section('title','Bienvenido a App-Shop')

@section('body-class','landing-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/profile_city.jpg') }}')">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1 class="title">Bienbenido a App Shop</h1>
          <h4>Realiza tus pedidos en línea y te contactaremos para coordinar la entrega hasta la puerta de tu casa.</h4>
          <br>
          <a href="https://www.youtube.com/watch?v=oofSnsGkops&list=RDoofSnsGkops&start_radio=1" target="_blank" class="btn btn-danger btn-raised btn-lg">
            <i class="fa fa-play"></i> ¿Cómo funciona?
          </a>
        </div>
      </div>
    </div>
</div>

<!-- div-pricipal -->
<div class="main main-raised">
  <!-- div-contendor -->
  <div class="container">
    <div class="section text-center">
          <div class="row">
              <div class="col-md-8 ml-auto mr-auto">
                  <h2 class="title">¿Por qué App Shop?</h2>
                  <h5 class="description">Puedes revisar nuestros catalogos completos de productos, comprarar precios y realizar tus pedidos cuando estes seguro de una buena compra... </h5>
              </div>
          </div>
      <div class="features">
        <div class="row">
          <div class="col-md-4">
            <div class="info">
              <div class="icon icon-info">
                <i class="material-icons">chat</i>
              </div>
              <h4 class="info-title">Atendemos tus dudas</h4>
              <p>Atendemos rapidamente cualquier consulta que tengas vía chat. No estas sólo, sino que siempre estamos atentos a tus inquietudes</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="info">
              <div class="icon icon-success">
                <i class="material-icons">verified_user</i>
              </div>
              <h4 class="info-title">Pagos Seguros</h4>
              <p>Todo pedido que realices será confirmado por una llamada. Sino confías en los pagos en lines puedes pagar cuando se te entrega el pedido con el valor acordado.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="info">
              <div class="icon icon-danger">
                <i class="material-icons">fingerprint</i>
              </div>
              <h4 class="info-title">Informaación privada</h4>
              <p>Los pediios que realices sólo los conoces tu a través de tu panel de usuario. Nadie más tendra conocimiento a las compras que realices.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section text-center">
      <h2 class="title">Productos disponibles</h2>
      <div class="team">
        <div class="row">
          <!-- Foreach donde muestra todo los productos -->
          @foreach($products as $product)
            <div class="col-md-4">
              <div class="team-player">
                <div class="card card-plain">
                  <div class="col-md-6 ml-auto mr-auto">
                    <img src="{{ $product->featured_image_url }}" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid">
                    <!-- $product->images()->first()->image -->
                  </div>
                  <h4 class="card-title">
                    <a href="{{ url('/products/'.$product->id) }}">{{ $product->name }} </a>
                    <br>
                    <small class="card-description text-muted">{{ $product->category->name }}</small> 
                    <!-- $product->category->name -->
                  </h4>
                  <div class="card-body">
                    <p class="card-description">{{ $product->description }}</p>
                  </div>
                  <!-- <div class="card-footer justify-content-center">
                    <a href="#pablo" class="btn btn-link btn-just-icon"><i class="fa fa-twitter"></i></a>
                    <a href="#pablo" class="btn btn-link btn-just-icon"><i class="fa fa-instagram"></i></a>
                    <a href="#pablo" class="btn btn-link btn-just-icon"><i class="fa fa-facebook-square"></i></a>
                  </div> -->
                </div>
              </div>
            </div>
          @endforeach
          {{ $products->links() }}
        </div>
        <!-- <div class="row"> -->
        <!-- </div> -->
      </div>
    </div>
    <div class="section section-contacts">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <h2 class="text-center title">¿Aún no te has registrado?</h2>
          <h4 class="text-center description">Registrate ingresando tus datos básicos, y podras realizar tus pedios a través de nuestro carrito de compras. Si aún no te decides de todas formas con tu cuenta de usuario podrás hacer todas tus consultas sin compromiso.</h4>
          <form class="contact-form">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Nombre</label>
                  <input type="email" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Correo electrónico</label>
                  <input type="email" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleMessage" class="bmd-label-floating">Tú mensaje</label>
              <textarea type="email" class="form-control" rows="4" id="exampleMessage"></textarea>
            </div>
            <div class="row">
              <div class="col-md-4 ml-auto mr-auto text-center">
                <button class="btn btn-primary btn-raised">
                  Enviar consulta
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- footer -->
@include('includes.footer')

@endsection