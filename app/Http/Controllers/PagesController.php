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

        $travels = Travel::with('offer')->with('request')->with('destination')->with('transportation_mean')->orderBy('updated_at', 'desc')->get();
        return view('travel', ['travels' => $travels]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $travel = Travel::where('id', '=', $id)->with('offer')->with('request')->with('destination')->with('transportation_mean')->orderBy('updated_at', 'desc')->first();
        return view('travel-details', ['travel' => $travel]);
    }

}
