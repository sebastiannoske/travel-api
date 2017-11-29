@extends('layouts.app')

@section('content')

    <div class="container">

        @if (session()->has('message'))

            <h4>Ihr Eintrag ist nun veröffentlicht!</h4>

            <p><a href="http://www.wir-haben-es-satt.de/mfz">>>Hier geht’s zur Mitfahrbörse von Wir-haben-es-satt.de</a></p>

        
            <p><?php echo session('message')[0]; ?></p>

            <br/><br/><br/>

        @endif

        <div style="text-align: right;">

            <a href="{{ url('/users/create') }}" target="_self"><button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">Moderator anlegen</button></a>

        </div>

        <ul class="nav nav-tabs">
            <!-- <li role="presentation" class="@if (!$kind) active @endif"><a href="{{ URL::action('PagesController@index') }}">Alle Fahrten</a></li> -->
            <!-- <li role="presentation" class="@if ($kind && $kind === 'offer') active @endif"><a href="{{ URL::action('PagesController@index', ['kind=offer']) }}">Nur Angebote anzeigen</a></li>
            <li role="presentation" class="@if ($kind && $kind === 'request') active @endif"><a href="{{ URL::action('PagesController@index', ['kind=request']) }}">Nur Gesuche anzeigen</a></li> -->
        </ul>

        @if (isset($users) && count($users))

            <div class="table-responsive">

                <table class="table table-striped">

                    <thead>

                    <tr>

                        <th>Name</th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th>Ort</th>
                        <th>Anzahl Fahrten</th>
                        <th>Verifiziert?</th>
                        <th>Rolle</th>
                        <th></th>

                    </tr>

                    </thead>

                    <tbody>

                    @foreach ($users as $current_user)

                        <tr>

                            <td>{{$current_user->name}}</td>
                            <td>{{$current_user->email}}</td>
                            <td>{{$current_user->phone_number}}</td>
                            <td>{{$current_user->city}}</td>
                            <td>{{$current_user->travel->count()}}</td>
                            <td>
                                @if ($current_user->verified === 1) <img src="{{ URL::to('/') }}/img/checked.svg"/> @else <img src="{{ URL::to('/') }}/img/not-checked.svg"/> @endif
                            </td>
                            <td>{{$current_user->roles[0]->fullname}}</td>
                            <td><a href="{{ url('/users/edit', $current_user->id) }}" target="_self"><button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">editieren</button></a></td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

                {{ $users->links() }}

            </div>

        @else

            <h5>Du besitzt nicht die nötige Berechtigung diese Fahrt zu bearbeiten.</h5>

        @endif

    </div>

@endsection
