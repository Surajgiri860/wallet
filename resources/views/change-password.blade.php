<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change User Password</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .header {
            background: linear-gradient(135deg,rgb(29, 120, 206),  #3f37c9);
            padding: 1rem;
            position: relative;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .back-button {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            color: #e0e0e0;
        }

        .header h2 {
            color: white;
            margin: 0;
            text-align: center;
            font-size: 1.5rem;
        }

        .container {
            max-width: 600px;
            padding: 0 15px;
        }

        .password-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            margin-top: 2rem;
        }

        .form-control {
            border: 1px solid #e0e0e0;
            padding: 0.7rem;
            border-radius: 7px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color:rgb(43, 81, 180);
            box-shadow: 0 0 0 0.2rem rgba(38, 38, 245, 0.25);
        }

        .form-label {
            font-weight: 500;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .btn-primary {
            background-color: #2a9d8f;
            border: none;
            padding: 0.7rem 2rem;
            border-radius: 7px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color:rgb(16, 66, 202);
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .alert-danger {
            background-color: #fff5f5;
            border: 1px solid #ffc9c9;
            color: #d9534f;
        }

        .alert-danger ul {
            margin-bottom: 0;
            padding-left: 1.5rem;
        }

        .password-field {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
            transition: color 0.3s ease;
        }

        .toggle-password:hover {
            color: #2a9d8f;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        .password-strength-meter {
            height: 5px;
            background-color: #e0e0e0;
            margin-top: -5px;
            margin-bottom: 1rem;
            border-radius: 0 0 7px 7px;
        }

        .password-strength-meter div {
            height: 100%;
            width: 0;
            transition: width 0.5s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="{{ route('account.dashboard')}}" class="back-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Back
        </a>
        <h2>Change User Password</h2>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success fade-in">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger fade-in">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="password-card fade-in">
            <form action="{{ route('user.updatePassword') }}" method="POST">
                @csrf
                @method('POST')

                <div class="mb-4">
                    <label for="current_password" class="form-label">Current Password</label>
                    <div class="password-field">
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                        <i class="fas fa-eye toggle-password" onclick="togglePassword('current_password')"></i>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="new_password" class="form-label">New Password</label>
                    <div class="password-field">
                        <input type="password" class="form-control" id="new_password" name="new_password" required minlength="8">
                        <i class="fas fa-eye toggle-password" onclick="togglePassword('new_password')"></i>
                    </div>
                    <div class="password-strength-meter">
                        <div id="password-strength"></div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                    <div class="password-field">
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required minlength="8">
                        <i class="fas fa-eye toggle-password" onclick="togglePassword('new_password_confirmation')"></i>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-lock me-2"></i>Change Password
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = passwordField.nextElementSibling;
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Password strength meter
        document.getElementById('new_password').addEventListener('input', function() {
            const password = this.value;
            const strengthMeter = document.getElementById('password-strength');
            let strength = 0;

            // Check length
            if (password.length >= 8) strength++;
            
            // Check for uppercase
            if (/[A-Z]/.test(password)) strength++;
            
            // Check for lowercase
            if (/[a-z]/.test(password)) strength++;
            
            // Check for numbers
            if (/[0-9]/.test(password)) strength++;
            
            // Check for special characters
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            strengthMeter.style.width = `${strength * 20}%`;
            
            // Color the strength meter
            if (strength <= 1) {
                strengthMeter.style.backgroundColor = '#ff6b6b';
            } else if (strength <= 3) {
                strengthMeter.style.backgroundColor = '#ffd43b';
            } else {
                strengthMeter.style.backgroundColor = '#40c057';
            }
        });
    </script>
</body>
</html>