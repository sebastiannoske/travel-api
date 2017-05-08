@extends('layouts.app')

@section('content')

    <div class="container">

        @if (isset($travel) && count($travel))

            <?php $stopoverError = ($errors->has('administrative_area_level_1') || $errors->has('postal_code') || $errors->has('lat') || $errors->has('lng')); ?>

            @if ($stopoverError)

                <p class="alert alert-danger">

                    Es ist ein Fehler im Formular beim Anlegen eines neuen Zwischenstopps aufgetreten.

                </p>

                <br/><br/><br/>

            @endif

            <?php $is_offer = $travel->offer; ?>

            <h4 style="text-align: center;"><?php if ($is_offer) : echo 'Angebot'; else: echo 'Gesuch'; endif; ?> / <span class="small">Fahrt nach</span> {{$travel->destination->name}}</h4>

            <div><span class="small">Erstellt: {{$travel->created_at->diffForHumans()}}</span></div>
            <div>Verkehrsmittel: {{$travel->transportation_mean->name}}</div><br/>
            <div>

                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-{{$travel->id}}">
                    <input type="checkbox" id="switch-{{$travel->id}}" class="mdl-switch__input" data-ref-id="{{$travel->id}}" <?php if ($travel->public): echo "checked"; endif; ?>>
                    <span class="mdl-switch__label">Öffentlich?</span>
                </label>

            </div>

            <br/><br/>

            <form method="POST" action="/travel/{{$travel->id}}/update">

                {{ csrf_field() }}

                <h5>Abfahrt</h5>

                <div class="form-group">
                    <label for="city">Stadt</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Stadt" value="{{$travel->city}}">
                </div>


                <div class="form-group">
                    <label for="postcode">Postleitzahl</label>
                    <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postleitzahl" value="{{$travel->postcode}}">
                </div>

                <div class="form-group">
                    <label for="street_address">Straße, Nr.</label>
                    <input type="text" class="form-control" id="street_address" name="street_address" placeholder="Straße, Nr" value="{{$travel->street_address}}">
                </div>

                <div class="form-group" id="datepicker-btn">
                    <label for="departure_time">Abfahrt</label>
                    <input type="text" class="form-control" id="departure_time" name="departure_time" placeholder="Abfahrtszeit" value="{{$travel->departure_time}}">
                </div>

                <h5>Fahrt</h5>

                <div class="form-group">
                    <label for="description">Beschreibung</label>
                    <textarea class="form-control" rows="10" id="description" name="description" placeholder="Beschreibung">{{$travel->description}}</textarea>
                </div>

                <div style="text-align: right;">

                    <button class="btn-delete mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--accent" data-ref-id="{{$travel->id}}">löschen</button>
                    <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">speichern</button>

                </div>

            </form>

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

                    <div class="form-group">

                        <input id="searchTextField" class="form-control" type="text" size="50" placeholder="Suche und finde">

                    </div>

                     {!! Form::open(['url' => "/travel/$travel->id/stopover"]) !!}

                        <div class="form-group <?php if ($errors->has('administrative_area_level_1')) echo 'has-error'; ?>">

                            {{ Form::label('administrative_area_level_1', 'Stadt')}}
                            {{ Form::text('administrative_area_level_1', null, array_merge(['class' => 'form-control', 'id' => 'administrative_area_level_1'])) }}

                        </div>

                        <div class="form-group <?php if ($errors->has('postal_code')) echo 'has-error'; ?>">

                            {{ Form::label('postal_code', 'Postleitzahl')}}
                            {{ Form::text('postal_code', null, array_merge(['class' => 'form-control', 'id' => 'postal_code'])) }}

                        </div>

                        <div class="form-group">

                            {{ Form::label('Straße')}}
                            {{ Form::text('route', null, array_merge(['class' => 'form-control', 'id' => 'route'])) }}

                        </div>

                        <div class="form-group">

                            {{ Form::label('Nr.')}}
                            {{ Form::text('street_number', null, array_merge(['class' => 'form-control', 'id' => 'street_number'])) }}

                        </div>

                        <div class="form-group <?php if ($errors->has('lat')) echo 'has-error'; ?>">

                            {{ Form::label('lat', 'Latitude')}}
                            {{ Form::text('lat', null, array_merge(['class' => 'form-control', 'id' => 'lat'])) }}

                        </div>

                        <div class="form-group <?php if ($errors->has('lng')) echo 'has-error'; ?>">

                            {{ Form::label('lng', 'Longitude')}}
                            {{ Form::text('lng', null, array_merge(['class' => 'form-control', 'id' => 'lng'])) }}

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

            <h4>Entweder existiert diese Fahrt nicht oder du hast nicht das Recht, diese Fahrt zu bearbeiten.</h4>

        @endif


    </div>

@endsection
