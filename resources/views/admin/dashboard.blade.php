<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>True Wallet:: admin</title>
      <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
      <style>
         body {
            background-color: #f4f7fc;
            font-family: 'Arial', sans-serif;
         }
         .navbar {
            background-color: #1e3d58;
         }
         .navbar a {
            
         }
         .navbar-toggler {
            border: none;
         }
         .offcanvas-body {
            background-color: #f8f9fa;
         }
         .card {
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
         }
         .card-header {
            background-color: #2d5c7f;
            
            border-radius: 10px 10px 0 0;
         }
         .card-body {
            background-color: #ffffff;
         }
         .card-body a {
            color: #1e3d58;
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
         .text-center img {
            max-width: 140px;
            border-radius: 50%;
         }
         .d-flex .col-sm-7 {
            text-align: left;
         }
         .d-flex .col-sm-5 {
            text-align: center;
         }
         .bsb-navbar-hover:hover {
            background-color: #2d5c7f;
         }
      </style>
   </head>
   <body>
        <nav class="navbar navbar-expand-md bg-white shadow-lg bsb-navbar bsb-navbar-hover bsb-navbar-caret">
            <div class="container">
                <a class="navbar-brand" href="#">
                   <strong >True Wallet:: Admin</strong>
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
                        <ul class="navbar-nav justify-content-end flex-grow-1">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#!" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Hello, {{ Auth::guard('admin')->user()->name }}</a>
                                <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="accountDropdown"> 
                                                             
                                    <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
                                    
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
                                <h5 class="card-title text-primary">Welcome Admin 🎉</h5>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                        <div class="text-center mt-3">
        <a href="{{ route('admin.banner') }}" class="btn btn-primary">Add Banner</a>
    </div>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-lg-12 col-md-12 order-1">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-6 mb-6">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Users  list(<small class="text-success fw-semibold">#</small>)</span>
                                <a href="{{ route('users.index') }}">View More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6 mb-6" style="margin-bottom: 10px;">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Set Fee (<small class="text-success fw-semibold">#</small>)</span>
                                <a href="{{ route('fee.form') }}">View More</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-12 col-md-12 order-1">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-6 mb-6">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Deposit Request (<small class="text-success fw-semibold">View</small>)</span>
                                <a href="{{ route('admin.paymentRequests')}}">View More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6 mb-6">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Withdraw Request (<small class="text-success fw-semibold">View</small>)</span>
                                <a href="{{ route('admin.withdrawRequests')}}">View More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6 mb-6">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Payment Settings (<small class="text-success fw-semibold">View</small>)</span>
                                <a href="{{ route('admin.paymentSettings') }}">View More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-6 mb-6" style="margin-bottom: 10px;">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Change Password (<small class="text-success fw-semibold">#</small>)</span>
                                <a href="{{ route('admin.users') }}">View More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   </body>
</html>
