<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\UserSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;


class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resume = Resume::where(['user_id' => session('user.id')])
        ->orderBy('id', 'desc')
        ->get();
        if($resume)
        {
            return view('my_resumes', ['data'=>$resume]);
        }
    }
    public function preview(){
        //dd(session('resume_id'));
        $resume_id = session('resume_id');
        return redirect('/preview/'.$resume_id);
    }
    public function create(Request $request)
    {
        $request->Session()->put('temp_id', $request->temp_id);

        $template = DB::table('templates')
            ->where('id', $request->temp_id)
            ->first();
        $template_name =  $template->name;


        $resume = new Resume;
        $resume->user_id = session('user.id');
        $resume->temp_id = session('temp_id');
        $resume->name = $template_name." ".date("M-d-Y");
        $resume->save();
        $resume->id;

        $sections = DB::table('sections')
            ->orderBy('id', 'asc')
            ->get();
        foreach($sections as $section){
            $data = new UserSection;
            $data->user_id = session('user.id');
            $data->resume_id =  $resume->id;
            $data->section_id = $section->id;
            $data->sort_order = $section->sort_order;
            $data->name = $section->name;
            $data->active = $section->active;
            $data->save();
        }

        $request->session()->put('resume_id', $resume->id);
        return redirect('/header');
    }

    public function save_resume_name(Request $request){

        $data = Resume::find(session('resume_id'));
        $data->name = $request->resume_name;
        $data->status = 'updated';
        $data->save();

        return response()->json(['success'=>true]);
    }


    public function select(Request $request)
    {
        $request->session()->put('resume_id', $request->id);
        return redirect('/header');
    }

    public function delete($id){
        $data = Resume::find($id);
        $data->delete();

        return redirect()->back()->with(session()->flash('alert-success', 'Your resume has been deleted successfully.'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */



    public function show($id)
    {
        $template = DB::table('resumes')
                ->where('id', '=', $id)
                ->first();
        $header = DB::table('headers')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->first();
        $educations = DB::table('educations')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->get();
        $experiences = DB::table('experiences')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->get();
        $activities = DB::table('activities')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->first();
        $certifications = DB::table('certifications')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->get();
        $skills = DB::table('skills')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->first();
        $professional_summaries = DB::table('professional_summaries')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->first();
        $additionals = DB::table('additionals')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->first();

        //dd($additionals);
        return view('preview', ['header'=>$header,'template'=>$template, 'educations'=>$educations, 'experiences'=>$experiences, 'certifications'=>$certifications,'activity'=>$activities,  'skill'=>$skills, 'professional_summary'=>$professional_summaries, 'additional'=>$additionals, 'resume_id'=>$id ]);

    }
    public function pdf($id)
    {

        $header = DB::table('headers')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->first();
        $educations = DB::table('educations')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->get();
        $experiences = DB::table('experiences')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->get();
        $activities = DB::table('activities')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->first();
        $certifications = DB::table('certifications')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->get();
        $skills = DB::table('skills')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->first();
        $professional_summaries = DB::table('professional_summaries')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->first();
        $additionals = DB::table('additionals')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->first();

        //dd($additionals);
        $pdf = PDF::loadView('resume', ['header'=>$header, 'educations'=>$educations, 'experiences'=>$experiences, 'certifications'=>$certifications,'activity'=>$activities,  'skill'=>$skills, 'professional_summary'=>$professional_summaries, 'additional'=>$additionals, 'resume_id'=>$id ]);


        if($header!=null){
            $name = $header->first_name;
        }else{
            $name = 'incomplete';
        }
        return $pdf->download($name.'_resume.pdf');

    }

    public function word($id)
    {
        $wordTest = new \PhpOffice\PhpWord\PhpWord();
        $newSection = $wordTest->addSection();

        $header = DB::table('headers')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->first();
        $educations = DB::table('educations')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->get();
        $experiences = DB::table('experiences')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->get();
        $activities = DB::table('activities')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->first();
        $certifications = DB::table('certifications')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->get();
        $skills = DB::table('skills')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->first();
        $professional_summaries = DB::table('professional_summaries')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->first();
        $additionals = DB::table('additionals')
                ->where('user_id', '=', session('user.id'))
                ->where('resume_id', '=', $id)
                ->first();


        $desc1 = "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint ipsam quam id fuga at quasi, reprehenderit iste? Eligendi ducimus illum ea voluptatibus, quod fuga omnis corporis provident vero, cum incidunt.";

        $title =  $header->first_name;
        //dd($desc2);

        $newSection->addTitle($title, );
        $newSection->addText($desc1);

        $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($wordTest, 'Word2007');

        try{
            $objectWriter->save(storage_path('TestWordFile.docx'));
        }catch(Exception $e){

        }
        return response()->download(storage_path('TestWordFile.docx'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function edit(Resume $resume)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resume $resume)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resume $resume)
    {
        //
    }
}
