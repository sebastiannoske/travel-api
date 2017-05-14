@extends('layouts.app')

@section('content')

    <div class="container">

        @if (session()->has('message'))

            <h4>Ihr Eintrag ist nun veröffentlicht!</h4>

            <p><a href="https://www.g20-protestwelle.de/anreise/mfz">>>Hier geht’s zur Mitfahrbörse der G20-Protestwelle</a></p>

            <p><?php echo session('message')[0]; ?></p>

            <br/><br/><br/>

        @endif

        <ul class="nav nav-tabs">
            <li role="presentation" class="@if (!$kind) active @endif"><a href="{{ URL::action('PagesController@index') }}">Alle Fahrten</a></li>
            <li role="presentation" class="@if ($kind && $kind === 'offer') active @endif"><a href="{{ URL::action('PagesController@index', ['kind=offer']) }}">Nur Angebote anzeigen</a></li>
            <li role="presentation" class="@if ($kind && $kind === 'request') active @endif"><a href="{{ URL::action('PagesController@index', ['kind=request']) }}">Nur Gesuche anzeigen</a></li>
            @can ('edit_travel') <a style="float:right;padding:10px 0;" href="{{ url('/export') }}">csv exportieren</a> @endcan
        </ul>

        @if (isset($travel) && count($travel))

            <div class="table-responsive" id="travel-wrap">

                <travel-component travel="{{ json_encode($travel) }}"></travel-component>

                {{ $travel->links() }}

            </div>

            <script src="/js/travel.js"></script>

        @else

            @if ($kind)

                    <h5>Es existiert keine Fahrt zu deinem Profil oder der aktuellen Auswahl. ( @if ($kind === 'offer') Nur Angebote @elseif ($kind === 'request') Nur Gesuche @endif )</h5>

            @else

                    <h5>Es existiert keine Fahrt zu deinem Profil.</h5>

            @endif


        @endif

    </div>

@endsection
