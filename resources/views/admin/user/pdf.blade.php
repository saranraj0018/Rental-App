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
                    <th>Name</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Aadhaar Number</th>
                    <th>Driving Licence</th>
                    <th>Update At</th>
                </tr>

            </thead>

            <tbody>
                @foreach ($user as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->mobile }}</td>
                        <td>{{ $item->email ?? '' }}</td>
                        <td>{{ $item->aadhaar_number ?? '' }}</td>
                        <td>{{ $item->driving_licence ?? '' }}</td>
                        <td>{{ showDateTime($item->updated_at) }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </main>
</body>

</html>
