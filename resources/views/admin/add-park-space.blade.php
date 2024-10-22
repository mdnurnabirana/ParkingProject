<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Park Space</title>
    <link rel="stylesheet" href="{{ asset('css/add-park-space.css') }}?v={{ time() }}">
    <link rel="icon" href="{{ asset('images/head_logo.png')}}">
    @if (!session('admin_id'))
                    <script type="text/javascript">
                    window.location = "{{ url('/admin/login') }}"; // Redirect to admin login page
                </script>
                    <p>You are not authorized to view this page. Redirecting to login...</p>
                @php
                    exit();
                @endphp
                @endif
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

    <div class="container">
        <nav class="sidebar">
            <a href="{{ asset('/admin/dashboard') }}">Dashboard</a>
            <a href="{{ asset('/admin/add-park-space') }}">Add ParkStation</a>
            <a href="{{ asset('/admin/manageuser') }}">Manage Users</a>
            <a href="{{ asset('/admin/managespaces') }}">Manage Parkings</a>
            <a href="{{ asset('/admin/managebookings') }}">Manage Bookings</a>
            <a href="{{ route('admin.logout') }}">Logout</a>
        </nav>

        <main class="content">
            <div class="form-container">
                <h2>Add Park Space</h2>

                <form action="/admin/add-park-space" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="park_name">Park Name</label>
                        <input type="text" id="park_name" name="park_name" placeholder="Enter park name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="Enter address" required>
                    </div>
                    <div class="form-group">
                        <label for="park_pic">Park Picture</label>
                        <input type="file" id="park_pic" name="park_pic">
                    </div>
                    <div class="form-group">
                        <label for="park_facilities">Facilities</label>
                        <textarea id="park_facilities" name="park_facilities" placeholder="Enter park facilities"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="park_rent">Rent (BDT)</label>
                        <input type="number" step="0.01" id="park_rent" name="park_rent" placeholder="Enter rent per hour">
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Payment Method</label>
                        <select id="payment_method" name="payment_method">
                            <option value="">Select payment method</option>
                            <option value="cash">Cash</option>
                            <option value="bkash">bKash</option>
                            <option value="nagad">Nagad</option>
                            <option value="credit_card">Credit Card</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bkash_number">bKash Number</label>
                        <input type="text" id="bkash_number" name="bkash_number" placeholder="Enter bKash number">
                    </div>
                    <div class="form-group">
                        <label for="nagad_number">Nagad Number</label>
                        <input type="text" id="nagad_number" name="nagad_number" placeholder="Enter Nagad number">
                    </div>
                    <div class="form-group">
                        <label for="total_spaces">Total Spaces</label>
                        <input type="number" id="total_spaces" name="total_spaces" placeholder="Enter total spaces" required>
                    </div>
                    <div class="form-group">
                        <label for="available_spaces">Available Spaces</label>
                        <input type="number" id="available_spaces" name="available_spaces" placeholder="Enter available spaces" required>
                    </div>
                    <div class="form-group">
                        <label for="owner_number">Owner Contact Number</label>
                        <input type="text" id="owner_number" name="owner_number" placeholder="Enter owner contact number" required>
                    </div>
                    <div class="form-group">
                        <label for="availability_time">Availability Time</label>
                        <input type="text" id="availability_time" name="availability_time" placeholder="Enter availability time" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>
                    <button type="submit">Add Space</button>
                </form>
            </div>
        </main>
    </div>

    <footer class="footer">
        <div class="container">
            <span>&copy; 2024 ParkStation BD. All rights reserved.</span>
            <span><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></span>
        </div>
    </footer>
</body>
</html>
