<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransportationMean;
use Illuminate\Support\Facades\DB;

class TransportationMeanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TransportationMean::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByTravelId(Request $request, $travel_id)
    {


        $tm = DB::table('transportation_means')
            ->leftJoin('travels', function ($leftJoin) use ($travel_id) {
                $leftJoin->on('transportation_means.id', '=', 'travels.transportation_mean_id')
                    ->where('travels.destination_id', '=', $travel_id);
            })
            ->where('destination_id', '!=', null)
            ->select('transportation_means.id', 'transportation_means.  name')
            ->get();


        return $tm;
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
