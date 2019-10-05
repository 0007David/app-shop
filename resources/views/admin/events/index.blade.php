@extends('layouts.app')

@section('title','Eventos')

@section('body-class','profile-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{ asset('img/profile_city.jpg') }}')">
    
</div>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var Calendar = FullCalendar.Calendar;

    /* initialize the calendar
    -----------------------------------------------------------------*/

    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      // #4caf50 color success
      // #f33527 color danger
      events: [
        @foreach($events as $event)
        {
          title  : '{{ $event->name }}',
          start  : '{{$event->event_date."T".$event->event_hour}}',
          allDay : true, // will make the time show
          color: '#4caf50',
          id: '{{$event->id}}',
          url: '/admin/events/{{$event->id}}/show'
        },
        @endforeach
      ],
      

    });
    calendar.render();

  });

</script>

<style>


  #external-events {
    float: left;
    width: 150px;
    padding: 0 10px;
    border: 1px solid #ccc;
    background: #eee;
    text-align: left;
  }

  #external-events h4 {
    font-size: 16px;
    margin-top: 0;
    padding-top: 1em;
  }

  #external-events .fc-event {
    margin: 10px 0;
    cursor: pointer;
  }

  #external-events p {
    margin: 1.5em 0;
    font-size: 11px;
    color: #666;
  }

  #external-events p input {
    margin: 0;
    vertical-align: middle;
  }

  #calendar {
    float: right;
    width: 900px;
  }

</style>

<!-- div-pricipal -->
<div class="main main-raised">
  <!-- div-contendor -->
  <div class="container">

    <div class="section text-center">
      <h1 class="title">Eventos a Organizar</h1>
    <div class="row">
      <div class="col-md-4">
          <div id='external-events'>
              <h4>Lista Eventos a organizar</h4>
          @foreach($events as $event)
            @if( $event->state == 'Approved' )
              <div id='external-events-list'>
                <div class='fc-event'>{{ $event->name }}</div>
              </div>
          
          @endif
          @endforeach
          </div>

      </div>
      <div class="col-md-8">
        <div id='calendar'></div>

        <div style='clear:both'></div>
        
      </div>
      
    </div>
      
    </div>
    
  </div>
</div>

  <!-- footer -->
@include('includes.footer')

@endsection