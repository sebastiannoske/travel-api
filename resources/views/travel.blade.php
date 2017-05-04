@extends('layouts.app')

@section('content')

    <div class="container">

        @if (isset($travel) && count($travel))

            <div class="table-responsive">

                <table class="table table-striped">

                    <thead>

                    <tr>

                        <th>erstellt</th>
                        <th>Art</th>
                        <th>PLZ</th>
                        <th>Abfahrtsort</th>
                        <th>Verkehrsmittel</th>
                        <th>Aktionsort</th>
                        <th>per Mail bestätigt?</th>
                        <th>Aktiv?</th>
                        <th></th>
                        <th></th>

                    </tr>

                    </thead>

                    <tbody>

                    @foreach ($travel as $current_travel)

                        <?php $is_offer = $current_travel->offer; ?>

                        <tr class="<?php if ($is_offer) : echo 'offer'; else: echo 'request'; endif; ?>">

                            <td>{{$current_travel->created_at->diffForHumans()}}</td>
                            <td><?php if ($is_offer) : echo 'Angebot'; else: echo 'Gesuch'; endif; ?></td>
                            <td>{{$current_travel->postcode}}</td>
                            <td>{{$current_travel->city}}</td>
                            <td>{{$current_travel->transportation_mean->name}}</td>
                            <td>{{$current_travel->destination->name}}</td>
                            <td>
                                @if ($current_travel->verified === 1) <img src="{{ URL::to('/') }}/img/checked.svg"/> @else <img src="{{ URL::to('/') }}/img/not-checked.svg"/> @endif
                            </td>
                            <td id="public-switch">
                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-{{$current_travel->id}}">
                                    <input type="checkbox" id="switch-{{$current_travel->id}}" class="mdl-switch__input" data-ref-id="{{$current_travel->id}}" @if ($current_travel->public === 1) checked @endif>
                                    <span class="mdl-switch__label"></span>
                                </label>
                            </td>
                            <td><a href="{{ url('/edit-travel', $current_travel->id) }}" target="_self"><button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">editieren</button></a></td>
                            <td><button class="btn-delete mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--accent" data-ref-id="{{$current_travel->id}}">löschen</button></td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

                {{ $travel->links() }}

            </div>

            <script src="/js/travel.js"></script>

        @else

            <h4>Bitte Logge dich zuerst ein um Fahren bearbeiten zu können.</h4>

        @endif

    </div>

@endsection
