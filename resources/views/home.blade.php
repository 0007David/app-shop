@extends('layouts.app')

@section('title','App-Shop | Dashboard')

@section('body-class','profile-page sidebar-collapse')

@section('content')

<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/profile_city.jpg') }}')">
</div>

<!-- div-pricipal -->
<div class="main main-raised">
  <!-- div-contendor -->
  <div class="container">
  
    <div class="section text-center">
      <h2 class="title">Dashboard</h2>
        <br>
        @if (session('notification') && session('type') == 'info' )
          <div class="alert alert-info">
            <div class="container">
              <div class="alert-icon">
                <i class="material-icons">info</i>
              </div>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="material-icons">clear</i></span>
              </button>
              <b>Info Alert :  </b> {{ session('notification') }}
            </div>
          </div>
        @elseif(session('notification') && session('type') == 'success')
          <div class="alert alert-success">
            <div class="container">
              <div class="alert-icon">
                <i class="material-icons">check</i>
              </div>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="material-icons">clear</i></span>
              </button>
              <b>Exito Alter:  </b> {{ session('notification') }}
            </div>
            
          </div>
        @endif
        @if( $message = session('success') )
          <div class="alert alert-success">
            <div class="container">
              <div class="alert-icon">
                <i class="material-icons">check</i>
              </div>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="material-icons">clear</i></span>
              </button>
              <b>Exito Alter:  </b> Pago realizado exitosamente. Gracias por su compra!!
            </div>
            {{ Session::forget('success')}}
          </div>
        @elseif( $message = session('error') )
          <div class="alert alert-danger">
            <div class="container">
              <div class="alert-icon">
                <i class="material-icons">info</i>
              </div>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="material-icons">clear</i></span>
              </button>
              <b>Info Alert :  </b> Uhhh! Hubo un error al realizar el pago del Pedido..
            </div>
            {{ Session::forget('error')}}
          </div>
        @endif
        <!-- Bloque del Dashboard -->
              
        <div class="col-md-12 col-md-12">
              <ul style="display: inline-flex;" class="nav nav-pills nav-pills-icons nav-pills-success" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active show" href="#dashboard-1" role="tab" data-toggle="tab" aria-selected="true">
                    <i class="material-icons">dashboard</i> Dashboard
                  </a>
                </li>
                @if(auth()->user()->admin)
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/admin/events') }}">
                    <i class="material-icons">schedule</i> Schedule
                  </a>
                </li>
                @elseif( auth()->user()->carts->where('status','Approved')->count() > 0 && auth()->user()->debit > 0 )
                <li class="nav-item">
                  <a class="nav-link" href="#schedule-1" role="tab" data-toggle="tab" aria-selected="false">
                    <i class="material-icons">payment</i> Pagos
                  </a>
                </li>
                @endif
                
              </ul>
              <div class="tab-content tab-space">
                <div class="tab-pane active show" id="dashboard-1">
                  <h4>Tu carrito de compras presenta {{ auth()->user()->cart->details->count() }} productos</h4>
                  <table class="table table-striped">
                      <thead>
                          <tr>
                              <th>Imagen</th>
                              <th>Nombre</th>
                              <th >Cantidad</th>
                              <th>Precio</th>
                              <th>SubTotal</th>
                              <th class="text-right">Operaciones</th>
                          </tr>
                      </thead>
                      <tbody>

                          @foreach (auth()->user()->cart->details as $detail)
                          <tr>
                              <td >
                                <img src="{{ $detail->product->featured_image_url }}" height="50">
                              </td>
                              <td> <a href="{{ url('/products/'.$detail->product->id ) }}" target="_blank"> {{ $detail->product->name}}</a></td>
                              <td >{{ $detail->quantity }}</td>
                              <td>$ {{ $detail->product->price }}</td>
                              <td >$ {{ $detail->quantity * $detail->product->price }}</td>
                              <td class="td-actions">
                                
                                  <form style="display: inline" method="post" action="{{ url('/cart/delete') }}">
                                    @csrf
                                    <a href="{{ url('/products/'.$detail->product->id ) }}" target="_blank"  data-toggle="tooltip" data-placement="top" title="ver info" class="btn btn-info btn-round btn-sm">
                                        <i class="material-icons md-36">info</i>
                                    </a>
                                    <input type="hidden" name="cart_detail_id" value="{{ $detail->id }}">
                                    <button type="submit" data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-danger btn-round btn-sm">
                                        <i class="material-icons md-36">delete_forever</i>
                                    </button>
                                    
                                  </form>
                                
                              </td>
                          </tr>
                          @endforeach

                         
                      </tbody>

                    </table>
        
                      <a href="{{ url('/order') }}" class="btn btn-primary btn-round">
                                    <i class="material-icons">done</i> Realizar Pedido
                      </a>
                  
                  <br>
                  <br> Lista de productos que se van a realizar pedidos
                </div>

                <div class="tab-pane" id="schedule-1">
                  <div class="col-md-12">
              <h2>
                <small>Opciones de Pagos Online</small>
                @if(!auth()->user()->admin && auth()->user()->carts->where('status','Approved')->count() > 0)
                <p>Monto total a Pagar {{ auth()->user()->carts->where('status','Approved')->first()->event->total_cost  }}. Page al menos el 50% para confirmar el pedido</p>
                @endif
              </h2>
              <!-- Tabs on Plain Card -->
              <div class="card card-nav-tabs card-plain">
                <div class="card-header card-header-success">
                  <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                          <a class="nav-link" href="#home" data-toggle="tab">Paypal
                            <i class="material-icons md-36">payment</i>
                            <div class="ripple-container"></div></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#updates" data-toggle="tab">Tarjeta de Credito
                            <i class="material-icons md-36">credit_card</i>
                            <div class="ripple-container"></div></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active show" href="#history" data-toggle="tab">Tigo Money
                            <i class="material-icons md-36">attach_money</i>
                            <div class="ripple-container"></div></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-body ">
                  <div class="tab-content text-center">
                    <div class="tab-pane" id="home">
                      <h2>Formulario PayPal</h2>
                      
                      <form method="post" action="{{ url('paypal/') }}">
                        @csrf
                        <div class="row">
                          <div class="offset-md-3 col-md-6">
                            <!-- Campo Monto -->
                          @if(!auth()->user()->admin && auth()->user()->carts->where('status','Approved')->count() > 0)
                            <div class="form-group">
                              <label for="amount">Ingrese Monto a pagar</label>
                              <input type="number" min="{{auth()->user()->carts->where('status','Approved')->first()->event->amount_to_pay }}" value="{{ auth()->user()->carts->where('status','Approved')->first()->event->amount_to_pay }}" class="form-control" id="amount" name="amount" required>
                              <input type="hidden" name="cart_id" value="{{auth()->user()->carts->where('status','Approved')->first()->id}}">
                            </div>
                          @endif
                          </div>
                        </div>
                        <button type="submit" class="btn btn-info">Pagar con PayPal</button>
                      </form>

                    </div>
                    <div class="tab-pane" id="updates">
                       <h2>Formulario Tarjeta de Credito</h2>
                      
                      <form  >
                        @csrf
                        <div class='row'>
                            <div class='offset-md-3 col-md-6 required'>
                                <label class='control-label'>Nombre del Titular de Tarjeta</label> <input
                                    class='form-control' size='4' type='text' required>


                            </div>
                            <div class='offset-md-3 col-md-6 card required'>
                                <label class='control-label'>Numero de Tarjeta</label> <input
                                    autocomplete='off' class='form-control card-number' size='20'
                                    type='text'>
                            </div>
                            
                              <div class='offset-md-3 col-md-2 cvc required'>
                                <label class='control-label'>CVC</label> <input autocomplete='off'
                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
                                    type='text'>
                            </div>
                            <div class='col-md-2 expiration required'>
                                <label class='control-label'>Expiration</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-md-2 expiration required'>
                                <label class='control-label'> </label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text'>
                            </div>
                            
                            @if(!auth()->user()->admin && auth()->user()->carts->where('status','Approved')->count() > 0)
                            <div class='offset-md-4 col-md-4'>
                              <br>
                                <div class='total btn btn-info'>
                                  <input type="hidden" value="{{ auth()->user()->carts->where('status','Approved')->first()->event->amount_to_pay }}" name="amount" required>
                                    Total: <span class='amount'>{{ auth()->user()->carts->where('status','Approved')->first()->event->amount_to_pay }}</span>
                                </div>
                            </div>
                            <div class='offset-md-4 col-md-4'>
                                <button class='btn btn-success submit-button'
                                    type='submit' style="margin-top: 10px;">
                                    <i class="material-icons md-36">attach_money</i>
                                  Pay »</button>
                            </div>
                            @endif
                        <!-- <div class='form-row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div> -->
                        

                        </div>
                       
                  
                        
                      </form>
                    </div>
                    <div class="tab-pane active show" id="history">
                       <h2>Formulario Tigo money</h2>
                      
                      <form  id="payment-form">
                        @csrf
                        <div class="row">
                          <div class="offset-md-3 col-md-7">
                            <!-- Campo Monto -->
                            <div class="form-group">
                              <label for="amount">Ingrese Monto</label>
                              <input type="text" class="form-control" id="amount" name="amount" value="" required>
                            </div>
                          </div>
                          <br>
                          
          
                        </div>
                        <br>

                        <button class="btn btn-info">Guardar cambios</button>
                        
                        
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Tabs on plain Card -->
            </div>           
          </div>
                
              </div>
            </div>
        

        <!-- end bloque dashboard -->
        <hr>
        
        
    </div>
    
  </div>
</div>

<!-- footer -->
@include('includes.footer')
<script>
  $(function() {
  $('form.require-validation').bind('submit', function(e) {
    var $form         = $(e.target).closest('form'),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
 
    $errorMessage.addClass('hide');
    $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorMessage.removeClass('hide');
        e.preventDefault(); // cancel on first error
      }
    });
  });
});

$(function() {
  var $form = $("#payment-form");

  $form.on('submit', function(e) {
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }
  });

  function stripeResponseHandler(status, response) {
    if (response.error) {
      $('.error')
        .removeClass('hide')
        .find('.alert')
        .text(response.error.message);
    } else {
      // token contains id, last4, and card type
      var token = response['id'];
      // insert the token into the form so it gets submitted to the server
      $form.find('input[type=text]').empty();
      $form.append("<input type='hidden' name='reservation[stripe_token]' value='" + token + "'/>");
      $form.get(0).submit();
    }
  }
})

</script>

@endsection