@extends('layouts.app')
@section('content')<h2>Halo, {{ $name[0]['name'] }}</h2>
  <form action="/in" method="post">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user }}">
    <input type="hidden" id="work_date" name="work_date" value="<?= Date("Y-m-d") ?>">
    <input type="hidden" id="time_in" name="time_in" value="<?= Date("H:i:s") ?>">
    <button type="submit" name="p_in" class="btn btn-primary fw-bold">Presensi Masuk</button>
  </form>
  <br>
  <form action="/out" method="post">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user }}">
    <input type="hidden" id="work_date" name="work_date" value="<?= Date("Y-m-d") ?>">
    <input type="hidden" id="time_out" name="time_out" value="<?= Date("H:i:s") ?>">
    <button type="submit" name="p_out" class="btn btn-danger fw-bold">Presensi Pulang</button>
  </form>
  <br>
@endsection
<script>

</script>