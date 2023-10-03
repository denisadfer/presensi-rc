@extends('layouts.app')
@section('content')
<h2>Halo, {{ $name[0]['name'] }}</h2>
{{-- <h4 class="d-inline font-weight-bold text-primary">Shift IN {{ $shift[0]->time_in }}</h4>
<h4 class="d-inline p-3 font-weight-bold text-danger">Shift OUT {{ $shift[0]->time_out }}</h4> --}}
<h4 class="d-inline font-weight-bold">
  Shift 
  <h4 class="d-inline font-weight-bold text-primary">{{ $shift[0]->time_in }}</h4>
  <h4 class="d-inline font-weight-bold">-</h4>
  <h4 class="d-inline font-weight-bold text-danger">{{ $shift[0]->time_out }}</h4>
</h4>
@php
  function convertTime($date, $format = 'H:i:s')
  {
    $tz1 = 'GMT';
    $tz2 = 'Asia/Jakarta'; // UTC +7

    $d = new DateTime($date, new DateTimeZone($tz1));
    $d->setTimeZone(new DateTimeZone($tz2));

    return $d->format($format);
  }

  function convertDate($date, $format = 'Y-m-d')
  {
    $tz1 = 'GMT';
    $tz2 = 'Asia/Jakarta'; // UTC +7

    $d = new DateTime($date, new DateTimeZone($tz1));
    $d->setTimeZone(new DateTimeZone($tz2));

    return $d->format($format);
  }
    $t1 = new DateTime($shift[0]->time_in);
    $t2 = new DateTime(convertTime(Date("H:i:s")));
    $t4 = $t1->format('H:i:s');
    $t3 = new DateTime(date('H:i:s', strtotime($t4) + 1200));
    $t5 = new DateTime(date('H:i:s', strtotime($t4) - 1200));
    $t6 = new DateTime($shift[0]->time_out);
@endphp
<br><br>
  <form action="/in" method="post">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user }}">
    <input type="hidden" name="work_date" value="<?= convertDate(Date("Y-m-d")) ?>">
    <input type="hidden" name="time_in" value="<?= convertTime(Date("H:i:s")) ?>">
    @if ($name[0]->presence == 'IN' && $t2 <= $t3)
    <button type="submit" id="p_in" name="p_in" class="btn btn-primary fw-bold">Presensi Masuk</button>
    @elseif ($name[0]->presence == 'IN' && $t2 <= $t5)
    <button type="submit" id="p_in" name="p_in" class="btn btn-primary fw-bold" disabled>Presensi Masuk</button>
    <h2>Presence not open yet!</h2>
    @else
    <button type="submit" id="p_in" name="p_in" class="btn btn-primary fw-bold" hidden>Presensi Masuk</button>
    @endif
  </form>
  <form action="/out" method="post">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user }}">
    <input type="hidden" name="work_date" value="<?= convertDate(Date("Y-m-d")) ?>">
    <input type="hidden" name="time_out" value="<?= convertTime(Date("H:i:s")) ?>">
    @if ($name[0]->presence == 'OUT' && $t2 >= $t6)
    <button type="submit" id="p_out" name="p_out" class="btn btn-danger fw-bold">Presensi Pulang</button>
    @elseif ($name[0]->presence == 'OUT' && $t2 < $t6)
    <button type="submit" id="p_out" name="p_out" class="btn btn-danger fw-bold" disabled>Presensi Pulang</button>
    @else
    <button type="submit" id="p_out" name="p_out" class="btn btn-danger fw-bold" hidden>Presensi Pulang</button>
    <h2>You are already presence today!</h2>
    @endif
  </form>
  <br>
@endsection