@extends('layouts.admin')
@section('content')
<a href="/admin/users">Back</a>
<br><br>
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
      @foreach ($presence as $p)
      @php $day = date('l', strtotime($p->work_date)) @endphp
      <tr>
        <th scope="row">{{ $day.', '.$p->work_date }}</th>
        <td>{{ $p->time_in }}</td>
        <td>{{ $p->time_out }}</td>
        <td>{{ $p->work_time }}</td>
        @php
          setlocale(LC_MONETARY, "id_ID");
          $salary = number_format($p->salary,2,',','.');
          $bonus = number_format($p->bonus,2,',','.');
        @endphp
        <td>Rp.{{ $salary }}</td>
        <td>Rp.{{ $bonus }}</td>
      </tr>
      @php 
        $totals = $totals + $p->salary;
        $totalb = $totalb + $p->bonus; 
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