<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .invoice-header { text-align: center; margin-bottom: 20px; }
        .invoice-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .invoice-table th, .invoice-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .invoice-table th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h2>Cahaya Barokah Transaction Buying Invoice</h2>
    </div>
    <table>
        <tr>
            <td><strong>Invoice Number:</strong></td>
            <td>{{ $buying->buying_invoice_id }}</td>
        </tr>
        <tr>
            <td><strong>Supplier Name:</strong></td>
            <td>{{ $buying->supplier_name }}</td>
        </tr>
        <tr>
            <td><strong>Order Date:</strong></td>
            <td>{{ $buying->order_date }}</td>
        </tr>
    </table>
    <h3>Products</h3>
    <table class="invoice-table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price (pcs)</th>
                <th>Expiration Date</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($buying->buyingDetail as $detail)
            <tr>
                <td>{{ $detail->product_name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>Rp {{ number_format($detail->product_supplier_price, 2, ',', '.') }}</td>
                <td>{{ $detail->exp_date }}</td>
                <td>Rp {{ number_format($detail->quantity * $detail->product_supplier_price, 2, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
                <td><strong>Rp {{ number_format($total, 2, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>
    
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
