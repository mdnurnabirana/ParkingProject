<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/managespaces.css') }}?v={{ time() }}">
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
            <h2>Manage Parking Spaces</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Address</th>
                        <th>Name</th>
                        <th>Rent</th>
                        <th>Payment Method</th>
                        <th>Total Spaces</th>
                        <th>Available Spaces</th>
                        <th>Status</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parkSpaces as $space)
                        <tr>
                            <td>{{ $space->park_id }}</td>
                            <td>
                                <form action="{{ route('admin.updateSpace', $space->park_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('POST')
                                    <input type="text" name="address" value="{{ $space->address }}" required>
                            </td>
                            <td>
                                <input type="text" name="park_name" value="{{ $space->park_name }}" required>
                            </td>
                            <td>
                                <input type="number" name="park_rent" value="{{ $space->park_rent }}" required>
                            </td>
                            <td>
                                <input type="text" name="payment_method" value="{{ $space->payment_method }}" required>
                            </td>
                            <td>
                                <input type="number" name="total_spaces" value="{{ $space->total_spaces }}" required>
                            </td>
                            <td>
                                <input type="number" name="available_spaces" value="{{ $space->available_spaces }}" required>
                            </td>
                            <td>
                                <select name="status" required>
                                    <option value="active" {{ $space->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $space->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.deleteSpace', $space->park_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this space?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
