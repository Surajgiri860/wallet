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
        .payment-card {
            background: linear-gradient(135deg, #ffffff 0%, #f1f3f5 100%);
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 30px;
            max-width: 500px;
            margin: 50px auto;
            transition: transform 0.3s ease;
        }
        .payment-card:hover {
            transform: scale(1.02);
        }
        .payment-title {
            color: #007bff;
            margin-bottom: 25px;
            text-align: center;
            font-weight: 600;
        }
        .payment-detail {
            background-color: #e9ecef;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .detail-label {
            font-weight: 600;
            color: #495057;
            margin-right: 10px;
        }
        .detail-value {
            color: #212529;
            text-align: right;
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
    </style>
</head>
<body>
    <div class="container position-relative">
        <div class="payment-card">
            <a href="{{ route('admin.dashboard') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="payment-title">{{ $user->name }}'s Payment Details</h2>
            
            <div class="payment-detail">
                <span class="detail-label">Account Number</span>
                <span class="detail-value">{{ $paymentDetails->account_number }}</span>
            </div>
            
            <div class="payment-detail">
                <span class="detail-label">IFSC Code</span>
                <span class="detail-value">{{ $paymentDetails->ifsc_code }}</span>
            </div>
            
            <div class="payment-detail">
                <span class="detail-label">Bank Name</span>
                <span class="detail-value">{{ $paymentDetails->bank_name }}</span>
            </div>
            
            <div class="payment-detail">
                <span class="detail-label">UPI ID</span>
                <span class="detail-value">{{ $paymentDetails->upi_id ?? 'N/A' }}</span>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Font Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</body>
</html>