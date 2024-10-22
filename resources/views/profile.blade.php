<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}?v={{ time() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/head_logo.png') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="ParkStation Logo">
            </div>
            <ul>
                <li><a href="{{ url('/view-park') }}">View Park</a></li>
                <li><a href="{{ route('profile.show') }}">Profile</a></li>
                <li><a href="{{ url('/logout') }}">Logout</a></li>
            </ul>
        </div>
    </header>

    <main class="profile-container">
        <!-- Display Success or Error Message -->
        @if(session('success'))
            <div class="alert alert-success">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <section class="left-section">
            <h2>Personal Information</h2>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li><p>{{ $error }}</p></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="user-info">
                <img src="{{ $user->user_pic ? asset('storage/' . $user->user_pic) : asset('images/default-user.png') }}" alt="User Photo">
                <input type="file" name="vehicle_pic" accept="image/*">

                    <div class="user-details">
                        <p class="name"><span class="fas fa-user"></span>
                            <input type="text" name="fname" value="{{ $user->fname }}" required>
                            <input type="text" name="lname" value="{{ $user->lname }}" required>
                        </p>
                        <p><span class="fas fa-envelope"></span><input type="email" name="email" value="{{ $user->email }}" required></p>
                        <p><span class="fas fa-phone"></span><input type="text" name="mobile" value="{{ $user->mobile }}" required></p>
                        <p><span class="fas fa-calendar-alt"></span>{{ \Carbon\Carbon::parse($user->created_at)->format('F j, Y') }}</p>
                        <p><span class="fas fa-map-marker-alt"></span><input type="text" name="address" value="{{ $user->address }}" required></p>
                        <p><span class="fas fa-venus-mars"></span>
                            <select name="gender" required>
                                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </p>
                    </div>
                </div>

                <h2>Vehicle Information</h2>
                <div class="vehicle-info">
                    <img src="{{ $user->vehicle_pic ? asset('storage/' . $user->vehicle_pic) : asset('images/default-vehicle.png') }}" alt="Vehicle Photo">
                    <input type="file" name="vehicle_pic" accept="image/*">

                    <div class="vehicle-details">
                        <p class="name">
                            <span class="fas fa-car"></span>
                            <select name="vehicle_type" required>
                                <option value="NOHA" {{ $user->vehicle_type == 'NOHA' ? 'selected' : '' }}>NOHA</option>
                                <option value="CAR" {{ $user->vehicle_type == 'CAR' ? 'selected' : '' }}>CAR</option>
                                <option value="BIKE" {{ $user->vehicle_type == 'BIKE' ? 'selected' : '' }}>BIKE</option>
                                <option value="HIACE" {{ $user->vehicle_type == 'HIACE' ? 'selected' : '' }}>HIACE</option>
                                <option value="CNG" {{ $user->vehicle_type == 'CNG' ? 'selected' : '' }}>CNG</option>
                                <option value="OTHER" {{ $user->vehicle_type == 'OTHER' ? 'selected' : '' }}>OTHER...</option>
                            </select>
                        </p>
                        <p>
                            <span class="fas fa-id-card"></span>
                            <input type="text" name="vehicle_reg_no" value="{{ $user->vehicle_reg_no }}" required>
                        </p>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </section>

        <!-- Add Change Password Section -->
        <section class="change-password-section">
            <h2>Change Password</h2>
            <form action="{{ route('profile.changePassword') }}" method="POST">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="alert alert-error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li><p>{{ $error }}</p></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label for="current_password">Current Password:</label>
                    <input type="password" name="current_password" required>
                </div>

                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" name="new_password" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm New Password:</label>
                    <input type="password" name="confirm_password" required>
                </div>

                @if(session('password_error'))
                    <div class="alert alert-error">
                        <p>{{ session('password_error') }}</p>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </section>
    </main>
    @include('footer');
</body>
</html>
