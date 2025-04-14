<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        /* Styling for the report page */
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
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: white;
        }

        .form-label {
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        .table-striped tbody tr:hover {
            background-color: #e0e0e0;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-outline-primary {
            color: #007bff;
            border-color: #007bff;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: white;
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
                <a href="{{ route('home') }}" class="nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
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
                <a href="{{ route('stockout.view') }}" class="nav-link"><i class="fa fa-arrow-up me-2"></i>Stock Out</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reports.index') }}" class="nav-link active"><i class="fa fa-chart-line me-2"></i>Reports</a>
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
        <div class="card mx-auto" style="max-width: 1000px;">
            <div class="card-header">
                <h5 class="mb-0">Stock Report</h5>
            </div>

            <div class="card-body">
                {{-- Date Filter Form --}}
                <form method="GET" action="{{ route('reports.index') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="from" class="form-label">Start Date</label>
                            <input type="date" name="from" id="from" class="form-control" value="{{ old('from', $from) }}">
                        </div>
                        <div class="col-md-5">
                            <label for="to" class="form-label">End Date</label>
                            <input type="date" name="to" id="to" class="form-control" value="{{ old('to', $to) }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary mt-4">Filter</button>
                        </div>
                    </div>
                </form>

                {{-- Stock In Table --}}
                <h5 class="mb-3">Stock In</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stockins as $stockin)
                            <tr>
                                <td>{{ $stockin->product->product_name }}</td>
                                <td>{{ $stockin->quantity }}</td>
                                <td>{{ number_format($stockin->price, 2) }}</td>
                                <td>{{ $stockin->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Stock Out Table --}}
                <h5 class="mb-3">Stock Out</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stockouts as $stockout)
                            <tr>
                                <td>{{ $stockout->product->product_name }}</td>
                                <td>{{ $stockout->quantity }}</td>
                                <td>{{ number_format($stockout->price, 2) }}</td>
                                <td>{{ $stockout->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
