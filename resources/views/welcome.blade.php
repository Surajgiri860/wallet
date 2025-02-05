<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>True Wallet - Smart Digital Payments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #3b82f6;
            --text-dark: #1e293b;
            --text-light: #f8fafc;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link {
            color: var(--text-dark) !important;
            font-weight: 500;
            position: relative;
            padding: 0.5rem 1rem !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 1rem;
            right: 1rem;
            height: 2px;
            background: var(--primary-color);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .nav-link:hover::after {
            transform: scaleX(1);
        }

        .hero-section {
            padding: 8rem 0 4rem;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            max-width: 800px;
            text-align: center;
            color: white;
        }

        .hero-badge {
            background: rgba(255, 255, 255, 0.15);
            padding: 0.5rem 1.25rem;
            border-radius: 2rem;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .feature-card {
            background: white;
            border-radius: 1.5rem;
            padding: 2rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e2e8f0;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            border-radius: 1rem;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border-radius: 1.5rem;
            padding: 2rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .section-heading {
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .section-heading::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--primary-color);
            width: 60px;
            margin: 0 auto;
        }

        .btn-custom {
            padding: 0.75rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 6rem 0 2rem;
            }
            
            .hero-content h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <!-- <i class="fas fa-wallet"></i> -->
                TrueWallet
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('account.login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <div class="hero-content mx-auto">
                <div class="hero-badge animate__animated animate__fadeIn">
                    <span>New</span>
                    <i class="fas fa-bolt"></i>
                </div>
                <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInUp">
                    Smart Digital Payments Made Simple
                </h1>
                <p class="lead mb-5 animate__animated animate__fadeInUp animate__delay-1s">
                    Experience seamless transactions with India's most secure digital wallet
                </p>
                <div class="d-flex gap-3 justify-content-center animate__animated animate__fadeInUp animate__delay-2s">
                    <a href="{{ route('account.register') }}" class="btn btn-primary btn-custom">
                        Get Started
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="#features" class="btn btn-outline-light btn-custom">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-5">
        <div class="container py-5">
            <h2 class="section-heading text-center mb-5">Why Choose TrueWallet?</h2>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt fa-2x"></i>
                        </div>
                        <h3>Military-Grade Security</h3>
                        <p class="text-muted">Bank-level encryption and biometric authentication protect every transaction</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bolt fa-2x"></i>
                        </div>
                        <h3>Instant Transfers</h3>
                        <p class="text-muted">Send and receive money instantly across any bank or UPI ID</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-percentage fa-2x"></i>
                        </div>
                        <h3>Low Fees</h3>
                        <p class="text-muted">Only 5% transaction fees, no hidden charges</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-dark text-white py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <img src="{{ asset('images/logo.png') }}" alt="Mobile App" class="img-fluid rounded-3" style="width: 250px; height: 250px;">
            </div>
            <div class="col-lg-6">
                <h2 class="section-heading mb-4">All Your Financial Needs in One App</h2>
                <ul class="list-unstyled">
                    <li class="mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box bg-primary text-white">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div>
                                <h4 class="h5 mb-1"></h4>
                                <p class="text-white mb-0">Instant</p> <!-- Text color white -->
                            </div>
                        </div>
                    </li>
                    <!-- Add more features -->
                </ul>
            </div>
        </div>
    </div>
</section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add smooth scroll and intersection observer for animations
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>