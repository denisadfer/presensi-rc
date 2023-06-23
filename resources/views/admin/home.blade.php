@extends('layouts.admin')
@section('content')
@php
  use Carbon\Carbon;
  use Carbon\CarbonImmutable;
  $now = Carbon::now();
  $weekStartDate = $now->startOfWeek()->format('Y-m-d');
  function convertDate($date, $format = 'l, Y-m-d')
  {
    $tz1 = 'GMT';
    $tz2 = 'Asia/Jakarta'; // UTC +7

    $d = new DateTime($date, new DateTimeZone($tz1));
    $d->setTimeZone(new DateTimeZone($tz2));

    return $d->format($format);
  }
  function convertTime($date, $format = 'H:i:s')
  {
    $tz1 = 'GMT';
    $tz2 = 'Asia/Jakarta'; // UTC +7

    $d = new DateTime($date, new DateTimeZone($tz1));
    $d->setTimeZone(new DateTimeZone($tz2));

    return $d->format($format);
  }
  $currentDate = convertDate(Date("l, Y-m-d"));
  $currentTime = convertTime(Date("H:i:s"));
@endphp
<h3>{{ $currentDate }} {{ $currentTime }}</h3>
<div class="table-responsive">
  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th class="fw-bold">Work Date</th>
        <th class="fw-bold">Shift</th>
        <th class="fw-bold">Add Shift</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($shifts as $shift)
        <tr>
          <td>
            {{ date('l, Y-m-d', strtotime($shift->work_date))}}
          </td>
          <td>
            @if ($shift->time_in)
              {{ $shift->time_in }}                
            @else
                No Data
            @endif
          </td>
          <td>
            <button type="button" class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#s{{ $shift->work_date }}">Set Shift</button>

            <form action="/admin/shift/add_shift" method="post">
              @csrf
              <div class="modal fade" id="s{{ $shift->work_date }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Shift | {{ $shift->work_date }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="work_date" value="{{ $shift->work_date }}">
                      <label for="time_in">Select time for shift: </label>
                      <input type="time" name="time_in" id="time_in" value="{{ $shift->time_in }}">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>
@endsection