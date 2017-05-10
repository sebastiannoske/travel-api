@extends('layouts.app')

@section('content')

    <div class="container">

        @if (isset($travel) && count($travel))

            <?php $is_offer = $travel->offer; ?>

            <h4>Detail- und Kontaktinformationen</h4>

            <div class="row travel-details">

                <div class="col-md-6 col-md-push-6">

                    <div class="section-wrap wide">

                        <h5>Kontakt & Ansprechpartner</h5>

                        <div class="row">

                            <div class="col-md-3">

                                <p><span>Organisation:</span></p>

                            </div>

                            <div class="col-md-9">

                                <p>{{$travel->contact->organisation}}</p>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">

                                <p><span>Name:</span></p>

                            </div>

                            <div class="col-md-9">

                                <p>{{$travel->contact->name}}</p>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">

                                <p><span>E-Mail:</span></p>

                            </div>

                            <div class="col-md-9">

                                <p><a href="mailto:{{$travel->contact->email}}">{{$travel->contact->email}}</a></p>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">

                                <p><span>Telefon:</span></p>

                            </div>

                            <div class="col-md-9">

                                <p><a href="tel:{{$travel->contact->phone_number}}">{{$travel->contact->phone_number}}</a></p>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-6 col-md-pull-6">

                    <div class="section-wrap">

                        <h5>Infos</h5>

                        <h6><?php if ($is_offer) : echo 'Angebot'; else: echo 'Gesuch'; endif; ?></h6>

                        <div class="row">

                            <div class="col-md-3">

                                <p><span>Von:</span></p>

                            </div>

                            <div class="col-md-9">

                                <p>{{$travel->street_address}}, {{$travel->postcode}}, {{$travel->city}}</p>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">

                                <p><span>Nach:</span></p>

                            </div>

                            <div class="col-md-9">

                                <p>{{$travel->destination->name}}</p>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">

                                <p><span>geplante Abfahrt:</span></p>

                            </div>

                            <div class="col-md-9">

                                <p>{{ Carbon\Carbon::parse($travel->departure_time)->format('d.m.Y, h:m')}} Uhr</p>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">

                                <p><span>Verkehrsmittel:</span></p>

                            </div>

                            <div class="col-md-9">

                                <p>{{$travel->transportation_mean->name}}</p>

                            </div>

                        </div>

                    </div>

                    <div class="section-wrap">

                        <h5>Beschreibung</h5>

                        <p>{{$travel->description}}</p>

                    </div>

                </div>

            </div>

        @else

            <h4>Entweder existiert diese Fahrt nicht oder du hast nicht das Recht, diese Fahrt zu sehen.</h4>

        @endif


    </div>

@endsection
