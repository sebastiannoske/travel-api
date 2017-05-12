@extends('layouts.app')

@section('content')

    <div class="container">

        @if (isset($travel) && count($travel))

            <?php $stopoverError = ($errors->has('administrative_area_level_1') || $errors->has('postal_code') || $errors->has('lat') || $errors->has('lng')); ?>

            <?php $formError = (!$stopoverError && $errors->all()) ? true : false; ?>

            <?php $is_offer = $travel->offer; ?>

            <h4 style="text-align: center;"><?php if ($is_offer) : echo 'Angebot'; else: echo 'Gesuch'; endif; ?> / <span class="small">Fahrt nach</span> {{$travel->destination->name}}</h4>

            @if ($stopoverError)

                <p class="alert alert-danger">

                    Es ist ein Fehler im Formular beim Anlegen eines neuen Zwischenstopps aufgetreten.

                </p>

                <br/><br/><br/>

            @endif

            @if ($formError)

                <p class="alert alert-danger">

                    Es ist ein Fehler im Formular beim Anpassen der Fahrt aufgetreten.

                </p>

                <br/><br/><br/>

            @endif

            @if (session()->has('message'))

                <p class="alert alert-success">

                    <?php echo session('message')[0]; ?>

                </p>

                <br/><br/><br/>

            @endif

            <div><span class="small">Erstellt: {{$travel->created_at->diffForHumans()}}</span></div>
            <div>Verkehrsmittel: {{$travel->transportation_mean->name}}</div><br/>
            <div>

                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-{{$travel->id}}">
                    <input type="checkbox" id="switch-{{$travel->id}}" class="mdl-switch__input" data-ref-id="{{$travel->id}}" <?php if ($travel->public): echo "checked"; endif; ?>>
                    <span class="mdl-switch__label">Öffentlich?</span>
                </label>

            </div>

            <br/><br/>

            {!! Form::open(['url' => "/travel/$travel->id/update"]) !!}

                <div class="row">

                    <div class="col-md-6">

                        <div class="section-wrap">

                            <h5>Abfahrt</h5>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('city')) echo 'has-error'; ?>">

                                {{ Form::text('city', $travel->city, array_merge(['class' => 'mdl-textfield__input', 'id' => 'city'])) }}
                                {{ Form::label('city', 'Stadt', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('postcode')) echo 'has-error'; ?>">

                                {{ Form::text('postcode', $travel->postcode, array_merge(['class' => 'mdl-textfield__input', 'id' => 'postcode'])) }}
                                {{ Form::label('postcode', 'Postleitzahl', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('street_address')) echo 'has-error'; ?>">

                                {{ Form::text('street_address', $travel->street_address, array_merge(['class' => 'mdl-textfield__input', 'id' => 'street_address'])) }}
                                {{ Form::label('street_address', 'Straße, Nr.', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div id="datepicker-btn" class="mdl-textfield mdl-js-textfield <?php if ($errors->has('departure_time')) echo 'has-error'; ?>">

                                <?php $departure_time = ($travel->departure_time && count($travel->departure_time)) ? Carbon\Carbon::parse($travel->departure_time)->format('d.m.Y H:i') : ''; ?>

                                {{ Form::text('departure_time',$departure_time , array_merge(['class' => 'mdl-textfield__input', 'id' => 'departure_time'])) }}
                                {{ Form::label('departure_time', 'Abfahrt', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('passenger')) echo 'has-error'; ?>">

                                <?php $passenger = ( $is_offer ) ? $travel->offer->passenger : $travel->request->passenger; ?>

                                {{ Form::text('passenger',$passenger , array_merge(['class' => 'mdl-textfield__input', 'id' => 'passenger'])) }}
                                {{ Form::label('passenger', 'Freie Plätze', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('cost')) echo 'has-error'; ?>">

                                <?php $cost = ( $is_offer ) ? $travel->offer->cost : $travel->request->cost; ?>

                                {{ Form::text('cost', $cost, array_merge(['class' => 'mdl-textfield__input', 'id' => 'cost'])) }}
                                {{ Form::label('cost', 'Preis pro Person', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('description')) echo 'has-error'; ?>">

                                {{ Form::textarea('description', $travel->description, array_merge(['class' => 'mdl-textfield__input', 'id' => 'description'])) }}
                                {{ Form::label('description', 'Beschreibung', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <?php $kind = ( $is_offer ) ? 'offer' : 'request' ?>

                            <input type="hidden" name="kind" value="{{$kind}}">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="section-wrap">

                            <h5>Kontakt</h5>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('organisation')) echo 'has-error'; ?>">

                                {{ Form::text('organisation', $travel->contact->organisation, array_merge(['class' => 'mdl-textfield__input', 'id' => 'organisation'])) }}
                                {{ Form::label('organisation', 'Organisation', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('name')) echo 'has-error'; ?>">

                                {{ Form::text('name', $travel->contact->name, array_merge(['class' => 'mdl-textfield__input', 'id' => 'name'])) }}
                                {{ Form::label('name', 'Kontakt-Person', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('email')) echo 'has-error'; ?>">

                                {{ Form::text('email', $travel->contact->email, array_merge(['class' => 'mdl-textfield__input', 'id' => 'email'])) }}
                                {{ Form::label('email', 'E-Mail', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('phone_number')) echo 'has-error'; ?>">

                                {{ Form::text('phone_number', $travel->contact->phone_number, array_merge(['class' => 'mdl-textfield__input', 'id' => 'phone_number'])) }}
                                {{ Form::label('phone_number', 'Telefon', array('class' => 'mdl-textfield__label'))}}

                            </div>

                        </div>

                    </div>

                </div>

                <div style="text-align: right;">

                    <button class="btn-delete mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--accent" data-ref-id="{{$travel->id}}">löschen</button>
                    <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">speichern</button>

                </div>

            {!! Form::close() !!}

            @if ($travel->transportation_mean_id === 2)

                <h5 style="text-align: center;">Zwischenstopps</h5>

                @if ($travel->stopover)

                    @foreach ( $travel->stopover as $stopover )


                        <p>über {{$stopover->street_address}}, {{$stopover->postcode}} {{$stopover->city}}</p>

                    @endforeach

                @else


                    <p>keine Zwischenstopps vorhanden.</p>


                @endif


                <h5 style="text-align: center;"><a class="btn" role="button" data-toggle="collapse" href="#collapse" aria-expanded="@if ($stopoverError) true @else false @endif" aria-controls="collapse">Zwischenstopp hinzufügen <i class="glyphicon glyphicon-plus"></i></a></h5>

                <div class="collapse @if ($stopoverError) in @endif" id="collapse">

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                        <input id="searchTextField" class="form-control" type="text" size="50" placeholder="Suche und finde">

                    </div>

                     {!! Form::open(['url' => "/travel/$travel->id/stopover"]) !!}

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('administrative_area_level_1')) echo 'has-error'; ?>">

                            {{ Form::text('administrative_area_level_1', null, array_merge(['class' => 'mdl-textfield__input', 'id' => 'administrative_area_level_1'])) }}
                            {{ Form::label('administrative_area_level_1', 'Stadt', array('class' => 'mdl-textfield__label'))}}

                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('postal_code')) echo 'has-error'; ?>">

                            {{ Form::text('postal_code', null, array_merge(['class' => 'mdl-textfield__input', 'id' => 'postal_code'])) }}
                            {{ Form::label('postal_code', 'Postleitzahl', array('class' => 'mdl-textfield__label'))}}

                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                            {{ Form::text('route', null, array_merge(['class' => 'mdl-textfield__input', 'id' => 'route'])) }}
                            {{ Form::label('route', 'Straße', array('class' => 'mdl-textfield__label'))}}

                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                            {{ Form::text('street_number', null, array_merge(['class' => 'mdl-textfield__input', 'id' => 'street_number'])) }}
                            {{ Form::label('street_number', 'Nr.', array('class' => 'mdl-textfield__label'))}}

                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('lat')) echo 'has-error'; ?>">

                            {{ Form::text('lat', null, array_merge(['class' => 'mdl-textfield__input', 'id' => 'lat'])) }}
                            {{ Form::label('lat', 'Latitude', array('class' => 'mdl-textfield__label'))}}

                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('lng')) echo 'has-error'; ?>">

                            {{ Form::text('lng', null, array_merge(['class' => 'mdl-textfield__input', 'id' => 'lng'])) }}
                            {{ Form::label('lng', 'Longitude', array('class' => 'mdl-textfield__label'))}}

                        </div>

                        <div style="text-align: right;">

                            <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">Zwischenstopp hinzufügen</button>

                        </div>

                     {!! Form::close() !!}

                </div>

                <br/><br/><br/><br/><br/>

                <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDS1rNqI3ZCpJu0fd8Rkyo5SAi8EPIna5g&libraries=places"></script>

            @endif

                <script src="/js/travel-details.js"></script>


        @else

            <h5>Entweder existiert diese Fahrt nicht oder du besitzt nicht die nötige Berechtigung diese Fahrt zu bearbeiten.</h5>

        @endif


    </div>

@endsection
