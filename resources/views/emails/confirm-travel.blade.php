<!DOCTYPE html>

<html>

    <head>

        <title>Travel Confirmation</title>

    </head>

    <body>

        <h2>{{$template->title}} {{ $user->name }}!</h2>

        <p>{!! nl2br(e($template->text)) !!}</p>

        <br/>

        <p>

            Du musst nur noch <a href='{{ url("travel/confirm/{$travel->token}") }}'>deine angelegte Fahrt bestätigen</a> um diese im Portal zu aktivieren.

        </p>

        <br/>

        <p>{!! nl2br(e($template->closing)) !!}</p>

    </body>

</html>
