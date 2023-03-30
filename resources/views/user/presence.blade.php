@extends('layouts.app')
@section('content')
<div class="table-responsive">
  <table class="table table-hover table-bordered">
    <thead class="table-dark">
      <tr>
        <th scope="col">Work Day</th>
        <th scope="col">Time In</th>
        <th scope="col">Time Out</th>
        <th scope="col">Work Time</th>
        <th scope="col">Salary</th>
        <th scope="col">Bonus</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($presences as $presence)
      @php $day = date('l', strtotime($presence->work_date)) @endphp
      <tr>
        <th scope="row">{{ $day.', '.$presence->work_date }}</th>
        <td>{{ $presence->time_in }}</td>
        <td>{{ $presence->time_out }}</td>
        <td>{{ $presence->work_time }}</td>
        @php
          setlocale(LC_MONETARY, "id_ID");
          $salary = number_format($presence->salary,2,',','.');
          $bonus = number_format($presence->bonus,2,',','.');
        @endphp
        <td>Rp.{{ $salary }}</td>
        <td>Rp.{{ $bonus }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection