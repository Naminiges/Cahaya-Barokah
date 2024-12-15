<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Service Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">

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

        #content-frame {
            width: 100%;
            height: 85%;
            background-color: #F8F9FA;
        }

        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .bordered-table td,
        .bordered-table th {
            border: 1px solid black;
            padding: 8px;
            vertical-align: top;
        }

        .bordered-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .no-border td {
            border: none;
        }

        textarea {
            resize: none;
        }

        .form-control,
        select {
            margin-bottom: 10px;
        }

        .form-control:focus,
        select:focus {
            box-shadow: none;
        }

        .total-transaksi-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .total-transaksi-container label {
            margin-right: 10px;
            font-size: 20px;
        }

        .total-transaksi-wrapper {
            display: flex;
            justify-content: flex-end;
        }

        .align-right {
            text-align: right;
        }

        .total-price-input {
            font-size: 20px;
        }

        .align-end {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .align-end label {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <!-- Sidebar -->
        <div class="sidebar text-white">
            @include('components.sidebar')
        </div>

        <!-- Main Content -->
        <main class="content">
            <h3><span style="color: black;">View Buying Transaction</span></h3>
            <hr>
            <div id="content-frame" class="container">
                    <table class="bordered-table">
                        <tr class="no-border">
                            <td colspan="9">
                                <table class="table">
                                    <tr>
                                        <td><strong>Invoice Number</strong></td>
                                        <td>{{ $buying->buying_invoice_id }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Supplier Name</strong></td>
                                        <td>{{ $buying->supplier_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Order Date</strong></td>
                                        <td>{{ $buying->order_date }}</td>
                                    </tr>
                                </table>
                                <br><br>
                            </td>
                        </tr>
                        <tr>
                            <td>Produk<br><br>
                                <table class="table">
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
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="9">
                                <div class="buttons">
                                    <a href="{{ route('buying.index') }}" class="btn btn-secondary">Back</a>
                                    <a href="{{ route('buying.print', $buying->buying_invoice_id) }}" target="_blank" class="btn btn-primary">Print</a>
                                </div>
                            </td>
                        </tr>
                    </table>
            </div>
        </main>
    </div>
</body>

</html>
