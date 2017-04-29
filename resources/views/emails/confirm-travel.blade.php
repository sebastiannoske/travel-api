<!DOCTYPE html>

<html>

    <head>

        <title>Travel Confirmation</title>

    </head>

    <body>

        <h1>Eine neue Fahrt wurde angelegt, {{ $user->name }}!</h1>

        <p>

            Du musst nur noch <a href='{{ url("travel/confirm/{$travel->token}") }}'>deine angelegte Fahrt bestätigen</a> um diese im Portal zu aktivieren.

        </p>

    </body>

</html>
