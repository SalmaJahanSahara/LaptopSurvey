<!DOCTYPE html>
<html lang="en">
<head>
    <title>Insert Laptop</title>
</head>
<body>
    <form action="{{route('insert.submit')}}" method="post">
        {{@csrf_field()}}
        
        <table>
            <tr>
                <td>Laptop Brand:</td>
                <td>
                    <select name="brand">
                        <option value="0">Select Laptop Brand Here</option>
                        @foreach($laptop_brands as $laptop_brand)
                            <option value="{{$laptop_brand->l_brand}}">{{$laptop_brand->l_brand}}</option>
                        @endforeach
                    </select>
                </td>

            <tr>
            </tr>
                
                <td>Laptop Model:</td>
                <td>
                    <input type="text" name="model">
                </td>

            <tr>
            </tr>
                
                <td>Brand Name:</td>
                <td>
                    <select name="brand">
                        <option value="0">Select Laptop Brand Here</option>
                        @foreach($laptop_brands as $laptop_brand)
                            <option value="{{$laptop_brand->l_brand}}">{{$laptop_brand->l_brand}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>        
        </table>

    </form>
</body>
</html>