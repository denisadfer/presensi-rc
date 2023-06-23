@extends('layouts.app')
@section('content')
<h2>Halo, {{ $name[0]['name'] }}</h2>
<h4>Today's shift: {{ $shift[0]->time_in }}</h4>
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
@endphp
  <form action="/in" method="post">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user }}">
    <input type="hidden" name="work_date" value="<?= convertDate(Date("Y-m-d")) ?>">
    <input type="hidden" name="time_in" value="<?= convertTime(Date("H:i:s")) ?>">
    @if ($t2 >= $t1)
    <button type="submit" id="p_in" name="p_in" class="btn btn-primary fw-bold">Presensi Masuk</button>
    @else
    <button type="submit" id="p_in" name="p_in" class="btn btn-primary fw-bold" disabled>Presensi Masuk</button>
    @endif
  </form>
  <br>
  <form action="/out" method="post">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user }}">
    <input type="hidden" name="work_date" value="<?= convertDate(Date("Y-m-d")) ?>">
    <input type="hidden" name="time_out" value="<?= convertTime(Date("H:i:s")) ?>">
    @if ($t2 >= $t1)
    <button type="submit" id="p_out" name="p_out" class="btn btn-danger fw-bold">Presensi Pulang</button>
    @else
    <button type="submit" id="p_out" name="p_out" class="btn btn-danger fw-bold" disabled>Presensi Pulang</button>
    @endif
  </form>
  <br>
  {{-- <script>
    var btn_in = document.getElementById('p_in');
    var btn_out = document.getElementById('p_out');
    var i;

    if (i == 1) {
        btn_in.style.display = 'none';
        btn_out.style.display = 'block';
    }

    if (i == 0) {
        btn_in.style.display = 'block';
        btn_out.style.display = 'none';
    }

    btn_in.addEventListener('click', () => {
      i = 1;
      btn_in.style.display = 'none';
      btn_out.style.display = 'block';
    });
    
    btn_out.addEventListener('click', () => {
      i = 0;
      btn_in.style.display = 'block';
      btn_out.style.display = 'none';
    });
  </script> --}}
@endsection