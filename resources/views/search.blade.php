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
        <a href="{{ route('viewproduct') }}" class="btn btn-dark">Back</a>

        <div class="row mb-5">
            <div class="col-6 mt-5">
                <input type="text" name="sername" id="sername" placeholder="Enter The Product Name">
            </div>
            <div class="col-6">

                <div class="sliderText">Price Range</div>
                <div id="slider-range" class="price-filter-range w-50 col-8" name="rangeInput"></div>
                <div style="margin:30px auto">
                    <input type="number" min=0 max="99000" oninput="validity.valid||(value='0');" id="min_price"
                        class="price-range-field" />
                    <input type="number" min=0 max="100000" oninput="validity.valid||(value='100000');"
                        id="max_price" class="price-range-field" />
                </div>
                <div id="searchResults" class="search-results-block"></div>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Qty</th>
                        <th scope="col">Product Price</th>
                        <th scope="col">Product Sku</th>
                        <th scope="col">Product Desc</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>


        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/jquery-3.2.1.slim.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>

    <script></script>

    <script>
        var name = ''; //this variable is work as global variable
        var min_price = null;
        var max_price = null;
        $(document).ready(function() {

            load_data();

            function load_data() {
                $.ajax({
                    url: "{{ route('ser_sub') }}",
                    method: 'GET',
                    data: {
                        sername: name,
                        min_price: min_price,
                        max_price: max_price
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('tbody').html(data.table_data);
                    }
                })
            }

            //Search name
            $(document).on('keyup', '#sername', function() {
                name = $(this).val(); // not put "var" before this variable...
                load_data();


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
                    load_data();

                }
            });

        });

    </script>

</body>

</html>
