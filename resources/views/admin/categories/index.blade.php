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
      <h3 class="title">Listado de Categorias</h3>
      <div class="team">

        <a href="{{ url('/admin/categories/create') }}" class="btn btn-primary btn-round">Nuevo categoria</a> <br><br>
        <div class="row">

          <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width:4px">#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th class="text-right">Operaciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($categories as $category)
                <tr>
                    <td style="width:4px">{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td class="text-left">{{ $category->description }}</td>
                    <td class="td-actions text-right">
                      
                        <form style="display: inline" method="post" action="#">
                          @csrf
                        <a href="{{ url('/admin/categories/'.$category->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-success btn-round btn-sm">
                            <i class="material-icons md-36">edit</i>
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
         

      </div>
    </div>
    
  </div>
</div>

<!-- footer -->
@include('includes.footer')

@endsection