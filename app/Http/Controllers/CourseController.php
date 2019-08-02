<?php

namespace App\Http\Controllers;

use App\Course;
use App\Department;
use App\Utilities;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->ajax()) {
           $course = Course::with('department')
                            ->select('id','name', 'department_id')
                            ->where('is_deleted', false);
            return Datatables::eloquent($course)
                ->addColumn('no_of_students', function(Course $course) {
                            return $course->students->count();
                        })
                ->addColumn('action', function(Course $course) {
                            $html = Utilities::editButton(action('CourseController@edit', [$course->id]));
                            $html .= Utilities::deleteButton(action('CourseController@delete', [$course->id]));
                            return $html;
                        })
                ->addColumn('department', function(Course $course) {
                           return $course->department ? $course->department->name : '--';
                        })
                ->make(true);
        }
        return view('course.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all()->where('is_deleted', false);
        return view('course.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => ['required', 'unique:courses,name'],
                                                        'department_id' => ['required', 'exists:department,id']]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        try {
            DB::beginTransaction();
            Course::create($request->all());
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Course added successfully!'
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
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $departments = Department::all()->where('is_deleted', false);
        return view('course.edit', compact('departments', 'course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $validator = Validator::make($request->all(), ['name' => ['required', 'unique:courses,name,' . $course->id],
                                                        'department_id' => ['required', 'exists:department,id']]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        try {
            DB::beginTransaction();
            $course->update($request->all());
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Course updated successfully!'
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        try {
            DB::beginTransaction();
            $course->update(['is_deleted' => true]);
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Course successfully deleted!'
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

    public function delete(Course $course){
        $action = action('CourseController@destroy', $course->id);
        $title = 'course ' . $course->name;
       return view('layouts.delete', compact('action' , 'title'));
    }

}
