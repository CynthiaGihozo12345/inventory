<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <!-- Add your CSS files here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <header>
            <nav>
                <!-- Your navigation menu (if needed) -->
            </nav>
        </header>

        <main>
            @yield('content') <!-- This will render the content of the page -->
        </main>
    </div>
</body>
</html>
