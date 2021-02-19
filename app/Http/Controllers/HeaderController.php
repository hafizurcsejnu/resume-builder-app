<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Header::where([
            'user_id' => session('user.id'),
            'resume_id' => session('resume_id')
            ])->first(); 

        if($data) 
        {
            return view('header_edit', ['data'=>$data]);
        }
        else{
            return view('header');
        }
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
        $header = new Header;
        $header->user_id = session('user.id');
        $header->resume_id = session('resume_id');
        $header->first_name = $request->first_name;
        $header->last_name = $request->last_name;
        $header->city = $request->city; 
        $header->state = $request->state; 
        $header->zip = $request->zip;         
        $header->phone = $request->phone;         
        $header->email = $request->email;         
        $header->save();

        return redirect()->route('education')->with(session()->flash('alert-success', 'Header data is saved successfully!'));
    }
    public function update(Request $request)
    {
        
        $header = Header::where([
            'user_id' => session('user.id'), 
            'resume_id' => session('resume_id')
            ])->first();    
              
        $header->first_name = $request->first_name;        
        $header->last_name = $request->last_name;
        $header->city = $request->city; 
        $header->state = $request->state; 
        $header->zip = $request->zip;         
        $header->phone = $request->phone;         
        $header->email = $request->email; 
        $header->save();

        return redirect()->route('education')->with(session()->flash('alert-success', 'Header data is updated successfully!'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Header  $header
     * @return \Illuminate\Http\Response
     */
    public function show(Header $header)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Header  $header
     * @return \Illuminate\Http\Response
     */
    public function edit(Header $header)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Header  $header
     * @return \Illuminate\Http\Response
     */
   
     

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Header  $header
     * @return \Illuminate\Http\Response
     */
    public function destroy(Header $header)
    {
        //
    }
}
