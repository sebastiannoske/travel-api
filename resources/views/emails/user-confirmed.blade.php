<!DOCTYPE html>

<html>

    <head>

        <title>User Confirmed</title>

    </head>

    <body>

        <h2>{{$template->title}} {{ $user->name }}</h2>

        <p>{!! nl2br(e($template->text)) !!}</p>

        <br/>

        <p>Du kannst dich nun mit deiner E-Mailadresse und dem Password "{{ $pw }}" <a href='{{ url("login") }}'>hier</a> anmelden.</p>

        <br/>

        <p>{!! nl2br(e($template->closing)) !!}</p>

    </body>

</html>
