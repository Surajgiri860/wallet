<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Deposit Fee</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
        }
    </style>
</head>
<body>
    <a href="javascript:history.back()" class="btn btn-secondary back-btn">&larr; Back</a>

    <div class="card p-4" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4">Manage Deposit Fee</h2>

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('update.fee') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Current Deposit Fee:</label>
                <strong>{{ $feePercentage }}%</strong>
            </div>

            <div class="mb-3">
                <label for="deposit_fee" class="form-label">Update Deposit Fee (%)</label>
                <input type="number" name="deposit_fee" id="deposit_fee" 
                       class="form-control" value="{{ $feePercentage }}" 
                       min="0" max="100" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Update Fee</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
