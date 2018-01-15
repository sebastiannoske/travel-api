@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                @if (isset($events) && count($events))

                    <?php $stopoverError = ($errors->has('locality') || $errors->has('postal_code') || $errors->has('lat') || $errors->has('lng')); ?>

                    @foreach ($events as $event)

                        <h4>{{$event->name}}</h4>

                    @endforeach

                        <h4><a role="button" data-toggle="collapse" href="#collapse" aria-expanded="@if ($stopoverError) true @else false @endif" aria-controls="collapse">Event hinzufügen <i class="glyphicon glyphicon-plus"></i></a></h4>

                        <div class="collapse @if ($stopoverError) in @endif" id="collapse">


                            {!! Form::open(['url' => "/settings/$event->id/destination"]) !!}

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

                            {!! Form::close() !!}

                        </div>

                @else

                    <h5>Keine ausreichenden Rechte vorhanden.</h5>

                @endif

            </div>

        </div>

    </div>

@endsection