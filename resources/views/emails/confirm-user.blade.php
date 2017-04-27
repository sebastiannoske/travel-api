<!DOCTYPE html>

<html>

<head>

    <title>Sign Up Confirmation</title>

</head>

<body>

<h1>Welcome zum Reiseportal, {{ $user->name }}!</h1>

<p>

    Du musst nur noch <a href='{{ url("register/confirm/{$user->token}") }}'>deine E-Mail Adresse bestätigen</a> um das Portal nutzen zu können.

</p>

</body>

</html>