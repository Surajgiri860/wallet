<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>True Wallet:: Admin</title>
      <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
      <style>
         body {
            background: linear-gradient(135deg, #f4f7fc, #e2e8f0);
            font-family: 'Arial', sans-serif;
            overflow-x: hidden;
         }
         .navbar {
            background: linear-gradient(135deg,rgb(27, 96, 157),rgb(9, 63, 105));
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
         }
         /* .navbar a {
            color: #fff !important;
         } */
         .navbar-toggler {
            border: none;
         }
         .offcanvas-body {
            background: rgba(248, 249, 250, 0.9);
            backdrop-filter: blur(10px);
         }
         .card {
            border: none;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
         }
         .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
         }
         .card-header {
            background: linear-gradient(135deg, #2d5c7f, #1e3d58);
            color: #fff;
            border-radius: 15px 15px 0 0;
         }
         .card-body {
            background: transparent;
         }
         .card-body a {
           
            text-decoration: none;
            font-weight: 600;
         }
         .card-body a:hover {
            color: #f39c12;
         }
         .fw-semibold {
            font-weight: 600;
         }
         .text-success {
            color: #28a745;
         }
         .btn-primary {
            background: linear-gradient(135deg,rgb(62, 162, 238),rgb(83, 168, 243));
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            transition: transform 0.3s ease;
         }
         .btn-primary:hover {
            background: linear-gradient(135deg, #1e3d58, #2d5c7f);
            transform: scale(1.05);
         }
         .bsb-navbar-hover:hover {
            background: linear-gradient(135deg, #2d5c7f, #1e3d58);
         }
         .icon {
            font-size: 24px;
            margin-right: 10px;
            color: #2d5c7f;
         }
         .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
         }
         .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
         }
         .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
         }
         .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #555;
         }
         @media (max-width: 768px) {
            .navbar-brand {
               font-size: 1.2rem;
            }
            .card {
               margin-bottom: 15px;
            }
            .col-sm-7, .col-sm-5 {
               text-align: center !important;
            }
         }
      </style>
   </head>
   <body>
        <nav class="navbar navbar-expand-md bg-white shadow-lg bsb-navbar bsb-navbar-hover bsb-navbar-caret">
            <div class="container">
                <a class="navbar-brand" href="#">
                   <strong>True Wallet:: Admin</strong>
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
    <ul class="navbar-nav justify-content-end flex-grow-1 ">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Hello, {{ Auth::guard('admin')->user()->name }}
            </a>
            <ul class="dropdown-menu border-0 shadow bsb-zoomIn " aria-labelledby="accountDropdown" style="position: revert;">
                <li>
                    <a class="dropdown-item" href="{{ route('admin.changePassword') }}">
                        <i class="fas fa-key icon"></i> Change Password
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}">
                        <i class="fas fa-sign-out-alt icon"></i> Logout
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>

                </div>
            </div>
        </nav>
        <div class="container my-5">
           <div class="card border-0 shadow my-5">
                <div class="card-header bg-light">
                    <h3 class="h5 pt-2">Dashboard</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5>Total Balance of All Users:</h5>
                                <h5 class="text-success">₹{{ number_format($totalBalance, 2) }}</h5>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="text-center mt-3">
                                <a href="{{ route('admin.banner') }}" class="btn btn-primary"><i class="fas fa-image icon"></i>Add Banner</a>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-lg-12 col-md-12 order-1">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1"><i class="fas fa-users icon"></i>Users List (<small class="text-success fw-semibold">#</small>)</span>
                                <a href="{{ route('users.index') }}">View More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1"><i class="fas fa-coins icon"></i>Set Fee (<small class="text-success fw-semibold">#</small>)</span>
                                <a href="{{ route('fee.form') }}">View More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1"><i class="fas fa-money-bill-wave icon"></i>Deposit Request (<small class="text-success fw-semibold">View</small>)</span>
                                <a href="{{ route('admin.paymentRequests')}}">View More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1"><i class="fas fa-wallet icon"></i>Withdraw Request (<small class="text-success fw-semibold">View</small>)</span>
                                <a href="{{ route('admin.withdrawRequests')}}">View More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1"><i class="fas fa-cog icon"></i>Payment Settings (<small class="text-success fw-semibold">View</small>)</span>
                                <a href="{{ route('admin.paymentSettings') }}">View More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   </body>
</html>