<!DOCTYPE html>

<html>

    <head>

        <title>Travel Confirmation</title>

    </head>

    <body>

        <h3>{{$template->title}}</h3>

        <p>{!! nl2br(e($template->text)) !!}</p>

        <br/>

        <p>

            <!-- <a href='{{ url("travel/confirm/{$travel->token}") }}'>Eintrag bestätigen</a> -->
            <a href="https://api2.lesscars.io/travel/confirm/{{$travel->token}}">Eintrag bestätigen</a>

        </p>

        <br/>

        <p>{!! nl2br(e($template->closing)) !!}</p>

    </body>

</html>
