<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .back-button {
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
        .back-button:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card position-relative">
                    <a href="{{ route('account.dashboard') }}" class="back-button">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    
                    <div class="card-body p-5">
                        <h2 class="card-title text-center mb-4 text-primary">Add Payment Details</h2>
                        
                        <!-- Success/Error Message -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <!-- Previous Payment Details -->
                        @if(isset($paymentDetails))
                            <div class="alert alert-info mb-4">
                                <h5 class="alert-heading">Saved Payment Details:</h5>
                                <hr>
                                <p class="mb-0"><strong>Account Number:</strong> {{ $paymentDetails->account_number }}</p>
                                <p class="mb-0"><strong>IFSC Code:</strong> {{ $paymentDetails->ifsc_code }}</p>
                                <p class="mb-0"><strong>Bank Name:</strong> {{ $paymentDetails->bank_name }}</p>
                                <p class="mb-0"><strong>UPI ID:</strong> {{ $paymentDetails->upi_id ?? 'Not Provided' }}</p>
                            </div>
                        @endif
                        
                        <!-- Payment Form -->
                        <form action="{{ route('user.savePaymentDetails') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="account_number" class="form-label">Account Number</label>
                                <input type="text" class="form-control" id="account_number" name="account_number" required>
                                <div class="invalid-feedback">Please enter a valid account number.</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="ifsc_code" class="form-label">IFSC Code</label>
                                <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" required>
                                <div class="invalid-feedback">Please enter a valid IFSC code.</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="bank_name" class="form-label">Bank Name</label>
                                <input type="text" class="form-control" id="bank_name" name="bank_name" required>
                                <div class="invalid-feedback">Please enter your bank name.</div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="upi_id" class="form-label">UPI ID (Optional)</label>
                                <input type="text" class="form-control" id="upi_id" name="upi_id">
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">Save Payment Details</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Font Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</body>
</html>