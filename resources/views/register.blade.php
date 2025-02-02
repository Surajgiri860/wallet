<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration - Modern Design</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-body {
            padding: 3rem !important;
        }

        h4 {
            color: #4a3f8d;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-floating {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border: 2px solid #e1e1e1;
            border-radius: 10px;
            padding: 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #764ba2;
            box-shadow: 0 0 0 0.2rem rgba(118, 75, 162, 0.25);
        }

        .form-floating label {
            padding-left: 1rem;
            color: #666;
        }

        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
            padding: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #764ba2, #667eea);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .link-secondary {
            color: #764ba2;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .link-secondary:hover {
            color: #667eea;
            text-decoration: none;
        }

        hr {
            border-color: rgba(118, 75, 162, 0.2);
            margin: 2rem 0;
        }

        .animate__animated {
            animation-duration: 0.8s;
        }

        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: #764ba2;
            transform: scale(0.85) translateY(-1rem) translateX(0.15rem);
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-light">
    <section class="p-3 p-md-4 p-xl-5 animate__animated animate__fadeIn">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                    <div class="card rounded-4 animate__animated animate__fadeInUp">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <h4 class="animate__animated animate__fadeInDown">Create Account</h4>
                                <p class="text-muted">Join us today and experience the difference</p>
                            </div>
                            
                            <form action="{{ route('account.processRegister') }}" method="post">
                                @csrf
                                <div class="row gy-3">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="name">
                                            <label for="name">Full Name</label>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com">
                                            <label for="email">Email Address</label>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                                            <label for="password">Password</label>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="confirm_password" placeholder="Confirm Password">
                                            <label for="confirm_password">Confirm Password</label>
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit">
                                            Create Account
                                        </button>
                                    </div>
                                </div>
                            </form>
                            
                            <!-- <div class="mt-4 text-center">
                                <p class="mb-0">Or sign up with</p>
                                <div class="social-login">
                                    <a href="#" class="social-btn">
                                        <img src="/api/placeholder/20/20" alt="Google" width="20">
                                    </a>
                                    <a href="#" class="social-btn">
                                        <img src="/api/placeholder/20/20" alt="Facebook" width="20">
                                    </a>
                                    <a href="#" class="social-btn">
                                        <img src="/api/placeholder/20/20" alt="Apple" width="20">
                                    </a>
                                </div>
                            </div> -->

                            <hr>
                            
                            <div class="text-center">
                                <p class="mb-0">Already have an account?</p>
                                <a href="{{ route('account.login') }}" class="link-secondary text-decoration-none">
                                    LogIn in here
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>