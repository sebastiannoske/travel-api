@extends('layouts.app')

@section('content')

    <div class="container">

        @if (isset($travel) && count($travel))

            <?php $is_offer = $travel->offer; ?>

            <h4 style="text-align: center;"><?php if ($is_offer) : echo 'Angebot'; else: echo 'Gesuch'; endif; ?> / <span class="small">Fahrt nach</span> {{$travel->destination->name}}</h4>

            <div><span class="small">Erstellt: {{$travel->created_at->diffForHumans()}}</span></div>
            <div>Verkehrsmittel: {{$travel->transportation_mean->name}}</div><br/>

            <br/><br/>

            <h5>Abfahrt</h5>

            <p>{{$travel->city}}</p>

            <p>{{$travel->postcode}}</p>

            <p>{{$travel->street_address}}</p>

            <p>{{$travel->departure_time}}</p>

            <h5>Fahrt</h5>

            <p>{{$travel->description}}</p>

        @else

            <h4>Entweder existiert diese Fahrt nicht oder du hast nicht das Recht, diese Fahrt zu sehen.</h4>

        @endif


    </div>

@endsection
