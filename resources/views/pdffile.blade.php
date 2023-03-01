<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Qty</th>
            <th scope="col">Product Price</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($product as $key => $value)
                    <tr>
                        <th scope="row">{{ $value->id }}</th>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->qty }}</td>
                        <td>{{ $value->price }}</td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</body>
</html>