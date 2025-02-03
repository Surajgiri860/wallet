<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .container {
            max-width: 1200px;
            margin-top: 30px;
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
        .table {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table-bordered th, .table-bordered td {
            vertical-align: middle;
        }
        .btn-action {
            margin: 0 5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-action i {
            margin-right: 5px;
        }
        @media (max-width: 768px) {
            .table-responsive {
                font-size: 12px;
            }
            .btn-action {
                padding: 4px 8px;
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container position-relative">
        <a href="{{ route('admin.dashboard') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
        </a>

        <h2 class="mb-4 text-primary text-center">User List</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Total Balance</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>₹{{ $user->total_bal }}</td>
                            <td>
                                @if($user->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Blocked</span>
                                @endif
                            </td>
                            <td>
                                @if($user->status == 'active')
                                    <a href="{{ route('admin.blockUser', ['id' => $user->id]) }}" class="btn btn-warning btn-sm btn-action">
                                        <i class="fas fa-ban"></i>Block
                                    </a>
                                @else
                                    <a href="{{ route('admin.unblockUser', ['id' => $user->id ?? 0]) }}" class="btn btn-success btn-sm btn-action">
                                        <i class="fas fa-check"></i>Unblock
                                    </a>
                                @endif
                                <a href="{{ route('admin.deleteUser', ['id' => $user->id ?? 0]) }}" class="btn btn-danger btn-sm btn-action" 
                                   onclick="return confirm('Are you sure you want to delete this user?')">
                                    <i class="fas fa-trash"></i>Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>