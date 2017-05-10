<!DOCTYPE html>

<html>

    <head>

        <title>User Confirmed</title>

    </head>

    <body>

        <h3>{{$template->title}} {{ $user->name }}</h3>

        <p>{!! nl2br(e($template->text)) !!}</p>

        <br/>

        <p>

            Passwort: "{{ $pw }}"

            <br />
            <a href='{{ url("login") }}'>Jetzt einloggen</a>

        </p>

        <br/>

        <p>{!! nl2br(e($template->closing)) !!}</p>

    </body>

</html>
