<?php

namespace App\Http\Controllers;

use App\Models\DataProfessionalSummary;
use Illuminate\Http\Request;

class DataProfessionalSummaryController extends Controller
{
   
    
    public function index()
    {
        $data = DataProfessionalSummary::orderBy('id', 'desc')->get();
        return view('admin.professional_summary', ['data'=>$data]);
    }     
    
    
    public function store(Request $request)
    {
        $data = new DataProfessionalSummary;
        $data->job_title = $request->job_title;
        $data->summary = $request->summary;
        $data->save();

        return redirect()->back()->with(session()->flash('alert-success', 'Data has been inserted successfully.'));        
    }

    public function update(Request $request)    {        
        
        $data = DataProfessionalSummary::find($request->id);
        $data->job_title = $request->job_title;
        $data->summary = $request->summary;
        $data->save(); 

        return redirect()->back()->with(session()->flash('alert-success', 'Data has been updated successfully.'));
    }

    public function destroy($id)
    {       
        $data = DataProfessionalSummary::find($id);
        $data->delete();

        return redirect()->back()->with(session()->flash('alert-success', 'Data has been deleted successfully.'));
    }

    
    
}
