<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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

        .table {
            background-color: white;
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
    <h3><span style="color: black;">Produk</span></h3>
    <hr>
    <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">Add Product</a>
    
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Stock</th>
                <th>Supplier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
            // Inisialisasi nomor urut untuk pagination
            $no = ($services->currentPage() - 1) * $services->perPage() + 1;
            @endphp
            @forelse ($services as $service)
            <tr data-service-id="{{ $service->id_service }}">
                <td>{{ $service->id_service }}</td>
                <td>{{ $service->service_name }}</td>
                <td>Rp {{ number_format($service->service_price, 2, ',', '.') }}</td>
                <td>{{ $service->stock }}</td>
                <td>{{ $service->supplier_id }}</td>
                <td class="actions-column">
                    <a href="{{ route('services.edit', ['service' => $service->id_service]) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('services.destroy', ['service' => $service->id_service]) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td class="text-center" colspan="7">No services found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Navigation -->
    {{-- <div class="d-flex justify-content-center mt-3">
        {{ $services->links() }}
    </div> --}}

    <div class="d-flex justify-content-center mt-3">
        {{ $services->links('pagination::bootstrap-5') }}
    </div>
    
</main>
</div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>