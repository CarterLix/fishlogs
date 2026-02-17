@extends('layouts.app')

@section('title', 'Edit Fish Log')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 fw-bold m-0">Edit Fish Log</h1>
    <a href="{{ route('fishlogs.show', $fishlog->id) }}" class="btn btn-outline-light">Back</a>
  </div>

  <div class="card shadow border-0 bg-dark text-light">
    <div class="card-body p-4">
      <form method="POST" action="{{ route('fishlogs.update', $fishlog->id) }}">
        @csrf
        @method('PUT')
        @include('fishlog._form')
      </form>
    </div>
  </div>
</div>
@endsection
