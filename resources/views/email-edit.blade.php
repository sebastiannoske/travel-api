@extends('layouts.app')

@section('content')

    <div class="container">

        @if (isset($templates) && count($templates))

            <h4 style="text-align: center;">Benutzereinstellungen</h4>

            @if (session()->has('message'))

                <p class="alert alert-success">

                    <?php echo session('message')[0]; ?>

                </p>

                <br/><br/><br/>

            @endif

            @if (session()->has('error'))

                <p class="alert alert-danger">

                    <?php echo session('error')[0]; ?>

                </p>

                <br/><br/><br/>

            @endif

            <br/><br/>

            <div class="row">

                @foreach ($templates as $current_template)

                <div class="col-md-6">

                    <div class="section-wrap">

                        <h5>{{$current_template->template_name}}</h5>

                        {!! Form::open(['url' => "/email/$current_template->id/update"]) !!}

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('title')) echo 'has-error'; ?>">

                            {{ Form::text('title', $current_template->title, array_merge(['class' => 'mdl-textfield__input', 'id' => 'title'])) }}
                            {{ Form::label('title', 'Anrede', array('class' => 'mdl-textfield__label'))}}

                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('text')) echo 'has-error'; ?>">

                            {{ Form::textarea('text', $current_template->text, array_merge(['class' => 'mdl-textfield__input', 'id' => 'text'])) }}
                            {{ Form::label('text', 'Inhalt', array('class' => 'mdl-textfield__label'))}}

                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('closing')) echo 'has-error'; ?>">

                            {{ Form::textarea('closing', $current_template->closing, array_merge(['class' => 'mdl-textfield__input', 'id' => 'closing'])) }}
                            {{ Form::label('closing', 'Abschluss', array('class' => 'mdl-textfield__label'))}}

                        </div>

                        <div style="text-align: right;">

                            <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">speichern</button>

                        </div>

                        {!! Form::close() !!}

                    </div>

                </div>

                @endforeach

            </div>



        @else

            <h4>Du besitzt nicht die nötige Berechtigung E-Mail Templates zu bearbeiten.</h4>

        @endif


    </div>

@endsection
