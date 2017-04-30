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

        $travel = Travel::with('offer')->with('request')->with('destination')->with('transportation_mean')->orderBy('created_at', 'desc')->paginate(15);
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
        $travel = Travel::where('id', '=', $id)->with('offer')->with('request')->with('destination')->with('transportation_mean')->first();
        return view('travel-details', ['travel' => $travel]);
    }

}
