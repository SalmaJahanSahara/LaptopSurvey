<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"/>

<title>Basic Information</title>
    <style>
        /* table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        } */
    </style>
</head>
<body>

    

    <p align="right">Page 1 of 3 &emsp;&emsp;&emsp;</p>
    <br><br><br><br>
    
    <form action="{{ route('basic.submit') }}" method="post">
    <!-- <form action="{{route('filter')}}" method="get"> -->
    {{@csrf_field()}}

    <center>
        <br><h3>Basic Information</h3>

        <b style="color:red">* Required</b> &emsp; &emsp; &emsp;
        <b style="color:green"># Optional</b>
        <br><br>

        <table class="table table-borderless" style="width: 730px">
            <tr>
                <td><b style="color:red">* </b>Name:</td>
                <td>
                    <input type="text" name="user_name" placeHolder="Enter Your Name" style="width: 200px" value="{{old('user_name')}}">
                    
                    <br>
                    @if($errors->has('user_name'))
                        <span style="color:red;">{{ $errors->first('user_name') }}</span>                            
                    @else
                        <br>
                    @endif


                </td>
                <td width="30px"> </td>
                <td>
                    <b style="color:red">* </b>Age:
                </td>
                <td>
                    <input type="number" name="age" placeHolder="Age in Years" style="width: 130px" value="{{old('age')}}"> years
                    <br>@error('age')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                </td>

            </tr>  
            <tr>    

                <td><b style="color:red">* </b>Gender:</td>
                <td>
                    <select name="gender" style="width: 200px" selected="{{old('gender')}}">
                        <option value="">Select Your Gender</option>
                        <option value="M" {{ ( "M" == old('gender')) ? 'selected' : '' }}>Male</option>
                        <option value="F" {{ ( "F" == old('gender')) ? 'selected' : '' }}>Female</option>
                    </select>
                    
                    <br>
                    @if($errors->has('gender'))
                        <span style="color:red;">{{ $errors->first('gender') }}</span>                            
                    @else
                        <br>
                    @endif

                </td>
                <td width="30px"> </td>
                <td>
                    <b style="color:red">* </b>Profession:
                </td>
                <td>
                    <select name="profession">
                        <option value="">Select Your Profession</option>
                        <option value="student" {{ ( "student" == old('profession')) ? 'selected' : '' }}>Student</option>
                        <option value="teacher" {{ ( "teacher" == old('profession')) ? 'selected' : '' }}>Teacher</option>
                        <option value="job" {{ ( "job" == old('profession')) ? 'selected' : '' }}>Job</option>
                        <option value="business" {{ ( "business" == old('profession')) ? 'selected' : '' }}>Business</option>
                    </select>
                    <br>@error('profession')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                </td>
            </tr>
            <tr>    

                <td><b style="color:red">* </b>User Type:</td>
                <td>
                    <select name="type">
                        <option value="">Select Purpose of Laptop</option>
                            <option value="general" {{ ( "general" == old('type')) ? 'selected' : '' }}>General</option>
                            <option value="study_work" {{ ( "study_work" == old('type')) ? 'selected' : '' }}>Study Work</option>
                            <option value="official_work" {{ ( "official_work" == old('type')) ? 'selected' : '' }}>Official Work</option>
                            <option value="gaming" {{ ( "gaming" == old('type')) ? 'selected' : '' }}>Gaming</option>
                            <option value="graphics_design" {{ ( "graphics_design" == old('type')) ? 'selected' : '' }}>Graphics Design</option>
                            <option value="video_editing" {{ ( "video_editing" == old('type')) ? 'selected' : '' }}>Video Editing</option>
                            <option value="movie" {{ ( "movie" == old('type')) ? 'selected' : '' }}>Watch Movies</option>
                            <option value="programming" {{ ( "programming" == old('type')) ? 'selected' : '' }}>Programming</option>
                    </select>
                    
                    <br>
                    @if($errors->has('type'))
                        <span style="color:red;">{{ $errors->first('type') }}</span>                            
                    @else
                        <br>
                    @endif

                </td>
                <td width="30px"> </td>
                <td>
                    <b style="color:red">* </b>Level:
                </td>
                <td>
                    <select name="level" style="width: 180px">
                        <option value="">Select Level of Usage</option>
                            <option value="1" {{ ( "1" == old('level')) ? 'selected' : '' }}>Low</option>
                            <option value="2" {{ ( "2" == old('level')) ? 'selected' : '' }}>Medium</option>
                            <option value="3" {{ ( "3" == old('level')) ? 'selected' : '' }}>High End</option>
                    </select>
                    <br>@error('level')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                    
                </td>
            </tr>
            <tr>
                <td>
                    <b style="color:green"># </b>Note:
                </td>
                <td colspan="4">
                    <input type="text" name="note" placeHolder="Enter Any Note (Optional)" style="width:580px" value="{{old('note')}}">
                </td>
            </tr>
            
        </table>
        <input class="btn btn-primary" type="submit" value="Submit">
    </center>
    </form>
</body>
</html>