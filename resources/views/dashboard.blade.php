<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>True Wallet</title>
      <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
      <style>
         .custom-box {
            width: 100%;
            height: 90px; /* Adjust the height */
            background-color: #007bff; /* Blue color */
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            color: white;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            transition: 0.3s ease-in-out;
         }
         .custom-box:hover {
            background-color: #0056b3; /* Darker blue on hover */
         }
         .custom-box a {
            color: white;
            text-decoration: none;
         }

         .containers {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 2px solid #fff;
            border-radius: 10px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            font-weight: bold;
        }
        .user-info {
            margin: 10px 0;
            font-size: 18px;
        }
        .balance {
            font-size: 24px;
            font-weight: bold;
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #fff;
            display: inline-block;
            border-radius: 5px;
        }
      </style>
   </head>
   <body class="bg-light">
        <nav class="navbar navbar-expand-md bg-white shadow-lg">
            <div class="container">
                <a class="navbar-brand" href="http://127.0.0.1:8000/account/dashboard"><strong>True Wallet</strong></a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown">
                                    Hello, {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu border-0 shadow">
                                <li><a class="dropdown-item" href="http://127.0.0.1:8000/account/deposit">Deposit      ></a></li>
                                <li><a class="dropdown-item" href="http://127.0.0.1:8000/account/withdraw">Withdraw     ></a></li>
                                    <li><a class="dropdown-item" href="{{ route('account.logout') }}">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div>
        <div class="containers">
                    <h2>Personal Details</h2>
                    <p class="user-info"><strong>Name:</strong> {{ $user->name }}</p>
                    <p class="user-info"><strong>Email:</strong> {{ $user->email }}</p>
                    
                    <p class="mb-2"><strong>Registered Since:</strong> {{ Auth::user()->created_at->format('M d, Y') }}</p>
                    <p class="balance"><strong>Balance:</strong> ${{ $user->total_bal }}</p>

                </div>

        <div class="container mt-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <a href="{{ route('account.deposit') }}" class="custom-box">
                        Deposit
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('withdraw.page') }}" class="custom-box">
                        Withdraw
                    </a>
                </div>
            </div>
        </div>
        </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
   </body>
</html>
