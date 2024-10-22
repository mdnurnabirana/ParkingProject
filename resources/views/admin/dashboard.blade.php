<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}?v={{ time() }}">
    <link rel="icon" href="{{ asset('images/head_logo.png') }}?v={{ time() }}">
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="ParkStation Logo">
            </div>
            <div class="admin-info">
                <h1>ParkStation BD Admin Dashboard</h1>
                <p class="admin-name">Welcome, {{ session('admin_name') }}</p>
            </div>
        </div>
    </header>

    <div class="main-container">
        <nav class="sidebar">
            <a href="{{ asset('/admin/add-park-space') }}">Dashboard</a>
            <a href="{{ asset('/admin/add-park-space') }}">Add ParkStation</a>
            <a href="{{ asset('/admin/manageuser') }}">Manage Users</a>
            <a href="{{ asset('/admin/managespaces') }}">Manage Parkings</a>
            <a href="{{ asset('/admin/managebookings') }}">Manage Bookings</a>
            <a href="{{ route('admin.logout') }}">Logout</a>
        </nav>

        <div class="content">
            <div class="grid-container">
                <div class="container">
                    <h2>User Details</h2>
                    <p><strong>Total Users:</strong> {{ $totalUsers }}</p>
                    <p><strong>Active Users:</strong> {{ $activeUsers }}</p>
                    <p><strong>Registered Today:</strong> {{ $usersRegisteredToday }}</p>
                    <p><strong>Inactive Users:</strong> {{ $inactiveUsers }}</p>
                </div>

                <div class="container">
                    <h2>Park Spaces</h2>
                    <p><strong>Total Spaces:</strong> {{ $totalSpaces }}</p>
                    <p><strong>Available Spaces:</strong> {{ $availableSpaces }}</p>
                    <p><strong>Occupied Spaces:</strong> {{ $occupiedSpaces }}</p>
                    <p><strong>Spaces Reserved Today:</strong> {{ $spacesReservedToday }}</p>
                </div>

                <div class="container coming-soon">
                    <p>Coming Soon</p>
                </div>

                <div class="container coming-soon">
                    <p>Coming Soon</p>
                </div>

                <div class="container coming-soon">
                    <p>Coming Soon</p>
                </div>

                <div class="container coming-soon">
                    <p>Coming Soon</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
