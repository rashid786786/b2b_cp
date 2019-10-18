<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>

<body>
<h2>Hello {{$user['name']}}</h2>
<br/>
Please click on the below link to reset your password
<br/>
<a href="{{url('user/reset_password', $user->token)}}">Click here to reset your password</a>
</body>

</html>