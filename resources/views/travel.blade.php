@extends('layouts.app')

@section('content')

    <div class="container">

        @if (session()->has('message'))

            <h4>Ihr Eintrag ist nun veröffentlicht!</h4>

            <!-- <p><a href="http://www.wir-haben-es-satt.de/mfz">>>Hier geht’s zur Mitfahrbörse von Wir-haben-es-satt.de</a></p> -->

            <p><?php echo session('message')[0];?></p>

            <br/><br/><br/>

        @endif

        <ul class="nav nav-tabs">
            <li role="presentation" class="@if (!$kind) active @endif"><a href="{{ URL::action('PagesController@showTravel', $event_id) }}">Alle Fahrten</a></li>
            <li role="presentation" class="@if ($kind && $kind === 'offer') active @endif"><a href="{{ URL::action('PagesController@showTravel', [$event_id, 'kind=offer']) }}">Nur Angebote anzeigen</a></li>
            <li role="presentation" class="@if ($kind && $kind === 'request') active @endif"><a href="{{ URL::action('PagesController@showTravel', [$event_id, 'kind=request']) }}">Nur Gesuche anzeigen</a></li>
        </ul>

        @if (isset($travel) && count($travel))

            <div class="table-responsive" id="travel-wrap">

                <travel-component travel="{{ json_encode($travel) }}"></travel-component>

                {{ $travel->links() }}

            </div>

            @can ('edit_travel') <span style="padding:10px 0;">export <a href="{{ url('/exportxls') }}">.xls</a> / <a href="{{ url('/exportcsv') }}">.csv</a></span>@endcan

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
