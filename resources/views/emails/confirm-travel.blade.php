<!DOCTYPE html>

<html>

    <head>

        <title>Sign Up Confirmation</title>

    </head>

    <body>

        <h1>Eine neue Fahrt wurde angelegt, {{ $user->name }}!</h1>

        <p>

            Du musst nur noch <a href='{{ url("login") }}'>deine angelegte Fahrt bestätigen</a> um diese im Portal zu aktivieren.

        </p>

    </body>

</html>
