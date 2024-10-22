<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/manageuser.css') }}?v={{ time() }}">
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
            <a href="{{ asset('/admin/dashboard') }}">Dashboard</a>
            <a href="{{ asset('/admin/add-park-space') }}">Add ParkStation</a>
            <a href="{{ asset('/admin/manageuser') }}">Manage Users</a>
            <a href="{{ asset('/admin/managespaces') }}">Manage Parkings</a>
            <a href="{{ asset('/admin/managebookings') }}">Manage Bookings</a>
            <a href="{{ route('admin.logout') }}">Logout</a>
        </nav>

        <div class="content">
            <div class="container">
                <h2>Manage Users</h2>
                <form method="GET" action="{{ route('admin.manageuser') }}" class="mb-3">
                    <label for="statusFilter" class="form-label">Filter by Status:</label>
                    <select id="statusFilter" name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">All</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                    </select>
                </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Vehicle Type</th>
                            <th>Vehicle Reg</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->fname }} {{ $user->lname }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->vehicle_type }}</td>
                                <td>{{ $user->vehicle_reg_no }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->status }}</td>
                                <td>
                                    <form action="{{ route('admin.updateStatus', $user->user_id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            <option value="suspended" {{ $user->status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary mt-2">Update</button>
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
