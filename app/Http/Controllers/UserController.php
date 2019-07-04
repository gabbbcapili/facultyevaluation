<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
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

    public function changePasswordForm(){
        return vieW('user.changePassword');
    }

    public function changePasswordUpdate(Request $request){
        if (!(Hash::check($request->get('CurrentPassword'), Auth::user()->password))) {
            return response()->json(['error' => ['CurrentPassword' => 'Your entry does not match your current password.']]);
        }
        $validator = Validator::make($request->all(), [
            'CurrentPassword' => 'required',
            'NewPassword' => 'required|min:6',
            'ConfirmPassword' => 'required|same:NewPassword',
        ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()]);
        }
        $user = request()->user();
        $user->password = Hash::make($request->NewPassword);
        $user->save();
        return response()->json(['success' => 'Successfully changed password!']);

    }
}
