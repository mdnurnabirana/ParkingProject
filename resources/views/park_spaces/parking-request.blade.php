<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Requests</title>
    <link rel="stylesheet" href="{{ asset('css/parking-request.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}?v={{ time() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/head_logo.png') }}?v={{ time() }}">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}?v={{ time() }}" alt="ParkStation Logo">
            </div>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/view-park') }}">View Parking Spaces</a></li>
                @if(Session::has('user'))
                    <li><a href="{{ route('profile.show') }}">Profile</a></li>
                    <li><a href="{{ route('booking.requests') }}">Parking Requests</a></li>
                    <li><a href="{{ route('user.logout') }}">Logout</a></li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endif
            </ul>
        </div>
    </header>

    <section class="main-content">
        <div class="header-container">
            <h1>Parking Requests</h1>
            <form method="GET" action="{{ route('booking.requests') }}" class="filter-form">
                <div class="filter-group">
                    <label for="status">Filter by Status:</label>
                    <select name="status" id="status">
                        <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="canceled" {{ $status === 'canceled' ? 'selected' : '' }}>Canceled</option>
                        <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    <button type="submit">Filter</button>
                </div>
            </form>
        </div>

        <div class="requests-container">
            @if($bookings->isEmpty())
                <p>No requests found for the selected status.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Parking Space</th>
                            <th>Booking Date</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->booking_id }}</td>
                                <td>{{ $booking->park_id }}</td>
                                <td>{{ $booking->booking_date }}</td>
                                <td>${{ $booking->total_amount }}</td>
                                <td>{{ ucfirst($booking->status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </section>

    @include('footer');
</body>
</html>
