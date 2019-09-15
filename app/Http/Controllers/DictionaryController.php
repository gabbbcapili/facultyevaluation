<?php

namespace App\Http\Controllers;

use App\Dictionary;
use Illuminate\Http\Request;
use Faker\Factory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Utilities;

class DictionaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ( request()->ajax()) {
           $dictionary = Dictionary::select('id','word', 'type')
                                    ->orderBy('updated_at','DESC');
            return Datatables::of($dictionary)
                ->addColumn('editType', function(Dictionary $dictionary) {
                            $html = Utilities::dictionaryDropDownType($dictionary->type, $dictionary->id);
                            return $html;
                        })
                ->rawColumns(['editType'])
                ->make(true);
        }
        return view('dictionary.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dictionary.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $validator = Validator::make($request->all(), ['word' => 'required|min:4|regex:/^[a-zA-Z]+$/u|unique:dictionary,word', 'type' => 'required']);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
            }
        try {
            DB::beginTransaction();
            $data = ['word' => strtoupper($request->input('word')), 'type' => $request->input('type')];
            Dictionary::create($data);
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Word added successfully!'
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

    public function updateType(Request $request){
         try {
            DB::beginTransaction();
            $dictionary = Dictionary::find($request->input('id'));
            $dictionary->touch();
            $dictionary->update($request->all());
            DB::commit();
            $output = ['success' => 1,
                        'msg' => 'Word updated successfully!'
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
     * @param  \App\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function show(Dictionary $dictionary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function edit(Dictionary $dictionary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dictionary $dictionary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dictionary  $dictionary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dictionary $dictionary)
    {
        //
    }
}
