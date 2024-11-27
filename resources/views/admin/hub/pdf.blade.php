<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <main style="display: flex; justify-content: center; align-items: center">
        <table>
            <thead>
                <tr>
                    <th>Booking<br>Type</th>
                    <th>Risk</th>
                    <th>Done</th>
                    <th>Address</th>
                    <th>Booking ID</th>
                    <th>Reschedule</th>
                </tr>

            </thead>

            <tbody>
                @foreach ($dataset as $item)
                    <tr>
                        <td>{{ $item->booking_type }}</td>
                        <td>{{ $item->risk }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->booking_id }}</td>
                        <td>{{ $item->reschedule_date }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </main>
</body>

</html>
