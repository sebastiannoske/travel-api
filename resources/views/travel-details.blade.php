@extends('layouts.app')

@section('content')

    <div class="container details-container">

        @if (isset($travel) && count($travel))

            <?php $is_offer = $travel->offer; ?>

            <h4>Detail- und Kontaktinformationen</h4>

            <div class="row travel-details">

                <div class="col-sm-6 col-sm-push-6">

                    <div class="section-wrap wide">

                        <h5>Kontakt & Ansprechpartner</h5>

                        <div class="row">

                            <div class="col-sm-3">

                                <p><span>Organisation:</span></p>

                            </div>

                            <div class="col-sm-9">

                                <p>@if ($travel->contact->organisation) {{$travel->contact->organisation}}  @else - @endif</p>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-3">

                                <p><span>Name:</span></p>

                            </div>

                            <div class="col-sm-9">

                                <p>{{$travel->contact->name}}</p>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-3">

                                <p><span>E-Mail:</span></p>

                            </div>

                            <div class="col-sm-9">

                                <p>@if ($travel->contact->email) <a href="mailto:{{$travel->contact->email}}"><?php echo str_replace( '@', '(at)', $travel->contact->email); ?></a>  @else - @endif</p>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-3">

                                <p><span>Telefon:</span></p>

                            </div>

                            <div class="col-sm-9">

                                <p>@if ($travel->contact->phone_number) <a href="tel:{{$travel->contact->phone_number}}">{{$travel->contact->phone_number}}</a>  @else - @endif</p>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-sm-6 col-sm-pull-6">

                    <div class="section-wrap">

                        <h5>Infos</h5>

                        <h6><?php if ($is_offer) : echo 'Angebot'; else: echo 'Gesuch'; endif; ?></h6>

                        <div class="row">

                            <div class="col-sm-3">

                                <p><span>Von:</span></p>

                            </div>

                            <div class="col-sm-9">

                                <p>{{$travel->street_address}}, {{$travel->postcode}}, {{$travel->city}}</p>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-3">

                                <p><span>Nach:</span></p>

                            </div>

                            <div class="col-sm-9">

                                <p>{{$travel->destination->name}}</p>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-3">

                                <p><span>Abfahrt:</span></p>

                            </div>

                            <div class="col-sm-9">

                                <p>@if ($travel->departure_time && count($travel->departure_time)) {{ Carbon\Carbon::parse($travel->departure_time)->format('d.m.Y, H:i')}} Uhr ( geplant )@else - @endif</p>

                            </div>

                        </div>

                        @if ($travel->transportation_mean_id === 2)

                            @if ($travel->stopover)

                                @foreach ( $travel->stopover as $stopover )


                                    <div class="row">

                                        <div class="col-sm-3">

                                            <p><span>über:</span></p>

                                        </div>

                                        <div class="col-sm-9">

                                            <p>{{$stopover->street_address}}, {{$stopover->postcode}} {{$stopover->city}}</p>

                                        </div>

                                    </div>

                                @endforeach

                            @endif

                        @endif

                        <div class="row">

                            <div class="col-sm-3">

                                <p><span>Womit:</span></p>

                            </div>

                            <div class="col-sm-9">

                                <p>{{$travel->transportation_mean->name}}</p>

                            </div>

                        </div>

                        @if (($is_offer && $travel->offer->passenger) || (!$is_offer && $travel->request->passenger))

                        <div class="row">

                            <div class="col-sm-3">

                                <p><span>Plätze:</span></p>

                            </div>

                            <div class="col-sm-9">

                               @if ($is_offer)

                                    <p>{{$travel->offer->passenger}}</p>

                                @else

                                    <p>{{$travel->request->passenger}}</p>

                                @endif

                            </div>

                        </div>

                        @endif

                        @if (($is_offer && $travel->offer->cost) || (!$is_offer && $travel->request->cost))

                            <div class="row">

                                <div class="col-sm-3">

                                    <p><span>Preis:</span></p>

                                </div>

                                <div class="col-sm-9">

                                    @if ($is_offer)

                                        <p>{{$travel->offer->cost}} ( pro Person )</p>

                                    @else

                                        <p>{{$travel->request->cost}} ( pro Person )</p>

                                    @endif

                                </div>

                            </div>

                        @endif

                    </div>

                    <div class="section-wrap">

                        <h5>Beschreibung</h5>

                        <p>{{$travel->description}}</p>

                    </div>

                </div>

            </div>

        @else

            <h5>Diese Fahrt existiert nicht oder wurde noch nicht freigegeben.</h5>

        @endif


    </div>

@endsection
