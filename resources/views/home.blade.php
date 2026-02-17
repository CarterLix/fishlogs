@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="container hero-shell">
  <div class="row justify-content-center w-100">
    <div class="col-lg-9 col-xl-8">

      <div class="hero-card text-center">
        <div class="hero-kicker mb-3">Fishing logbook</div>

        <h1 class="hero-title fw-bold mb-3">
          Keep a clean record of every trip.
        </h1>

        <p class="hero-subtitle mb-0">
          View your recent logs, add new trips, and keep everything organized in one place.
        </p>

        <div class="hero-divider"></div>

        <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
          <a href="{{ route('fishlogs.index') }}" class="btn btn-soft btn-soft-primary btn-lg">
            View Fish Logs
          </a>

          <a href="{{ route('fishlogs.create') }}" class="btn btn-soft btn-soft-success btn-lg">
            Add New Log
          </a>
        </div>

        <div class="mt-4 text-secondary" style="font-size:.95rem;">
          Simple. Fast. No clutter.
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
