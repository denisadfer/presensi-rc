@extends('layouts.admin')
@section('content')
<a href="/admin/position" class="mb-2" style="display: block"><i class="fa-solid fa-circle-arrow-left"></i> Back</a>
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