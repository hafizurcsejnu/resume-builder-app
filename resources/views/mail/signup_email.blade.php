Hello {{$email_data['name']}},
<br><br>
Welcome to my website!
<br>
Please click the below link to verify your email and acitvate your account.
<br><br>
<a href="{{env('APP_URL')}}/verify?code={{$email_data['verification_code']}}">Click here</a>
<br><br>

Thank you!
<br>
MyResumeDash Team.
