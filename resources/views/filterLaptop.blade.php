<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"/>

<title>Filter Laptop</title>
    <style>
        /* table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        } */
    </style>
</head>
<body>
    
    <form action="{{route('filter.submit')}}" method="post">
    {{@csrf_field()}}

    <center>
        <br><h3>Filter Laptop</h3><br>
        <table class="table" style="width: 700px">
            <tr>
                <td>Laptop Brand:</td>
                <td colspan="2">
                    <select name="laptop_brand">
                        <option value="0">Select Laptop Brand Here</option>
                        @foreach($laptop_brands as $laptop_brand)
                            <option value="{{$laptop_brand->id}}">{{$laptop_brand->l_brand}}</option>
                        @endforeach
                    </select>
                </td>

            </tr>  
            <tr>    

                <td>Processor:</td>
                <td>
                    <select name="processor_brand">
                        <option value="0">Select Processor Here</option>
                        @foreach($processor_brands as $processor_brand)
                            <option value="{{$processor_brand->id}}">{{$processor_brand->p_brand}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="processor_model">
                        <option value="0">Select Processor Specification (Advanced)</option>
                        @foreach($processor_models as $processor_model)
                            <option value="{{$processor_model->id}}">{{$processor_model->p_brand .' '. $processor_model->p_model}}</option>
                        @endforeach
                    </select>
                </td>

            </tr>  
            <tr>     

                <td>RAM:</td>
                <td colspan="2">
                <input type="checkbox" name="ram[]" value="4">4GB &emsp;
                <input type="checkbox" name="ram[]" value="8">8GB &emsp;
                <input type="checkbox" name="ram[]" value="16">16GB &emsp;
                <input type="checkbox" name="ram[]" value="32">32GB &emsp;
                </td>

            </tr>  
            <tr>     

                <td>Storage:</td>
                <td colspan="2">
                    <input type="radio" name="storage" value="none" checked>No Choice &emsp;
                    <input type="radio" name="storage" value="ssd">Only SSD &emsp;
                    <input type="radio" name="storage" value="hdd">Only HDD &emsp;
                    <input type="radio" name="storage" value="both">Both SSD & HDD &emsp;
                </td>

            </tr>    
            <tr>    
                          
                <td>Graphics:</td>
                <td>
                    <select name="gpu">
                        <option value="0">Select Graphics Here</option>
                        @foreach($gpu_models as $gpu_model)
                            <option value="{{$gpu_model->id}}">{{$gpu_model->g_brand .' '. $gpu_model->g_model}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="gpu_memory">
                        <option value="0">Select Graphics Specification (Advanced)</option>
                        @foreach($gpu_memories as $gpu_memory)
                            <option value="{{$gpu_memory->id}}">{{$gpu_memory->g_memory}}</option>
                        @endforeach
                    </select>
                </td>

            </tr>     
            <tr>    
                          
                <td>Display:</td>
                <td>
                    <select name="disp_size">
                        <option value="0">Select Display Size Here</option>

                        <option value="12.3">12.3"</option>
                        <option value="13.1">13.3"</option>
                        <option value="14">14"</option>
                        <option value="15.6">15.6"</option>
                        <option value="16.2">16.2"</option>
                    </select>
                </td>
                <td>
                    <select name="disp_quality">
                        <option value="0">Select Display Quality</option>
                        
                        <option value="FHD">FHD</option>
                        <option value="UHD">UHD</option>
                        <option value="IPS">IPS</option>
                    </select>
                </td>

            </tr>      
            <tr>    
                          
                <td>Price Range:</td>
                <td>
                    <input type="number" name="min_price" placeHolder="Lowest Price">
                </td>
                <td>
                    - &emsp;
                    <input type="number" name="max_price" placeHolder="Maximum Price">
                </td>

            </tr>     
        </table>
        <input class="btn btn-primary" type="submit" value="Submit">
    </center>
    </form>
</body>
</html>