<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in - MessYetu</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="auth-card">
        <div class="auth-hero">
            <div class="hero-brand">
                <div class="brand-icon">
                    <img src="{{ asset('images/logo.png') }}" alt="Site Logo">

                </div>
                <span class="brand-title">MessYetu</span>
            </div>

            <div class="hero-main">
                <h1 class="hero-heading">Skip the queue.<br>Pay from your phone.</h1>
                <p class="hero-subheading">Order, pay with M-PESA, show your code.</p>
            </div>

            <div class="hero-footer">
                <span>Student cafeteria</span>
            </div>
        </div>

        <div class="auth-form-side">
            <div class="form-inner">
                <h2 class="form-title">Sign in</h2>

                @if ($errors->any())
                    <div class="alert-error">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form id="login-form" action="{{ route('login.post') }}" method="POST" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="phone_number" class="form-label">Phone number</label>
                        <input
                            type="text"
                            name="phone_number"
                            id="phone_number"
                            class="form-input"
                            value="{{ old('phone_number') }}"
                            placeholder="0712 345 678"
                        >
                        <span class="error-message" id="phone_number_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-input"
                            placeholder="••••••••"
                        >
                        <span class="error-message" id="password_error"></span>
                    </div>

                    <button type="submit" class="btn-submit">Sign in</button>
                </form>

                <div class="auth-switch">
                    New here? <a href="{{ route('register') }}">Create account</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#login-form').on('submit', function(e) {
                let isValid = true;
                const phone = $('#phone_number').val().trim();
                const password = $('#password').val();

                $('#phone_number_error').hide().text('');
                $('#password_error').hide().text('');
                $('#phone_number').removeClass('input-error');
                $('#password').removeClass('input-error');

                if (phone === '') {
                    $('#phone_number_error').text('Phone number is required.').show();
                    $('#phone_number').addClass('input-error');
                    isValid = false;
                } else if (!/^[0-9+\s-]{9,15}$/.test(phone)) {
                    $('#phone_number_error').text('Please enter a valid phone number.').show();
                    $('#phone_number').addClass('input-error');
                    isValid = false;
                }

                if (password === '') {
                    $('#password_error').text('Password is required.').show();
                    $('#password').addClass('input-error');
                    isValid = false;
                } else if (password.length < 6) {
                    $('#password_error').text('Password must be at least 6 characters.').show();
                    $('#password').addClass('input-error');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });

            $('#phone_number').on('input', function() {
                $('#phone_number_error').hide().text('');
                $(this).removeClass('input-error');
            });

            $('#password').on('input', function() {
                $('#password_error').hide().text('');
                $(this).removeClass('input-error');
            });
        });
    </script>
</body>
</html>
