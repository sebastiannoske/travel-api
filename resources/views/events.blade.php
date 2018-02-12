@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-12">

            @if (isset($events) && count($events))

                <?php $stopoverError = ($errors->has('name') || $errors->has('campaignText')); ?>

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


                @foreach ($events as $event)


                     <div class="row">

                        <div class="col-md-6">

                            <h4>{{$event->name}}</h4>

                        </div>

                        <div class="col-md-6 inline-form-wrap" style="text-align: right; padding-top:20px;">

                            @can('edit_super_all')

                                @if (false) <!-- TODO -->

                                    {!! Form::open(['url' => "/events/$event->id/delete"]) !!}

                                    <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--accent">löschen</button>

                                    {!! Form::close() !!}

                                @endif

                            @endcan

                            @can('edit_all')

                                <a href="{{ url('/events/' . $event->id . '/edit') }}" target="_self"><button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">Einstellungen</button></a>

                            @endcan

                            @cannot('edit_travel')

                                <a href="{{ url('/events/' . $event->id . '/travel') }}" target="_self"><button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">Meine Fahrten</button></a>

                            @else

                                 <a href="{{ url('/events/' . $event->id . '/travel') }}" target="_self"><button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">Alle Fahrten</button></a>

                            @endcan

                        </div>

                    </div>

                @endforeach

                    @can('edit_super_all')

                    <h4><a role="button" data-toggle="collapse" href="#collapse" aria-expanded="@if ($stopoverError) true @else false @endif" aria-controls="collapse">Event hinzufügen <i class="glyphicon glyphicon-plus"></i></a></h4>

                    <div class="collapse @if ($stopoverError) in @endif" id="collapse">


                        {!! Form::open(['url' => "/events/create"]) !!}

                        <div class="row">

                            <div class="col-md-6">

                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('name')) echo 'has-error'; ?>">

                                    {{ Form::text('name', null, array_merge(['class' => 'mdl-textfield__input', 'id' => 'name'])) }}
                                    {{ Form::label('name', 'Name des Events', array('class' => 'mdl-textfield__label'))}}

                                </div>

                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('name')) echo 'has-error'; ?>">

                                    {{ Form::textarea('campaignText', null, array_merge(['class' => 'mdl-textfield__input', 'id' => 'campaignText'])) }}
                                    {{ Form::label('campaignText', 'Beschreibung der Kampagne', array('class' => 'mdl-textfield__label'))}}

                                </div>

                            </div>

                        </div>

                        <div style="text-align: right;">

                            <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">Event hinzufügen</button>

                        </div>


                        {!! Form::close() !!}

                    </div>

                    @endif

                @else

                    <h5>Keine ausreichenden Rechte vorhanden.</h5>

                @endif

            </div>

        </div>

    </div>

@endsection