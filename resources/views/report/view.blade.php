<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .main-container {
            display: flex;
            background-color: #6756ff;
        }
        .sidebar {
            width: 260px;
            background-color: #6756ff;
        }
        .content {
            flex: 1;
            padding: 20px;
            margin: 30px 30px 30px 0;
            background-color: #F8F9FA;
            border-radius: 20px;
        }
        .summary-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="sidebar text-white">
            @include('components.sidebar')
        </div>

        <main class="content">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Financial Report</h3>
                <form action="{{ route('reports.print') }}" method="GET" target="_blank">
                    <input type="hidden" name="start_date" value="{{ $validated['start_date'] }}">
                    <input type="hidden" name="end_date" value="{{ $validated['end_date'] }}">
                    <button type="submit" class="btn btn-primary">Print Report</button>
                </form>
            </div>
            <hr>

            <div class="summary-card">
                <h4>Summary ({{ $validated['start_date'] }} - {{ $validated['end_date'] }})</h4>
                <div class="row">
                    <div class="col-md-3">
                        <h6>Total Sales</h6>
                        <p>Rp {{ number_format($summary['total_sales'], 2, ',', '.') }}</p>
                    </div>
                    <div class="col-md-3">
                        <h6>Total Purchases</h6>
                        <p>Rp {{ number_format($summary['total_purchases'], 2, ',', '.') }}</p>
                    </div>
                    <div class="col-md-3">
                        <h6>Total Profit</h6>
                        <p>Rp {{ number_format($summary['total_profit'], 2, ',', '.') }}</p>
                    </div>
                    <div class="col-md-3">
                        <h6>Total Transactions</h6>
                        <p>{{ $summary['total_transactions'] }}</p>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Sales Transactions</th>
                            <th>Purchase Transactions</th>
                            <th>Sales Amount</th>
                            <th>Purchase Amount</th>
                            <th>Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <td>{{ $report->transaction_date }}</td>
                            <td>{{ $report->total_sales_transactions }}</td>
                            <td>{{ $report->total_purchase_transactions }}</td>
                            <td>Rp {{ number_format($report->total_sales_amount, 2, ',', '.') }}</td>
                            <td>Rp {{ number_format($report->total_purchase_amount, 2, ',', '.') }}</td>
                            <td>Rp {{ number_format($report->profit, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>