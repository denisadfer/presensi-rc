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
        function convertDate($date, $format = 'Y-m-d')
        {
          $tz1 = 'GMT';
          $tz2 = 'Asia/Jakarta'; // UTC +7

          $d = new DateTime($date, new DateTimeZone($tz1));
          $d->setTimeZone(new DateTimeZone($tz2));

          return $d->format($format);
        }
        $today = convertDate(Date("Y-m-d"))
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
          $wt = new Datetime($p->work_time);
          $wt2 = $wt->format('H:i:s');
        @endphp
        <td>
          Rp.{{ $salary }}
          @if (!$p->time_out && $today  != $p->work_date)
          <button type="button" style="border: none; background: none" data-toggle="popover" title="Tidak melakukan presensi pulang!">
            <i class="fa-solid fa-circle-exclamation fa-xl" style="color: #f4d033;"></i>
          </button>
          @elseif ($p->time_out && $wt2 <= '01:00:00')
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
      @endforeach
      @if ($totalss == 0)
        <tr>
          <td colspan="6" class="fs-6 fw-bold text-center align-middle">No Data</td>
        </tr>
      @else
      @endif
    </tbody>
  </table>
</div>
@endsection