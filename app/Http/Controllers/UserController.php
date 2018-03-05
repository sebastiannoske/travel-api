<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\UserConfirmed;
use App\Http\Requests;
use Illuminate\Hashing\BcryptHasher;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Requests\UpdateUserRequest $request)
    {
        //
        $user = User::where('email', $request->email)->first();

        if (!$user) {

            $pw = str_random(10);

            $user = User::firstOrCreate([
                'email' => $request->email,
                'password' => bcrypt($pw),
                'name' => $request->name,
                'street_address' => $request->street_address,
                'postcode' => $request->postcode,
                'city' => $request->city,
                'phone_number' => $request->phone_number
            ]);

            $user->verified = true;
            $user->token = null;
            $user->save();

            DB::table('role_user')->insert(
                ['user_id' => $user->id, 'role_id' => 3]
            );

            \Mail::to($user)->send(new UserConfirmed($user, $pw));


            // assign user to event
            /* $user_event = new UsersEvent(
                [
                    'event_id' => $event_id,
                    'user_id' => $user_id
                ]
            );

            $user_event->save(); */

            return redirect()->back()->with('message', ['Benutzer angelegt.']);

        }

        return redirect()->back()->with('error', ['EMail-Adresse bereits vorhanden.']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Requests\UpdateUserRequest $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->city = $request->city;
        $user->postcode = $request->postcode;
        $user->street_address = $request->street_address;

        $user->save();

        return redirect()->back()->with('message', ['Änderungen gespeichert.']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Requests\UpdatePasswordRequest $request, $id)
    {
        //

        $user = User::find($id);
        $hasher = app('hash');

        if ($hasher->check($request->current_password, $user->password)) {

            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->back()->with('message', ['Das Passwort wurde geändert.']);

        }

        return redirect()->back()->with('error', ['Das angegebene, aktuelle Passwort ist falsch.']);

    }

    public function generateApikey(Request $request, $user_id) {

        $user = User::find($user_id);
        $user->api_token = str_random(60);
        $user->save();

        return redirect()->back()->with('message', ['Ein neuer API-Token wurde generiert.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        // todo
        return response()->json(['status' => 'success']);
    }
}
