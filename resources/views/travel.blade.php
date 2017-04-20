@extends('layouts.app')

@section('content')

    <div class="container">

        @can('edit_travel')


            @if (isset($travels) && count($travels))

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
                            <th></th>
                            <th></th>
                            <th>Aktiv?</th>

                        </tr>

                        </thead>

                        <tbody>

                        @foreach ($travels as $travel)

                            <?php $is_offer = $travel->offer; ?>

                            <tr class="<?php if ($is_offer) : echo 'offer'; else: echo 'request'; endif; ?>">

                                <td>{{$travel->created_at->diffForHumans()}}</td>
                                <td><?php if ($is_offer) : echo 'Angebot'; else: echo 'Gesuch'; endif; ?></td>
                                <td>{{$travel->postcode}}</td>
                                <td>{{$travel->city}}</td>
                                <td>{{$travel->transportation_mean->name}}</td>
                                <td>{{$travel->destination->name}}</td>
                                <td>
                                    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-{{$travel->id}}">
                                        <input type="checkbox" id="checkbox-{{$travel->id}}" class="mdl-checkbox__input" checked>
                                    </label>
                                </td>
                                <td><a href="{{ url('/travel', $travel->id) }}" target="_self"><button class="mdl-button mdl-js-button mdl-button--primary">editieren</button></a></td>
                                <td><button class="mdl-button mdl-js-button mdl-button--accent">löschen</button></td>
                                <td>
                                    <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-{{$travel->id}}">
                                        <input type="checkbox" id="switch-{{$travel->id}}" class="mdl-switch__input" <?php if ($travel->public): echo "checked"; endif; ?>>
                                        <span class="mdl-switch__label"></span>
                                    </label>
                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        @endcan

    </div>

@endsection
