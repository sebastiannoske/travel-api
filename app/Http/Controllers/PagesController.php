<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\Travel;
use App\EmailTemplate;
use Carbon\Carbon;
use Share;
use Image;
use URL;

class PagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user = \Auth::user();
        $travel = null;

        if ($user)
        {
            if ($user->hasRole('user')) {

                if ($request->kind) {

                    $travel = Travel::where('user_id', '=', $user->id)->whereHas($request->kind, function ($query) {
                        $query->where('id', '>', 0);
                    })->with($request->kind)->whereHas('destination', function ($query) {
                        $query->where('id', '=', 1);
                    })->with('destination')->with('contact')->with('transportation_mean')->orderBy('created_at', 'desc')->paginate(100);



                } else {

                    $travel = Travel::where('user_id', '=', $user->id)->with('offer')->with('contact')->with('request')->whereHas('destination', function ($query) {
                        $query->where('id', '=', 1);
                    })->with('destination')->with('transportation_mean')->orderBy('created_at', 'desc')->paginate(100);

                }
            } else {

                if ($request->kind) {

                    $travel = Travel::whereHas($request->kind, function ($query) {
                        $query->where('id', '>', 0);
                    })->with($request->kind)->with('contact')->whereHas('destination', function ($query) {
                        $query->where('id', '=', 1);
                    })->with('destination')->with('transportation_mean')->orderBy('created_at', 'desc')->paginate(100);

                } else {

                    $travel = Travel::with('offer')->with('contact')->with('request')->with('stopover')->whereHas('destination', function ($query) {
                        $query->where('id', '=', 1);
                    })->with('destination')->with('transportation_mean')->orderBy('created_at', 'desc')->paginate(100);

                }

            }

            foreach ( $travel as $current_travel ) {

                $current_travel->dateHuman = $current_travel->created_at->diffForHumans();
                $current_travel->label = 'switch-' . $current_travel->id;
                $current_travel->editURL = '/edit-travel/' . $current_travel->id;
                $current_travel->isPublic = $current_travel->public;
                $current_travel->isVerified = $current_travel->verified;
                if ($current_travel->contact) {
                    $current_travel->userData = $current_travel->contact->organisation . ' ' . $current_travel->contact->name . ' ' . $current_travel->contact->email . ' ' . $current_travel->street_address;
                }

            }


            return view('travel', ['travel' => $travel, 'kind' => $request->kind]);

        } else {

            return redirect('/login');

        }



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editTravel($id)
    {

        $user = \Auth::user();
        $travel = null;

        if ($user)
        {
            if ($user->hasRole('user')) {

                $travel = Travel::where([['user_id', '=', $user->id], ['id', '=', $id]])->with('stopover')->with('offer')->with('request')->with('contact')->with('destination')->with('transportation_mean')->first();

            } else {

                $travel = Travel::where('id', '=', $id)->with('stopover')->with('offer')->with('request')->with('contact')->with('destination')->with('transportation_mean')->first();

            }
        }

        return view('travel-edit', ['travel' => $travel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editUser()
    {

        $user = \Auth::user();

        return view('user-edit', ['user' => $user]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editUserById(Request $request, $user_id)
    {

        $auth_user = \Auth::user();
        $user = null;

        if ($auth_user) {

            if ($auth_user->hasRole('admin')) {

                $user = User::find($user_id);

            }

        }

        return view('user-edit', ['user' => $user]);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editAllUser(Request $request)
    {

        $user = \Auth::user();
        $users = null;

        if ($user) {

            if ($user->hasRole('admin')) {

                $users = User::with('roles')->with('travel')->paginate(30);
            }
        }

        return view('users-management', ['users' => $users, 'kind' => $request->kind]);

    }

    public function fileUpload(Request $request)

    {

        $this->validate($request, [

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);


        $image = $request->file('image');

        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('/images');

        $image->move($destinationPath, $input['imagename']);

        $user = \Auth::user();
        $event = null;

        if ($user) {

            if ($user->hasRole('admin')) {

                $event = Event::find(1);
                $event->imagePath = URL::to('/').'/images/'.$input['imagename'];
                $event->save();

            }
        }


        return back()->with('success','Image Upload successful');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editSettings(Request $request)
    {

        $user = \Auth::user();
        $event = null;

        if ($user) {

            if ($user->hasRole('admin')) {

                $event = Event::where('id', '=', 1)->with('destinations')->first();
            }
        }

        return view('settings', ['event' => $event]);

    }

    public function editEmails() {

        $user = \Auth::user();
        $templates = null;

        if ($user) {

            if ($user->hasRole('admin')) {

                $templates = EmailTemplate::all();

            }

        }

        return view('email-edit', ['templates' => $templates]);

    }

    public function createUser() {

        $auth_user = \Auth::user();
        $user = null;

        if ($auth_user) {

            if ($auth_user->hasRole('admin')) {

                return view('user-create', ['user' => $user]);

            }

        }

        return redirect()->back()->with('error', ['Du hast nicht die nötigen Rechte einen neuen Benutzer anzulegen.']);

    }


    /**
     * Show content for a travel bei url_token.
     *
     * @param  int  $url_token
     * @return \Illuminate\Http\Response
     */
    public function showByUrlToken($url_token) {

        $travel = Travel::where([
            ['url_token', '=', $url_token],
            ['public', '=', '1'],
            ['verified', '=', '1'],
        ])->with('stopover')->with('offer')->with('request')->with('contact')->with('destination')->with('transportation_mean')->first();

        $share = Share::load('https://mfz.wir-haben-es-satt.de/travel/' . $travel->url_token , 'Mitfahrzentrale')->services('facebook', 'gplus', 'twitter');

        return view('travel-details', ['travel' => $travel, 'share' => $share]);

    }

}
