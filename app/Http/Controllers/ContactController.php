<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Validator;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // /^\+[1-9]{1}[0-9]{3,14}$/
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_no' => ['required', 'regex:/^(09|\+639)\d{9}$/', 'unique:contacts'],
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Contact::create([
            'name' => $request->input('name'),
            'phone_no' => $request->input('phone_no'),
        ]);
        $request->session()->flash('status', 'Successfully added contact!');

        return response()->json(['success' => 'Success!']);
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
    public function edit(Contact $contact)
    {
        return view('contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $validator = Validator::make($request->all(), [
            'phone_no' => ['required', 'regex:/^(09|\+639)\d{9}$/', 'unique:contacts'],
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $contact->update([
            'name' => $request->input('name'),
            'phone_no' => $request->input('phone_no'),
        ]);
        $request->session()->flash('status', 'Successfully edited contact!');
        return response()->json(['success' => 'Success!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function delete(Contact $contact, Request $request){
        $contact->delete();
        $request->session()->flash('status', 'Successfully deleted contact!');

        return response()->json(['success' => 'success']);
    }

    public function getCSV(){
        return view('contact.CSV');
    }

    public function postCSV(Request $request){
        $validator = Validator::make($request->all(), [
            'csv' => ['required', 'mimes:csv,txt'],
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        if ($request->hasFile('csv')) {
            $csv = array_map('str_getcsv', file($request->csv));
            array_shift($csv);
            foreach($csv as $data){
                Contact::create(['phone_no' => $data[0], 'name' => $data[1]]);
            }   
            $request->session()->flash('status', 'Successfully added contacts!');
        }
        return response()->json(['success' => 'success']);
    }
}
