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
      </tr>
    </thead>
    <tbody>
      @foreach ($presence as $p)
      @php $day = date('l', strtotime($p->work_date)) @endphp
      <tr>
        <th scope="row">{{ $day.', '.$p->work_date }}</th>
        <td>{{ $p->time_in }}</td>
        <td>{{ $p->time_out }}</td>
        <td>{{ $p->work_time }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection