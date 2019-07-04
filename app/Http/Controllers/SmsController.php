<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('sms.index', compact('contacts'));
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
        // $recipients = $request->input('recipients');
        // $recipient = implode(', ', $recipients);
        

        // $client = new \GuzzleHttp\Client();
        // $client = $client->post('https://api.semaphore.co/api/v4/messages',
        //  [ 'form_params' => 
        //     [ 'apikey' => env('SEMAPHORE_KEY'), 'number' => $recipient, 'message' => $request->input('message'), 'sendername' => 'MilasLechon']
        // ]);
        
         $recipients = $request->input('recipients');
        
        
        foreach($recipients as $recipient){
            
            $message = $request->input('message');
            
            if (strpos($message, '[name]') !== false) {
                $contact = Contact::where('phone_no', $recipient)->first();
                $message = str_replace("[name]", $contact != null ? $contact->name : '', $message);
            }
            $client = new \GuzzleHttp\Client();
            $client = $client->post('https://api.semaphore.co/api/v4/messages',
             [ 'form_params' => 
                [ 'apikey' => env('SEMAPHORE_KEY'), 'number' => $recipient, 'message' => $message, 'sendername' => 'MilasLechon']
            ]);
            
        }

        
        
        

        $request->session()->flash('status', 'SMS sent successfully!');
        return redirect()->action('SmsController@index');
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
}
