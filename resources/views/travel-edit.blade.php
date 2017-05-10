@extends('layouts.app')

@section('content')

    <div class="container">

        @if (isset($travel) && count($travel))

            <?php $stopoverError = ($errors->has('administrative_area_level_1') || $errors->has('postal_code') || $errors->has('lat') || $errors->has('lng')); ?>

            <?php $is_offer = $travel->offer; ?>

            <h4 style="text-align: center;"><?php if ($is_offer) : echo 'Angebot'; else: echo 'Gesuch'; endif; ?> / <span class="small">Fahrt nach</span> {{$travel->destination->name}}</h4>

            @if ($stopoverError)

                <p class="alert alert-danger">

                    Es ist ein Fehler im Formular beim Anlegen eines neuen Zwischenstopps aufgetreten.

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

                        <h5>Abfahrt</h5>

                        <div class="form-group <?php if ($errors->has('city')) echo 'has-error'; ?>">

                            {{ Form::label('city', 'Stadt')}}
                            {{ Form::text('city', $travel->city, array_merge(['class' => 'form-control', 'id' => 'city'])) }}

                        </div>

                        <div class="form-group <?php if ($errors->has('postcode')) echo 'has-error'; ?>">

                            {{ Form::label('postcode', 'Postleitzahl')}}
                            {{ Form::text('postcode', $travel->postcode, array_merge(['class' => 'form-control', 'id' => 'postcode'])) }}

                        </div>

                        <div class="form-group <?php if ($errors->has('street_address')) echo 'has-error'; ?>">

                            {{ Form::label('street_address', 'Straße, Nr.')}}
                            {{ Form::text('street_address', $travel->street_address, array_merge(['class' => 'form-control', 'id' => 'street_address'])) }}

                        </div>

                        <div id="datepicker-btn" class="form-group <?php if ($errors->has('departure_time')) echo 'has-error'; ?>">

                            {{ Form::label('departure_time', 'Abfahrt')}}
                            {{ Form::text('departure_time', Carbon\Carbon::parse($travel->departure_time)->format('d.m.Y h:i'), array_merge(['class' => 'form-control', 'id' => 'departure_time'])) }}

                        </div>

                        <div class="form-group <?php if ($errors->has('description')) echo 'has-error'; ?>">

                            {{ Form::label('description', 'Beschreibung')}}
                            {{ Form::textarea('description', $travel->description, array_merge(['class' => 'form-control', 'id' => 'description'])) }}

                        </div>

                    </div>


                    <div class="col-md-6">

                        <h5>Kontakt</h5>

                        <div class="form-group <?php if ($errors->has('organisation')) echo 'has-error'; ?>">

                            {{ Form::label('organisation', 'Organisation')}}
                            {{ Form::text('organisation', $travel->contact->organisation, array_merge(['class' => 'form-control', 'id' => 'organisation'])) }}

                        </div>

                        <div class="form-group <?php if ($errors->has('name')) echo 'has-error'; ?>">

                            {{ Form::label('name', 'Kontakt-Person')}}
                            {{ Form::text('name', $travel->contact->name, array_merge(['class' => 'form-control', 'id' => 'name'])) }}

                        </div>

                        <div class="form-group <?php if ($errors->has('email')) echo 'has-error'; ?>">

                            {{ Form::label('email', 'E-Mail')}}
                            {{ Form::text('email', $travel->contact->email, array_merge(['class' => 'form-control', 'id' => 'email'])) }}

                        </div>

                        <div class="form-group <?php if ($errors->has('phone_number')) echo 'has-error'; ?>">

                            {{ Form::label('phone_number', 'Telefon')}}
                            {{ Form::text('phone_number', $travel->contact->phone_number, array_merge(['class' => 'form-control', 'id' => 'phone_number'])) }}

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

            <h5>Entweder existiert diese Fahrt nicht oder du besitzt nicht die nötige Berechtigung diese Fahrt zu bearbeiten.</h5>

        @endif


    </div>

@endsection
