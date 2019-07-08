<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Faker\Factory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Utilities;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->ajax()) {
           $departments = Department::select('id','name', 'is_deleted')
                                    ->where('is_deleted', false);
            return Datatables::of($departments)
                ->addColumn('no_of_students', function(Department $department) {
                            return $department->students->count();
                        })
                ->addColumn('no_of_faculty', function(Department $department) {
                            return $department->faculty->count();
                        })
                ->addColumn('action', function(Department $department) {
                            $html = Utilities::editButton(action('DepartmentController@edit', [$department->id]));
                            $html .= Utilities::deleteButton(action('DepartmentController@delete', [$department->id]));
                            return $html;
                        })
                ->make(true);
        }
        return view('department.index');
    }

    public function test(){
        dd(Department::first()->update(['name', 'test']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => 'required']);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
            }
        try {
            DB::beginTransaction();
            Department::create($request->all());
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Department added successfully!'
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
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $validator = Validator::make($request->all(), ['name' => 'required']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
            }
        try {
            DB::beginTransaction();
            $department->update($request->all());
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Department updated successfully!'
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
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
         try {
            DB::beginTransaction();
            $department->update(['is_deleted' => true]);
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Department successfully deleted!'
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

    public function delete(Department $department){
        $action = action('DepartmentController@destroy', $department->id);
        $title = 'department ' . $department->name;
       return view('layouts.delete', compact('action' , 'title'));
    }
}
