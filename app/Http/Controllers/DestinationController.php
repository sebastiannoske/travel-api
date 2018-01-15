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
    public function storeDestination(Request $request, $event_id)
    {
        //
        $streetAddress = $request->route;

        if (count($request->street_number)) {
            $streetAddress .= ' ' . $request->street_number;
        }

        $destination = new Destination([
            'name' => $request->locality,
            'event_id' => $event_id,
            'lat' => $request->lat,
            'long' => $request->lng,
            'street_address' => $streetAddress,
            'postcode' => $request->postal_code,
            'date' => Carbon::create(2018, 01, 20, 11, 0, 0)

        ]);

        $destination->save();

        return redirect()->back()->with('message', ['Zwischenstopp hinzugefügt.']);

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
