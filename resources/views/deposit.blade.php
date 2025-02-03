<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Money</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        /* Custom Styles */
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .header-area {
            background-color: #007bff;
            color: white;
            padding: 10px 0;
        }
        .header-area .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .page-heading h6 {
            font-size: 20px;
            margin: 0;
        }
        .page-content-wrapper {
            margin-top: 30px;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-body {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-body h5, .card-body p {
            color: #333;
        }
        .contact-form input[type="number"], .contact-form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .contact-form button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .contact-form button:hover {
            background-color: #0056b3;
        }
        .table th, .table td {
            padding: 15px;
            text-align: center;
        }
        .product-title {
            color: #007bff;
            text-decoration: none;
        }
        .product-title:hover {
            text-decoration: underline;
        }
        .table {
            background-color: #f9f9f9;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<!-- Header Area-->
<div class="header-area" id="headerArea">
    <div class="container h-100 d-flex align-items-center justify-content-between">
        <!-- Back Button-->
        <div class="back-button me-2">
            <a href="{{ route('account.dashboard') }}" class="btn btn-link" style="color: black;">
                <i class="ti ti-arrow-left"></i> Back
            </a>
        </div>
        <!-- Page Title-->
        <div class="page-heading">
            <h6 class="mb-0">Add Money</h6>
        </div>
        <!-- Navbar Toggler-->
        <div class="suha-navbar-toggler ms-2" data-bs-toggle="offcanvas" data-bs-target="#suhaOffcanvas" aria-controls="suhaOffcanvas">
            <div><span></span><span></span><span></span></div>
        </div>
    </div>
</div>


<div class="page-content-wrapper">
    <div class="container">
        <div class="card">
        <div class="card-body text-center">
    <h5 class="mb-1">Add Money</h5>
    <p class="mb-4">
        Scan the provided QR code to make a payment, and fill in the required details to add money to your account.  
        (Note: Please review all fields before saving.)
    </p>

    @if(isset($payment['qrpic']))
        <img src="{{ publicPath($payment['qrpic']) }}" alt="QR Code" class="img-fluid mb-3">
    @endif

    @if(isset($payment['upiId']))
        <h5 class="mb-1">UPI ID: {{ $payment['upiId'] }}</h5>
    @endif

    <!-- Fetch Deposit Fee from Config and Display -->
    @php
        $depositFee = \App\Models\Config::where('key', 'deposit_fee')->value('value') ?? 0;
    @endphp

    <div class="alert alert-info mt-3">
        <strong>Note:</strong> A deposit fee of <strong>{{ $depositFee }}%</strong> will be deducted from your deposit amount.
    </div>
</div>

        </div>

        <div class="card">
            <div class="card-body">
                <div class="contact-form mt-3">
                <form action="{{ route('request.transaction') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="type" value="1">

                        <label for="request_amount">Request Amount:</label>
                        <input type="number" name="request_amount" id="request_amount" required>

                        <label for="utr_number">UTR Number (Optional):</label>
                        <input type="text" name="utr_number" id="utr_number">

                        <!-- Screenshot Upload -->
                        <label for="screenshot">Upload Screenshot:</label>
                        <input type="file" name="screenshot" id="screenshot" class="form-control" accept="image/*">
                        <br>

                        <button type="submit">Submit Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Status -->
    <div class="container">
        <div class="cart-wrapper-area py-3">
            <div class="cart-table card mb-3">
                <div class="table-responsive card-body">
                    <table class="table mb-0">
                    <thead>
                    <tr>
                        <th>UTR Number</th>
                        <th>Deposit Amount</th>
                        <th>Request Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $request)
                        @if($request->type == 1) <!-- Only show deposit entries -->
                            <tr>
                                <td>{{ $request->utr_number }}</td>
                                <td>{{ $request->request_amount }}</td>
                                <td>{{ ucfirst($request->request_status) }}</td>
                                <td>
                                    @if($request->screenshot)
                                        <a href="{{ asset('storage/' . $request->screenshot) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $request->screenshot) }}" width="50" height="50" alt="Screenshot">
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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
