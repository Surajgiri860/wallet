<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
        }

        /* Header Styling */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border-radius: 8px 8px 0 0;
        }

        .header h2 {
            margin: 0;
            flex-grow: 1;
            text-align: center;
        }

        .back-button {
            text-decoration: none;
            color: white;
            font-size: 16px;
            background-color: #0056b3;
            padding: 8px 12px;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #003d80;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

    </style>
</head>
<body>

<div class="container">
    <!-- Header with Back Button -->
    <div class="header">
        <a href="javascript:history.back()" class="back-button">⬅ Back</a>
        <h2>Users List</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Balance</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ number_format($user->total_bal, 2) }}</td>
                    <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
