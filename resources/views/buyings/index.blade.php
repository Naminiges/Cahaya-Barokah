<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="main-container" style="display: flex; background-color:#6756ff;">
        <!-- Sidebar -->
        <div class="sidebar text-white" style="width: 260px; background-color:#6756ff;">
            @include('components.sidebar')
        </div>

        <!-- Main Content -->
        <main class="content" style="flex: 1; padding: 20px; margin: 30px 30px 30px 0; background-color: #F8F9FA; border-radius: 20px;">
            <h3><span style="color: black;">Buying Transactions</span></h3>
            <hr>
            <a href="{{ route('buying.create') }}" class="btn btn-primary mb-3">Add Buying Transaction</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Invoice Number</th>
                        <th>Supplier Name</th>
                        <th>Order Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buyings as $buying)
                    <tr data-transaction-id="{{ $buying->buying_invoice_id }}">
                        <td>{{ $buying->buying_invoice_id }}</td>
                        <td>{{ $buying->supplier_name }}</td>
                        <td>{{ $buying->order_date }}</td>
                        <td class="actions-column">
                            <a href="{{ route('buying.show', $buying->buying_invoice_id) }}" class="btn btn-sm btn-info">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
                {{ $buyings->links('pagination::bootstrap-5') }}
            </div>

        </main>
    </div>
    <script>
        $('#payModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var transaction = button.data('transaction');

            var modal = $(this);
            modal.find('.modal-body #total_amount').text('Rp. ' + parseInt(transaction.total_price).toLocaleString('id-ID'));
            modal.find('.modal-body #payment_amount').val('');
            modal.find('.modal-body #change_amount').text('Rp. 0');
            modal.find('.modal-body #warning-message').addClass('d-none');

            var formAction = "{{ url('service_transactions') }}/" + transaction.transaction_id + "/pay";
            modal.find('.modal-body #paymentForm').attr('action', formAction);
            modal.find('.modal-body #paymentForm').data('transaction-id', transaction.transaction_id);
        });

        $('#payment_amount').on('input', function () {
            var total = parseInt($('#total_amount').text().replace(/[^0-9]/g, ''));
            var payment = $(this).val().replace(/[^0-9]/g, '');
            var change = payment - total;

            if (payment < total) {
                $('#warning-message').removeClass('d-none');
                $('#change_amount').text('Rp. 0');
            } else {
                $('#warning-message').addClass('d-none');
                $('#change_amount').text('Rp. ' + change.toLocaleString('id-ID'));
            }
        });

        $('#paymentForm').on('submit', function (event) {
            event.preventDefault();

            var form = $(this);
            var transactionId = form.data('transaction-id');
            var paymentAmount = $('#payment_amount').val().replace(/[^0-9]/g, '');
            var totalAmount = parseInt($('#total_amount').text().replace(/[^0-9]/g, ''));

            if (paymentAmount >= totalAmount) {
                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    success: function (response) {
                        $('#payModal').modal('hide');
                        var row = $('tr[data-transaction-id="' + transactionId + '"]');
                        row.find('.actions-column').html(
                            '<a href="{{ url("service_transactions") }}/view/' + transactionId + '" class="btn btn-sm btn-info">View</a>' +
                            '<form action="{{ url("service_transactions") }}/' + transactionId + '" method="POST" style="display:inline-block;">' +
                            '@csrf' +
                            '@method("DELETE")' +
                            '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm("Are you sure?")">Delete</button>' +
                            '</form>'
                        );
                        row.find('td:nth-child(8)').text('completed');
                    },
                    error: function (xhr, status, error) {
                        alert('Payment failed. Please try again.');
                    }
                });
            } else {
                $('#warning-message').removeClass('d-none');
            }
        });

        $('#payModal').on('hidden.bs.modal', function () {
            window.location.href = "{{ route('service_transactions.index') }}";
        });
    </script>
</body>

</html>
