<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmTravel;
use App\Mail\UserConfirmed;
use App\Mail\ConfirmUser;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Travel;
use App\Destination;
use App\TravelOffer;
use App\TravelRequest;
use App\Stopover;
use App\TravelContact;

class TravelController extends Controller
{
    protected $redirectTo = '/';

    public function confirmTravel($token) {

        $travel = Travel::whereToken($token)->first();

        if ($travel) {

            $travel->verified = true;

            $travel->public = true;

            $travel->token = null;

            $travel->save();

            $user_activated = $this->confirmEmail($travel->user_id);
            $message = 'Hier können Sie sich auf der Mitfahrbörse einloggen und Ihren Eintrag bearbeiten, oder auch löschen.';

            if (!$user_activated) {

                $message .= '<br /><br />Die Zugangsdaten wurden Ihnen per Email zugesendet.';

            }

            if (\Auth::user()) {

                return redirect('/')->with('message', [$message]);

            } else {

                return redirect('/login')->with('message', [$message]);

            }

        }

        return redirect('/');

    }

    private function confirmEmail($user_id) {

        $user = User::find($user_id);

        if (!$user->verified) {

            $pw = str_random(10);

            $user->password = bcrypt($pw);

            $user->verified = true;

            $user->token = null;

            $user->save();

            \Mail::to($user)->send(new UserConfirmed($user, $pw));

            return true;

        }

        return false;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $destination_id)
    {
        $travel_query = null;
        $travel = null;
        $paginate = null;
        $query_by_input_ready = false;


        // All travel by a given center coordinate and a radius in km
        if ( ( sizeof($request->input('center')) > 0 ) && ( sizeof($request->input('radius')) > 0 ) ) {

            // TODO

            // All travel if kind = offer, request given
        } elseif ( sizeof($request->input('kind')) > 0 ) {

            // border box given
            if ( sizeof($request->input('bbox')) > 0 ) {

                $bbox = explode(',', $request->input('bbox'));

                if (sizeof($bbox) === 4 && strlen($bbox[0]) && strlen($bbox[1]) && strlen($bbox[2])  && strlen($bbox[3])) { // bbox is ok

                    $travel = Travel::whereHas('destination', function ($query) use ($destination_id) {
                            $query->where('id', '=', $destination_id);
                        })
                        ->whereHas($request->input('kind'), function ($query) {
                            $query->where('id', '>', 0);
                        })
                        ->whereBetween('lat', [$bbox[0], $bbox[2]])
                        ->whereBetween('long', [$bbox[1], $bbox[3]])
                        ->with($request->input('kind'))
                        ->with('transportation_mean')
                        ->with('contact')
                        ->with('stopover')
                        ->where([
                            ['public', '=', '1'],
                            ['verified', '=', '1'],
                        ])
                        ->orderBy('id', 'desc')
                        ->get();

                    $query_by_input_ready = true;

                }

            }

            if (!$query_by_input_ready) { // bbox is not ok

                $travel = Travel::whereHas('destination', function ($query) use ($destination_id) {
                        $query->where('id', '=', $destination_id);
                    })
                    ->whereHas($request->input('kind'), function ($query) {
                        $query->where('id', '>', 0);
                    })
                    ->with($request->input('kind'))
                    ->with('transportation_mean')
                    ->with('contact')
                    ->with('stopover')
                    ->where([
                        ['public', '=', '1'],
                        ['verified', '=', '1'],
                    ])
                    ->orderBy('id', 'desc')
                    ->get();

            }

        } else { // not geo stuff given

            if ( sizeof($request->input('bbox')) > 0 ) {

                $bbox = explode(',', $request->input('bbox'));

                if (sizeof($bbox) === 4 && strlen($bbox[0]) && strlen($bbox[1]) && strlen($bbox[2])  && strlen($bbox[3])) { // bbox is ok

                    $travel = Travel::whereHas('destination', function ($query) use ($destination_id) {
                            $query->where('id', '=', $destination_id);
                        })
                        ->whereBetween('lat', [$bbox[0], $bbox[2]])
                        ->whereBetween('long', [$bbox[1], $bbox[3]])
                        ->with('offer')
                        ->with('request')
                        ->with('transportation_mean')
                        ->with('contact')
                        ->with('stopover')
                        ->where([
                            ['public', '=', '1'],
                            ['verified', '=', '1'],
                        ])
                        ->orderBy('id', 'desc')
                        ->get();

                    $query_by_input_ready = true;

                }

            }

            if (!$query_by_input_ready) { // bbox is not ok

                $travel = Travel::whereHas('destination', function ($query) use ($destination_id) {
                            $query->where('id', '=', $destination_id);
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
            }

        };

        $travel_count = $travel->count();

        // slice Array, if start and limit is given
        if ( sizeof($request->input('start')) > 0 && sizeof($request->input('limit')) > 0 ) {

            $start = intval($request->input('start'));
            $limit = intval($request->input('limit'));

            $travel = array_slice ( $travel->toArray() , $start, $limit );
            $paginate = [ 'start' => $start, 'limit' => $limit ];
            $travel_count = sizeof($travel);

        }


        return response()->json(['data' => $travel, 'paginate' => $paginate, 'status' => 'success', 'total' => $travel_count]);
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

        $user = User::where('email', $request->userEmail)->first();

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

            //\Mail::to($user)->send(new ConfirmUser($user));

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


        $departure = (isset($request->departureTime)) ? Carbon::createFromFormat('Y-m-d H:i:s', $request->departureTime) : null;
        $passenger = (isset($request->passenger)) ? $request->passenger : null;
        $cost = (isset($request->cost)) ? $request->cost : null;
        $phone_number = $request->phoneNumber;
        $contact_email = $request->contactEmail;

        if (!$phone_number && !$contact_email) {

            return response()->json(['status' => 'error', 'message' => 'unprocessable entity. at least a phone number or a contact e-email must be specified.', 'code' => 422], 422);

        }

        $travel = new Travel([
            'description' => $request->description,
            'departure_time' => $departure,
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

        TravelContact::create([
            'travel_id' => $travel->id,
            'organisation' => $request->organisation,
            'name' => $request->contactName,
            'phone_number' => $request->phoneNumber,
            'email' => $request->contactEmail
        ]);

        if ($request->travelType === 'offer') {

            TravelOffer::create([
                'travel_id' => $travel->id,
                'passenger' => $passenger,
                'cost' => $cost
            ]);

        } else if ($request->travelType === 'request') {

            TravelRequest::create([
                'travel_id' => $travel->id,
                'passenger' => $passenger,
                'cost' => $cost
            ]);
        }

        \Mail::to($user)->send(new ConfirmTravel($user, $travel));

        return response()->json(['data' => [ 'id' => $travel->id ], 'status' => 'success', 'total' => $travel->count()]);
    }

    public function storeStopover(Requests\CreateStopoverRequest $request, $travel_id) {

        $streetAddress = $request->route;

        if (count($request->street_number)) {
            $streetAddress .= ' ' . $request->street_number;
        }

        $stopover = new Stopover([
            'travel_id' => $travel_id,
            'lat' => $request->lat,
            'long' => $request->lng,
            'city' => $request->administrative_area_level_1,
            'street_address' => $streetAddress,
            'postcode' => $request->postal_code

        ]);

        $stopover->save();

        return redirect()->back()->with('message', ['Zwischenstopp hinzugefügt.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($destionation_id, $travel_id)
    {

        $travel = Travel::where([
            ['id', '=', $travel_id],
            ['public', '=', '1'],
            ['verified', '=', '1'],
        ])
            ->with('offer')
            ->with('request')
            ->with('stopover')
            ->with('contact')
            ->with('transportation_mean')->get();

        return response()->json(['data' => $travel, 'status' => 'success', 'total' => $travel->count()]);
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
    public function update(Requests\UpdateTravelRequest $request, $id)
    {

        $travel = Travel::find($id);
        $travel->city = $request->city;
        $travel->postcode = $request->postcode;
        $travel->street_address = $request->street_address;
        $travel->departure_time = Carbon::createFromFormat('d.m.Y H:i', $request->departure_time);
        $travel->description = $request->description;
        $travel->save();

        $travel_contact = TravelContact::where('travel_id', '=', $travel->id)->first();
        $travel_contact->organisation = $request->organisation;
        $travel_contact->name = $request->name;
        $travel_contact->email = $request->email;
        $travel_contact->phone_number = $request->phone_number;
        $travel_contact->save();

        return redirect()->back()->with('message', ['Änderungen gespeichert.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $offer = TravelOffer::where('travel_id', '=', $id)->first();

        if ($offer) {
            $offer->delete();
        } else {
            $request = TravelRequest::where('travel_id', '=', $id)->first();

            if ($request) {
                $request->delete();
            }
        }

        Stopover::where('travel_id', '=', $id)->delete();
        TravelContact::where('travel_id', '=', $id)->delete();

        $travel = Travel::findOrFail($id);

        if ($travel) {
            $travel->delete();
        }

        return response()->json(['status' => 'success']);
    }

    public function setPublicValue(Request $request, $id) {

        $value = ( $request->state === 'true') ? 1 : 0;
        $travel = Travel::find($id);
        $travel->public = $value;
        $travel->save();

        return $request->state;
    }
}
