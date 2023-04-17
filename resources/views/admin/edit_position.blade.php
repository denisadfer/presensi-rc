@extends('layouts.admin')
@section('content')
<a href="/admin/position" class="mb-2" style="display: block"><i class="fa-solid fa-circle-arrow-left"></i> Back</a>
<form action="/admin/position/edit_position" method="post">
  @csrf
  @foreach ($position as $p)
  <input type="hidden" value="{{ $p->id }}" name="id">
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" class="form-control" value="{{ $p->position }}" name="position">
  </div>
  <div class="mb-3">
    <label class="form-label">Salary</label>
    <input type="number" class="form-control" value="{{ $p->salary }}" name="salary">
  </div>
  <button type="submit" class="btn btn-primary">Edit</button>
  @endforeach
</form>
@endsection