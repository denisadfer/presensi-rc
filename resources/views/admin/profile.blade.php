@extends('layouts.admin')
@section('content')
<a href="/admin/users" class="mb-2" style="display: block"><i class="fa-solid fa-circle-arrow-left"></i> Back</a>
<form action="/admin/users/profile" method="post">
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
    <select class="form-select mb-3" aria-label="Default select example" name="position" id="position" type="text">
      <option selected value="{{ $u->position }}">{{ $u->position }}</option>
      @foreach ($positions as $position)
      @if ($position->position == $u->position)
        @php
          continue;
        @endphp
      @endif
      <option value="{{ $position->position }}">{{ $position->position }}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Edit</button>
  @endforeach
</form>
@endsection