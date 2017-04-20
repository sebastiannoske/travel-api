@extends('layouts.app')

@section('content')

    <div class="container">

        <?php $is_offer = $travel->offer; ?>

        <div>{{$travel->created_at->diffForHumans()}}</div>
        <div><?php if ($is_offer) : echo 'Angebot'; else: echo 'Gesuch'; endif; ?></div><br/>
        <div>{{$travel->postcode}}</div>
        <div>{{$travel->city}}</div>
         <div>{{$travel->street_address}}</div><br/>
        <div>{{$travel->description}}</div>
        <div>{{$travel->transportation_mean->name}}</div>
        <div>{{$travel->destination->name}}</div><br/>
        <div>
            <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-{{$travel->id}}">
                <input type="checkbox" id="checkbox-{{$travel->id}}" class="mdl-checkbox__input" checked>
            </label>
        </div>
        <div><button class="mdl-button mdl-js-button mdl-button--primary">speichern</button></div>
        <div><button class="mdl-button mdl-js-button mdl-button--accent">löschen</button></div>
        <div>
            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-{{$travel->id}}">
                <input type="checkbox" id="switch-{{$travel->id}}" class="mdl-switch__input" <?php if ($travel->public): echo "checked"; endif; ?>>
                <span class="mdl-switch__label"></span>
            </label>
        </div>


    </div>

@endsection
