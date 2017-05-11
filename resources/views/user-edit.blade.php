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

                    <h5>Hinterlegte Daten</h5>

                    {!! Form::open(['url' => "/user/$user->id/update"]) !!}

                        <div class="form-group <?php if ($errors->has('name')) echo 'has-error'; ?>">

                            {{ Form::label('name', 'Name')}}
                            {{ Form::text('name', $user->name, array_merge(['class' => 'form-control', 'id' => 'name'])) }}

                        </div>

                        <div class="form-group <?php if ($errors->has('email')) echo 'has-error'; ?>">

                            {{ Form::label('email', 'E-Mail ')}}
                            {{ Form::text('email', $user->email, array_merge(['class' => 'form-control', 'id' => 'email'])) }}

                        </div>

                        <div class="form-group <?php if ($errors->has('phone_number')) echo 'has-error'; ?>">

                            {{ Form::label('phone_number', 'Telefon')}}
                            {{ Form::text('phone_number', $user->phone_number, array_merge(['class' => 'form-control', 'id' => 'phone_number'])) }}

                        </div>

                        <div class="form-group <?php if ($errors->has('street_address')) echo 'has-error'; ?>">

                            {{ Form::label('street_address', 'Straße')}}
                            {{ Form::text('street_address', $user->street_address, array_merge(['class' => 'form-control', 'id' => 'street_address'])) }}

                        </div>

                        <div class="form-group <?php if ($errors->has('postcode')) echo 'has-error'; ?>">

                            {{ Form::label('postcode', 'Postleitzahl')}}
                            {{ Form::text('postcode', $user->postcode, array_merge(['class' => 'form-control', 'id' => 'postcode'])) }}

                        </div>

                        <div class="form-group <?php if ($errors->has('city')) echo 'has-error'; ?>">

                            {{ Form::label('city', 'Wohnort')}}
                            {{ Form::text('city', $user->city, array_merge(['class' => 'form-control', 'id' => 'city'])) }}

                        </div>

                        <div style="text-align: right;">

                            <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">speichern</button>

                        </div>

                    {!! Form::close() !!}

                </div>


                <div class="col-md-6">

                    <h5>Passwort ändern</h5>

                    {!! Form::open(['url' => "/user/$user->id/updatepassword"]) !!}

                        <div class="form-group <?php if ($errors->has('current_password')) echo 'has-error'; ?>">

                            {{ Form::label('current_password', 'Aktuelles Passwort')}}
                            {{ Form::password('current_password', array_merge(['class' => 'form-control', 'id' => 'current_password', 'placeholder' => '*************'])) }}

                        </div>

                        <div class="form-group <?php if ($errors->has('password')) echo 'has-error'; ?>">

                            {{ Form::label('password', 'Neues Passwort')}}
                            {{ Form::password('password', array_merge(['class' => 'form-control', 'id' => 'password'])) }}

                        </div>

                        <div class="form-group <?php if ($errors->has('password2')) echo 'has-error'; ?>">

                            {{ Form::label('password2', 'Neues Passwort wiederholen')}}
                            {{ Form::password('password2', array_merge(['class' => 'form-control', 'id' => 'password2'])) }}

                        </div>

                        <div style="text-align: right;">

                            <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">speichern</button>

                        </div>

                    {!! Form::close() !!}

                    @if ($user->roles[0]->id === 1)

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

                    @endif

                </div>

            </div>



        @else

            <h5>Du besitzt nicht die nötige Berechtigung diese Fahrt zu bearbeiten.</h5>

        @endif


    </div>

@endsection
