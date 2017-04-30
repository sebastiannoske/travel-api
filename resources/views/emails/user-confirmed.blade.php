<!DOCTYPE html>

<html>

<head>

    <title>User Confirmed</title>

</head>

<body>

<h1>Hallo, {{ $user->name }}</h1>

<p>Deine E-Mail Adresse wurde bestätigt. Du kanst dich nun mit deiner E-Mailadresse und dem Password {{ $pw }} unter <a href='{{ url("login") }}'>hier</a> anmelden.</p>

</body>

</html>
