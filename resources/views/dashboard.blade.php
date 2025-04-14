<!-- <x-app-layout style="background-color: #000;">
    <x-slot name="header">
        <span class="font-semibold text-xl text-black leading-tight" >
            {{ __('Dashboard') }}
        </span>
    </x-slot>

    {{-- Custom Admin Dashboard Section --}}
    <div>
        {{-- Bootstrap & FontAwesome --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

        <style>
            /* Updated background for the entire layout */
            .admin-body {
                display: flex;
                min-height: 100vh;
                background-color: #000; /* Black background */
                color: white; /* White text for contrast */
            }

            .sidebar {
                width: 270px;
                background-color: #343a40;
                color: white;
                flex-shrink: 0;
                height: 100vh;
                position: sticky;
                top: 0;
            }

            .sidebar .nav-link {
                color: #ccc;
                border-radius: 6px;
                margin-bottom: 5px;
            }

            .sidebar .nav-link.active, 
            .sidebar .nav-link:hover {
                background-color: #495057;
                color: white;
            }

            .main-content {
                flex-grow: 1;
                padding: 30px;
                background-color: #212529; /* Slightly darker background for the main content */
                color: white; /* Ensure the text is visible on the dark background */
            }

            .top-info-box {
                max-width: 400px;
                margin: 0 auto 30px auto;
                padding: 16px 24px;
                background: #ffffff;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                font-size: 16px;
                text-align: center;
            }

            .card {
                margin-right: 20px;
                border: none;
                border-radius: 12px;
                box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                overflow: hidden;
            }

            .card-header {
                background-color: #007bff;
                color: white;
                font-weight: 600;
                font-size: 16px;
                padding: 10px;
            }

            .card-body {
                padding: 20px;
                background-color: #fff;
            }

            .dashboard-cards {
                display: flex;
                gap: 20px;
                flex-wrap: wrap;
            }

            @media (max-width: 768px) {
                .admin-body {
                    flex-direction: column;
                }

                .sidebar {
                    width: 100%;
                    position: relative;
                    height: auto;
                }

                .dashboard-cards {
                    flex-direction: column;
                }
            }

            /* Updated header style */
            .font-semibold.text-xl.text-gray-800.dark\:text-gray-200.leading-tight {
                background-color: #000;
                padding: 15px;
                border-radius: 5px;
            }
        </style>

        <div class="admin-body">
            {{-- Sidebar --}}
            <div class="sidebar d-flex flex-column p-3">
                <h4 class="text-center">Admin Panel</h4>
                <hr>
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a href="" class="nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
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
                        <a href="{{ route('reports.index') }}" class="nav-link"><i class="fa fa-chart-line me-2"></i>Reports</a>
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
        </div>
    </div>
</x-app-layout> -->
