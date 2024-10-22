<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ParkStation</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}?v={{ time() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
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
                <li><a href="#">List Your Parking</a></li>
                <li><a href="#">Career</a></li>
            </ul>
        </div>
    </header>

    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h2>Login</h2>
            </div>

            <div class="message-container">
                @if(session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="error-message">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <div>
                    <label for="email_or_mobile">Email or Mobile</label>
                    <input type="text" id="email_or_mobile" name="email_or_mobile" required>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
            <div class="signup-link">
                <p>Don't have an account? <a href="{{ url('/register') }}">Sign up</a></p>
            </div>
        </div>
    </div>

    @include('footer');

</body>
</html>
