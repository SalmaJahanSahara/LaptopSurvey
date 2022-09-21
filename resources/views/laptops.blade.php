<!DOCTYPE html>
<html lang="en">
<head>
    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"/>
    <title>Document</title>
</head>
<body>

<h1><center>Laptop List</center></h1>
@php $laptop_count=0; @endphp
<form action="" method="post">
    {{@csrf_field()}}

    <div class="container">
    <table class="table table-striped table-hover" id="allProducts">
        <tr>
            <th>Seial</th>
            <th>Product Name</th>
            <th>Processor</th>
            <th>Ram</th>
            <th>Storage</th>
            <th>Graphics</th>
            <th>Display</th>
            <th>Battery</th>
            <th>Price</th>
        </tr>
        @foreach($laptop_models as $laptop_model)
            <tr>
                <td>
                    <input type="checkbox" name="selected_laptops" value="{{$laptop_model->id}}">
                    {{$laptop_count = $loop->iteration}}
                </td>

                <td><a href="{{$laptop_model->url}}">{{$laptop_model->l_brand .' '. $laptop_model->model_name}}</a></td>
                <td>{{$laptop_model->p_brand .' '. $laptop_model->p_model .' '. $laptop_model->p_generation}}</td>
                <td>{{$laptop_model->ram}} GB</td>

                <td>
                    @if ($laptop_model->ssd > 0 && $laptop_model->hdd > 0)
                        {{$laptop_model->ssd}}GB SSD, {{$laptop_model->hdd}}GB HDD
                    @elseif ($laptop_model->ssd > 0)
                        {{$laptop_model->ssd}}GB SSD
                    @elseif ($laptop_model->hdd > 0)
                        {{$laptop_model->hdd}}GB HDD
                    @else
                        Data Not Found!
                    @endif
                </td>

                <td>{{$laptop_model->g_brand .' '. $laptop_model->g_model .' '. $laptop_model->g_memory}}</td>
                <td>{{$laptop_model->display_size .'" '. $laptop_model->display_quality}}</td>
                <td>{{$laptop_model->battery}} WHr</td>
                <td>{{$laptop_model->price}} taka</td>
            </tr>
        @endforeach
    </table>
    <h6 align="right">Showing {{$laptop_count}} laptops out of {{$total_laptop}}</h6>
    
    </div>
</form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#allProducts').DataTable();
    } );
</script>
    
</body>
</html>
