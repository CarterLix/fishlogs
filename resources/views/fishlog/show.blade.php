@extends('layouts.app')

@section('title', 'Fish Log Details')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Fish Log Details</h1>
            <div class="text-secondary">
                {{ \Carbon\Carbon::parse($fishlog->date)->format('F j, Y') }}
            </div>
        </div>

        <a href="{{ route('fishlogs.index') }}" class="btn btn-outline-light">Back</a>
        <a href="{{ route('fishlogs.edit', $fishlog->id) }}" class="btn btn-primary ms-2">Edit</a>

    </div>

    <div class="card shadow border-0 bg-dark text-light">
        <div class="card-body p-4">
            <div class="row g-4">


                <div class="col-md-6">
                    <div class="text-secondary small">Name</div>
                    <div class="fs-5 fw-semibold">{{ $fishlog->name }}</div>
                </div>

                <div class="col-md-6">
                    <div class="text-secondary small">Location</div>
                    <div class="fs-5 fw-semibold">{{ $fishlog->location }}</div>
                </div>

                <div class="col-md-6">
                    <div class="text-secondary small">Species</div>
                    <div class="fs-5 fw-semibold">{{ $fishlog->species }}</div>
                </div>

                <div class="col-md-6">
                    <div class="text-secondary small">Method</div>
                    <div class="fs-5 fw-semibold">{{ $fishlog->method }}</div>
                </div>

                <div class="col-12">
                    <div class="text-secondary small">Rating</div>
                    <div class="display-6 fw-bold">{{ $fishlog->rating }}/10</div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection

