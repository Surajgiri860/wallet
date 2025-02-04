<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Payment Settings</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
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
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
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
        }

        .container {
            max-width: 900px;
            padding: 0 15px;
        }

        .payment-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }

        .payment-card:hover {
            transform: translateY(-5px);
        }

        .payment-card h4 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .qr-image {
            max-width: 200px;
            margin: 0 auto;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .btn-danger {
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }

        .card-body {
            padding: 2rem;
        }

        .form-control {
            border: 1px solid #e0e0e0;
            padding: 0.7rem;
            border-radius: 7px;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .alert {
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="{{ route('admin.dashboard') }}" class="back-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Back
        </a>
        <h2>Admin Payment Settings</h2>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Show All Payment Accounts -->
        @if(count($paymentDetails) > 0)
            @foreach($paymentDetails as $payment)
                <div class="payment-card text-center">
                    <h4>Payment Account</h4>
                    @if($payment->qrpic)
                        <img src="{{ asset('storage/' . $payment->qrpic) }}" alt="QR Code" class="img-fluid mb-3 qr-image">
                    @endif
                    <div class="mb-4">
                        <strong>UPI ID:</strong> {{ $payment->upi_id }} <br>
                        <strong>Bank Name:</strong> {{ $payment->bank_name }} <br>
                        <strong>Account Number:</strong> {{ $payment->account_number }} <br>
                        <strong>IFSC Code:</strong> {{ $payment->ifsc_code }}
                    </div>

                    <form action="{{ route('admin.deletePaymentDetails', $payment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this payment method?');">
                            Delete Payment Method
                        </button>
                    </form>
                </div>
            @endforeach
        @else
            <p class="alert alert-warning text-center">No payment details found. Please add new details.</p>
        @endif

        <!-- Form to Add New Payment Details -->
        <div class="card mt-4">
            <div class="card-body">
                <h4 class="text-center mb-4">Add New Payment Details</h4>
                <form action="{{ route('admin.savePaymentDetails') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="qrpic" class="form-label">QR Code Image</label>
                        <input type="file" class="form-control" id="qrpic" name="qrpic">
                    </div>

                    <div class="mb-3">
                        <label for="upi_id" class="form-label">UPI ID</label>
                        <input type="text" class="form-control" id="upi_id" name="upi_id" required>
                    </div>

                    <div class="mb-3">
                        <label for="bank_name" class="form-label">Bank Name</label>
                        <input type="text" class="form-control" id="bank_name" name="bank_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="account_number" class="form-label">Account Number</label>
                        <input type="text" class="form-control" id="account_number" name="account_number" required>
                    </div>

                    <div class="mb-3">
                        <label for="ifsc_code" class="form-label">IFSC Code</label>
                        <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Payment Details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>