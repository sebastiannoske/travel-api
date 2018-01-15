<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Destination;
use Carbon\Carbon;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $event_id)
    {
        $destinations = Destination::where('event_id', '=', $event_id)->get();

        return response()->json(['data' => $destinations, 'status' => 'success', 'total' => $destinations->count()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $event_id
     * @return \Illuminate\Http\Response
     */
    public function storeDestination(Requests\CreateDestinationRequest $request, $event_id)
    {
        $destination = new Destination([
            'name' => $request->locality,
            'event_id' => $event_id,
            'lat' => $request->lat,
            'long' => $request->lng,
            'street_address' => $request->street_address,
            'postcode' => $request->postal_code,
            'date' => Carbon::create(2018, 01, 20, 11, 0, 0)

        ]);

        $destination->save();

        return redirect()->back()->with('message', ['Neuer Demonstrationsort hinzugefügt.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $destination = Destination::find($id);

        return response()->json(['data' => $destination, 'status' => 'success', 'total' => $destination->count()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function editDestination($destinations_id)
    {
        $auth_user = \Auth::user();
        $destination = null;

        if ($auth_user) {

            if ($auth_user->hasRole('superadmin') || $auth_user->hasRole('admin')) {

                $destination = Destination::find($destinations_id);

            }

        }

        return view('destination-edit', ['destination' => $destination]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\CreateDestinationRequest $request, $destination_id)
    {
        $destination = Destination::find($destination_id);
        $destination->name = $request->locality;
        $destination->lat = $request->lat;
        $destination->long = $request->lng;
        $destination->street_address = $request->street_address;
        $destination->postcode = $request->postal_code;

        $destination->save();

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
        //
        $destination = Destination::findOrFail($id);

        if ($destination) {
            $destination->delete();
        }

        return redirect()->back()->with('message', ['Demonstrationsort wurde gelöscht.']);
    }
}
