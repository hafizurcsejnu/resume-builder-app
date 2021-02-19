<?php

namespace App\Http\Controllers;

use App\Models\Additional;
use Illuminate\Http\Request;

class AdditionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $additional = Additional::where([
            'user_id' => session('user.id'), 
            'resume_id' => session('resume_id')
            ])->first(); 
          
        if($additional) 
        { 
            return view('additional', ['data'=>$additional, 'description' => $additional->description]);
        }
        else{
            return view('additional');
        }

        
    }

    public function store(Request $request)
    {
        //dd($request);
        $data = new Additional;
        $data->user_id = session('user.id');
        $data->resume_id = session('resume_id');
        $data->description = $request->description;
        $data->save();
        $additional_id= $data->id;
        
        session()->put('additional_id', $additional_id);
       
        return redirect()->route(session('next_url'))->with(session()->flash('alert-success', 'Additional information has been saved successfully!'));
    }

    public function update(Request $request)    
    {
        $data = Additional::where([
            'user_id' => session('user.id'), 
            'resume_id' => session('resume_id')
            ])->first();      
        $data->description = $request->description;
        $data->save();

        return redirect()->route(session('next_url'))->with(session()->flash('alert-success', 'Additional information has been updated successfully!'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Additional  $additional
     * @return \Illuminate\Http\Response
     */
    public function destroy(Additional $additional)
    {
        //
    }
}
