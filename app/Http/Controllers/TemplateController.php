<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Template::all();
        return view('admin.templates', ['data'=>$data]);
    }  

    public function store(Request $request)
    {
       
        $data = new Template;
        $data->name = $request->name;
        $data->active = '1';
        $data->save();

        return redirect()->back()->with(session()->flash('alert-success', 'Template has been inserted successfully.'));        
    }

    public function update(Request $request)    {        
        
        $data = Template::find($request->id);
        $data->name = $request->name;
        $data->active = '1';
        $data->save(); 

        return redirect()->back()->with(session()->flash('alert-success', 'Template has been updated successfully.'));
    }

    public function destroy($id)
    {       
        $data = Template::find($id);
        $data->delete();

        return redirect()->back()->with(session()->flash('alert-success', 'Template has been deleted successfully.'));
    }

    
    
}
