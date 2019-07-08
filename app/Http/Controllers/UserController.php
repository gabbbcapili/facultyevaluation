<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use Validator;
use Faker\Factory;
use App\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();
            $user->update(['active' => false]);
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'User '. $user->getFullName() . ' successfully deleted!'
                    ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). " Line:" . $e->getLine(). " Message:" . $e->getMessage());
            $output = ['success' => 0,
                        'msg' => 'Sorry something went wrong.'
                    ];
             DB::rollBack();
        }
        return response()->json($output);
    }

    public function delete(User $user){
        $action = action('UserController@destroy', $user->id);
        $title = 'user ' . $user->getFullName();
        return view('layouts.delete', compact('action' , 'title'));
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
        try {
        DB::beginTransaction();
        $user = request()->user();
        $user->password = Hash::make($request->NewPassword);
        $user->save(); 
        DB::commit();
        $output = ['success' => 1,
                        'msg' => 'Successfully changed password!'
                    ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). " Line:" . $e->getLine(). " Message:" . $e->getMessage());
            $output = ['success' => 0,
                        'msg' => 'Sorry something went wrong.'
                    ];
             DB::rollBack();
        }
        return response()->json($output);
    }

// test functions
    public function createStudents(){
        $user = factory(User::class, 100)->create();
        dd($user);
    }
}
