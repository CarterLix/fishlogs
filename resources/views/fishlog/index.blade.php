@extends('layouts.app')

@section('title', 'Fish Logs')

@section('content')
    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">Fish Logs</h1>
        </div>

        <div class="card shadow border-0">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Datersrs</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Species</th>
                                <th>Method</th>
                                <th>Rating</th>
                                <th class="text-end">Edit</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($fishlogs as $log)
                                <tr>
                                    <td>{{ $log->date }}</td>
                                    <td><a class="text-light text-decoration-none"
                                            href="{{ route('fishlogs.show', $log) }}">
                                        {{ $log->name }}</a></td>
                                    <td>{{ $log->location }}</td>
                                    <td>{{ $log->species }}</td>
                                    <td>{{ $log->method }}</td>
                                    <td class="fw-bold">{{ $log->rating }}/10</td>
                                    <td class="text-end"><a href="{{ route('fishlogs.edit', $log->id) }}" class="btn btn-sm btn-primary ms-1">Edit</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-secondary">
                                        No fish logs found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection