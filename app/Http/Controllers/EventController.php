<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Travel;
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
    public function create()
    {
        return 'halo';
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

            }

        }

        return view('events', ['events' => $events]);
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

        if ($request->campaignText) {

            $event->campaignText = $request->campaignText;

        } else if ($request->googleApiKey) {

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
}
