<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List of Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 270px;
            background-color: #343a40;
            color: white;
            flex-shrink: 0;
        }
        .sidebar .nav-link {
            color: #ccc;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background-color: #495057;
            color: white;
        }
        .main-content {
            flex-grow: 1;
            padding: 30px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .profile-info {
    text-align: center;
    padding: 20px 10px;
    background-color: #2c3136;
    border-radius: 10px;
    margin-bottom: 20px;
}

.profile-info img {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #ffffff30;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    margin-bottom: 10px;
}

.profile-info h4 {
    font-size: 1.1rem;
    color: #fff;
    margin-bottom: 5px;
    font-weight: 600;
}

.profile-info a {
    color: #0d6efd;
    text-decoration: none;
    font-size: 0.9rem;
}

.profile-info a i {
    margin-right: 4px;
}

.profile-info a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    {{-- Sidebar --}}
    <div class="sidebar d-flex flex-column p-3">
    <div class="profile-info">
            {{-- Static Profile Image --}}
            <img src="{{ asset('images/profile.png') }}" alt="Profile Picture">

            {{-- User Name --}}
            <h4>{{ Auth::user()->name }}</h4>

            {{-- Update Profile Link --}}
            <a href="{{ route('profile.edit') }}">
                <i class="fas fa-user-edit me-1"></i> Update Profile
            </a>
        </div>
        <h4 class="text-center">Admin Panel</h4>
        <hr>
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="{{route('stock.index')}}" class="nav-link"><i class="fa fa-cogs me-2"></i>Inventory</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('products.view') }}" class="nav-link"><i class="fa fa-box me-2"></i>Products</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('stockin.view') }}" class="nav-link"><i class="fa fa-arrow-down me-2"></i>Stock In</a>
            </li>
            <li class="nav-item">
                <a href="{{route('stockout.view')}}" class="nav-link"><i class="fa fa-arrow-up me-2"></i>Stock Out</a>
            </li>
            <li class="nav-item">
                <a href="{{route('reports.index')}}" class="nav-link"><i class="fa fa-chart-line me-2"></i>Reports</a>
            </li>
            {{-- Logout button at the bottom --}}
        <li class="nav-item mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link btn btn-link text-start w-100">
                    <i class="fa fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </li>
        </ul>
    </div>

    {{-- Main Content --}}
    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">List of Available Products</h5>
            </div>
            @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr><th colspan="4" style="border: 0;"><a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">ADD +</a></th></tr>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->created_at->format('Y-m-d') }}</td>
                            <td>
                            <a href="{{ route('products.edit', ['products' => $product]) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i> Edit
                                </a>


                                <form action="{{route('products.delete',['products'=>$product])}}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($products->isEmpty())
                    <p class="text-muted">No products available.</p>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
