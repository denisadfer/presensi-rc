@extends('layouts.admin')
@section('content')
<div class="table-responsive">
  <table class="table table-hover table-bordered">
    <thead class="table-dark">
      <tr>
        <th scope="col">No</th>
        <th scope="col">Name</th>
        <th scope="col">Username</th>
        <th scope="col">Position</th>
        <th scope="col">Profile</th>
        <th scope="col">Presence</th>
      </tr>
    </thead>
    <tbody>
      @php $i=1; @endphp
      @foreach ($users as $user)
      <tr>
        <th scope="row">{{ $i }}</th>
        <td>{{ $user->name }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->position }}</td>
        <td>
          <a href="/admin/users/profile/{{$user->id}}">
            <button type="submit" class="btn btn-warning fw-bold">
              Profile
            </button>
          </a>
        </td>
        <td>
          <a href="/admin/users/presence/{{$user->id}}">
            <button type="submit" class="btn btn-success fw-bold">
              Presence
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