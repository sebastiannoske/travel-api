@extends('layouts.app')

@section('content')

    <div class="container">

        @can ('edit_all')

            <h4 style="text-align: center;">Benutzer Anlegen</h4>

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

                <div class="col-md-6 col-md-offset-3">

                    <h5>Benutzer Daten</h5>

                    {!! Form::open(['url' => "/events/1/user/create"]) !!} <!-- TODO -->

                    <div class="form-group <?php if ($errors->has('name')) echo 'has-error'; ?>">

                        {{ Form::label('name', 'Name')}}
                        {{ Form::text('name', null, array_merge(['class' => 'form-control', 'id' => 'name'])) }}

                    </div>

                    <div class="form-group <?php if ($errors->has('email')) echo 'has-error'; ?>">

                        {{ Form::label('email', 'E-Mail ')}}
                        {{ Form::text('email', null, array_merge(['class' => 'form-control', 'id' => 'email'])) }}

                    </div>

                    <div class="form-group <?php if ($errors->has('phone_number')) echo 'has-error'; ?>">

                        {{ Form::label('phone_number', 'Telefon')}}
                        {{ Form::text('phone_number', null, array_merge(['class' => 'form-control', 'id' => 'phone_number'])) }}

                    </div>

                    <div class="form-group <?php if ($errors->has('street_address')) echo 'has-error'; ?>">

                        {{ Form::label('street_address', 'Straße')}}
                        {{ Form::text('street_address', null, array_merge(['class' => 'form-control', 'id' => 'street_address'])) }}

                    </div>

                    <div class="form-group <?php if ($errors->has('postcode')) echo 'has-error'; ?>">

                        {{ Form::label('postcode', 'Postleitzahl')}}
                        {{ Form::text('postcode', null, array_merge(['class' => 'form-control', 'id' => 'postcode'])) }}

                    </div>

                    <div class="form-group <?php if ($errors->has('city')) echo 'has-error'; ?>">

                        {{ Form::label('city', 'Wohnort')}}
                        {{ Form::text('city', null, array_merge(['class' => 'form-control', 'id' => 'city'])) }}

                    </div>

                    <div style="text-align: right;">

                        <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">Benutzer anlegen</button>

                    </div>

                    {!! Form::close() !!}

                </div>


            </div>



        @else

            <h5>Du besitzt nicht die nötige Berechtigung neue Benutzer anzulegen.</h5>

        @endcan


    </div>

@endsection
