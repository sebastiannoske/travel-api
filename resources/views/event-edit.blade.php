@extends('layouts.app')

@section('content')

    <div class="container">

        @if (isset($event))

            {!! Form::open(['url' => "/events/{$event->id}/update"]) !!}

            <div class="row">

                <div class="col-md-6">

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('name')) echo 'has-error'; ?>">

                        {{ Form::text('name', $event->name, array_merge(['class' => 'mdl-textfield__input', 'id' => 'name'])) }}
                        {{ Form::label('name', 'Name des Events', array('class' => 'mdl-textfield__label'))}}

                    </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('name')) echo 'has-error'; ?>">

                        {{ Form::textarea('campaignText', $event->campaignText, array_merge(['class' => 'mdl-textfield__input', 'id' => 'campaignText'])) }}
                        {{ Form::label('campaignText', 'Beschreibung der Kampagne', array('class' => 'mdl-textfield__label'))}}

                    </div>

                    <div style="text-align: right;">

                        <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">speichern</button>

                    </div>

                </div>

            </div>

            {!! Form::close() !!}

        @endif

    </div>

@endsection

