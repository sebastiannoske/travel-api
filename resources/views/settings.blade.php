@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">

        <div class="col-md-12">

            @if (isset($event))

                <?php $stopoverError = ($errors->has('locality') || $errors->has('postal_code') || $errors->has('lat') || $errors->has('lng')); ?>

                <div class="dark">

                    <div class="row">

                        <div class="col-md-9">

                            <h4>Einrichtung und globale Einstellungen der Mitfahrzentrale</h4>
                            <p>Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc,  litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules.</p>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <h4>Kampagnenbeschreibung</h4>

                        <div class="section-wrap">

                            {!! Form::open(['url' => "/settings/$event->id/update"]) !!}

                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('title')) echo 'has-error'; ?>">

                                    {{ Form::textarea('campaignText', $event->campaignText, array_merge(['class' => 'mdl-textfield__input', 'id' => 'campaignText'])) }}
                                    {{ Form::label('campaignText', 'Kampagnen-Text', array('class' => 'mdl-textfield__label'))}}

                                </div>

                                <div style="text-align: right;">

                                    <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">speichern</button>

                                </div>

                            {!! Form::close() !!}

                        </div>

                    </div>

                    <div class="col-md-6">

                        <h4>Kampagnenlogo hochladen</h4>

                        <div class="section-wrap">

                            @if (isset($event->imagePath))

                                <div class="row">

                                    <div class="col-md-12">

                                        <div style="padding: 15px">

                                            <img src="{{$event->imagePath}}"/>

                                        </div>

                                    </div>

                                </div>

                                <br/><br/>

                            @endif

                            {!! Form::open(array('route' => 'fileUpload','enctype' => 'multipart/form-data')) !!}

                                <div class="row">

                                    <div class="col-md-8">

                                        {!! Form::file('image', array('class' => 'image')) !!}

                                    </div>

                                    <div class="col-md-4" style="text-align: right;">

                                        <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">Upload</button>

                                    </div>

                                </div>

                            {!! Form::close() !!}

                        </div>

                    </div>

                </div>

                <div class="hline"></div>

                <div class="row">

                    <div class="col-md-6">

                        <h4>Einstellungen für globale Kartenansicht</h4>

                        <div class="section-wrap">

                            {!! Form::open(['url' => "/settings/$event->id/update"]) !!}

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('title')) echo 'has-error'; ?>">

                                {{ Form::text('googleApiKey', $event->googleApiKey, array_merge(['class' => 'mdl-textfield__input', 'id' => 'googleApiKey'])) }}
                                {{ Form::label('googleApiKey', 'Google API Key', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div style="text-align: right;">

                                <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">speichern</button>

                            </div>

                            {!! Form::close() !!}

                        </div>

                    </div>

                </div>

                <br/><br/><br/><br/><br/>

                <div class="dark">

                    <div class="row">

                        <div class="col-md-9">

                            <h4>Anlegen und verwalten der Demonstrationsorte</h4>
                            <p>Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc,  litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules.</p>

                        </div>

                    </div>

                </div>

                @foreach ($event->destinations as $destination)

                    <div class="row">

                        <div class="col-md-6">

                            <h4>Demonstration in {{$destination->name}}</h4>

                        </div>

                        <div class="col-md-6" style="text-align: right; padding-top:20px;">

                            <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">löschen</button>

                        </div>

                    </div>

                    <div class="hline"></div>

                @endforeach

                <h4><a role="button" data-toggle="collapse" href="#collapse" aria-expanded="@if ($stopoverError) true @else false @endif" aria-controls="collapse">Demonstrationsort hinzufügen <i class="glyphicon glyphicon-plus"></i></a></h4>

                <div class="collapse @if ($stopoverError) in @endif" id="collapse">

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                        <input id="searchTextField" class="form-control" type="text" size="50" placeholder="Suche und finde">

                    </div>

                    {!! Form::open(['url' => "/settings/$event->id/destination"]) !!}

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('locality')) echo 'has-error'; ?>">

                        {{ Form::text('locality', null, array_merge(['class' => 'mdl-textfield__input', 'id' => 'locality'])) }}
                        {{ Form::label('locality', 'Stadt', array('class' => 'mdl-textfield__label'))}}

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

                        <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">Demonstrationsort hinzufügen</button>

                    </div>

                    {!! Form::close() !!}

                </div>

            @endif

                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbZ4hrT0d_RIaXoaCbUCwSIB3uo90bHAM&libraries=places"></script>

                <script src="/js/travel-details.js"></script>

        </div>

    </div>

</div>

@endsection
