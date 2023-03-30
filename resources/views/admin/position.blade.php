@extends('layouts.admin')
@section('content')
<a href="/admin/position/add_position">
  <button type="submit" class="btn btn-primary fw-bold">
    Add Position
  </button>
</a>
<br><br>
<div class="table-responsive">
  <table class="table table-hover table-bordered">
    <thead class="table-dark">
      <tr>
        <th scope="col">No</th>
        <th scope="col">Position</th>
        <th scope="col">Salary</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
      @php $i=1; @endphp
      @foreach ($positions as $position)
      <tr>
        <th scope="row">{{ $i }}</th>
        <td>{{ $position->position }}</td>
        @php
          setlocale(LC_MONETARY, "id_ID");
          $salary = number_format($position->salary,2,',','.')
        @endphp
        <td>Rp.{{ $salary }}</td>
        <td>
          <a href="/admin/position/edit_position/{{ $position->id }}">
            <button type="submit" class="btn btn-primary fw-bold">
              Edit
            </button>
          </a>
        </td>
      </tr>
      @php $i++; @endphp
      @endforeach
    </tbody>
  </table>
</div>
@endsection