<table>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Qty</th>
            <th scope="col">Product Price</th>
            <th scope="col">Product Image</th>
            <th scope="col">Product Sku</th>
            <th scope="col">Product Desc</th>
            <th scope="col" colspan="2">Operation</th>
          </tr>
        </thead>
        <tbody>
            @if ($total_row > 0)
                @foreach ($product as $key => $value)
                    <tr>
                        <th scope="row">{{ $value->id }}</th>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->qty }}</td>
                        <td>{{ $value->price }}</td>
                        <td>
                            @foreach ($value->img as $item)
                                <a href="{{ asset('image/'.$item->pro_image) }}" target="blank"><img src="{{ asset('image/'.$item->pro_image) }}" height="40px" width="60px"></a>
                            @endforeach
                        </td>
                        <td>
                            {{QrCode::size(100)->generate($value->sku);}}
                        </td>
                        <td>{{ $value->desc }}</td>
                        <td>
                            <button class="btn btn-danger" data-id="{{ $value->id }}" onclick="Delete(this)">Delete</button>
                        </td>
                        <td>
                            <a href="{{ route('editdata',$value->id) }}" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8"><h5><center>No Record Found</center></h5></td>
                </tr>
            @endif
        </tbody>
</table>
{{$product->links()}}


