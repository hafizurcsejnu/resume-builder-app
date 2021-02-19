<?php

namespace App\Http\Controllers;

use App\Models\DataAwardSchool;
use Illuminate\Http\Request;

class DataAwardSchoolController extends Controller
{
   
    
    public function index()
    {
        $data = DataAwardSchool::orderBy('id', 'desc')->get();
        return view('admin.award_school', ['data'=>$data]);
    }     
    
    
    public function store(Request $request)
    {
        $data = new DataAwardSchool;
        $data->name = $request->name;
        $data->save();

        return redirect()->back()->with(session()->flash('alert-success', 'Data has been inserted successfully.'));        
    }

    public function update(Request $request)    {        
        
        $data = DataAwardSchool::find($request->id);
        $data->name = $request->name;
        $data->save(); 

        return redirect()->back()->with(session()->flash('alert-success', 'Data has been updated successfully.'));
    }

    public function destroy($id)
    {       
        $data = DataAwardSchool::find($id);
        $data->delete();

        return redirect()->back()->with(session()->flash('alert-success', 'Data has been deleted successfully.'));
    }

    
    
}
