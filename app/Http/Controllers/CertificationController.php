<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $data = Certification::where([
            'user_id' => session('user.id'), 
            'resume_id' => session('resume_id')
            ])
            ->orderBy('id', 'desc')
            ->get(); 
        if(count($data)) 
        { 
            return view('certifications', ['data'=>$data]);
        }
        else{     
            return view('certifications');
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
        $data = new Certification;
        $data->user_id = session('user.id');
        $data->resume_id = session('resume_id');
        $data->certificate_name = $request->certificate_name;
        $data->institute = $request->institute;
        $data->start_date = $request->start_date; 
        $data->end_date = $request->end_date;      
        $data->save();

        return redirect()->back()->with(session()->flash('alert-success', 'Certificate is saved successfully!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Certification  $certification
     * @return \Illuminate\Http\Response
     */
    public function show(Certification $certification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certification  $certification
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data = Certification::find($id);
        return view('certification_edit', ['data'=>$data]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Certification  $certification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = Certification::find($request->id);        
        $data->certificate_name = $request->certificate_name;
        $data->institute = $request->institute;
        $data->start_date = $request->start_date; 
        $data->end_date = $request->end_date; 
        $data->save();

        return redirect()->route('certifications')->with(session()->flash('alert-success', 'Certification is updated successfully!'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certification  $certification
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        $data = Certification::find($id);
        $data->delete();

        return redirect()->back()->with(session()->flash('alert-success', 'Certification has been deleted successfully.'));
    }
}
