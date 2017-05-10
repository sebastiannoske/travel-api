@extends('layouts.app')

@section('content')

    <div class="container">

        @if (isset($travel) && count($travel))

            <?php $is_offer = $travel->offer; ?>

            <div class="row travel-details">

                <div class="col-md-6">

                    <div class="section-wrap">

                        <h5>Infos</h5>

                        <p><span>art:</span> <?php if ($is_offer) : echo 'Angebot'; else: echo 'Gesuch'; endif; ?></p>

                        <p><span>von:</span> {{$travel->street_address}}, {{$travel->postcode}}, {{$travel->city}}</p>

                        <p><span>nach:</span> {{$travel->destination->name}}</p>

                        <p><span>am:</span> {{ Carbon\Carbon::parse($travel->departure_time)->format('d.m.Y')}}</p>

                        <p><span>um:</span> {{ Carbon\Carbon::parse($travel->departure_time)->format('h:m')}} Uhr</p>

                        <p><span>wie:</span> {{$travel->transportation_mean->name}}</p>

                    </div>

                    <div class="section-wrap">

                        <h5>Beschreibung</h5>

                        <p>{{$travel->description}}</p>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="section-wrap wide">

                        <h5>Kontakt & Ansprechpartner</h5>

                        <p><span>Organisation:</span> {{$travel->contact->organisation}}</p>

                        <p><span>Kontakt:</span> {{$travel->contact->name}}</p>

                        <p><span>E-Mail:</span> <a href="mailto:{{$travel->contact->email}}">{{$travel->contact->email}}</a></p>

                        <p><span>Telefon:</span> <a href="tel:{{$travel->contact->phone_number}}">{{$travel->contact->phone_number}}</a></p>

                    </div>

                </div>

            </div>

        @else

            <h4>Entweder existiert diese Fahrt nicht oder du hast nicht das Recht, diese Fahrt zu sehen.</h4>

        @endif


    </div>

@endsection
