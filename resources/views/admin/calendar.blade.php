@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Calendar</h4> 
                </div>
                <table class="table mt-3">
                    <thead>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Pharmacy Name</th>
                        <th>Search</th>
                    </thead>
                    <tbody>
                        <form action="{{ route('admin.calendar.search') }}" method="POST">
                            <tr>
                                <td>
                                    <div class='input-group date' id='datetimepicker'>
                                        <input type='text' class="form-control" name="start_time" />
                                        <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class='input-group date' id='datetimepicker'>
                                        <input type='text' class="form-control" name="end_time" />
                                        <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class='input-group'>
                                        <input type='text' class="form-control" name="pharmacy" />
                                    </div>
                                </td>
                                <td>
                                    <input type='submit' class="btn btn-primary time "  value="Search"/>
                                </td>
                            </tr>
                        </form>  
                    </tbody>
                </table>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <th width="125" class="time">Time</th>
                            @foreach($weekDays as $day)
                                <th class="days">{{ $day }}</th>
                            @endforeach
                        </thead>
                        <tbody>
                            @foreach($calendarData as $time => $days)
                                <tr>
                                    <td class="times">
                                        {{ $time }}
                                    </td>
                                    @foreach($days as $value)
                                        @if (is_array($value))
                                            <td rowspan="{{ $value['rowspan'] }}" class="align-middle accent text-center">
                                                  @can('show_user_name')
                                                  <p>{{ $value['user_name'] }}</p>
                                                  <br>
                                                  @endcan  
                                                <p>{{ $value['pharmacy_name'] }} </p> 
                                            </td>
                                        @elseif ($value === 1)
                                            <td></td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection
<style>
@import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400);
.table {
  font-family: 'Open Sans', Helvetica;
  color: #efefef;
}
.table tr:nth-child(2n) {
  background: #eff0f1;
}
.table tr:nth-child(2n+3) {
  background: #fff;
}
.table th, table td {
  padding: 1em;
  width: 10em;
}

.days, .time {
  background: #9198e5;
  text-transform: uppercase;
  color:#efefef;
  font-size: 1em;
  text-align: center;
}
.times {
  background: #e66465;
  text-transform: uppercase;
  color:#efefef;
  font-size: 1em;
  text-align: center;
}
.accent {
background: rgb(238,174,202);
color:#7a476b;
font-size: 1.2em;
font-weight: bold;
background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);
}
.accent:hover {
  transform: scale(1.05); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}




</style>

