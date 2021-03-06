<?php

namespace App\Http\Controllers;

use App\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Department;
use App\Course;
use App\Validation;
use Validator;
use App\Utilities;
use Hash;

class StudentController extends Controller
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
            with('department', 'course', 'section')
           ->select('users.id',
            'student_id',
            'department_id',
            'course_id',
            'section_id',
             DB::raw('CONCAT(users.last_name, ", ", users.first_name, " ", COALESCE(users.middle_name,"")) AS full_name'),
            'email', 
            'gender',
            'username',
            'contact_number')
           ->where('active', true)
           ->where('role', 'student')
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
                            $html = Utilities::editButton(action('StudentController@edit', [$user->id]));
                            $html .= Utilities::deleteButton(action('UserController@delete', [$user->id]));
                            return $html;
                        })
            ->addColumn('department', function(User $user) {
                           return $user->department ? $user->department->name : '--';
                        })
            ->addColumn('course', function(User $user) {
                           return $user->course ? $user->course->name : '--';
                        })
            ->addColumn('section', function(User $user) {
                           return $user->section ? $user->section->name : '--';
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
        $departments = Department::all()->where('is_deleted', false);
        $civil_statuses = User::getCivilStatus();
        $courses = Course::where('department_id', request()->user()->department_id)->where('is_deleted', false)->get();
        return view('user.student.create', compact('departments', 'civil_statuses', 'courses'));
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
            $data = $request->only(['department_id', 'student_id' , 'first_name', 'middle_name', 'email' , 'last_name', 'bday', 'civil_status', 'contact_number', 'gender', 'course_id', 'section_id']);
            $data['username'] = (int)$request->input('student_id');
            $data['password'] = Hash::make(Utilities::format_date($request->input('bday'), 'mdy'));
            $data['role'] = 'student';
            $user = User::create($data);
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Student added successfully!'
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
        $departments = Department::all()->where('is_deleted', false);
        $civil_statuses = User::getCivilStatus();
        return view('user.student.edit', compact('user' ,'departments', 'civil_statuses'));
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
        try {
            DB::beginTransaction();
            $data = $request->only(['department_id', 'first_name', 'middle_name', 'email' , 'last_name', 'bday', 'civil_status', 'contact_number', 'gender', 'course_id', 'section_id']);
            $user->touch();
            $user = $user->update($data);
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Student updated successfully!'
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

    public function import(){
        $departments = Department::all()->where('is_deleted', false);
        $headers = User::studentCsvHeader();
        $courses = Course::where('department_id', request()->user()->department_id)->where('is_deleted', false)->get();
        return view('user.student.import', compact('departments', 'headers', 'courses'));
    }

    public function postImport(Request $request){
        $validator = Validator::make($request->all(), Validation::userCsvValidator());

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        if ($request->hasFile('file')) {
            try {
                $department_id = $request->input('department_id');
                $course_id = $request->input('course_id');
                $section_id = $request->input('section_id');
                $csv = array_map('str_getcsv', file($request->file));
                array_shift($csv);
                $row = 2;
                $errors = [];
                foreach($csv as $data){
                    $username = $data[0];
                    $password = Hash::make(Utilities::format_date($data[6], 'mdy'));
                    $data = [
                        'username' => $username,
                        'password' => $password,
                        'department_id' => $department_id,
                        'course_id' => $course_id,
                        'section_id' => $section_id,
                        'student_id' => $data[0],
                        'first_name' => $data[1],
                        'middle_name' => $data[2],
                        'last_name' => $data[3],
                        'email' => $data[4],
                        'contact_number' => $data[5],
                        'bday' => $data[6],
                        'gender' => $data[7],
                        'civil_status' => 'Single',
                    ];
                    $validator = Validator::make($data, Validation::userValidator());
                    if ($validator->fails()) {
                        $errors[$row] = $validator->errors();
                        continue;
                    }
                    $row += 1;
                    User::create($data);
                }   
                $output = ['success' => 1,
                            'errors' => $errors,
                        'msg' => $errors ? 'Please check for errors. Other data successfully imported.' : 'Successfully imported students.'
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

    public function getCSV(){
       $filename = 'StudentSampleCSV.csv'; 
       header("Content-Description: File Transfer"); 
       header("Content-Disposition: attachment; filename=$filename"); 
       header("Content-Type: application/csv; ");
       $file = fopen('php://output', 'w');
       $headers = User::studentCsvHeader(); 
       fputcsv($file, $headers);
       fclose($file); 
       exit;
    }







}
