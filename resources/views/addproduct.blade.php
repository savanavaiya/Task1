<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container-fluid w-50">
        <span><b><center>Products</center></b></span><br><br>

        <form enctype="multipart/form-data" id="data">
            @csrf
            <input type="hidden" name="id" value="{{ isset($editData) ? $editData->id : '0' }}">
            <div class="form-group">
                <label for="exampleInputprname">Product Name</label>
                <input type="text" class="form-control" placeholder="enter the product name" name="name" value="{{ isset($editData) ? $editData->name : old('name') }}">
            </div>
            <div class="form-group">
                <label for="exampleInputqty">Product Qty</label>
                <input type="text" class="form-control" placeholder="enter the product qty" name="qty" value="{{ isset($editData) ? $editData->qty : old('qty') }}">
            </div>
            <div class="form-group">
                <label for="exampleInputprice">Product Price</label>
                <input type="text" class="form-control" placeholder="enter the product price" name="price" value="{{ isset($editData) ? $editData->price : old('price') }}">
            </div>
            <div class="form-group">
                <label for="exampleInputimg">Product Image</label>
                <input type="file" multiple name="image[]" class="form-control">
                @if (isset($editData))         
                    <br>     
                    <div class="row">
                    @foreach ($editData->img as $value)
                            <div class="col">
                                <img src="{{ asset('image/'.$value->pro_image) }}" height="100px" width="100px">
                                <a href="{{ route('delimg',$value->id) }}">Remove</a>
                            </div>
                    @endforeach
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="exampleInputsku">Product Sku</label>
                <input type="text" class="form-control" placeholder="enter the product sku" name="sku" value="{{ isset($editData) ? $editData->sku : old('sku') }}">
            </div>
            <div class="form-group">
                <label for="exampleInputdesc">Product Description</label>
                <input type="text" class="form-control" placeholder="enter the product description" name="desc" value="{{ isset($editData) ? $editData->desc : old('desc') }}">
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>

        <br><br>
        <a href="{{ route('index') }}">Back</a>
    </div>  

    {{-- <button >Savan</button> --}}

    <script src="{{ asset('assets/js/jquery-3.2.1.slim.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



    <script>

        $("form#data").submit(function(e) {
                    e.preventDefault();    
                    var formData = new FormData(this);
                    // alert('savan');
                    swal({
                        title: "Are you sure?",
                        text: "Submit You Data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        })
                        .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "{{ route('sub_data') }}",
                                type: 'POST',
                                data: formData,
                                success: function (data) {
                                    // alert(data)
                                    if(data.error){
                                        // alert(data.error);
                                        // $('#savanerr').html(data.error);
                                        swal("Fill The Field!", ""+data.error);
                                    }
                                    if(data == true){
                                        location.reload();
                                    }
                                    if(data == false){
                                        // alert('successfully edited');
                                        window.location.href = "/";
                                    }
                                },
                                cache: false,
                                contentType: false,
                                processData: false
                            });
                        } else {
                            swal("Your imaginary file is safe!");
                        }
                        });
                });

    </script>

    
</body>
</html>