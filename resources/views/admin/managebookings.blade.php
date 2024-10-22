<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/managebookings.css') }}">
    <link rel="icon" href="{{ asset('images/head_logo.png') }}">
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
            <h2>Manage Bookings</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>User Name</th>
                        <th>Mobile</th>
                        <th>Park Name</th>
                        <th>Park Area</th>
                        <th>Booking Date</th>
                        <th>Total Amount</th>
                        <th>Payment Method</th>
                        <th>Transaction ID</th>
                        <th>Status</th>
                        <th>Update Status</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->booking_id }}</td>
                            <td>{{ $booking->user->fname ?? 'N/A' }} {{ $booking->user->lname ?? 'N/A' }}</td>
                            <td>{{ $booking->user->mobile ?? 'N/A' }}</td>
                            <td>{{ $booking->parkSpace->park_name ?? 'N/A' }}</td>
                            <td>{{ $booking->parkSpace->address ?? 'N/A' }}</td>
                            <td>{{ $booking->booking_date }}</td>
                            <td>{{ $booking->total_amount }}</td>
                            <td>{{ $booking->payment->payment_method ?? 'N/A' }}</td>
                            <td>{{ $booking->payment->transaction_number ?? 'N/A' }}</td>
                            <td>{{ $booking->status }}</td>
                            <td>
                                <form action="{{ route('admin.updateBooking', $booking->booking_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('POST')
                                    <select name="status" required>
    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
    <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
    <option value="canceled" {{ $booking->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
    <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
</select>

                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.deleteBooking', $booking->booking_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</button>
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
