@extends('layouts.admin')
@section('content')
<form action="/admin/presences/filter" method="post" class="mr-1 mb-2" style="display: inline-block">
  @csrf
  <label for="day" class="fs-6 fw-bold">Date:</label>
  <input type="date" name="date" id="date" class="mr-1">
  <button type="submit" class="btn btn-primary fw-bold">Filter</button>
</form>
<a href="/admin/presences">
  <button type="submit" class="btn btn-danger fw-bold">
    Reset
  </button>
</a>
<div class="table-responsive">
  <table class="table table-hover table-bordered">
    <thead class="table-dark">
      <tr>
        <th scope="col">Name</th>
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
        $totalss = 0;
        $totalbb = 0;
      @endphp
      @foreach ($presence as $p)
      @foreach ($user as $u)
      @php $day = date('l', strtotime($p->work_date)) @endphp
      <tr>
        @if ($p->user_id == $u->id)
        <th scope="row">{{ $u->name }}</th>
        @else
          @php
            continue;
          @endphp
        @endif
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
      @endforeach
      @if ($totalss == 0)
        <tr>
          <td colspan="6" class="fs-6 fw-bold text-center align-middle">No Data</td>
        </tr>
      @else
        {{-- <tr>
          <td colspan="3" style="border-bottom: solid rgba(255, 255, 255, 0); border-left: none"></td>
          <td class="fs-6 fw-bold text-right align-middle">Total:</td>
          <td class="align-middle">Rp.{{ $totalss }}</td>
          <td class="align-middle">Rp.{{ $totalbb }}</td>
        </tr> --}}
      @endif
    </tbody>
  </table>
</div>
@endsection