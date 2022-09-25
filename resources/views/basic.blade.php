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
    
    <form action="{{route('filter')}}" method="get">
    {{@csrf_field()}}

    <center>
        <br><h3>Basic Information</h3><br>
        <table class="table" style="width: 730px">
            <tr>
                <td>Name:</td>
                <td>
                    <input type="text" name="user_name" placeHolder="Enter Your Name" required>
                </td>
                <td width="30px"> </td>
                <td>
                    Age:
                </td>
                <td>
                    <input type="number" name="age" placeHolder="" style="width: 100px" required> years
                </td>

            </tr>  
            <tr>    

                <td>Gender:</td>
                <td>
                    <select name="gender" required>
                        <option value="0">Select Your Gender</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                    </select>
                </td>
                <td width="30px"> </td>
                <td>
                    Profession:
                </td>
                <td>
                    <select name="profession">
                        <option value="0">Select Your Profession</option>
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                            <option value="job">Job</option>
                            <option value="business">Business</option>
                    </select>
                </td>
            </tr>
            <tr>    

                <td>User Type:</td>
                <td>
                    <select name="type">
                        <option value="0">Select Purpose of Laptop</option>
                            <option value="1">General</option>
                            <option value="2">Study Work</option>
                            <option value="3">Official Work</option>
                            <option value="4">Gaming</option>
                            <option value="5">Graphics Design</option>
                            <option value="6">Video Editing</option>
                            <option value="7">View Movie</option>
                            <option value="8">Programming</option>
                    </select>
                </td>
                <td width="30px"> </td>
                <td>
                    Level:
                </td>
                <td>
                    <select name="level">
                        <option value="0">Select Level of Usage</option>
                            <option value="1">Low</option>
                            <option value="2">Medium</option>
                            <option value="3">High End</option>
                    </select>
                </td>
            </tr>
            
        </table>
        <input class="btn btn-primary" type="submit" value="Submit">
    </center>
    </form>
</body>
</html>