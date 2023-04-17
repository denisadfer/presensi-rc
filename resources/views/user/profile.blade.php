@extends('layouts.app')
@section('content')
<form action="/profile" method="post">
  @csrf
  @foreach ($user as $u)
  <input type="hidden" value="{{ $u->id }}" name="id">
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" class="form-control" value="{{ $u->name }}" name="name">
  </div>
  <div class="mb-3">
    <label class="form-label">Username</label>
    <input type="text" class="form-control" value="{{ $u->username }}" name="username">
  </div>
  <div class="mb-3">
    <label class="form-label">Position</label>
    <input type="text" class="form-control" value="{{ $u->position }}" name="position" disabled>
    {{-- <select class="form-select mb-3" aria-label="Default select example" name="position" id="position" type="text">
      <option disabled selected value="{{ $u->position }}">{{ $u->position }}</option>
    </select> --}}
  </div>
  <button type="submit" class="btn btn-primary">Edit</button>
  @endforeach
</form>
@endsection