<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fish Logs</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #121212;
            color: #ffffff;
        }
        .card {
            background-color: #1e1e1e;
        }
        .table {
            margin-bottom: 0;
        }
    </style>
</head>
<body>

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
                            <th>Date</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Species</th>
                            <th>Method</th>
                            <th class="text-end">Rating</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($fishlogs as $log)
                        <tr>
                            <td>{{$log->date}}</td>
                            <td>{{ $log->name }}</td>
                            <td>{{ $log->location }}</td>
                            <td>{{ $log->species }}</td>
                            <td>{{ $log->method }}</td>
                            <td class="text-end fw-bold">{{ $log->rating }}/10</td>
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

</body>
</html>
