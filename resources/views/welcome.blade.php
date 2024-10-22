<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to ParkStation Bd</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}?v={{ time() }}">
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
                <li><a href="{{ asset('/') }}">Home</a></li>
                <li><a href="{{ asset('/view-park') }}">View Parking Spaces</a></li>
                @if(Session::has('user'))
                    <li><a href="{{ asset('profile') }}">Profile</a></li>
                    <li><a href="{{ route('booking.requests') }}">Parking Requests</a></li>
                    <li><a href="{{ route('user.logout') }}">Logout</a></li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endif
            </ul>
        </div>
    </header>

    <section class="hero-section">
    <div id="hero-content">
        <h1>Welcome to ParkStation Bd</h1>
        <p>Your trusted partner for finding and listing parking spaces.</p>
        <a href="#search-bar-container" class="cta-button">Get Started</a>
    </div>
    <div id="search-bar-container" class="search-bar-section">
        <form action="/search" method="GET">
            <input type="text" name="query" id="search-input" placeholder="Search by park name or location" required>
            <button type="submit">Search</button>
        </form>
    </div>
</section>



    <section class="services-section">
        <h2>Browse Our Services</h2>
        <div class="services-grid">
            <div class="service-card">
                <h3>Find Parking</h3>
                <p>Easily find available parking spots near you with our advanced search tools.</p>
            </div>
            <div class="service-card">
                <h3>List Your Parking</h3>
                <p>Have a parking space to offer? List it on our platform and start earning.</p>
            </div>
            <div class="service-card">
                <h3>Our Solution</h3>
                <p>Learn more about how our innovative solution can simplify parking for everyone.</p>
            </div>
        </div>
    </section>

    @include('footer');
</body>
</html>
