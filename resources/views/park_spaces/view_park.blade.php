<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Spaces</title>
    <link rel="stylesheet" href="{{ asset('css/view_park.css') }}?v={{ time() }}">
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

    <div class="container">
        @foreach($parks as $park)
            <div class="park-item">
                <div class="park-image">
                    <img src="{{ $park->park_pic ? asset('storage/' . $park->park_pic) : asset('images/default-park.png') }}" alt="{{ $park->park_name }}">
                </div>
                <div class="park-details">
                    <h3>{{ $park->park_name }}</h3>
                    <p>{{ $park->address }}</p>
                    <p>Facilities: {{ $park->park_facilities }}</p>
                    <p>Rent: {{ $park->park_rent }}</p>
                    <p>Status: {{ $park->status }}</p>
                </div>
                <button data-park-id="{{ $park->park_id }}">Book Park</button>
            </div>
        @endforeach
    </div>

    <div id="booking-form-overlay" style="display: none;">
        <div class="booking-form">
            <button id="close-booking-form">×</button> <!-- Close button -->
            <h2>Book Parking</h2>
            <form action="{{ route('book.parking') }}" method="POST">
                @csrf
                <input type="hidden" name="park_id" id="park_id">
                <label for="payment_method">Select Payment Method</label>
                <select name="payment_method" required>
                    <option value="cash">Cash</option>
                    <option value="bkash">Bkash</option>
                    <option value="nagad">Nagad</option>
                    <option value="credit_card">Credit Card</option>
                </select>
                <label for="transaction_number">Transaction Number</label>
                <input type="text" name="transaction_number" id="transaction_number" required>
                <button type="submit">Book Parking</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const bookButtons = document.querySelectorAll('.park-item button');

            bookButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const parkId = this.getAttribute('data-park-id');
                    if ({{ Session::has('user') ? 'true' : 'false' }}) {
                        document.getElementById('park_id').value = parkId;
                        document.getElementById('booking-form-overlay').style.display = 'block';
                    } else {
                        alert('You are not logged in. Please log in to continue.');
                        window.location.href = "{{ route('login') }}";
                    }
                });
            });

            document.getElementById('close-booking-form').addEventListener('click', function () {
                document.getElementById('booking-form-overlay').style.display = 'none';
            });
        });
    </script>
    @include('footer');
</body>
</html>
