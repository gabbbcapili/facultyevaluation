<?php

namespace App\Http\Controllers;

use App\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->ajax()) {
           $users = User::select(
            'student_id',
             DB::raw('CONCAT(users.last_name, ", ", users.first_name, " ", COALESCE(users.middle_name,"")) AS full_name'),
            'email', 
            'created_at')
           ->where('role', 'student');
            return Datatables::of($users)
            ->filterColumn('full_name', function($query, $keyword) {
                    $sql = "CONCAT(users.last_name, ', ', users.first_name, ' ', COALESCE(users.middle_name, ' '))  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
            ->make(true);
        }
        return view('user.student.index');
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
