<?php

namespace App\Http\Controllers;

use App\Section;
use App\Course;
use App\Department;
use App\Utilities;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Validator;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->ajax()) {
           $section = Section::with('course', 'course.department')
                            ->select('sections.id', 'sections.name', 'sections.course_id')
                            ->where('sections.is_deleted', false);
            return Datatables::eloquent($section)
                ->addColumn('no_of_students', function(Section $section) {
                            return $section->course->students->count();
                        })
                ->addColumn('action', function(Section $section) {
                            $html = Utilities::editButton(action('SectionController@edit', [$section->id]));
                            $html .= Utilities::deleteButton(action('SectionController@delete', [$section->id]));
                            return $html;
                        })
                ->addColumn('department', function(Section $section) {
                           return $section->course->department ? $section->course->department->name : '--';
                        })
                ->addColumn('course', function(Section $section) {
                           return $section->course ? $section->course->name : '--';
                        })
                ->make(true);
        }
        return view('section.index');
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all()->where('is_deleted', false);
        return view('section.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => ['required', 'unique:sections,name'],
                                                        'course_id' => ['required', 'exists:courses,id']]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        try {
            DB::beginTransaction();
            Section::create($request->all());
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Section added successfully!'
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
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        $departments = Department::all()->where('is_deleted', false);
        return view('section.edit', compact('section', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $validator = Validator::make($request->all(), ['name' => ['required', 'unique:sections,name'],
                                                        'course_id' => ['required', 'exists:courses,id']]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        try {
            DB::beginTransaction();
            $section->update($request->all());
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Section updated successfully!'
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

    public function destroy(Section $section)
    {
        try {
            DB::beginTransaction();
            $section->update(['is_deleted' => true]);
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Section successfully deleted!'
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
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function delete(Section $section)
    {
        $action = action('SectionController@destroy', $section->id);
        $title = 'section ' . $section->name;
        return view('layouts.delete', compact('action' , 'title'));
    }
}
