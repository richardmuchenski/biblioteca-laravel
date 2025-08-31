<!DOCTYPE html>
<html>
<head>
    <title>Library Reports</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .report-card { margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
        .table { width: 100%; margin-top: 20px; }
        .btn-pdf { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Library Reports</h1>
        <div class="report-card">
            <h3>Summary</h3>
            <p><strong>Total Users:</strong> {{ $totalUsers }}</p>
            <p><strong>Total Books:</strong> {{ $totalBooks }}</p>
            <p><strong>Active Loans:</strong> {{ $activeLoans }}</p>
            <p><strong>Overdue Loans:</strong> {{ $overdueLoans }}</p>
        </div>
        <div class="report-card">
            <h3>Recent Loans</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Book</th>
                        <th>Loan Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentLoans as $loan)
                        <tr>
                            <td>{{ $loan->user->name }}</td>
                            <td>{{ $loan->book->titulo }}</td>
                            <td>{{ $loan->loan_date }}</td>
                            <td>{{ \Carbon\Carbon::parse($loan->loan_date)->addDays(7)->format('d/m/Y') }}</td>
                            <td>{{ $loan->returned ? 'Returned' : 'Active' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>