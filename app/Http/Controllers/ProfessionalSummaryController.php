<?php

namespace App\Http\Controllers;

use App\Models\ProfessionalSummary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfessionalSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professional = ProfessionalSummary::where([
            'user_id' => session('user.id'), 
            'resume_id' => session('resume_id')
            ])->first(); 
          
        if($professional) 
        { 
            $collection = DB::table('data_professional_summaries')
            ->orderBy('id', 'asc')
            ->get();

            return view('professional', ['data'=>$collection, 'professional_summary' => $professional->description]);
        }
        else{
            $collection = DB::table('data_professional_summaries')
            ->orderBy('id', 'asc')
            ->get();

            return view('professional', ['data'=>$collection]);
        }

        
    }

    public function store(Request $request)
    {
        $data = new ProfessionalSummary;
        $data->user_id = session('user.id');
        $data->resume_id = session('resume_id');
        $data->description = $request->description;
        $data->save();
        $professional_id= $data->id;
        
        session()->put('professional_id', $professional_id);        
       
        return redirect()->route(session('next_url'))->with(session()->flash('alert-success', 'professional has been saved successfully!'));
    }

    public function update(Request $request)    
    {
        $data = ProfessionalSummary::where([
            'user_id' => session('user.id'), 
            'resume_id' => session('resume_id')
            ])->first();      
        $data->description = $request->description;
        $data->save();

        //dd(session('next_url'));

        return redirect()->route(session('next_url'))->with(session()->flash('alert-success', 'professional has been updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfessionalSummary  $professionalSummary
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfessionalSummary $professionalSummary)
    {
        //
    }
}
