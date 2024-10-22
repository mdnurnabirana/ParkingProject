<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}?v={{ time() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/head_logo.png') }}?v={{ time() }}">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="ParkStation Logo">
            </div>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="#">Our Solution</a></li>
                <li><a href="#">Find Parking</a></li>
                <li><a href="#">Career</a></li>
            </ul>
        </div>
    </header>

    <div class="login-container">
        <div class="login-box">
            <h2>Admin Login</h2>
            <form method="POST" action="{{ url('/admin/login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
            @if (session('error'))
                <div class="error-message">{{ session('error') }}</div>
            @endif
        </div>
    </div>

    @include('footer')
</body>
</html>
