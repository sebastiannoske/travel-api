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

                            <div class="col-md-3">

                                <h5>Teilen</h5>

                            </div>

                            <div class="col-md-9">

                                <div class="row social-share-links">

                                @foreach ($share as $key => $link)

                                    <div class="col-sm-4">

                                        <a role="button" href="{{$link}}" target="_blank" class="{{$key}}">

                                            @if ($key === 'facebook')

                                                <span class="social-icon">

                                                    <svg width="32px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 32"><path d="M17.1 0.2v4.7h-2.8q-1.5 0-2.1 0.6t-0.5 1.9v3.4h5.2l-0.7 5.3h-4.5v13.6h-5.5v-13.6h-4.5v-5.3h4.5v-3.9q0-3.3 1.9-5.2t5-1.8q2.6 0 4.1 0.2z"></path></svg>

                                                </span>

                                            @elseif ($key === 'twitter')

                                                <span class="social-icon">

                                                    <svg width="32px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 32"><path d="M29.7 6.8q-1.2 1.8-3 3.1 0 0.3 0 0.8 0 2.5-0.7 4.9t-2.2 4.7-3.5 4-4.9 2.8-6.1 1q-5.1 0-9.3-2.7 0.6 0.1 1.5 0.1 4.3 0 7.6-2.6-2-0.1-3.5-1.2t-2.2-3q0.6 0.1 1.1 0.1 0.8 0 1.6-0.2-2.1-0.4-3.5-2.1t-1.4-3.9v-0.1q1.3 0.7 2.8 0.8-1.2-0.8-2-2.2t-0.7-2.9q0-1.7 0.8-3.1 2.3 2.8 5.5 4.5t7 1.9q-0.2-0.7-0.2-1.4 0-2.5 1.8-4.3t4.3-1.8q2.7 0 4.5 1.9 2.1-0.4 3.9-1.5-0.7 2.2-2.7 3.4 1.8-0.2 3.5-0.9z"></path></svg>

                                                </span>

                                            @elseif ($key === 'gplus')

                                                <span class="social-icon">

                                                    <svg width="32px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M31.6 14.7h-3.3v-3.3h-2.6v3.3h-3.3v2.6h3.3v3.3h2.6v-3.3h3.3zM10.8 14v4.1h5.7c-0.4 2.4-2.6 4.2-5.7 4.2-3.4 0-6.2-2.9-6.2-6.3s2.8-6.3 6.2-6.3c1.5 0 2.9 0.5 4 1.6v0l2.9-2.9c-1.8-1.7-4.2-2.7-7-2.7-5.8 0-10.4 4.7-10.4 10.4s4.7 10.4 10.4 10.4c6 0 10-4.2 10-10.2 0-0.8-0.1-1.5-0.2-2.2 0 0-9.8 0-9.8 0z"></path></svg>

                                                </span>

                                            @endif

                                            <span>{{$key}}</span>

                                        </a>

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


                        @if ($travel->link)

                            <div class="row">

                                <div class="col-sm-3">

                                    <p><span>Tickets:</span></p>

                                </div>

                                <div class="col-sm-9">

                                    <p><a href="{{$travel->link}}" target="_blank">Jetzt Tickets kaufen</a></p>

                                </div>

                            </div>

                         @endif

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

                        <p>{!! nl2br(e($travel->description)) !!}</p>

                    </div>

                </div>

                <div class="col-sm-6 col-sm-pull-6">

                    <div id="map" style="width:100%;height: calc(100vh - 100px);min-height:300px;"></div>

                </div>

            </div>

            <input type="hidden" id="input-lat" value="{{$travel->lat}}">
            <input type="hidden" id="input-lng" value="{{$travel->long}}">
            <input type="hidden" id="input-dest" value="{{$travel->destination->name}}">
            <input type="hidden" id="input-dest-lat" value="{{$travel->destination->lat}}">
            <input type="hidden" id="input-dest-lng" value="{{$travel->destination->long}}">

            <?php if ( $travel->transportation_mean->id === 1 || $travel->transportation_mean->id === 2 || $travel->transportation_mean->id === 6 ) : ?>

                <input type="hidden" id="input-travelmode" value="DRIVING">

            <?php elseif ($travel->transportation_mean->id === 3) : ?>

                <input type="hidden" id="input-travelmode" value="TRANSIT">

            <?php elseif ($travel->transportation_mean->id === 4) : ?>

                <input type="hidden" id="input-travelmode" value="BICYCLING">

            <?php elseif ($travel->transportation_mean->id === 5) : ?>

                <input type="hidden" id="input-travelmode" value="WALKING">

            <?php endif; ?>

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
                    var destLng = document.getElementById('input-dest-lng').value;
                    var destLat = document.getElementById('input-dest-lat').value;
                    var travelMode = document.getElementById('input-travelmode').value;

                    directionsService.route({
                        origin: lat + ',' + lng,
                        destination: destLat + ', ' + destLng,
                        travelMode: travelMode
                    }, function(response, status) {
                        if (status === 'OK') {
                            directionsDisplay.setDirections(response);
                        } else {
                            window.alert('Directions request failed due to ' + status);
                        }
                    });
                }
            </script>

            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9XnE7sObsw-I0PAKdL7-XTsN7MD5mvQ0&libraries=places&callback=initMap"></script>

        @else

            <h5>Diese Fahrt existiert nicht oder wurde noch nicht freigegeben.</h5>

        @endif


    </div>

@endsection
