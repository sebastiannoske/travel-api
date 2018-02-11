@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">

        <div class="col-md-12">

            @can('edit_all')

            @if (isset($event))

                <?php $stopoverError = ($errors->has('locality') || $errors->has('postal_code') || $errors->has('lat') || $errors->has('lng')); ?>

                <?php $formError = (!$stopoverError && $errors->all()) ? true : false; ?>

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

                @if (isset($admins) && sizeof($admins) > 0)

                    @can('edit_super_all')

                        <div class="dark">

                            <div class="row">

                                <div class="col-md-9">

                                    <h4>Festlegen, welcher Benutzer dem aktuellen Event zugeordnet ist</h4>
                                    <p>Li Europan lingues es membres del sam familie. Lor separat existentie es un myth. Por scientie, musica, sport etc,  litot Europa usa li sam vocabular. Li lingues differe solmen in li grammatica, li pronunciation e li plu commun vocabules.</p>

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 col-md-offset-3">

                                <ul class="demo-list-item mdl-list">
                                    @foreach ($admins as $admin)

                                        <li class="mdl-list__item">
                                            <span class="mdl-list__item-primary-content">
                                              <i class="material-icons  mdl-list__item-avatar">person</i>
                                                {{$admin->name}}<br/>({{$admin->email}})
                                            </span>
                                            <span class="mdl-list__item-secondary-action">
                                              <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="list-checkbox-{{$admin->id}}">
                                                <input type="checkbox" id="list-checkbox-{{$admin->id}}" data-event-id="{{$event->id}}" data-user-id="{{$admin->id}}" class="mdl-checkbox__input"/>
                                              </label>
                                            </span>
                                        </li>

                                    @endforeach
                                </ul>

                            </div>

                        </div>

                        <script>

                            $(document).ready(function() {
                                var crsfToken = $('meta[name="csrf-token"]').attr('content');

                                $('input:checkbox').on('change', function(e) {
                                    var target = $(e.target);

                                    $.ajaxSetup({

                                        headers: {

                                            'X-CSRF-TOKEN': crsfToken

                                        }

                                    });

                                    var state = target.is(':checked')

                                    $.post('/events/'+target.data('event-id')+'/hasuser/'+target.data('user-id'), { 'state' : state }, function(data) {

                                    });
                                })


                            });

                        </script>

                        <br/><br/><br/>

                    @endcan

                @endif

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

                            {!! Form::open(array('route' => array('fileUpload', $event->id), 'enctype' => 'multipart/form-data')) !!}

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

                        <div class="col-md-6 inline-form-wrap" style="text-align: right; padding-top:20px;">


                                @if (sizeof($event->destinations) > 1 && false) <!-- TODO -->

                                    {!! Form::open(['url' => "/settings/destination/$destination->id/delete"]) !!}

                                        <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--accent">löschen</button>

                                    {!! Form::close() !!}

                                @endif

                                <a href="{{ url('/settings/destination', $destination->id) }}" target="_self"><button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">editieren</button></a>



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

                        {{ Form::text('street_address', null, array_merge(['class' => 'mdl-textfield__input', 'id' => 'street_address'])) }}
                        {{ Form::label('street_address', 'Straße, Nr.', array('class' => 'mdl-textfield__label'))}}

                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('lat')) echo 'has-error'; ?>">

                        {{ Form::text('lat', null, array_merge(['class' => 'mdl-textfield__input', 'id' => 'lat'])) }}
                        {{ Form::label('lat', 'Latitude', array('class' => 'mdl-textfield__label'))}}

                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('lng')) echo 'has-error'; ?>">

                        {{ Form::text('lng', null, array_merge(['class' => 'mdl-textfield__input', 'id' => 'lng'])) }}
                        {{ Form::label('lng', 'Longitude', array('class' => 'mdl-textfield__label'))}}

                    </div>

                    <div id="datepicker-btn" class="mdl-textfield mdl-js-textfield <?php if ($errors->has('date')) echo 'has-error'; ?>">

                        {{ Form::text('date',null , array_merge(['class' => 'mdl-textfield__input', 'id' => 'date_time'])) }}
                        {{ Form::label('date', 'Veranstaltungsbeginn', array('class' => 'mdl-textfield__label'))}}

                    </div>

                    <div style="text-align: right;">

                        <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">Demonstrationsort hinzufügen</button>

                    </div>

                    {!! Form::close() !!}

                </div>

            @endif

                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbZ4hrT0d_RIaXoaCbUCwSIB3uo90bHAM&libraries=places"></script>

                <script src="/js/travel-details.js"></script>

            @else

                <h5>Keine ausreichenden Rechte vorhanden.</h5>

            @endcan

        </div>

    </div>

</div>

@endsection
