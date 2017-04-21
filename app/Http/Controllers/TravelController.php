<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmTravel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Travel;
use App\Destination;
use App\TravelOffer;
use App\TravelRequest;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $destination_id)
    {
        if ( sizeof($request->input('kind')) > 0 ) {

            if ( $request->input('kind') === 'offer') {

                $travel = Travel::whereHas('destination', function ($query) use ($destination_id) {
                    $query->where('id', '=', $destination_id);
                })
                ->whereHas('offer', function ($query) use ($destination_id) {
                    $query->where('id', '>', 0);
                })
                ->with('offer')
                ->with('transportation_mean')
                ->orderBy('id', 'desc')
                ->get();

                return $travel;

            } elseif ( $request->input('kind') === 'request' ){

                $travel = Travel::whereHas('destination', function ($query) use ($destination_id) {
                    $query->where('id', '=', $destination_id);
                })
                ->whereHas('request', function ($query) use ($destination_id) {
                    $query->where('id', '>', 0);
                })
                ->with('request')
                ->with('transportation_mean')
                ->orderBy('id', 'desc')
                ->get();

                return $travel;

            }

        }

        $travel = Travel::whereHas('destination', function ($query) use ($destination_id) {
            $query->where('id', '=', $destination_id);
        })->with('offer')->with('request')->with('transportation_mean')->orderBy('id', 'desc')->get();

        return $travel;
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


    public function firstOrCreateUser(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if (!$user) {

            $user = User::firstOrCreate([
                'email' => $request->email,
                'name' => $request->name,
                'password' => bcrypt($request->password)
            ]);

            DB::table('role_user')->insert([
                ['user_id' => $user->id]
            ]);

        }

        return $user;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $destination_id)
    {
        $user = $this->firstOrCreateUser($request);

        $travel = new Travel([
            'description' => $request->description,
            'lat' => $request->lat,
            'long' => $request->long,
            'city' => $request->city,
            'street_address' => $request->streetAddress,
            'postcode' => $request->postcode,
            'user_id' => $user->id,
            'destination_id' => $destination_id,
            'transportation_mean_id' => $request->transportationMeanId

        ]);

        $travel->save();

        if ($request->travel_type === 'offer') {

            TravelOffer::create([
                'travel_id' => $travel->id,
                'passenger' => $request->passenger,
                'cost' => $request->cost
            ]);

        } else if ($request->travel_type === 'request') {

            TravelRequest::create([
                'travel_id' => $travel->id,
                'passenger' => $request->passenger,
                'cost' => $request->cost
            ]);
        }

        \Mail::to($user)->send(new ConfirmTravel($user));

        return $travel;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Travel::find($id);
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
