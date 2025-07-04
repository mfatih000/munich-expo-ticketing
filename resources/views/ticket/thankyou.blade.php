@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="card shadow p-4">
    <h2 class="text-success">Thank you for registering!</h2>
    <p class="lead">Here is a summary of your registration:</p>

    <ul class="list-group list-group-flush">
      <li class="list-group-item"><strong>Name:</strong> {{ $data->first_name }} {{ $data->last_name }}</li>
      <li class="list-group-item"><strong>Email:</strong> {{ $data->email }}</li>
      <li class="list-group-item"><strong>Company:</strong> {{ $data->company ?? '-' }}</li>
      <li class="list-group-item"><strong>Country:</strong> {{ $data->country ?? '-' }}</li>

    </ul>
  </div>
</div>
@endsection