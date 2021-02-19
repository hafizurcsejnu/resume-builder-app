<?php 

$sections = DB::table('user_sections') 
        ->where('user_id', '=', session('user.id'))
        ->where('resume_id', '=', $resume_id)
        ->where('active', '=', 'on')
        ->orderBy('sort_order', 'asc')
        ->get();
        //dd($professional_summary);
        
    ?>

<style>
footer.footer.d-none.d-sm-block {
    display: none!important;
}
body {
    overflow-x: hidden;
    background-color: #fff; 
    color: #000;
    font-family: 'Times New Roman', Times, serif;
}
.resume_wrapper {
    margin: 10px 50px;
}

.header{
        text-align: center;
    }
.header ul li {
    display: inline;
    margin: 0 14px;
}
.certifications ul li{
    
}
</style>
    <div class="resume_wrapper">        
    @if($header!=null)
        <div class="section_area header">
            <h1>{{$header->first_name}} {{$header->last_name}}</h1>
            <hr style="border-bottom: 2px solid #000;">
            <ul style="text-align: center">
                <li style="display: inline; margin: 0 14px;">{{$header->city}}, {{$header->city}}, {{$header->zip}}</li>
                <li>{{$header->phone}} </li>
                <li>{{$header->email}}</li>
            </ul>
        </div>  
        @endif 
        
    @foreach ($sections as $section)
        @if($section->name=='Education' && count($educations)!=null )
        <div class="section_area education" style="margin-top: 20px;">
            <h3>@if($section->name_updated!=null){{$section->name_updated}}@else{{$section->name}}@endif</h3>   
            @foreach ($educations as $item)
                <p><b>{{$item->school_name}}</b>  {{$item->end_date}}</p>
                <p style="margin-top: -15px">{!!$item->awards!!}</p>
            @endforeach           
        </div>        

        @elseif($section->name=='Certifications' && count($certifications)!=null )
        <div class="section_area certifications" style="margin-top: 10px">
            <h3>@if($section->name_updated!=null){{$section->name_updated}}@else{{$section->name}}@endif</h3>            
            <ul>
                @foreach ($certifications as $item)
                    <li>{!!$item->certificate_name!!}</li>
                @endforeach    
            </ul>  
        </div>

        @elseif($section->name=='Skills' && $skill!=null)
        <div class="section_area skills" style="margin-top: 10px;">
            <h3>@if($section->name_updated!=null){{$section->name_updated}}@else{{$section->name}}@endif</h3>            
            {!!$skill->description!!} 
        </div>

        @elseif($section->name=='Extra-Curricular' && $activity!=null)
        <div class="section_area activities" style="margin-top: 10px;">
            <h3>@if($section->name_updated!=null){{$section->name_updated}}@else{{$section->name}}@endif</h3>            
            {!!$activity->description!!}
        </div>
        
        @elseif($section->name=='Work Experience' && count($experiences)!=null )
        <div class="section_area experiences" style="margin-top: 10px;">
            <h3>@if($section->name_updated!=null){{$section->name_updated}}@else{{$section->name}}@endif</h3>   
            @foreach ($experiences as $item)
                <p><b>{{$item->job_title}} - </b>  {{$item->start_date}} to 
                    @if($item->still_working=='on')Current 
                    @else {{$item->end_date}}
                    @endif
                </p>
                <p style="margin-top: -15px">{!!$item->description!!}</p>
            @endforeach  
        </div>

        @elseif($section->name=='Additional Information' && $additional!=null)
        <div class="section_area additional" style="margin-top: 10px;">
            <h3>@if($section->name_updated!=null){{$section->name_updated}}@else{{$section->name}}@endif</h3>            
            {!!$additional->description!!}
        </div>

        @elseif($section->name=='Professional Summary' && $professional_summary!=null)
        <div class="section_area professional_summary" style="margin-top: 10px;">
            <h3>@if($section->name_updated!=null){{$section->name_updated}}@else{{$section->name}}@endif</h3>            
            {!!$professional_summary->description!!}
        </div> 

        @endif
    @endforeach
    </div>
