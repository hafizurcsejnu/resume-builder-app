<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $data = Education::where([
            'user_id' => session('user.id'), 
            'resume_id' => session('resume_id')
            ])
            ->orderBy('id', 'desc')
            ->get();             
        if(count($data)) 
        { 
            return view('education_list', ['data'=>$data]);
        }
        else{  
            return view('education');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('education');
    }
    public function addSchool()
    {
        $awards = DB::table('data_award_schools')
            ->orderBy('id', 'asc')
            ->get();
        $schools = DB::table('data_high_schools')
            ->orderBy('id', 'asc')
            ->get();

        return view('education_school', ['awards'=>$awards, 'schools'=>$schools]);
    }
    public function addCollege()
    {
        $awards = DB::table('data_award_colleges')
            ->orderBy('id', 'asc')
            ->get();
        $colleges = DB::table('data_colleges')
            ->orderBy('id', 'asc')
            ->get();

        return view('education_college', ['awards'=>$awards, 'colleges'=>$colleges]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return 'ok';               
        $request->validate([
            'school_name'=>'required',
            'city'=>'required',
            'degree_program'=>'required'
        ]);
        $data = new Education;
        $data->user_id = session('user.id');
        $data->resume_id = session('resume_id');
        $data->school_name = $request->school_name;
        $data->city = $request->city;
        $data->state = $request->state;
        $data->country = $request->country;
        $data->degree_program = $request->degree_program; 
        $data->field_of_study = $request->field_of_study; 
        $data->start_date = $request->start_date;         
        $data->end_date = $request->end_date;            
        $data->still_enrolled = $request->still_enrolled;               
        $data->education_type = $request->education_type; 
        $data->awards = $request->description; 
        $data->save();

        return redirect()->route('education')->with(session()->flash('alert-success', 'Education data is saved successfully!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function show(Education $education)
    {
        //
    }

    public function find_college(Request $request){
        $college = DB::table('data_colleges')
            ->where('name', $request->name)
            ->first();
        // dd($college);
        return response()->json(['success'=>true,'data'=>$college]);
        return $college;
    }

    public function find_school(Request $request){
        $school = DB::table('data_high_schools')
            ->where('name', $request->name)
            ->first();
        // dd($school);
        return response()->json(['success'=>true,'data'=>$school]);
    }

    public function find_state(Request $request){
        $state = DB::table('city_states')
            ->where('state_city', $request->name)
            ->first();
        // dd($state);
        return response()->json(['success'=>true,'data'=>$state]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data = Education::find($id);
        $education_type = $data->education_type;


        if($education_type == 'school') 
        {
            $awards = DB::table('data_award_schools')
            ->orderBy('id', 'asc')
            ->get();

            $schools = DB::table('data_high_schools')
            ->orderBy('id', 'asc')
            ->get();
            
            return view('education_edit', ['data'=>$data, 'awards'=>$awards, 'schools'=>$schools]);
        }
        else{

            $awards = DB::table('data_award_colleges')
            ->orderBy('id', 'asc')
            ->get();
            $colleges = DB::table('data_colleges')
            ->orderBy('id', 'asc')
            ->get();

            return view('education_edit', ['data'=>$data, 'awards'=>$awards, 'colleges'=>$colleges]);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'school_name'=>'required',
            'city'=>'required',
            'degree_program'=>'required'
        ]);
        
        $data = Education::find($request->id);
        
        $data->school_name = $request->school_name;
        $data->city = $request->city;
        $data->state = $request->state;
        $data->country = $request->country;
        $data->degree_program = $request->degree_program; 
        $data->field_of_study = $request->field_of_study; 
        $data->start_date = $request->start_date;         
        $data->end_date = $request->end_date;            
        $data->still_enrolled = $request->still_enrolled;               
        $data->education_type = $request->education_type; 
        $data->awards = $request->description; 
        $data->save();

        return redirect()->route('education')->with(session()->flash('alert-success', 'Header data is updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        $data = Education::find($id);
        $data->delete();

        return redirect()->back()->with(session()->flash('alert-success', 'Education has been deleted successfully.'));
    }
}
