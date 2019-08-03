@extends('layouts.app')

@section('title','Caracteristicas del producto')

@section('body-class','profile-page sidebar-collapse')

@section('content')
 <!-- imagen de fondo -->
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/city-profile.jpg') }}')">
    
</div>
<!-- div-principal -->
<div class="main main-raised">
	<div class="profile-content">
		<!-- div-contenedor -->
		<div class="container">
			<div class="row">
				<div class="col-md-6 ml-auto mr-auto">
					<div class="profile">
						<div class="avatar">
					    	<img src="{{ $product->featured_image_url }}" alt="Circle Image" class="img-raised rounded-circle img-fluid">
						</div>


						<div class="name">
					    	<h2 class="title">{{$product->name}}</h2>
					    	<h4>{{ $product->category->name }}</h4>
					    	<a href="#pablo" class="btn btn-just-icon btn-link btn-dribbble"><i class="fa fa-dribbble"></i></a>
					    	<a href="#pablo" class="btn btn-just-icon btn-link btn-twitter"><i class="fa fa-twitter"></i></a>
					    	<a href="#pablo" class="btn btn-just-icon btn-link btn-pinterest"><i class="fa fa-pinterest"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="description text-center">
		  		<p>{{ $product->long_description }} </p>
				<br>
				@if (session('notification'))
		        	<div class="alert alert-success">
		            <div class="container">
		              <div class="alert-icon">
		                <i class="material-icons">check</i>
		              </div>
		              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span aria-hidden="true"><i class="material-icons">clear</i></span>
		              </button>
		              <b>Alerta de Exito :  </b> {{ session('notification') }}
		            </div>
		          </div>
		        @endif
		        <br>
		        @if(auth()->user())
					<button class="btn btn-primary btn-round" data-toggle="modal" data-target="#ModalProductAdd">
		                <i class="material-icons">add_shopping_cart</i> Añadir al carrito de compra
		            </button>
	            @else
	            	<div class="alert alert-info">
			            <div class="container">
			              <div class="alert-icon">
			                <i class="material-icons">info</i>
			              </div>
			              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                <span aria-hidden="true"><i class="material-icons">clear</i></span>
			              </button>
			              <b>Info Alert :  </b>Necesitar iniciar sesión para realizar tu pedido de tu producto.
			            </div>
		          </div>
		          <br>
	            	<a href="{{url('/login')}}" class="btn btn-primary btn-round">
	                <i class="material-icons">add_shopping_cart</i> Añadir al carrito de compra
	            	</a>
	            @endif
	            <!-- <i class="material-icons">library_books</i> -->
	              
			</div>
			<div>
				
			</div>
			<hr>
			<!-- <div class="row">
				<div class="col-md-6 ml-auto mr-auto">
					<div class="profile-tabs">
						<ul class="nav nav-pills nav-pills-icons justify-content-center" role="tablist">
							<li class="nav-item">
							  <a class="nav-link active" href="#studio" role="tab" data-toggle="tab">
							    <i class="material-icons">camera</i> Studio
							  </a>
							</li>
							<li class="nav-item">
							  <a class="nav-link" href="#works" role="tab" data-toggle="tab">
							    <i class="material-icons">palette</i> Work
							  </a>
							</li>
							<li class="nav-item">
							  <a class="nav-link" href="#favorite" role="tab" data-toggle="tab">
							    <i class="material-icons">favorite</i> Favorite
							  </a>
							</li>
						</ul>
					</div>
				</div>
			</div> -->

			<div class="tab-content tab-space">
				<div class="tab-pane active text-center gallery" id="studio">
					<div class="row">
					  <div class="col-md-3 ml-auto">
						@foreach($imagesRight as $image)
					    <img src="{{ $image->url }}" class="rounded">
						@endforeach
					  </div>
					  <div class="col-md-3 mr-auto">
						@foreach($imagesLeft as $image)
					    <img src="{{ $image->url }}" class="rounded">
						@endforeach
					  </div>
					 
				</div>

				<!-- <div class="tab-pane text-center gallery" id="works">
					<div class="row">
					  <div class="col-md-3 ml-auto">
					    <img src="../assets/img/examples/olu-eletu.jpg" class="rounded">
					    <img src="../assets/img/examples/clem-onojeghuo.jpg" class="rounded">
					    <img src="../assets/img/examples/cynthia-del-rio.jpg" class="rounded">
					  </div>
					  <div class="col-md-3 mr-auto">
					    <img src="../assets/img/examples/mariya-georgieva.jpg" class="rounded">
					    <img src="../assets/img/examples/clem-onojegaw.jpg" class="rounded">
					  </div>
					</div>
				</div>

				<div class="tab-pane text-center gallery" id="favorite">
					<div class="row">
					  <div class="col-md-3 ml-auto">
					    <img src="../assets/img/examples/mariya-georgieva.jpg" class="rounded">
					    <img src="../assets/img/examples/studio-3.jpg" class="rounded">
					  </div>
					  <div class="col-md-3 mr-auto">
					    <img src="../assets/img/examples/clem-onojeghuo.jpg" class="rounded">
					    <img src="../assets/img/examples/olu-eletu.jpg" class="rounded">
					    <img src="../assets/img/examples/studio-1.jpg" class="rounded">
					  </div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</div>
<!-- footer -->
@include('includes.footer')

@endsection
 <!-- Classic Modal -->
  <div class="modal fade" id="ModalProductAdd" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title text-center">Añadir producto al carrito de compras</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <form method="post" action="{{ url('/cart') }}">
        	@csrf
        	
	        <div class="modal-body">
	          <input type="number" name="quantity" class="form-control" value="1" required min="1">
	          <input type="hidden" name="product_id" value="{{ $product->id }}">
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Cancelar</button>
	          <button type="submit" class="btn btn-link">Añadir al carrito</button>
	        </div>
        </form>
      </div>
    </div>
  </div>
  <!--  End Modal -->