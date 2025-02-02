<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to True Wallet - Your Digital Financial Partner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            scroll-behavior: smooth;
        }
        .navbar {
            background: linear-gradient(135deg, #1a237e 0%, #0d47a1 100%);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        .navbar-brand {
            font-size: 28px;
            font-weight: bold;
            background: linear-gradient(45deg, #fff, #e3f2fd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .nav-link {
            font-size: 18px;
            margin: 0 15px;
            transition: all 0.3s ease;
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: white;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .hero-section {
            background-image: url('/api/placeholder/1920/1080');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(42, 42, 46, 0.9) 0%, rgba(13,71,161,0.7) 100%);
        }
        element.style{
            background color:  rgba(7, 9, 13, 0.7);
        }
        .content {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 50px;
            border-radius: 30px;
            position: relative;
            max-width: 900px;
            text-align: center;
            color: white;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            border: 1px solid rgba(255,255,255,0.2);
        }
        .content h1 {
            font-size: 4rem;
            margin-bottom: 20px;
            font-weight: bold;
            /* text-shadow: 2px 2px 4px rgba(0,0,0,0.5); */
            background: linear-gradient(45deg, #ffffff, #e3f2fd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .content p {
            font-size: 1.5rem;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .btn-custom {
            padding: 15px 40px;
            font-size: 1.2rem;
            border-radius: 50px;
            transition: all 0.4s ease;
            margin: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }
        .btn-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: all 0.6s;
        }
        .btn-custom:hover::before {
            left: 100%;
        }
        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
        }
        .features-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f5f7fa 0%, #e3f2fd 100%);
        }
        .feature-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            margin: 20px 0;
            transition: all 0.4s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: 1px solid rgba(0,0,0,0.05);
            height: 100%;
        }
        .feature-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        .feature-icon {
            font-size: 56px;
            margin-bottom: 25px;
            background: linear-gradient(135deg, #1a237e, #0d47a1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .stats-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #1a237e 0%, #0d47a1 100%);
            color: white;
        }
        .stat-card {
            text-align: center;
            padding: 30px;
            background: rgba(255,255,255,0.1);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        .stat-card h4 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .about-section {
            padding: 100px 0;
            background: #ffffff;
        }
        .about-card {
            padding: 40px;
            border-radius: 20px;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin: 20px 0;
            border: 1px solid rgba(0,0,0,0.05);
        }
        .contact-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #f5f7fa 0%, #e3f2fd 100%);
        }
        .contact-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: 1px solid rgba(0,0,0,0.05);
        }
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            margin: 0 10px;
            transition: all 0.4s ease;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .social-links a:hover {
            background: white;
            color: #1a237e;
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <!-- Navbar remains same -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand animate__animated animate__fadeIn" href="#">True Wallet</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero-section">
        <div class="content animate__animated animate__fadeIn">
            <h1>Welcome to True Wallet</h1>
            <p>Revolutionizing Digital Payments Since 2025</p>
            <p>Experience the future of seamless, secure, and smart financial transactions</p>
            <div>
                <a href="{{ route('account.login') }}" class="btn btn-primary btn-custom">Login</a>
                <a href="{{ route('account.register') }}" class="btn btn-success btn-custom">Sign Up</a>
            </div>
        </div>
    </div>

    <section id="features" class="features-section">
        <div class="container">
            <h2 class="text-center mb-5">Why Choose True Wallet?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon">🔒</div>
                        <h3>Bank-Grade Security</h3>
                        <p>End-to-end encryption and multi-factor authentication to keep your money safe</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon">⚡</div>
                        <h3>Lightning Fast Transfers</h3>
                        <p>Instant money transfers across banks, wallets, and UPI with zero waiting time</p>
                    </div>
                </div>
                <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">💰</div>
                    <h3>5% Deposit Fees</h3>
                    <p>Add money to your wallet instantly with 5% deposit fees. Direct bank transfers, UPI, and cards accepted with no additional charges.</p>
                </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-card">
                        <h4>10M+</h4>
                        <p>Happy Users</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <h4>₹50B+</h4>
                        <p>Transaction Value</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <h4>99.9%</h4>
                        <p>Success Rate</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="about-card text-center">
                        <h2 class="mb-4">About True Wallet</h2>
                        <p class="lead mb-4">Established in 2020, True Wallet has rapidly emerged as India's most trusted digital payment platform. Our journey began with a simple mission: to make digital payments accessible, secure, and rewarding for everyone.</p>
                        <p class="mb-4">True Wallet is built on three core principles:</p>
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Innovation</h5>
                                <p>Leveraging cutting-edge technology to provide the best payment solutions</p>
                            </div>
                            <div class="col-md-4">
                                <h5>Security</h5>
                                <p>Implementing military-grade encryption to protect your transactions</p>
                            </div>
                            <div class="col-md-4">
                                <h5>Customer First</h5>
                                <p>24/7 customer support and continuous service improvements</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="contact-section">
        <div class="container text-center">
            <h2 class="mb-4">Get in Touch</h2>
            <p class="lead mb-4">Our dedicated support team is available 24/7 to assist you</p>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="contact-card">
                        <p>📧 Email: support@truewallet.com</p>
                        <p>📞 Toll-Free: 1800 TRUE WALLET (1800 8783 92553)</p>
                        <p>🏢 Headquarters: Cyber Hub, DLF Cyber City, Gurugram, India</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <h4>True Wallet</h4>
                    <p>Your digital future, our responsibility</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
                    <p class="mt-3">&copy; 2025 True Wallet. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>