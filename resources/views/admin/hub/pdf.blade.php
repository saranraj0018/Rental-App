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
                <tr>
                    <th>Booking ID</th>
                    <th>Date</th>
                    <th>Model Name</th>
                    <th>Address</th>
                    <th>Drivers License</th>
                    <th>Reschedule Date</th>
                    <th>Deposit Amount</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($dataset as $item)
                    <tr>
                        <td>{{ $item->booking_id }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->model_name }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->driving_licence }}</td>
                        <td>{{ $item->reschedule_date }}</td>
                        <td>{{ $item->dep_amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

</body>

</html>
