@extends('layouts.app')

@section('content')

    <div class="container">

        @if (isset($travel) && count($travel))

            <?php $is_offer = $travel->offer; ?>

            <h4 style="text-align: center;"><?php if ($is_offer) : echo 'Angebot'; else: echo 'Gesuch'; endif; ?> / <span class="small">Fahrt nach</span> {{$travel->destination->name}}</h4>

            <div><span class="small">Erstellt: {{$travel->created_at->diffForHumans()}}</span></div>
            <div>Verkehrsmittel: {{$travel->transportation_mean->name}}</div><br/>
            <div>

                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-{{$travel->id}}">
                    <input type="checkbox" id="switch-{{$travel->id}}" class="mdl-switch__input" data-ref-id="{{$travel->id}}" <?php if ($travel->public): echo "checked"; endif; ?>>
                    <span class="mdl-switch__label">Öffentlich?</span>
                </label>

            </div>

            <br/><br/>

            <form method="POST" action="/travel/{{$travel->id}}/update">

                {{ csrf_field() }}

                <h5>Abfahrt</h5>

                <div class="form-group">
                    <label for="city">Stadt</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Stadt" value="{{$travel->city}}">
                </div>


                <div class="form-group">
                    <label for="postcode">Postleitzahl</label>
                    <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postleitzahl" value="{{$travel->postcode}}">
                </div>

                <div class="form-group">
                    <label for="street_address">Straße, Nr.</label>
                    <input type="text" class="form-control" id="street_address" name="street_address" placeholder="Straße, Nr" value="{{$travel->street_address}}">
                </div>

                <div class="form-group" id="datepicker-btn">
                    <label for="departure_time">Abfahrtszeit</label>
                    <input type="text" class="form-control" id="departure_time" name="departure_time" placeholder="Abfahrtszeit" value="{{$travel->departure_time}}">
                </div>

                <h5>Fahrt</h5>

                <div class="form-group">
                    <label for="description">Beschreibung</label>
                    <textarea class="form-control" rows="10" id="description" name="description" placeholder="Beschreibung">{{$travel->description}}</textarea>
                </div>

                <div style="text-align: right;">

                    <button class="btn-delete mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--accent" data-ref-id="{{$travel->id}}">löschen</button>
                    <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">speichern</button>

                </div>

            </form>

            <script src="/js/travel-details.js"></script>


        @else

            <h4>Entweder existiert diese Fahrt nicht oder du hast nicht das Recht, diese Fahrt zu bearbeiten.</h4>

        @endif


    </div>

@endsection
