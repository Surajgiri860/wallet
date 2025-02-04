<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>True Wallet</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
      <style>
         body {
            background-color: #f4f6f9;
            overflow-x: hidden;
         }
         .back-btn {
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: #6c757d;
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
         }
         .back-btn:hover {
            background-color: #495057;
         }
         .banner-container {
            background: linear-gradient(135deg, #ffffff 0%, #f1f3f5 100%);
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 20px;
         }
         .banner-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 15px 15px 0 0;
            transition: transform 0.3s ease;
         }
         .banner-image:hover {
            transform: scale(1.05);
         }
         .user-card {
            background: linear-gradient(135deg, #ffffff 0%, #f1f3f5 100%);
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 30px;
            text-align: center;
            margin-bottom: 20px;
         }
         .balance {
            background-color: #007bff;
            color: white;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 10px;
            margin: 15px 0;
            font-size: 22px;
         }
         .custom-box {
            display: block;
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 15px;
         }
         .custom-box:hover {
            background-color: #0056b3;
            transform: translateY(-5px);
         }
         @media (max-width: 768px) {
            .banner-image {
               height: 200px;
            }
         }
      </style>
   </head>
   <body>
      <div class="position-relative">
         <a href="#" class="back-btn">
            <i class="fas fa-arrow-left"></i>
         </a>

         <nav class="navbar navbar-expand-md bg-white shadow-lg container-fluid">
            <div class="container">
               <a class="navbar-brand" href="#"><strong>True Wallet</strong></a>
               <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
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
                              <li><a class="dropdown-item" href="{{ route('account.deposit') }}">Deposit ></a></li>
                              <li><a class="dropdown-item" href="{{ route('withdraw.page') }}">Withdraw ></a></li>
                              <li><a class="dropdown-item" href="{{ route('account.logout') }}">Logout</a></li>
                           </ul>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </nav>

         <div class="container mt-3">
            @php
               $banner = \App\Models\Banner::first();
            @endphp
            
            @if($banner)
               <div class="banner-container">
                  @if($banner->image)

                 
                     <img src=" {{ asset('storage/' . $banner->image) }}" class="banner-image mb-2" alt="Banner Image">
                  @endif
                  <div class="p-3">
                     @if($banner->title)
                        <h3 class="text-primary">{{ $banner->title }}</h3>
                     @endif
                     @if($banner->content)
                        <p class="text-muted">{{ $banner->content }}</p>
                     @endif
                  </div>
               </div>
            @endif
         </div>

         <div class="container">
            <div class="user-card">
               <h2 class="text-primary mb-4">Personal Details</h2>
               <p class="mb-2"><strong>Name:</strong> {{ $user->name }}</p>
               <p class="mb-2"><strong>Email:</strong> {{ $user->email }}</p>
               <p class="mb-2"><strong>Registered Since:</strong> {{ Auth::user()->created_at->format('M d, Y') }}</p>
               <div class="balance">
                  <strong>Balance:</strong> ₹{{ $user->total_bal }}
               </div>
               <a href="{{ route('user.payment') }}" class="btn btn-outline-primary mt-3">Add Payment Details</a>
            </div>

            <div class="row">
               <div class="col-md-6">
                  <a href="{{ route('account.deposit') }}" class="custom-box">
                     <i class="fas fa-arrow-down me-2"></i>Deposit
                  </a>
               </div>
               <div class="col-md-6">
                  <a href="{{ route('withdraw.page') }}" class="custom-box">
                     <i class="fas fa-arrow-up me-2"></i>Withdraw
                  </a>
               </div>
            </div>
         </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   </body>
</html>