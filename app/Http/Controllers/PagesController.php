<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Travel;
use App\EmailTemplate;

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
                    })->with($request->kind)->with('destination')->with('transportation_mean')->orderBy('created_at', 'desc')->paginate(30);



                } else {

                    $travel = Travel::where('user_id', '=', $user->id)->with('offer')->with('request')->with('destination')->with('transportation_mean')->orderBy('created_at', 'desc')->paginate(30);

                }
            } else {

                if ($request->kind) {

                    $travel = Travel::whereHas($request->kind, function ($query) {
                        $query->where('id', '>', 0);
                    })->with($request->kind)->with('destination')->with('transportation_mean')->orderBy('created_at', 'desc')->paginate(15);

                } else {

                    $travel = Travel::with('offer')->with('request')->with('stopover')->with('destination')->with('transportation_mean')->orderBy('created_at', 'desc')->paginate(30);

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

        return view('travel-details', ['travel' => $travel]);

    }

}
