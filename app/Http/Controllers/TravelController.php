<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmTravel;
use App\Mail\ConfirmUser;
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

            //dd($request->input('kind') === 'offer');

            if ( $request->input('kind') === 'offer') {

                $travel = Travel::whereHas('destination', function ($query) use ($destination_id) {
                    $query->where('id', '=', $destination_id);
                })
                ->whereHas('offer', function ($query) {
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

        $user = User::where('email', $request->user_email)->first();

        if (!$user) {

            $user = User::firstOrCreate([
                'email' => $request->user_email,
                'password' => bcrypt(str_random(60)),
                'name' => $request->user_name,
                'street_address' => $request->user_address,
                'postcode' => $request->user_postcode,
                'city' => $request->user_city,
                'phone_number' => $request->user_phone_number,
            ]);

            DB::table('role_user')->insert([
                ['user_id' => $user->id]
            ]);

            \Mail::to($user)->send(new ConfirmUser($user));

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
            'phone_number' => $request->phone_number,
            'postcode' => $request->postcode,
            'user_id' => $user->id,
            'destination_id' => $destination_id,
            'transportation_mean_id' => $request->transportationMeanId

        ]);

        $travel->save();

        dd($request->travel_type);

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
