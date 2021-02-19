<?php

namespace App\Http\Controllers;

use App\Models\DataDegreeProgram;
use Illuminate\Http\Request;

class DataDegreeProgramController extends Controller
{
   
    
    public function index()
    {
        $data = DataDegreeProgram::orderBy('id', 'desc')->get();
        return view('admin.degree_programs', ['data'=>$data]);
    }     
    
    
    public function store(Request $request)
    {
        $data = new DataDegreeProgram;
        $data->name = $request->name;
        $data->save();

        return redirect()->back()->with(session()->flash('alert-success', 'Data has been inserted successfully.'));        
    }

    public function update(Request $request)    {        
        
        $data = DataDegreeProgram::find($request->id);
        $data->name = $request->name;
        $data->save(); 

        return redirect()->back()->with(session()->flash('alert-success', 'Data has been updated successfully.'));
    }

    public function destroy($id)
    {       
        $data = DataDegreeProgram::find($id);
        $data->delete();

        return redirect()->back()->with(session()->flash('alert-success', 'Data has been deleted successfully.'));
    }

    
    
}
