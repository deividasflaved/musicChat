<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Rules\ValidPassword;
use Validator;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        return view('user.edit')->with('id', $id);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminindex()
    {
        return view('user.admin');
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

    public function ban(Request $request)
    {
        $user = User::where('name', $request->input('username'))->first();
        if ($user != null) {
            if ($user->userlevel == 0) {
                return redirect()->back()->with('error_msg', 'User is already banned!');
            } else {
                $user->userlevel = 0;
                $user->update();
                return redirect()->back()->with('message', 'User successfully banned!');
            }
        } else {
            return redirect()->back()->with('error_msg', "User with this username doesn't exist!");
        }
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
        if(!empty($request->newpassword) || !empty($request->oldpassword)){
            $validator = Validator::make($request->all(), [
               'oldpassword' => ['required', new ValidPassword],
               'newpassword' => 'required|min:6|max:20'
           ]);
           if ($validator->fails()) {
            return redirect('settings')
                        ->withErrors($validator)
                        ->withInput();
          }

          $newPassword = bcrypt($request['newpassword']);
          DB::table('users')
            ->where('id', $id)
            ->update(['password' => $newPassword]);
            return redirect('settings')->with('pass_message', 'Password was changed!');
        }
        else if(!empty($request->email)){
          DB::table('users')
            ->where('id', $id)
            ->update(['email' => $request->email]);
            return redirect('settings')->with('mail_message', 'E-mail was changed!');;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $request
     * @return void
     */
    public function destroy(Request $request)
    {
        //$user = User::find($request->input('username'));
        $user = User::where('name',$request->input('username')) -> first();
        if ($user != null) {
            $user->delete();
            return redirect()->back()->with('message', 'User successfully deleted!');
        } else {
            return redirect()->back()->with('error_msg', "User with this username doesn't exist!");
        }
    }
}
