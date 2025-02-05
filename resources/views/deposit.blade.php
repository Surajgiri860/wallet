<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Money</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .container {
            max-width: 800px;
            margin-top: 30px;
        }
        .qr-section {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        .qr-section img {
            max-width: 250px;
            margin: 0 auto;
            border-radius: 10px;
        }
        .payment-details {
            background-color: #e9ecef;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .deposit-form .card {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .deposit-form .form-label {
            font-weight: 600;
            color: #495057;
        }
        .deposit-form .btn-primary {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
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
        .table-responsive {
            border-radius: 15px;
            overflow: hidden;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table-image {
            max-width: 50px;
            max-height: 50px;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .table-image:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="container position-relative">
        <a href="{{ route('account.dashboard')}}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
        </a>
        
        <h2 class="mb-4 text-primary text-center">Add Money</h2>

        <p class="text-center">Scan the provided QR code to make a payment and fill in the required details.</p>

        @if($paymentDetails->count() > 0)
    @foreach($paymentDetails as $payment)
        <div class="payment-card mb-4">
            @if($payment->qrpic)
                <img src="{{ asset('storage/' . $payment->qrpic) }}" alt="QR Code" class="img-fluid mb-3">
            @endif

            <div class="payment-details">
                <h5>UPI ID: {{ $payment->upi_id }}</h5>
                <h5>Bank Name: {{ $payment->bank_name }}</h5>
                <h5>Account Number: {{ $payment->account_number }}</h5>
                <h5>IFSC Code: {{ $payment->ifsc_code }}</h5>
            </div>
        </div>
    @endforeach
@else
    <p class="alert alert-warning text-center">No payment methods available.</p>
@endif





        @php
            $depositFee = \App\Models\Config::where('key', 'deposit_fee')->value('value') ?? 0;
        @endphp

        <div class="alert alert-info mt-3 text-center">
            <strong>Note:</strong> A deposit fee of <strong>{{ $depositFee }}%</strong> will be deducted from your deposit amount.
        </div>

        <div class="deposit-form">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('request.transaction') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="type" value="1">

                        <div class="mb-3">
                            <label for="request_amount" class="form-label">Request Amount:</label>
                            <input type="number" class="form-control" name="request_amount" id="request_amount" required>
                        </div>

                        <div class="mb-3">
                            <label for="utr_number" class="form-label">UTR Number (Optional):</label>
                            <input type="text" class="form-control" name="utr_number" id="utr_number">
                        </div>

                        <div class="mb-3">
                            <label for="screenshot" class="form-label">Upload Screenshot:</label>
                            <input type="file" name="screenshot" id="screenshot" class="form-control" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Request</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="cart-wrapper-area py-3">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>UTR Number</th>
                                <th>Deposit Amount</th>
                                <th>Request Status</th>
                                <th>Screenshot</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                                @if($request->type == 1)
                                    <tr>
                                        <td>{{ $request->utr_number }}</td>
                                        <td>{{ $request->request_amount }}</td>
                                        <td>{{ ucfirst($request->request_status) }}</td>
                                        <td>
                                            @if($request->screenshot)
                                                <a href="{{ asset('storage/' . $request->screenshot) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $request->screenshot) }}" class="table-image" alt="Screenshot">
                                                </a>
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Font Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</body>
</html>