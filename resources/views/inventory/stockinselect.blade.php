<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock In Records</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
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
        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
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
    <!-- Sidebar -->
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
  
       
    <!-- Main Content -->
    <div class="main-content">
        <div class="card mx-auto" style="max-width: 900px;">
            <div class="card-header">
                <h5 class="mb-0">List of Stock In Records</h5>

            </div>
            @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
            <div class="card-body">
                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Stock In Table -->
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                    <tr><th colspan="4" style="border: 0;"><a href="{{ route('stockin.form') }}" class="btn btn-primary btn-sm">ADD +</a></th></tr>
                        <tr>
                            <th>#</th>
                            <th>Product ID</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $p)
                            <tr>
                                <td>{{ $p->stockin_id }}</td>
                                <td>{{ $p->product_id }}</td>
                                <td>{{ $p->quantity }}</td>
                                <td>{{ $p->price }}</td>
                                <td>
                                    <!-- Replace these with actual routes -->
                                    <a href="{{route('stockin.edit',['stockin'=>$p])}}" class="btn btn-sm btn-warning me-1">Update</a>
                                    <form action="{{route('stockin.delete',['stockin'=>$p])}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
