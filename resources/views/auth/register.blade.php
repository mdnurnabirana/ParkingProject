<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ParkStation</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}?v={{ time() }}">
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

    <div class="register-container">
    <div class="register-box">
        <h2>Register</h2>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-section">
                <div class="form-column">
                    <h3>User Details</h3>
                    <div class="input-box">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="fname" value="{{ old('fname') }}" required>
                        @error('fname')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="lname" value="{{ old('lname') }}" required>
                        @error('lname')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <label for="mobile">Mobile</label>
                        <input type="text" id="mobile" name="mobile" value="{{ old('mobile') }}" required>
                        @error('mobile')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <div class="input-box">
                        <label for="user_pic">User Picture</label>
                        <input type="file" id="user_pic" name="user_pic">
                    </div>
                </div>
                <div class="form-column">
                    <h3>Vehicle Details</h3>
                    <div class="input-box">
                        <label for="vehicle_type">Vehicle Type</label>
                        <select id="vehicle_type" name="vehicle_type" required>
                            <option value="" disabled {{ old('vehicle_type') ? '' : 'selected' }}>Select Vehicle Type</option>
                            <option value="NOHA" {{ old('vehicle_type') == 'NOHA' ? 'selected' : '' }}>NOHA</option>
                            <option value="CAR" {{ old('vehicle_type') == 'CAR' ? 'selected' : '' }}>CAR</option>
                            <option value="BIKE" {{ old('vehicle_type') == 'BIKE' ? 'selected' : '' }}>BIKE</option>
                            <option value="HIACE" {{ old('vehicle_type') == 'HIACE' ? 'selected' : '' }}>HIACE</option>
                            <option value="CNG" {{ old('vehicle_type') == 'CNG' ? 'selected' : '' }}>CNG</option>
                            <option value="OTHERS" {{ old('vehicle_type') == 'OTHERS' ? 'selected' : '' }}>OTHERS</option>
                        </select>
                        @error('vehicle_type')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <label for="vehicle_reg_no">Vehicle Registration Number</label>
                        <input type="text" id="vehicle_reg_no" name="vehicle_reg_no" value="{{ old('vehicle_reg_no') }}" required>
                        @error('vehicle_reg_no')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <label for="vehicle_pic">Vehicle Picture</label>
                        <input type="file" id="vehicle_pic" name="vehicle_pic">
                    </div>
                    <div class="input-box">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}" required>
                        @error('address')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="prefer not to say" {{ old('gender') == 'prefer not to say' ? 'selected' : '' }}>Prefer not to say</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="register-btn">Register</button>
        </form>
    </div>
</div>

    </div>

    @include('footer');

</body>
</html>
