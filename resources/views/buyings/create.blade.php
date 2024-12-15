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
            <h3><span style="color: black;">Buying Transaction</span></h3>
            <hr>
            <div id="content-frame" class="container">
                <form action="{{ route('buying.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="buying_invoice_id" class="form-label">Invoice</label>
                        <input type="text" name="buying_invoice_id" id="buying_invoice_id" class="form-control" required>
                        @error('buying_invoice_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="supplier_name" class="form-label">Supplier Name</label>
                        <input type="text" name="supplier_name" id="supplier_name" class="form-control" required>
                        @error('supplier_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="entry_date" class="form-label">Entry Date</label>
                        <input type="date" name="entry_date" class="form-control" required id="entry_date">
                        @error('entry_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3" id="services-container">
                        <div class="service-item">
                            <table class="no-border">
                                <tr>
                                    <td>
                                        <label for="product_name" class="form-label">Product Name</label>
                                        <input type="text" name="product_name[]" class="form-control" required>
                                    </td>
                                    <td>
                                        <label for="product_price" class="form-label">Product Price</label>
                                        <input type="number" name="product_price[]" class="form-control" required>
                                    </td>
                                    <td>
                                        <label for="exp_date" class="form-label">Exp Date</label>
                                        <input type="date" name="exp_date[]" class="form-control" required>
                                    </td>
                                    <td>
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" name="quantity[]" class="form-control" required>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <button type="button" id="add-service-btn" class="btn btn-primary mt-2">Add Product</button>
                    <button type="submit" class="btn btn-primary mt-2">Add Transaction</button>
                </form>
                <div class="buttons mt-2">
                    <a href="{{ route('buying.index') }}" class="btn btn-secondary">Back</a>
                    <a href="{{ route('buying.create') }}" class="btn btn-danger">Reset</a>
                </div>
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
    document.getElementById('add-service-btn').addEventListener('click', function () {
        const container = document.getElementById('services-container');
        const newServiceItem = document.querySelector('.service-item').cloneNode(true);
        
        newServiceItem.querySelectorAll('input').forEach(input => {
            input.value = ''; // Kosongkan nilai input
        });

        container.appendChild(newServiceItem);
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
