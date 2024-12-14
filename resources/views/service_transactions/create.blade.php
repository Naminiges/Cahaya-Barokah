<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Service Transaction</title>
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

        .service-item {
            margin-bottom: 10px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            border-radius: 6px;
            padding: 1px;
            border: 1px solid #dee2e6;
            height: 38px; /* Match Bootstrap's default form-control height */
        }

        .quantity-btn {
            width: 36px;
            height: 32px;
            border: none;
            background: white;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #6756ff;
        }

        .quantity-btn:hover {
            background: #6756ff;
            color: white;
        }

        .quantity-btn:active {
            transform: scale(0.95);
        }

        .quantity-input {
            width: 50px;
            height: 100%;
            border: none;
            background: transparent;
            text-align: center;
            font-weight: 500;
            font-size: 14px;
            -moz-appearance: textfield;
            margin: 0 4px;
        }

        .quantity-input::-webkit-inner-spin-button, 
        .quantity-input::-webkit-outer-spin-button { 
            -webkit-appearance: none;
            margin: 0;
        }

        .quantity-input:focus {
            outline: none;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(0.95); }
            100% { transform: scale(1); }
        }

        .pulse {
            animation: pulse 0.2s ease-in-out;
        }

        /* Hover states */
        .quantity-btn:hover i {
            transform: scale(1.1);
        }

        /* Focus states for accessibility */
        .quantity-btn:focus {
            outline: 2px solid #6756ff;
            outline-offset: 2px;
        }

        /* Disabled state */
        .quantity-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Font size adjustment for icons */
        .quantity-btn i {
            font-size: 16px;
        }

        /* Ensure select and quantity control have same height */
        .service-select, .quantity-control {
            height: 38px !important;
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
            <h3><span style="color: black;">Create Transaction</span></h3>
            <hr>
            <div id="content-frame" class="container">
                <form action="{{ route('service_transactions.store') }}" method="POST">
                    @csrf
                    <table class="bordered-table">
                        <tr class="no-border">
                            <td colspan="9">
                                <table class="no-border">
                                    <tr>
                                        <td>Invoice Number</td>
                                        <td>:</td>
                                        <td><input type="text" name="invoice_number" class="form-control" value="{{ $nextInvoiceNumber }}" required readonly></td>
                                        <td width="600 px"></td>
                                        <td class="align-right total-transaksi-container">
                                            <label for="total_price">Total Transaction</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cashier</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" name="cashier_id" class="form-control" value="{{ $cashier->id }}" required readonly>
                                        </td>
                                        <td width="600 px"></td>
                                        <td><input type="text" name="total_price" id="total_price" class="form-control total-price-input" placeholder="Rp 0,-" required readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Entry Date</td>
                                        <td>:</td>
                                        <td><input type="date" name="entry_date" class="form-control" required id="entry_date" value="{{ now()->toDateString() }}" required readonly></td>
                                        <td width="600 px"></td>
                                        <td colspan="3" class="align-end">
                                            <label for="status">Status:</label>
                                            <select name="status" class="form-control" required>
                                                <option value="pending">Pending</option>
                                                <option value="completed">Completed</option>
                                            </select>
                                        </td>
                                        <td colspan="2"></td>
                                    </tr>
                                </table>
                                <br><br>
                            </td>
                        </tr>
                        <tr>
                            <td>Customer<br><br>
                                <table class="no-border">
                                    <tr>
                                        <td>Customer</td>
                                        <td>:</td>
                                        <td>
                                            <select name="customer_id" id="customer_id" class="form-control" required>
                                                <option value="">Select Customer</option>
                                                @foreach($customers as $customer)
                                                <option value="{{ $customer->customer_id }}">{{ $customer->customer_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <td>Laptop</td>
                                        <td>:</td>
                                        <td>
                                            <select name="laptop_id" id="laptop_id" class="form-control" required>
                                                <option value="">Select Laptop</option>
                                                @foreach($customers as $customer)
                                                    @foreach($customer->laptops as $laptop)
                                                    <option value="{{ $laptop->id_laptop }}" data-customer-id="{{ $customer->customer_id }}">{{ $laptop->laptop_brand }}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr> --}}
                                    {{-- <tr>
                                        <td>Problem Description</td>
                                        <td>:</td>
                                        <td><textarea rows="4" cols="50" name="problem_description" id="problem_description" class="form-control" required></textarea></td>
                                    </tr> --}}
                                </table>
                            </td>
                            <td>Produk <br><br>
                                <table class="no-border">
                                    <tr>
                                        <td>Produk</td>
                                        <td>
                                           <div id="services-container">
                                                <div class="service-item">
                                                    <div class="d-flex gap-2">
                                                        <select name="service_id[]" class="form-control service-select" style="width: 300px;" required>
                                                            <option value="">Select Product</option>
                                                            @foreach($services as $service)
                                                            <option value="{{ $service->id_service }}" data-price="{{ $service->service_price }}">{{ $service->service_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="quantity-control">
                                                            <button type="button" class="quantity-btn decrease-quantity">
                                                                <i class="bi bi-dash"></i>
                                                            </button>
                                                            <input type="number" name="quantity[]" class="quantity-input" value="1" min="1">
                                                            <button type="button" class="quantity-btn increase-quantity">
                                                                <i class="bi bi-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" id="add-service-btn" class="btn btn-primary mt-2">Add Service</button>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            {{-- <td>Warranty <br><br>
                                <table class="no-border">
                                    <tr>
                                        <td>Warranty Number</td>
                                        <td>:</td>
                                        <td><input type="text" name="warranty_id" class="form-control" value="{{ $nextWarrantyNumber }}" required readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Start Date</td>
                                        <td>:</td>
                                        <td><input type="date" name="warranty_start_date" id="warranty_start_date" class="form-control" required></td>
                                    </tr>
                                    <tr>
                                        <td>End Date</td>
                                        <td>:</td>
                                        <td><input type="date" name="warranty_end_date" id="warranty_end_date" class="form-control" required readonly></td>
                                    </tr>
                                </table>
                            </td> --}}
                        </tr>
                        <tr>
                            <td colspan="9">
                                <div class="buttons">
                                    <a href="{{ route('service_transactions.index') }}" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
    // Initial setup
    function initializeServiceItem(serviceItem) {
        const select = serviceItem.find('.service-select');
        const quantityInput = serviceItem.find('.quantity-input');
        
        // Set initial values
        select.val('');
        quantityInput.val(1);
        
        // Update total price
        updateTotalPrice();
    }

    // Add new service item
    $('#add-service-btn').click(function() {
        const newServiceItem = $('.service-item').first().clone();
        initializeServiceItem(newServiceItem);
        $('#services-container').append(newServiceItem);
    });

    // Handle quantity increase
    $('#services-container').on('click', '.increase-quantity', function(e) {
        e.preventDefault();
        const quantityInput = $(this).siblings('.quantity-input');
        const currentValue = parseInt(quantityInput.val()) || 1;
        quantityInput.val(currentValue + 1);
        
        // Add pulse animation
        $(this).addClass('pulse');
        setTimeout(() => $(this).removeClass('pulse'), 200);
        
        updateTotalPrice();
    });

    // Handle quantity decrease
    $('#services-container').on('click', '.decrease-quantity', function(e) {
        e.preventDefault();
        const quantityInput = $(this).siblings('.quantity-input');
        const currentValue = parseInt(quantityInput.val()) || 2;
        if (currentValue > 1) {
            quantityInput.val(currentValue - 1);
            
            // Add pulse animation
            $(this).addClass('pulse');
            setTimeout(() => $(this).removeClass('pulse'), 200);
            
            updateTotalPrice();
        }
    });

    // Handle manual quantity input
    $('#services-container').on('input', '.quantity-input', function() {
        let value = parseInt($(this).val()) || 1;
        
        // Ensure minimum value is 1
        if (value < 1) {
            value = 1;
        }
        
        $(this).val(value);
        updateTotalPrice();
    });

    // Handle service selection change
    $('#services-container').on('change', '.service-select', function() {
        updateTotalPrice();
    });

    // Calculate and update total price
    function updateTotalPrice() {
        let totalPrice = 0;
        
        $('.service-item').each(function() {
            const selectedOption = $(this).find('.service-select option:selected');
            const price = parseFloat(selectedOption.data('price')) || 0;
            const quantity = parseInt($(this).find('.quantity-input').val()) || 1;
            
            totalPrice += price * quantity;
        });

        // Format total price with Indonesian Rupiah format
        const formattedPrice = 'Rp ' + totalPrice.toLocaleString('id-ID') + ',-';
        $('#total_price').val(formattedPrice);
    }

    // Prevent form submission on button clicks
    $('.quantity-btn').on('click', function(e) {
        e.preventDefault();
    });

    // Handle keyboard input for quantity
    $('#services-container').on('keydown', '.quantity-input', function(e) {
        // Allow: backspace, delete, tab, escape, enter, and numbers
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
            // Allow: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
            ($.inArray(e.keyCode, [65, 67, 86, 88]) !== -1 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            return;
        }
        // Stop keypress if not a number
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    // Initialize on page load
    $('.service-item').each(function() {
        initializeServiceItem($(this));
    });
});
    </script>
</body>

</html>
