<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdraw Money</title>
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
            <a href="http://13.51.239.115/account/dashboard" class="btn btn-link" style="color: black;">
                <i class="ti ti-arrow-left"></i> Back
            </a>
        </div>
        <!-- Page Title-->
        <div class="page-heading">
            <h6 class="mb-0">Withdraw Money</h6>
        </div>
    </div>
</div>

<br>

<!-- Withdraw Form -->
<div class="page-content-wrapper">
    <div class="container">
        <div class="card">
            <div class="card-body text-center">
                <h5 class="mb-1">Withdraw Money</h5>
                <p class="mb-4">Fill in the required details to request a withdrawal from your account. (Note: Please review all fields before submitting.)</p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="contact-form mt-3">
                <form action="{{ route('withdraw.request') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}"> <!-- User ID -->
                            <input type="hidden" name="type" value="2"> <!-- 2 for Withdraw -->

                            <label for="request_amount">Request Amount:</label>
                            <input type="number" name="request_amount" id="request_amount" required>

                            <button type="submit" class="btn btn-primary mt-3 w-100">Submit Request</button>
                        </form>

                        <script>
                            document.getElementById('request_amount').addEventListener('input', function() {
                                let userBalance = {{ Auth::user()->total_bal ?? 0 }}; // Fetch user's total balance
                                let enteredAmount = parseFloat(this.value);

                                if (enteredAmount > userBalance) {
                                    alert("You cannot withdraw more than your available balance (₹" + userBalance + ")");
                                    this.value = userBalance; // Reset to max allowable balance
                                }
                            });
                        </script>

                </div>
            </div>
        </div>
    </div>

    <!-- Withdraw Status -->
    <div class="container">
        <div class="cart-wrapper-area py-3">
            <div class="cart-table card mb-3">
                <div class="table-responsive card-body">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Request Amount</th>
                                <th>Request Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                                <tr>
                                    <td>{{ $request->request_amount }}</td>
                                    <td>{{ ucfirst($request->request_status) }}</td>
                                </tr>
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
