<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $skill = Skill::where([
            'user_id' => session('user.id'), 
            'resume_id' => session('resume_id')
            ])->first(); 
          
        if($skill) 
        { 
            $collection = DB::table('data_skills')
            ->orderBy('id', 'asc')
            ->get();
            // $collection = DB::table('data_skills')->distinct()->get(['column_name']);

            return view('skills', ['data'=>$collection, 'description' => $skill->description]);
        }
        else{
            $collection = DB::table('data_skills')
            ->orderBy('id', 'asc')
            ->get();

            return view('skills', ['data'=>$collection]);
        }

        
    }

    public function store(Request $request)
    {
        $data = new Skill;
        $data->user_id = session('user.id');
        $data->resume_id = session('resume_id');
        $data->description = $request->description;
        $data->save();
        $skill_id= $data->id;
        
        session()->put('skill_id', $skill_id);
       
        return redirect()->route(session('next_url'))->with(session()->flash('alert-success', 'Skills has been saved successfully!'));
    }

    public function update(Request $request)    
    {
        $data = Skill::where([
            'user_id' => session('user.id'), 
            'resume_id' => session('resume_id')
            ])->first();      
        $data->description = $request->description;
        $data->save();

        return redirect()->route(session('next_url'))->with(session()->flash('alert-success', 'Skills has been updated successfully!'));
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
   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        //
    }
}
