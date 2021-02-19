<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    public function index()
    {
        $data = Section::all();
        return view('admin.sections', ['data'=>$data]);
    }  
    
}
