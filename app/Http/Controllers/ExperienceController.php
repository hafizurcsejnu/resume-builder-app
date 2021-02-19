<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $data = Experience::where([
            'user_id' => session('user.id'), 
            'resume_id' => session('resume_id')
            ])->get(); 
        if(count($data)) 
        { 
            return view('experience_list', ['data'=>$data]);
        }
        else{
            return view('experience');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('experience');
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
        
        $data = new Experience;
        $data->user_id = session('user.id');
        $data->resume_id = session('resume_id');
        $data->job_title = $request->job_title;
        $data->employer = $request->employer;
        $data->city = $request->city; 
        $data->state = $request->state;     
        $data->start_date = $request->start_date; 
        $data->end_date = $request->end_date;               
        $data->still_working = $request->still_working;
        $data->save();
        $experience_id= $data->id;

        session()->put('job_title', $request->job_title);
        session()->put('experience_id', $experience_id);
       
        return redirect()->route('experience-details')->with(session()->flash('alert-success', 'Work experience has been saved successfully!'));
    }
    public function experienceDetails(){
        $collection = DB::table('jobs')
         ->where('title', session('job_title'))
        ->orderBy('id', 'asc')
        ->get();

        return view('experience_details', ['data'=>$collection]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function show(experience $experience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Experience::find($id); 
        if($data) 
        {
            return view('experience_edit', ['data'=>$data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = Experience::find($request->id);
        $data->job_title = $request->job_title;
        $data->employer = $request->employer;
        $data->city = $request->city; 
        $data->state = $request->state;     
        $data->start_date = $request->start_date; 
        $data->end_date = $request->end_date;               
        $data->still_working = $request->still_working;
        $data->save();        
        $experience_id= $data->id;

        session()->put('job_title', $request->job_title);
        session()->put('experience_id', $experience_id);

        $exp_description = Experience::find($experience_id); 
        if($exp_description->description != null) 
        {
            //dd($exp_description->description);
            $collection = DB::table('jobs')
            ->where('title', session('job_title'))
            ->orderBy('id', 'asc')
            ->get();
            if(!count($collection)){
                $collection = DB::table('jobs')
                    ->orderBy('id', 'asc')
                    ->get();
            }
            return view('experience_details_edit', ['data'=>$collection, 'exp_description'=> $exp_description->description]);
        }else{
            
            $collection = DB::table('data_experiences')
            ->where('job_title', session('job_title'))
            ->orderBy('id', 'asc')
            ->get();

            return view('experience_details', ['data'=>$collection]);
        }

        return redirect()->route('experience-details')->with(session()->flash('alert-success', 'Work experience has been updated successfully!'));
    }

    public function find_experience(Request $request){  

            if($request->ajax())
            {
            $output = '';
            
            $action_word = $request->get('action_word');
            $soft_skill = $request->get('soft_skill');
            $job_title = $request->get('job_title');
            //dd($soft_skill);

            if($soft_skill != '' && $action_word != '' && $job_title != '')
            {
                $i=1;
                $data = DB::table('data_experiences')
                ->where('soft_skill', $soft_skill)
                ->where('word', $action_word)
                ->where('job_title', $job_title)
                ->get();                
            }          
           
            elseif($job_title != ''  &&  $action_word != '' && $soft_skill == '' )
            {
                $i=2;
                $data = DB::table('data_experiences')
                ->where('job_title', $job_title)
                ->where('word', $action_word)                
                ->get();                
            }           
            elseif($job_title != ''  &&  $action_word == '' && $soft_skill != '' )
            {
                $i=3;
                $data = DB::table('data_experiences')
                ->where('job_title', $job_title)
                ->where('soft_skill', $soft_skill)                
                ->get();                
            }           
            elseif($job_title == ''  &&  $action_word != '' && $soft_skill != '' )
            {
                $i=4;
                $data = DB::table('data_experiences')
                ->where('word', $action_word)
                ->where('soft_skill', $soft_skill)                
                ->get();                
            }           
           
           
            elseif($job_title != '' && $soft_skill == ''  && $action_word == '' )
            {
                $i=5;
                $data = DB::table('data_experiences')
                ->where('job_title', $job_title)
                ->get();                
            }
            elseif($action_word != '' && $soft_skill == '' && $job_title == '' )
            {
                $i=6;
                $data = DB::table('data_experiences')
                ->where('word', $action_word)
                ->get();                
            }
            elseif($soft_skill != '' && $job_title == '' && $action_word == '' )
            {
                $i=7;
                $data = DB::table('data_experiences')
                ->where('soft_skill', $soft_skill)
                ->get();                
            }
            
            
            else
            {                
                $i=8;
                $data = DB::table('data_experiences')
                ->where('job_title', session('job_title'))
                ->orderBy('id', 'asc')
                ->get();
            }
            $total_row = $data->count();
            if($total_row > 0)
            {
                foreach($data as $item)
                {
                    $output .= '<a type="button" id="task_id'.$item->id.'"  class="task_id text-500 text-95"> 
                    <div class="tasks_item">              
                    <button type="button" class="btn-icon btn-icon-primary rounded-circle"><i class="icon-add fas fa-plus"></i></button>
                    
                    <p>'.$item->task.'</p>              
                    </div>
                    </a>';
                }
            }
            else
            {
                $output = '
                <tr>
                    <td align="center" colspan="5">No Data Found</td>
                </tr>
                ';
            }
            $data = array(
            'zone'  => $i,
            'table_data'  => $output,
            'total_data'  => $total_row,
            'job_title'  => $job_title,
            'action_word'  => $action_word,
            'soft_skill'  => $soft_skill
            );

            echo json_encode($data);
            }


        
    }

    public function updateExperienceDescription(Request $request)
    {
        $data = Experience::find(session('experience_id'));       
        $data->description = $request->description;
        $data->save();

        return redirect()->route('experience')->with(session()->flash('alert-success', 'Work experience has been updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        $data = Experience::find($id);
        $data->delete();

        return redirect()->back()->with(session()->flash('alert-success', 'experience has been deleted successfully.'));
    }
}
