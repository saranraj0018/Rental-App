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
