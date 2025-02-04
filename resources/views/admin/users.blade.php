<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
            font-size: 1.5rem;
        }

        .container {
            max-width: 1000px;
            padding: 0 15px;
        }

        .table-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            margin-top: 2rem;
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
            color: #495057;
            font-weight: 600;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .btn-warning {
            background-color: #ffd43b;
            border: none;
            color: #000;
            padding: 0.5rem 1rem;
            border-radius: 7px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-warning:hover {
            background-color: #fcc419;
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: none;
        }

        .user-email {
            color: #6c757d;
            font-size: 0.95rem;
        }

        .user-name {
            font-weight: 500;
            color: #212529;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        @media (max-width: 768px) {
            .table-responsive {
                border-radius: 15px;
            }
            
            .header h2 {
                font-size: 1.3rem;
            }
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
        <h2>User Management</h2>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success fade-in">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="table-card fade-in">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <i class="fas fa-user me-2"></i>Name
                            </th>
                            <th>
                                <i class="fas fa-envelope me-2"></i>Email
                            </th>
                            <th>
                                <i class="fas fa-cog me-2"></i>Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <span class="user-name">{{ $user->name }}</span>
                                </td>
                                <td>
                                    <span class="user-email">{{ $user->email }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.showChangePasswordForm', $user->id) }}" class="btn btn-warning">
                                        <i class="fas fa-key me-2"></i>Change Password
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>