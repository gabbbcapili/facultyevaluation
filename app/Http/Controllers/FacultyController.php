<?php

namespace App\Http\Controllers;

use App\User;
use App\Subject;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Department;
use App\Validation;
use Validator;
use App\Evaluation;
use App\Utilities;
use Hash;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ( request()->ajax()) {
           $users = User::
            with('department')
           ->select('id',
            'faculty_id',
            'department_id',
             DB::raw('CONCAT(users.last_name, ", ", users.first_name, " ", COALESCE(users.middle_name,"")) AS full_name'),
            'email', 
            'gender',
            'username',
            'contact_number',
            'role')
           ->where('active', true)
           ->where('role', '!=', 'student')
           ->orderBy('updated_at', 'desc');
           if($request->user()->isAdmin() == false){
                $users->where('department_id', $request->user()->department_id);
           }
            return Datatables::eloquent($users)
            ->filterColumn('full_name', function($query, $keyword) {
                    $sql = "CONCAT(users.last_name, ', ', users.first_name, ' ', COALESCE(users.middle_name, ' '))  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
            ->addColumn('action', function(User $user) {
                            $html = Utilities::editButton(action('FacultyController@edit', [$user->id]));
                            $html .= Utilities::deleteButton(action('UserController@delete', [$user->id]));
                            if($user->isFaculty()){
                                $html .= Utilities::viewButton(action('FacultyController@show', [$user->id]));
                            }
                            return $html;
                        })
            ->addColumn('department', function(User $user) {
                           return $user->department ? $user->department->name : '--';
                        })
            ->make(true);
        }
        return view('user.faculty.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all()->where('is_deleted', false);
        $civil_statuses = User::getCivilStatus();
        
        return view('user.faculty.create', compact('departments', 'civil_statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), Validation::userValidator());

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
            }
        try {
            DB::beginTransaction();
            $data = $request->only(['department_id', 'faculty_id', 'first_name', 'middle_name', 'email' , 'last_name', 'bday', 'civil_status', 'contact_number', 'gender', 'role']);
            $data['username'] = (int)$request->input('faculty_id');
            $data['password'] = Hash::make(Utilities::format_date($request->input('bday'), 'mdy'));
            $user = User::create($data);
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Faculty added successfully!'
                    ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). " Line:" . $e->getLine(). " Message:" . $e->getMessage());
            $output = ['success' => 0,
                        'msg' => env('APP_DEBUG') ? $e->getMessage() : 'Sorry something went wrong, please try again later.'
                    ];
             DB::rollBack();
        }
        return response()->json($output);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $evaluations = Evaluation::where('user_id', $user->id)->get();
        $totals = ['positve' => 0, 'negative' => 0, 'neutral' => 0];
        $words = [];
        foreach($evaluations as $evaluation){
            foreach($evaluation->list as $list){
                $totals['positve'] += $list->getTotalForPositive();
                $totals['negative'] += $list->getTotalForNegative();
                $totals['neutral'] += $list->getTotalForNeutral();
                $comments = $list->unsetInvalidComments(explode(' ', $list->comments));
                foreach($comments as $comment){
                        if(isset($words[$comment])){
                             $words[$comment] += 1;
                        }else{
                            $words[$comment] = 1;
                        }
                    }
                }
            }
        arsort($words);
        return view('user.faculty.show', compact('user', 'totals', 'words'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $departments = Department::all()->where('is_deleted', false);
        $civil_statuses = User::getCivilStatus();
        $subjects = Subject::all()->where('is_deleted', false);
        return view('user.faculty.edit', compact('user' ,'departments', 'civil_statuses', 'subjects'));
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
         $validator = Validator::make($request->all(), Validation::userValidator($user->id));
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        if(! $request->input('subjects') && $user->role == 'faculty'){
            return response()->json(['error' => ['subjects[]' => 'This field is required']]);
         }
        try {
            DB::beginTransaction();
            $data = $request->only(['department_id', 'first_name', 'middle_name', 'email' , 'last_name', 'bday', 'civil_status', 'contact_number', 'gender']);
            $user->touch();
            if($request->input('subjects') && $user->role == 'faculty'){
                $data['subjects'] = implode(',', $request->input('subjects'));
            }
            $user = $user->update($data);
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Faculty updated successfully!'
                    ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). " Line:" . $e->getLine(). " Message:" . $e->getMessage());
            $output = ['success' => 0,
                        'msg' => env('APP_DEBUG') ? $e->getMessage() : 'Sorry something went wrong, please try again later.'
                    ];
             DB::rollBack();
        }
        return response()->json($output);
    }
}
