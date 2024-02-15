<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        h1 {
            font-family: 'Times New Roman', Times, serif;
            text-align: left;
            color: #333;
            margin-bottom: 20px;
            font-size: 15;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 14px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            text-align: center;
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        td[colspan="3"] {
            text-align: center;
            font-style: italic;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>

<body>
    <h1>Daftar List Pengguna</h1>
    <table>
        <tr>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
        </tr>
        @php
        $totalUsers = count($User);
        @endphp
        @forelse ($User as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->role }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3">Data Pengguna Tidak Ditemukan</td>
        </tr>
        @endforelse
        <tr>
            <td colspan="3">Jumlah pengguna: <strong>{{ $totalUsers }}</strong></td>
        </tr>
    </table>
</body>

</html>