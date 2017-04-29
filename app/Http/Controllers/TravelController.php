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

    public function confirmTravel($token) {

        $travel = Travel::whereToken($token)->firstOrFail();

        $travel->verified = true;

        $travel->token = null;

        $travel->save();

        return redirect('/login');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $destination_id)
    {
        if ( sizeof($request->input('kind')) > 0 ) {

            $travel = [];
            $paginate = [];

            if ( $request->input('kind') === 'offer') {

                $travel = Travel::whereHas('destination', function ($query) use ($destination_id) {
                                $query->where('id', '=', $destination_id);
                            })
                            ->whereHas('offer', function ($query) {
                                $query->where('id', '>', 0);
                            })
                            ->with('offer')
                            ->with('transportation_mean')
                            ->where([
                                ['public', '=', '1'],
                                ['verified', '=', '1'],
                            ])
                            ->orderBy('id', 'desc')
                            ->get();

            } elseif ( $request->input('kind') === 'request' ){

                $travel = Travel::whereHas('destination', function ($query) use ($destination_id) {
                                $query->where('id', '=', $destination_id);
                            })
                            ->whereHas('request', function ($query) use ($destination_id) {
                                $query->where('id', '>', 0);
                            })
                            ->with('request')
                            ->with('transportation_mean')
                            ->where([
                                ['public', '=', '1'],
                                ['verified', '=', '1'],
                            ])
                            ->orderBy('id', 'desc')
                            ->get();

            }


        } else {

            $travel = Travel::whereHas('destination', function ($query) use ($destination_id) {
                            $query->where('id', '=', $destination_id);
                        })
                            ->with('offer')
                            ->with('request')
                            ->with('transportation_mean')
                            ->where([
                                ['public', '=', '1'],
                                ['verified', '=', '1'],
                            ])
                            ->orderBy('id', 'desc')
                            ->get();

        }

        if ( sizeof($request->input('start')) > 0 && sizeof($request->input('limit')) > 0 ) {

            $start = intval($request->input('start'));
            $limit = intval($request->input('limit'));

            $travel = array_slice ( $travel->toArray() , $start, $limit );
            $paginate = [ 'start' => $start, 'limit' => $limit ];

        }


        return response()->json(['data' => $travel, 'paginate' => $paginate]);
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
                'email' => $request->userEmail,
                'password' => bcrypt(str_random(60)),
                'name' => $request->userName,
                'street_address' => $request->userAddress,
                'postcode' => $request->userPostCode,
                'city' => $request->userCity,
                'phone_number' => $request->userPhoneNumber,
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
            'phone_number' => $request->phoneNumber,
            'postcode' => $request->postcode,
            'user_id' => $user->id,
            'destination_id' => $destination_id,
            'transportation_mean_id' => $request->transportationMeanId

        ]);

        $travel->save();

        if ($request->travelType === 'offer') {

            TravelOffer::create([
                'travel_id' => $travel->id,
                'passenger' => $request->passenger,
                'cost' => $request->cost
            ]);

        } else if ($request->travelType === 'request') {

            TravelRequest::create([
                'travel_id' => $travel->id,
                'passenger' => $request->passenger,
                'cost' => $request->cost
            ]);
        }

        \Mail::to($user)->send(new ConfirmTravel($user, $travel));

        return response()->json(['data' => $travel]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $travel = Travel::where([
            ['id', '=', $id],
            ['public', '=', '1'],
            ['verified', '=', '1'],
        ])->get();

        return response()->json(['data' => $travel]);
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
