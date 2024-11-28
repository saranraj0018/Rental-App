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

        td[colspan="8"] {
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
                    <th>Action</th>
                    <th>Block Type</th>
                    <th>Reason</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Car Register Number</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
            </thead>

            <tbody>
                @if (filled($dataset))
                    @foreach ($dataset as $item)
                        <tr>
                            <td>{{ $item->action }}</td>
                            <td>{{ block_type()[$item->block_type] ?? '' }}</td>
                            <td>{{ reason_type()[$item->reason] ?? '' }}</td>
                            <td>{{ $item->user->email ?? '' }}</td>
                            <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i A') }}</td>
                            <td>{{ $item->register_number }}</td>
                            <td>{{ Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }}</td>
                            <td>{{ Carbon\Carbon::parse($item->end_date)->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8">Record Not Found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </main>

</body>

</html>
