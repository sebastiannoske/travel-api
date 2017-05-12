@extends('layouts.app')

@section('content')

    <div class="container">

        @if (isset($user) && count($user))

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

                <div class="col-md-6">

                    <div class="section-wrap">

                        <h5>Hinterlegte Daten</h5>

                        {!! Form::open(['url' => "/user/$user->id/update"]) !!}

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('name')) echo 'has-error'; ?>">

                                {{ Form::text('name', $user->name, array_merge(['class' => 'mdl-textfield__input', 'id' => 'name'])) }}
                                {{ Form::label('name', 'Name', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('email')) echo 'has-error'; ?>">

                                {{ Form::text('email', $user->email, array_merge(['class' => 'mdl-textfield__input', 'id' => 'email'])) }}
                                {{ Form::label('email', 'E-Mail', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('phone_number')) echo 'has-error'; ?>">

                                {{ Form::text('phone_number', $user->phone_number, array_merge(['class' => 'mdl-textfield__input', 'id' => 'phone_number'])) }}
                                {{ Form::label('phone_number', 'Telefon', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('street_address')) echo 'has-error'; ?>">

                                {{ Form::text('street_address', $user->street_address, array_merge(['class' => 'mdl-textfield__input', 'id' => 'street_address'])) }}
                                {{ Form::label('street_address', 'Straße', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('postcode')) echo 'has-error'; ?>">

                                {{ Form::text('postcode', $user->postcode, array_merge(['class' => 'mdl-textfield__input', 'id' => 'postcode'])) }}
                                {{ Form::label('postcode', 'Postleitzahl', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('city')) echo 'has-error'; ?>">

                                {{ Form::text('city', $user->city, array_merge(['class' => 'mdl-textfield__input', 'id' => 'city'])) }}
                                {{ Form::label('city', 'Wohnort', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div style="text-align: right;">

                                <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">speichern</button>

                            </div>

                        {!! Form::close() !!}

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="section-wrap">

                        <h5>Passwort ändern</h5>

                        {!! Form::open(['url' => "/user/$user->id/updatepassword"]) !!}

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('current_password')) echo 'has-error'; ?>">

                                {{ Form::password('current_password', array_merge(['class' => 'mdl-textfield__input', 'id' => 'current_password', 'placeholder' => '*************'])) }}
                                {{ Form::label('current_password', 'Aktuelles Passwort', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('password')) echo 'has-error'; ?>">

                                {{ Form::password('password', array_merge(['class' => 'mdl-textfield__input', 'id' => 'password'])) }}
                                {{ Form::label('password', 'Neues Passwort', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php if ($errors->has('password2')) echo 'has-error'; ?>">

                                {{ Form::password('password2', array_merge(['class' => 'mdl-textfield__input', 'id' => 'password2'])) }}
                                {{ Form::label('password2', 'Neues Passwort wiederholen', array('class' => 'mdl-textfield__label'))}}

                            </div>

                            <div style="text-align: right;">

                                <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">speichern</button>

                            </div>

                        {!! Form::close() !!}

                    </div>

                    @if ($user->roles[0]->id === 1)

                        <div class="section-wrap">

                            <h5>API Key</h5>


                            <div class="form-group">

                                <span class="form-control">{{$user->api_token}}</span>

                            </div>

                            <div style="text-align: right;">

                                {!! Form::open(['url' => "/users/$user->id/apikey"]) !!}

                                <div class="form-group">

                                    <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">Neu generieren</button>

                                </div>

                                {!! Form::close() !!}

                            </div>

                        </div>

                    @endif

                </div>

            </div>



        @else

            <h5>Du besitzt nicht die nötige Berechtigung diesen Benutzer zu bearbeiten.</h5>

        @endif


    </div>

@endsection
