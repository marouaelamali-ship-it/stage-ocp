<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">

    <style>

        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #071120;
            color: white;
        }

        h1 {
            color: #071120;
        }

    </style>

</head>

<body>

    <h1>
        Rapport des Maintenances
    </h1>

    <table>

        <thead>

            <tr>

                <th>ID</th>
                <th>Équipement</th>
                <th>Status</th>
                <th>Date</th>

            </tr>

        </thead>

        <tbody>

            @foreach($maintenances as $m)

            <tr>

                <td>{{ $m->id }}</td>

                <td>
                    Equipment {{ $m->equipment_id }}
                </td>

                <td>{{ $m->status }}</td>

                <td>{{ $m->created_at }}</td>

            </tr>

            @endforeach

        </tbody>

    </table>

</body>
</html>