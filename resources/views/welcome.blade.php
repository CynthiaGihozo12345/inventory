<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Bootstrap CDN --}}
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
        .card {
            margin-right: 20px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    {{-- Sidebar --}}
    <div class="sidebar d-flex flex-column p-3">
        <h4 class="text-center">Admin Panel</h4>
        <hr>
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="" class="nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fa fa-cogs me-2"></i>Inventory</a>
            </li>
            <li class="nav-item">
                <a href="{{route('products.create')}}" class="nav-link"><i class="fa fa-box me-2"></i>Products</a>
            </li>
            <li class="nav-item">
                <a href="{{route('stock_in.create')}}" class="nav-link"><i class="fa fa-arrow-down me-2"></i>Stock In</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fa fa-arrow-up me-2"></i>Stock Out</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fa fa-chart-line me-2"></i>Reports</a>
            </li>
            <li class="nav-item mt-auto">
                <a href="#" class="nav-link"><i class="fa fa-sign-out-alt me-2"></i>Logout</a>
            </li>
        </ul>
    </div>

    {{-- Main Content --}}
    <div class="main-content">
        <h2>Welcome, admin!</h2>
        <p>This is your admin dashboard. Manage your inventory features from the sidebar.</p>
        <div class="d-flex">
            <div class="card text-center flex-fill">
                <div class="card-header">📦 Inventory</div>
                <div class="card-body">
                    <h3>0</h3>
                    <p>Total stock</p>
                </div>
            </div>
            <div class="card text-center flex-fill">
                <div class="card-header">⬇️ Stock In</div>
                <div class="card-body">
                    <h3>12</h3>
                    <p>Total stockin</p>
                </div>
            </div>
            <div class="card text-center flex-fill">
                <div class="card-header">⬆️ Stock Out</div>
                <div class="card-body">
                    <h3>10</h3>
                    <p>Total stockout</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
