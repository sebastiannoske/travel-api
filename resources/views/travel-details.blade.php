@extends('layouts.app')

@section('content')

    <div class="container details-container">

        @if (isset($travel) && count($travel))

            <?php $is_offer = $travel->offer; ?>

            <div class="row travel-details">

                <div class="col-sm-6 col-sm-push-6">

                    <br/><br/>

                    <div class="section-wrap">

                        <div class="row">

                            <div class="col-md-4">

                                <h5>Teilen</h5>

                            </div>

                            <div class="col-md-8">

                                <div class="row social-share-links">

                                @foreach ($share as $key => $link)

                                    <div class="col-xs-4">

                                        <a role="button" href="{{$link}}" target="_blank" class="{{$key}}">{{$key}}</a>

                                    </div>

                                @endforeach

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="section-wrap">

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

                        <p>{!! nl2br(e($travel->description)) !!}<br/><br/><a href="{{$travel->link}}" target="_blank">{{$travel->link}}</a></p>

                    </div>

                </div>

                <div class="col-sm-6 col-sm-pull-6">

                    <div id="map" style="width:100%;height: calc(100vh - 100px);min-height:300px;"></div>

                </div>

            </div>

            <input type="hidden" id="input-lat" value="{{$travel->lat}}">
            <input type="hidden" id="input-lng" value="{{$travel->long}}">
            <input type="hidden" id="input-dest" value="{{$travel->destination->name}}">

            <script>
                function initMap() {

                    var directionsService = new google.maps.DirectionsService;
                    var directionsDisplay = new google.maps.DirectionsRenderer;
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 7,
                        center: {lat: 51.163375, lng: 10.447683}
                    });
                    directionsDisplay.setMap(map);

                    calculateAndDisplayRoute(directionsService, directionsDisplay);

                }

                function calculateAndDisplayRoute(directionsService, directionsDisplay) {

                    var lat = document.getElementById('input-lat').value;
                    var lng = document.getElementById('input-lng').value;
                    var dest = document.getElementById('input-dest').value;

                    directionsService.route({
                        origin: lat + ',' + lng,
                        destination: dest,
                        travelMode: 'DRIVING'
                    }, function(response, status) {
                        if (status === 'OK') {
                            directionsDisplay.setDirections(response);
                        } else {
                            window.alert('Directions request failed due to ' + status);
                        }
                    });
                }
            </script>

            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbZ4hrT0d_RIaXoaCbUCwSIB3uo90bHAM&libraries=places&callback=initMap"></script>

        @else

            <h5>Diese Fahrt existiert nicht oder wurde noch nicht freigegeben.</h5>

        @endif


    </div>

@endsection
