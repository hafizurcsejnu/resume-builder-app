<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $activity = Activity::where([
            'user_id' => session('user.id'), 
            'resume_id' => session('resume_id')
            ])->first(); 
          
        if($activity) 
        { 
            $collection = DB::table('data_activities')
            ->orderBy('id', 'asc')
            ->get();
            // $collection = DB::table('data_activities')->distinct()->get(['column_name']);

            return view('extra-curricular', ['data'=>$collection, 'description' => $activity->description]);
        }
        else{
            $collection = DB::table('data_activities')
            ->orderBy('id', 'asc')
            ->get();

            return view('extra-curricular', ['data'=>$collection]);
        }

        
    }

    public function store(Request $request)
    {
        $data = new Activity;
        $data->user_id = session('user.id');
        $data->resume_id = session('resume_id');
        $data->description = $request->description;
        $data->save();
        $activity_id= $data->id;
        
        session()->put('activity_id', $activity_id);
       
        return redirect()->route(session('next_url'))->with(session()->flash('alert-success', 'activitys has been saved successfully!'));
    }

    public function update(Request $request)    
    {
        $data = Activity::where([
            'user_id' => session('user.id'), 
            'resume_id' => session('resume_id')
            ])->first();      
        $data->description = $request->description;
        $data->save();

        return redirect()->route(session('next_url'))->with(session()->flash('alert-success', 'Activity has been updated successfully!'));
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
