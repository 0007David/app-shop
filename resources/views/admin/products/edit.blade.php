@extends('layouts.app')

@section('title','Bienvenido a App-Shop')

@section('body-class','profile-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/profile_city.jpg') }}')">
    
</div>
<!-- Classic Modal -->
  <div class="modal fade" id="#modalAddUnits" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title text-center">Asisnar Cantidad</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <form method="post" action="{{ url('admin/products/'.$product->id.'/quantity') }}">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="offset-md-3 col-md-2">
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" value=""> todos
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              @foreach($unitsRight as $unit)
                  
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="units[]" value="{{ $unit->id }}"> {{ $unit->quantity }}
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                    
                  </label>
                </div>
              @endforeach
              </div>
              <div class="col-md-2">
                @foreach($unitsLeft as $unit)
                  
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="units[]" value="{{ $unit->id }}"> {{ $unit->quantity }}
                    <span class="form-check-sign">
                      <span class="check"></span>
                    </span>
                    
                  </label>
                </div>
              @endforeach
                
              </div>
              
            </div>
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



<!-- div-pricipal -->
<div class="main main-raised">
  <!-- div-contendor -->
  <div class="container">
  
    <div class="section text-center">
      <h2 class="title">Editar producto seleccionado</h2>
      <br><br>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddUnits" >Asignar cantidad</button>
      <br><br>
      <form method="post" action="{{ url('admin/products/'.$product->id.'/edit') }}">
        @csrf
        <div class="row">
          <div class="offset-md-2 col-md-7">
            <!-- Campo Categoria -->
            <div class="form-group ">
              <div class="form-group label-floating">
              <label for="name">Categoria de producto</label>
              <input type="text" class="form-control" value="{{ $product->category->name }}" readonly>
             </div>
            </div>
          </div>          
        </div>
        <div class="row">
          <div class="offset-md-2 col-md-4">
            <!-- Campo nombre -->
            <div class="form-group label-floating">
              <label for="name">Nombre de producto</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
            </div>

          </div>
          
          <div class="col-md-1">
            <!-- Campo precio -->
            <div class="form-group">
              <label for="price">Precio</label>
              <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $product->price }}" >
            </div>
          </div>

          <div class="col-md-1">
            <!-- Campo Cantidad -->
            <div class="form-group">
              <label for="base_quantity">Cantidad</label>
              <input type="number" class="form-control" id="base_quantity" name="base_quantity" value="{{ $product->base_quantity }}" min="0" value="0">
            </div>
          </div>
          <div class="col-md-1">
            <!-- Campo STOCK -->
            <div class="form-group">
              <label for="stock">Stock</label>
              <input type="number" class="form-control" id="stock" name="stock" min="0" value="0" value="{{ $product->stock }}" >
            </div>
          </div>

        </div>

        <!-- Campo descripcion -->
        <div class="form-group offset-md-2 col-md-7" >
          <label for="description">Description corta</label>
          <input type="text" class="form-control" id="description" name="description" value="{{ $product->description }}" placeholder="Description corta..." maxlength="200" required>
        </div>

        <!-- Campo descripcion larga -->
        <div class="form-group offset-md-2 col-md-7">
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