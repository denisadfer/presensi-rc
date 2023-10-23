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
        $totalss = 0;
        $totalbb = 0;
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
          $wt = new Datetime($presence->work_time);
          $wt2 = $wt->format('H:i:s');
        @endphp
        <td>
          Rp.{{ $salary }}
          @if ($presence->time_out && $wt2 <= '01:00:00')
          <button type="button" style="border: none; background: none" data-toggle="popover" title="Jam kerja kurang dari 1 jam!">
            <i class="fa-solid fa-circle-exclamation fa-xl" style="color: #f4d033;"></i>
          </button>
          @elseif ($presence->time_out && $presence->salary == 0)
          <button type="button" style="border: none; background: none" data-toggle="popover" title="Presensi lebih awal 15 menit dari waktu masuk shift!">
            <i class="fa-solid fa-circle-exclamation fa-xl" style="color: #f4d033;"></i>
          </button>
          @endif
        </td>
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