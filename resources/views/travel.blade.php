@extends('layouts.app')

@section('content')

    <div class="container">

        @can('edit_own')

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
                            <th></th>
                            <th></th>
                            <th>Aktiv?</th>

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
                                    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-{{$current_travel->id}}">
                                        <input type="checkbox" id="checkbox-{{$current_travel->id}}" class="mdl-checkbox__input" @if ($current_travel->verified === 1) checked @endif>
                                    </label>
                                </td>
                                <td><a href="{{ url('/travel', $current_travel->id) }}" target="_self"><button class="mdl-button mdl-js-button mdl-button--primary">editieren</button></a></td>
                                <td><button class="mdl-button mdl-js-button mdl-button--accent">löschen</button></td>
                                <td>
                                    <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-{{$current_travel->id}}">
                                        <input type="checkbox" id="switch-{{$current_travel->id}}" class="mdl-switch__input" @if ($current_travel->public === 1) checked @endif>
                                        <span class="mdl-switch__label"></span>
                                    </label>
                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                    {{ $travel->links() }}

                </div>

            @endif

        @endcan

    </div>

@endsection
