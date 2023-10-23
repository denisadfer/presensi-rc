@extends('layouts.admin')
@section('content')
<a href="/admin/users" class="mb-2" style="display: block"><i class="fa-solid fa-circle-arrow-left"></i> Back</a>
<form action="/admin/users/presence/filter" method="post" class="mr-1 mb-2" style="display: inline-block">
  @csrf
  @foreach ($presences as $p)
  <input type="hidden" name="id" value="{{ $p->user_id }}">
  @endforeach
  <label for="start_date" class="fs-6 fw-bold">Week:</label>
  <input type="week" name="week" id="week" class="mr-1">
  <button type="submit" class="btn btn-primary fw-bold">Filter</button>
</form>
@foreach ($presences as $p)
<a href="/admin/users/presence/{{ $p->user_id }}">
  @endforeach
  <button type="submit" class="btn btn-danger fw-bold">
    Reset
  </button>
</a>
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
        $totalss = 0;
        $totalbb = 0;
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
          $wt = new Datetime($p->work_time);
          $wt2 = $wt->format('H:i:s');
        @endphp
        <td>
          Rp.{{ $salary }}
          @if ($p->time_out && $wt2 <= '01:00:00')
          <button type="button" style="border: none; background: none" data-toggle="popover" title="Jam kerja kurang dari 1 jam!">
            <i class="fa-solid fa-circle-exclamation fa-xl" style="color: #f4d033;"></i>
          </button>
          @elseif ($p->time_out && $p->salary == 0)
          <button type="button" style="border: none; background: none" data-toggle="popover" title="Presensi lebih awal 15 menit dari waktu masuk shift!">
            <i class="fa-solid fa-circle-exclamation fa-xl" style="color: #f4d033;"></i>
          </button>
          @endif
        </td>
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
      @if ($totalss == 0)
        <tr>
          <td colspan="6" class="fs-6 fw-bold text-center align-middle">No Data</td>
        </tr>
      @else
        <tr>
          <td colspan="3" style="border-bottom: solid rgba(255, 255, 255, 0); border-left: none"></td>
          <td class="fs-6 fw-bold text-right align-middle">Total:</td>
          <td class="align-middle">Rp.{{ $totalss }}</td>
          <td class="align-middle">Rp.{{ $totalbb }}</td>
        </tr>
      @endif
    </tbody>
  </table>
</div>
@endsection