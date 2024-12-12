<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 20px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .no-border td {
            border: none;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h2>Service Transaction Invoice</h2>
    </div>
    <table class="invoice-table">
        <tr>
            <td>No Faktur</td>
            <td>{{ $serviceTransaction->invoice_number }}</td>
        </tr>
        <tr>
            <td>Cashier</td>
            <td>{{ $serviceTransaction->cashier_name }}</td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td>{{ $serviceTransaction->customer_name }}</td>
        </tr>
        <tr>
            <td>Total Price</td>
            <td>Rp {{ number_format($serviceTransaction->total_price, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Entry Date</td>
            <td>{{ $serviceTransaction->entry_date }}</td>
        </tr>
        <tr>
        <tr>
            <td>Status</td>
            <td>{{ $serviceTransaction->status }}</td>
        </tr>
    </table>
    <h3>Services</h3>
    <table class="invoice-table">
        <thead>
            <tr>
                <th>Service</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach(json_decode($serviceTransaction->service_ids) as $serviceId)
            @php
                $service = $services->firstWhere('id_service', $serviceId);
            @endphp
            <tr>
                <td>{{ $service->service_name }}</td>
                <td>Rp {{ number_format($service->service_price, 2, ',', '.') }}</td>
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
