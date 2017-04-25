<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Validator;
use Redirect;
use Session;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::select('id', 'name','email')->where('id','=', Auth::user()->id)->first();
        return view('cms.pages.my_account', compact("user"));
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $rule = [
            'name' => 'required|alpha_spaces',
            'password' => array(
                                  'min:8',
                                  'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).+$/',
                                  'same:cpassword',
                                  'user_password_old',
                                  'required_with:cpassword',
                                  'different:email'
                            ),
            'cpassword' => 'required_with:password|same:password',
            'opassword' => 'required_with:password|user_password'
        ];

        $friendly_names = [
            'name' => 'name',
            'password' => 'password',
            'cpassword' => 'confirm password',
            'opassword' => 'old password'
        ];

        $validator = Validator::make($request->all(),$rule);
        $validator->setAttributeNames($friendly_names);

        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput($request->all());
        }

        $update_data = [
            'name' => trim($request['name'])
        ];

        if($request['password']){
            $update_data['password'] = bcrypt($request['password']);
        }

        User::where('id','=',Auth::user()->id)->update($update_data);

        Session::flash('success', '1');

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
