@extends('layouts.app')
@section('content')<h2>Halo, {{ $name[0]['name'] }}</h2>
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
@endphp
  <form action="/in" method="post">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user }}">
    <input type="hidden" id="work_date" name="work_date" value="<?= convertDate(Date("Y-m-d")) ?>">
    <input type="hidden" id="time_in" name="time_in" value="<?= convertTime(Date("H:i:s")) ?>">
    <button type="submit" name="p_in" class="btn btn-primary fw-bold">Presensi Masuk</button>
  </form>
  <br>
  <form action="/out" method="post">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user }}">
    <input type="hidden" id="work_date" name="work_date" value="<?= convertDate(Date("Y-m-d")) ?>">
    <input type="hidden" id="time_out" name="time_out" value="<?= convertTime(Date("H:i:s")) ?>">
    <button type="submit" name="p_out" class="btn btn-danger fw-bold">Presensi Pulang</button>
  </form>
  <br>
@endsection
<script>

</script>