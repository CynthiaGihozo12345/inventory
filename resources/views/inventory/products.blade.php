<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
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
            height: 100vh;
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
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            width: 100%;
            max-width: 500px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .view-btn {
            margin-top: 15px;
            width: 100%;
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
            <div class="card-header text-center">
                <h5 class="mb-0"><i class="fa fa-box me-2"></i>Add New Product</h5>
            </div>
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
                @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


                {{-- Product Form --}}
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name:</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Enter product name" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100"><i class="fa fa-check-circle me-1"></i>Submit</button>
                </form>

                <a href="{{ route('products.view') }}" class="btn btn-outline-primary view-btn">
                    <i class="fa fa-eye me-1"></i> View Products
                </a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
