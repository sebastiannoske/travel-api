<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Event;
use App\Travel;
use App\User;
use App\UsersEvent;
use App\Destination;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $events = Event::all();
        return response()->json(['data' => $events, 'status' => 'success', 'total' => $events->count()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Requests\CreateEventRequest $request)
    {
        $event = new Event([
            'name' => $request->name,
            'campaignText' => $request->campaignText
        ]);

        $event->save();

        return redirect()->back()->with('message', ['Neues Event hinzugefügt.']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return 'cool';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);

        $destinations = Destination::where('event_id', '=', $id)->get();

        foreach ($destinations as $destination) {

            $travel = Travel::whereHas('destination', function ($query) use ($destination) {
                $query->where('id', '=', $destination->id);
            })
                ->with('offer')
                ->with('request')
                ->with('contact')
                ->with('transportation_mean')
                ->with('stopover')
                ->where([
                    ['public', '=', '1'],
                    ['verified', '=', '1'],
                ])
                ->orderBy('id', 'desc')
                ->get();

            $destination->travel = $travel;
        }

        $event->destinations = $destinations;

        return response()->json(['data' => $event, 'status' => 'success', 'total' => $destinations->count()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'halo';
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editEvents()
    {
        $auth_user = \Auth::user();
        $events = null;

        if ($auth_user) {

            if ($auth_user->hasRole('superadmin')) {

                $events = Event::all();

            } else {

                $events = Event::whereHas('users', function ($query) use ($auth_user) {
                    $query->where('user_id', '=', $auth_user->id);
                })->get();

                if ($events->count() === 0) {
                    $events = Event::whereHas('destination', function ($query) use ($auth_user) {
                        $query->whereHas('travel', function($subquery) use ($auth_user) {
                            $subquery->whereHas('user_id', '=', $auth_user->id);
                        });
                    });
                }
            }

        }

        return view('events', ['events' => $events]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editEvent($event_id)
    {
        $auth_user = \Auth::user();
        $event = null;
        $admins = null;
        $editors = null;

        if ($auth_user) {

            if ($auth_user->hasRole('admin') || $auth_user->hasRole('superadmin')) {

                if ($auth_user->hasRole('superadmin')) {

                    $event = Event::find($event_id);
                    $admins = User::whereHas('roles', function ($query) {
                        $query->where('roles.id', '=', 2);
                    })->get();

                    $editors = User::whereHas('roles', function ($query) {
                        $query->where('roles.id', '=', 3);
                    })->get();

                    foreach ($admins as $admin) {
                        $user_event = UsersEvent::where([['event_id', '=', $event_id], ['user_id', '=', $admin->id]])->first();
                        $admin->has_event = isset($user_event);
                    }

                    foreach ($editors as $editor) {
                        $user_event = UsersEvent::where([['event_id', '=', $event_id], ['user_id', '=', $editor->id]])->first();
                        $editor->has_event = isset($user_event);
                    }

                } else {

                    $usersEvents = UsersEvent::where('user_id', '=', $auth_user->id)->get();
                    $userIds = [];

                    foreach ( $usersEvents as $usersEvent ) {

                        if ($usersEvent->event_id == $event_id) {
                            $userIds[] = $usersEvent->event_id;
                        }
                    }

                    $event = Event::whereHas('users', function ($query) use ($userIds) {
                        $query->whereIn('user_id', $userIds);
                    })->first();

                    $editors = User::whereHas('roles', function ($query) {
                        $query->where('roles.id', '=', 3);
                    })->get();

                    foreach ($editors as $editor) {
                        $user_event = UsersEvent::where([['event_id', '=', $event_id], ['user_id', '=', $editor->id]])->first();
                        $editor->has_event = isset($user_event);
                    }

                }

            }

        }

        return view('settings', ['event' => $event, 'admins' => $admins, 'editors' => $editors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        if ($request->name) {

            $event->name = $request->name;

        }

        if ($request->campaignText) {

            $event->campaignText = $request->campaignText;

        }

        if ($request->googleApiKey) {

            $event->googleApiKey = $request->googleApiKey;

        }

        $event->save();

        return redirect()->back()->with('message', ['Änderungen gespeichert.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'halo';
    }

    public function setHasUserValue(Request $request, $event_id, $user_id) {


        if ( $request->state === 'true') {

            $user_event = UsersEvent::where([['event_id', '=', $event_id], ['user_id', '=', $user_id]])->first();

            if (!$user_event) {
                $user_event = new UsersEvent(
                    [
                        'event_id' => $event_id,
                        'user_id' => $user_id
                    ]
                );

                $user_event->save();
            }

        } else {

            $user_event = UsersEvent::where([['event_id', '=', $event_id], ['user_id', '=', $user_id]])->first();

            if ($user_event) {
                $user_event->delete();
            }

        }

        return $user_id;
    }
}
