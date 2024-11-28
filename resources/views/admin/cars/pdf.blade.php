<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #1a1a1a;
            color: #e1e1e1;
            margin: 0;
            padding: 15px;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding-top: 20px;
        }

        table {
            width: 100%;
            max-width: 1000px;
            border-collapse: collapse;
            margin: 10px 0;
            background-color: #2a2a2a;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 6px 10px;
            text-align: left;
            font-size: 10px;
            color: #d1d1d1;
        }

        th {
            background-color: #333;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        tr:nth-child(even) {
            background-color: #3a3a3a;
        }

        tr:hover {
            background-color: #444;
        }

        td {
            border-bottom: 1px solid #444;
        }

        td[colspan="7"] {
            text-align: center;
            color: #bbb;
            padding: 12px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table {
                width: 100%;
            }

            th,
            td {
                padding: 5px 8px;
            }
        }
    </style>
</head>

<body>

    <main>
        <table>
            <thead>
                @if ($type != 'models')
                    <tr>
                        <th>Action</th>
                        <th>Car Model ID</th>
                        <th>Car Model Name</th>
                        <th>Car Registration No.</th>
                        <th>Hub</th>
                        <th>Created By</th>
                        <th>Created At</th>
                    </tr>
                @else
                    <tr>
                        <th>Action</th>
                        <th>Car Model ID</th>
                        <th>Car Model Name</th>
                        <th>Created By</th>
                        <th>Created At</th>
                    </tr>
                @endif
            </thead>

            <tbody>
                @if ($type != 'models')
                    @foreach ($dataset as $item)
                        <tr>
                            <td>{{ $item?->action }}</td>
                            <td>{{ $item?->car_model_id }}</td>
                            <td>{{ $item?->model_name }}</td>
                            <td>{{ $item?->register_number }}</td>
                            <td>{{ $item?->carDetails?->city->name }}</td>
                            <td>{{ $item?->user?->email }}</td>
                            <td>{{ !$item?->created_at ? '' : Carbon\Carbon::parse($item?->created_at)->format('d-m-Y H:i A') }}
                            </td>
                        </tr>
                    @endforeach
                @else
                    @foreach ($dataset as $item)
                        <tr>
                            <td>{{ $item?->action }}</td>
                            <td>{{ $item?->car_model_id }}</td>
                            <td>{{ $item?->model_name }}</td>
                            <td>{{ $item?->user?->email }}</td>
                            <td>{{ !$item?->created_at ? '' : Carbon\Carbon::parse($item?->created_at)->format('d-m-Y H:i A') }}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </main>

</body>

</html>
