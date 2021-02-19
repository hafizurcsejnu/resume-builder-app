<?php

namespace App\Http\Controllers;

use App\Models\DataSkill;
use Illuminate\Http\Request;

class DataSkillController extends Controller
{
   
    
    public function index()
    {
        $data = DataSkill::orderBy('id', 'desc')->get();
        return view('admin.skills', ['data'=>$data]);
    }     
    
    
    public function store(Request $request)
    {
        $data = new DataSkill;
        $data->job_title = $request->job_title;
        $data->skills = $request->skills;
        $data->save();

        return redirect()->back()->with(session()->flash('alert-success', 'Data has been inserted successfully.'));        
    }

    public function update(Request $request)    {        
        
        $data = DataSkill::find($request->id);
        $data->job_title = $request->job_title;
        $data->skills = $request->skills;
        $data->save(); 

        return redirect()->back()->with(session()->flash('alert-success', 'Data has been updated successfully.'));
    }

    public function destroy($id)
    {       
        $data = DataSkill::find($id);
        $data->delete();

        return redirect()->back()->with(session()->flash('alert-success', 'Data has been deleted successfully.'));
    }

    
    
}
