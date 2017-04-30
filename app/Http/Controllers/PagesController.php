<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Travel;

class PagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = \Auth::user();
        $travel = null;

        if ($user)
        {
            if ($user->hasRole('user')) {

                $travel = Travel::where('user_id', '=', $user->id)->with('offer')->with('request')->with('destination')->with('transportation_mean')->orderBy('created_at', 'desc')->paginate(15);

            } else {

                $travel = Travel::with('offer')->with('request')->with('destination')->with('transportation_mean')->orderBy('created_at', 'desc')->paginate(15);

            }
        }

        return view('travel', ['travel' => $travel]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = \Auth::user();
        $travel = null;

        if ($user)
        {
            if ($user->hasRole('user')) {

                $travel = Travel::where([['user_id', '=', $user->id], ['id', '=', $id]])->with('offer')->with('request')->with('destination')->with('transportation_mean')->first();

            } else {

                $travel = Travel::where('id', '=', $id)->with('offer')->with('request')->with('destination')->with('transportation_mean')->first();

            }
        }


        return view('travel-details', ['travel' => $travel]);
    }

}
