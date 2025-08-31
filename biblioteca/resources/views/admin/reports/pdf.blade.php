<!DOCTYPE html>
<html>
<head>
    <title>Library Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1 { text-align: center; }
        .report-card { margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Library Report - {{ now()->format('d/m/Y') }}</h1>
    <div class="report-card">
        <h3>Resumo</h3>
        <p><strong>Número Total de Usuários:</strong> {{ $totalUsers }}</p>
        <p><strong>Número Total de Livros:</strong> {{ $totalBooks }}</p>
        <p><strong>Empréstimos Ativos:</strong> {{ $activeLoans }}</p>
        <p><strong>Empréstimos Atrasados:</strong> {{ $overdueLoans }}</p>
    </div>
    <div class="report-card">
        <h3>Recent Loans</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Livro</th>
                    <th>Data de Empréstimo</th>
                    <th>Data de Retorno</th>
                    <th>Devolvido?</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentLoans as $loan)
                    <tr>
                      <td>{{ $loan->user->name }}</td>
                        <td>{{ $loan->book->titulo }}</td>
                        <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($loan->loan_date)->addDays(7)->format('d/m/Y') }}</td>
                        <td>{{ $loan->returned ? 'Retornado' : 'Ainda não retornado' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>