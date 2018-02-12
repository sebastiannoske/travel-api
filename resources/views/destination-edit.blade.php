@extends('layouts.app')

@section('content')

    <div class="container">

        @if (isset($destination))

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

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                <input id="searchTextField" class="form-control" type="text" size="50" placeholder="Suche und finde">

            </div>

            {!! Form::open(['url' => "/events/$destination->id/destinations/$destination->id/update"]) !!}

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('locality')) echo 'has-error'; ?>">

                {{ Form::text('locality', $destination->name, array_merge(['class' => 'mdl-textfield__input', 'id' => 'locality'])) }}
                {{ Form::label('locality', 'Stadt', array('class' => 'mdl-textfield__label'))}}

            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('postal_code')) echo 'has-error'; ?>">

                {{ Form::text('postal_code', $destination->postcode, array_merge(['class' => 'mdl-textfield__input', 'id' => 'postal_code'])) }}
                {{ Form::label('postal_code', 'Postleitzahl', array('class' => 'mdl-textfield__label'))}}

            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                {{ Form::text('street_address', $destination->street_address, array_merge(['class' => 'mdl-textfield__input', 'id' => 'street_address'])) }}
                {{ Form::label('street_address', 'Straße, Nr.', array('class' => 'mdl-textfield__label'))}}

            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('lat')) echo 'has-error'; ?>">

                {{ Form::text('lat', $destination->lat, array_merge(['class' => 'mdl-textfield__input', 'id' => 'lat'])) }}
                {{ Form::label('lat', 'Latitude', array('class' => 'mdl-textfield__label'))}}

            </div>

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('lng')) echo 'has-error'; ?>">

                {{ Form::text('lng', $destination->long, array_merge(['class' => 'mdl-textfield__input', 'id' => 'lng'])) }}
                {{ Form::label('lng', 'Longitude', array('class' => 'mdl-textfield__label'))}}

            </div>

            <div id="datepicker-btn" class="mdl-textfield mdl-js-textfield <?php if ($errors->has('date')) echo 'has-error'; ?>">

                <?php $date = ($destination->date) ? Carbon\Carbon::parse($destination->date)->format('d.m.Y H:i') : ''; ?>
                {{ Form::text('date', $date, array_merge(['class' => 'mdl-textfield__input', 'id' => 'date_time'])) }}
                {{ Form::label('date', 'Veranstaltungsbeginn', array('class' => 'mdl-textfield__label'))}}

            </div>

            <div style="text-align: right;">

                <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">Speichern</button>

            </div>

            {!! Form::close() !!}

        @endif

        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbZ4hrT0d_RIaXoaCbUCwSIB3uo90bHAM&libraries=places"></script>

        <script src="/js/travel-details.js"></script>

    </div>

@endsection