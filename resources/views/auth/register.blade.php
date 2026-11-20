<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create account - MessYetu</title>
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
                <h2 class="form-title">Create account</h2>

                @if ($errors->any())
                    <div class="alert-error">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form id="register-form" action="{{ route('register.post') }}" method="POST" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">Full names</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-input"
                            value="{{ old('name') }}"
                            placeholder="e.g. John Doe"
                        >
                        <span class="error-message" id="name_error"></span>
                    </div>

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

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Repeat password</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="form-input"
                            placeholder="••••••••"
                        >
                        <span class="error-message" id="password_confirmation_error"></span>
                    </div>

                    <button type="submit" class="btn-submit">Create account</button>
                </form>

                <div class="auth-switch">
                    Already have an account? <a href="{{ route('login') }}">Sign in</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#register-form').on('submit', function(e) {
                let isValid = true;
                const name = $('#name').val().trim();
                const phone = $('#phone_number').val().trim();
                const password = $('#password').val();
                const passwordConfirmation = $('#password_confirmation').val();

                $('#name_error').hide().text('');
                $('#phone_number_error').hide().text('');
                $('#password_error').hide().text('');
                $('#password_confirmation_error').hide().text('');

                $('#name').removeClass('input-error');
                $('#phone_number').removeClass('input-error');
                $('#password').removeClass('input-error');
                $('#password_confirmation').removeClass('input-error');

                if (name === '') {
                    $('#name_error').text('Full names are required.').show();
                    $('#name').addClass('input-error');
                    isValid = false;
                } else if (name.length < 2) {
                    $('#name_error').text('Full names must be at least 2 characters.').show();
                    $('#name').addClass('input-error');
                    isValid = false;
                }

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

                if (passwordConfirmation === '') {
                    $('#password_confirmation_error').text('Please repeat your password.').show();
                    $('#password_confirmation').addClass('input-error');
                    isValid = false;
                } else if (password !== passwordConfirmation) {
                    $('#password_confirmation_error').text('Passwords do not match.').show();
                    $('#password_confirmation').addClass('input-error');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });

            $('#name').on('input', function() {
                $('#name_error').hide().text('');
                $(this).removeClass('input-error');
            });

            $('#phone_number').on('input', function() {
                $('#phone_number_error').hide().text('');
                $(this).removeClass('input-error');
            });

            $('#password').on('input', function() {
                $('#password_error').hide().text('');
                $(this).removeClass('input-error');
            });

            $('#password_confirmation').on('input', function() {
                $('#password_confirmation_error').hide().text('');
                $(this).removeClass('input-error');
            });
        });
    </script>
</body>
</html>
