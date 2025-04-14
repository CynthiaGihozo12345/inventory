<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome Icons --}}
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

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: #495057;
            color: white;
        }

        .main-content {
            flex-grow: 1;
            padding: 30px;
        }

        .card {
            margin-right: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: white;
        }

        .form-group {
            margin-bottom: 15px;
        }
          /* Profile Styling */
          .profile-info {
            background-color: #2d3238;
            border-radius: 10px;
            padding: 20px 15px;
            margin-bottom: 30px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .profile-info img {
            border-radius: 50%;
            width: 90px;
            height: 90px;
            object-fit: cover;
            border: 2px solid #fff;
            margin-bottom: 10px;
        }

        .profile-info h4 {
            color: #fff;
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .profile-info a {
            display: inline-block;
            font-size: 0.9rem;
            color: #0d6efd;
            text-decoration: none;
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
                <a href="{{ route('home') }}" class="nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('stock.index') }}" class="nav-link"><i class="fa fa-cogs me-2"></i>Inventory</a>
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
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-header">
                <h5 class="mb-0">Add StockOut Records</h5>
            </div>
            @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
       
            <div class="card-body">
                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Product Form --}}
                <form action="{{ route('stockout.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="product_id">Product</label>
                        <select name="product_id" id="product_id" class="form-select" required>
                            <option value="" disabled selected>Select Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}" min="1" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Price (per unit)</label>
                        <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price') }}" min="0" required>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save me-1"></i> Save Stock OUt</button>
                        <a href="{{ route('stockout.view') }}" class="btn btn-outline-primary"><i class="fa fa-eye me-1"></i> View Stock Out</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
