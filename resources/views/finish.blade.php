<br><br><br><br><br>
<center>
    <h2>{{ strtoupper(session()->get('user_name')) }}, you are really appreciated for your valuable response.</h2>
    {{ session()->flush(); }}
    <h3><a href="{{ route('basic') }}">Want to submit another response?</a><h3>
</center>