<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdraw Requests</title>
    <style>
        /* Header */
        .header-area {
            background-color: #007bff;
            color: white;
            padding: 10px 10px;
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

        /* Table */
        .card-body {
            padding: 1.5rem;
        }

        .table th, .table td {
            vertical-align: middle;
            text-align: center;
            padding: 0.75rem;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Button Styles */
        .btn-sm {
            font-size: 0.875rem;
            padding: 0.375rem 0.75rem;
        }

        /* Badge Styles */
        .badge {
            font-size: 0.875rem;
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
        }

        .table-responsive {
            overflow-x: auto;
        }

        /* Table Styles */
        .table {
            width: 100%;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .table-dark {
            background-color: #343a40;
            color: white;
        }

        /* Approval / Reject Button Styles */
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .table th, .table td {
                padding: 0.5rem;
            }
            .card-header, .card-footer {
                text-align: center;
            }
        }
        /* Custom button styles */
.btn-custom {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    background: linear-gradient(135deg, #007bff, #0056b3);
    border: none;
    border-radius: 8px;
    text-align: center;
    text-decoration: none;
    transition: all 0.3s ease-in-out;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
}

.btn-custom:hover {
    background: linear-gradient(135deg, #0056b3, #003d80);
    transform: scale(1.05);
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
}

.btn-custom:active {
    transform: scale(0.98);
    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.2);
}

    </style>
</head>
<body>

<!-- Header Area -->
<div class="header-area" id="headerArea">
    <div class="container h-100 d-flex align-items-center justify-content-between">
        <!-- Back Button -->
        <div class="back-button me-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-link" style="color: black;">
                <i class="ti ti-arrow-left"></i> Back
            </a>
        </div>
        <!-- Page Title -->
        <div class="page-heading">
            <h6 class="mb-0">Withdraw Requests</h6>
        </div>
        <!-- Navbar Toggler -->
        <div class="suha-navbar-toggler ms-2" data-bs-toggle="offcanvas" data-bs-target="#suhaOffcanvas" aria-controls="suhaOffcanvas">
            <div><span></span><span></span><span></span></div>
        </div>
    </div>
</div>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($withdrawRequests as $request)
                        <tr>
                            <td>{{ $request->id }}</td>
                            <td>{{ $request->user->name }}</td>

                            <td>{{ number_format($request->request_amount, 2) }}</td>
                            <td>
                                <span class="badge {{ $request->request_status == 'pending' ? 'bg-warning' : 'bg-success' }} text-dark">
                                    {{ ucfirst($request->request_status) }}
                                </span>
                            </td>
                            <td>
                                    @if($request->request_status === 'pending')
                                        <!-- Approve Button -->
                                        <form action="{{ route('admin.approveRequest', $request->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                        </form>

                                        <!-- Reject Button -->
                                        <form action="{{ route('admin.rejectRequest', $request->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                        </form>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($request->request_status) }}</span>
                                    @endif

                                    <!-- View Payment Details Button -->
                                    <a href="{{ route('admin.viewPaymentDetails', $request->user_id) }}" class="btn-custom">View Details</a>

                                </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
