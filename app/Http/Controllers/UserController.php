<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Hashing\BcryptHasher;
use App\User;

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
    public function create()
    {
        //
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
