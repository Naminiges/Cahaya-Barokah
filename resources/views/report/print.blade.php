<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Report Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
        }
        .report-header { 
            text-align: center; 
            margin-bottom: 30px; 
        }
        @media print {
            .no-print { 
                display: none; 
            }
        }
    </style>
</head>
<body>
    <div class="report-header">
        <h2>Cahaya Barokah Financial Report</h2>
        <h5>Period: {{ $validated['start_date'] }} - {{ $validated['end_date'] }}</h5>
    </div>

    <div class="row mb-4">
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

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>