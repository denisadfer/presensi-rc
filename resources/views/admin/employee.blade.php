@extends('layouts.app')
@section('content')
<a href="/admin/dashboard">Back</a>
<br><br>
<div class="table-responsive">
  <table class="table table-hover table-bordered">
    <thead class="table-dark">
      <tr>
        <th scope="col">No</th>
        <th scope="col">Name</th>
        <th scope="col">Username</th>
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
        <td>
          <form action="/admin/users/presence" method="get">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <button type="submit" class="btn btn-primary fw-bold">
              Presence
            </button>
          </form>
        </td>
      </tr>
      @php $i++; @endphp
      @endforeach
    </tbody>
  </table>
</div>
@endsection