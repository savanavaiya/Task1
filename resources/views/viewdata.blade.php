<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
    <script src="{{ asset('assets/js/price_range_script.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/price_range_style.css') }}" />
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
           <div class="col-6 mt-5">
                <input type="text" name="sername" id="sername" placeholder="Enter The Product Name">
            </div>
            <div class="col-6">
                <div>Price Range</div><br>
                <div id="slider-range" class="price-filter-range w-50 col-8" name="rangeInput"></div>
                <div style="margin:30px auto">
                    <input type="number" min=0 max="99000" oninput="validity.valid||(value='0');" id="min_price"
                        class="price-range-field" />
                    <input type="number" min=0 max="100000" oninput="validity.valid||(value='100000');"
                        id="max_price" class="price-range-field" />
                </div>
                <div id="searchResults" class="search-results-block"></div>
            </div>           
        </div>      
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="dropdown show col-6">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Export Excel
                </a>

                <a href="{{ route('dowpdf') }}" class="btn btn-primary">
                    Export
                </a>
              
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <div class="p-3">
                        <form action="{{ route('ex_sub') }}" method="POST">
                            @csrf
                            <table>
                                <tr>
                                    <th scope="col" class="">Select All</th>
                                    <th><input type="checkbox" name="selectall" id="selectAll"></th>
                                </tr>
                                    <input type="hidden" name="select[]" value="id">
                                <tr>
                                    <td>Product Name</td>
                                    <td><input type="checkbox" name="select[]" value="name" class="checkbox"></td>
                                </tr>
                                <tr>
                                    <td>Product Qty</td>
                                    <td><input type="checkbox" name="select[]" value="qty" class="checkbox"></td>
                                </tr>
                                <tr>
                                    <td>Product price</td>
                                    <td><input type="checkbox" name="select[]" value="price" class="checkbox"></td>
                                </tr>
                                <tr>
                                    <td>Product sku</td>
                                    <td><input type="checkbox" name="select[]" value="sku" class="checkbox"></td>
                                </tr>
                                <tr>
                                    <td>Product desc</td>
                                    <td><input type="checkbox" name="select[]" value="desc" class="checkbox"></td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="select[]" value="updated_at">
                                    <td colspan="2"><input type="submit" name="export" value="Export"></td>
                                </tr>
                            </table>
                        </form> 
                    </div>   
                </div>
            </div>
            <div class="col-6">
                <div class="float-right">
                    <a href="{{ route('addproduct') }}" class="btn btn-primary">Add Product</a>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="display-data">
        </div>
    </div>


    
 
    
    <script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/jquery-3.2.1.slim.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script>
        $(function() {

            $('#selectAll').click(function() {
                if ($(this).prop('checked')) {
                    // alert();
                    $('.checkbox').prop('checked', true);
                } else {
                    $('.checkbox').prop('checked', false);
                }
            });

        });
    </script>
    <script>
        function Delete(data){
            var id = $(data).attr('data-id');
            console.log(id);
            // alert();
            swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('deletedata') }}",
                    data: {
                        'id' : id,
                        "_token": "{{ csrf_token() }}",
                    },
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(response){
                        // alert(result.d);
                        console.log(response);
                        if(response==true){
                            location.reload();
                        }
                        
                    }
                });
            } else {
                swal("Your imaginary file is safe!");
            }
            });

            
        }
        

        // $("form#data").submit(function(e) {
        //     e.preventDefault();    
        //     // alert('savan');
        //     var formData = new FormData(this);

        //     $.ajax({
        //         url: "{{ route('sub_data') }}",
        //         type: 'POST',
        //         data: formData,
        //         success: function (data) {
        //             // alert(data)
        //             if(data.error){
        //                 alert(data.error);
        //                 // $('#savanerr').html(data.error);
        //             }else{
        //                 // alert('successfully');
        //                 location.reload();
        //             }
        //         },
        //         cache: false,
        //         contentType: false,
        //         processData: false
        //     });
        // });

    </script>

    <script>
        var name = ''; //this variable is work as global variable
        var min_price = null;
        var max_price = null;
        // var page_no = 1;
        var query = '';
        $(document).ready(function() {

            load_data(query);

            function load_data(query) {
                $.ajax({
                    url: "{{ route('product') }}?"+query,
                    method: 'GET',
                    data: {
                        sername: name,
                        min_price: min_price,
                        max_price: max_price
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        // alert();
                        $('.display-data').html(data.data);
                    }
                })
            }

            //Search name
            $(document).on('keyup', '#sername', function() {
                name = $(this).val(); // not put "var" before this variable...
                load_data(query);
            });
            $(document).on('click', '.pagination a',function(event){
                event.preventDefault();
                page=$(this).attr('href').split('page=')[1];
                query = 'page='+page;
                load_data(query);
            });

            //search Price 
            $("#slider-range").slider({
                range: true,
                orientation: "horizontal",
                min: 0,
                max: 100000,
                values: [0, 100000],
                step: 100,

                slide: function(event, ui) {
                    if (ui.values[0] == ui.values[1]) {
                        return false;
                    }
                    // alert('range slide');
                    $("#min_price").val(ui.values[0]);
                    $("#max_price").val(ui.values[1]);
                    min_price = ui.values[0];
                    // console.log(min_price);
                    max_price = ui.values[1];
                    // console.log(max_price);
                    load_data(query);

                }
            });

        });

    </script>
   
</body>
</html>