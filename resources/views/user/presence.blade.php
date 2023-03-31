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
      @php 
        $totals = 0; 
        $totalb = 0; 
      @endphp
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
      @php 
        $totals = $totals + $presence->salary;
        $totalb = $totalb + $presence->bonus; 
        setlocale(LC_MONETARY, "id_ID");
        $totalss = number_format($totals,2,',','.');
        $totalbb = number_format($totalb,2,',','.');
      @endphp
      @endforeach
      <tr>
        <td colspan="3" style="border-bottom: solid rgba(255, 255, 255, 0); border-left: none"></td>
        <td class="fs-6 fw-bold text-right align-middle">Total:</td>
        <td class="align-middle">Rp.{{ $totalss }}</td>
        <td class="align-middle">Rp.{{ $totalbb }}</td>
      </tr>
    </tbody>
  </table>
</div>
@endsection