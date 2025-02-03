<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Payment Settings</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .container {
            max-width: 700px;
            margin-top: 30px;
        }
        .payment-card {
            background: linear-gradient(135deg, #ffffff 0%, #f1f3f5 100%);
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 20px;
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
        .qr-image {
            max-width: 200px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .qr-image:hover {
            transform: scale(1.05);
        }
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            width: 100%;
            padding: 10px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container position-relative">
        <a href="{{ route('admin.dashboard') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
        </a>

        <h2 class="mb-4 text-primary text-center">Admin Payment Settings</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($paymentDetails)
            <div class="payment-card text-center">
                <h4 class="mb-4">Current Payment Details</h4>
                @if($paymentDetails->qrpic)
                    <img src="{{ asset('storage/' . $paymentDetails->qrpic) }}" alt="QR Code" class="img-fluid mb-3 qr-image" width="200">
                @endif

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <strong>UPI ID:</strong> {{ $paymentDetails->upi_id }}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Bank Name:</strong> {{ $paymentDetails->bank_name }}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Account Number:</strong> {{ $paymentDetails->account_number }}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>IFSC Code:</strong> {{ $paymentDetails->ifsc_code }}
                    </div>
                </div>
            </div>
        @else
            <p class="alert alert-warning text-center">No payment details found. Please add new details.</p>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.savePaymentDetails') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="qrpic" class="form-label">QR Code Image</label>
                        <input type="file" class="form-control" id="qrpic" name="qrpic">
                    </div>

                    <div class="mb-3">
                        <label for="upi_id" class="form-label">UPI ID</label>
                        <input type="text" class="form-control" id="upi_id" name="upi_id" value="{{ $paymentDetails->upi_id ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="bank_name" class="form-label">Bank Name</label>
                        <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{ $paymentDetails->bank_name ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="account_number" class="form-label">Account Number</label>
                        <input type="text" class="form-control" id="account_number" name="account_number" value="{{ $paymentDetails->account_number ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="ifsc_code" class="form-label">IFSC Code</label>
                        <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" value="{{ $paymentDetails->ifsc_code ?? '' }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Payment Details</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Font Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</body>
</html>