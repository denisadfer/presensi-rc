@extends('layouts.admin')
@section('content')
<form action="/admin/position/add_position" method="post">
  @csrf
  <div class="mb-3">
    <label class="form-label">Position</label>
    <input type="text" class="form-control" name="position">
  </div>
  <div class="mb-3">
    <label class="form-label">Salary</label>
    <input type="number" class="form-control" name="salary">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection