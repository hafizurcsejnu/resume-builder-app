
@extends('layouts.master')
@section('main_content')
<?php 
$section_name='Work';
?>
{{-- @include('_next_url')  --}}
    

  <div class="page-content container container-plus">
    <div class="page-header pb-2">
      <h1 class="page-title text-primary-d2 text-150">
      @php
        $exp = \App\Models\Experience::where('id',Session::get('experience_id'))->first();
      @endphp
        What did you do in {{$exp->job_title}}
      </h1>
    </div>


    <div class="row mt-2 mt-lg-4 pt-2">
      <div class="col-12 col-lg-6">
        <div class="card bcard h-100">
          <div class="border-t-3 w-100 brc-info-m1 radius-t-1"></div><!-- the colored line on top of stats -->

          <div class="card-header"> 
            <input type="text" list="job_titles" id="job_title" placeholder="Search recommended phrases by job title" required class="form-control form-control-lg shadow-none"> 
              <?php 
              $collection = DB::table('data_experiences')
                          ->select('job_title')
                          ->distinct()
                          ->get();
            ?>
            <datalist id="job_titles">
                @foreach ($collection as $item)                  
                  <option value="{{$item->job_title}}">{{$item->job_title}}</option>
                @endforeach 
            </datalist>            
        </div>

        <div class="card-header">              
            <input type="text" id="action_word" list="all" placeholder="Search by action word" required class="form-control form-control-lg shadow-none" id="id-form-field-2"> 
            <?php 
              $collection = DB::table('data_experiences')->distinct('word')->orderBy('word','ASC')->get();
              $present = DB::table('data_experiences')->where('word_tense','present_word')->distinct('word')->orderBy('word','ASC')->get();
              $past = DB::table('data_experiences')->where('word_tense','past_word')->distinct('word')->orderBy('word','ASC')->get();
              $future = DB::table('data_experiences')->where('word_tense','future_word')->distinct('word')->orderBy('word','ASC')->get();
            ?>
            <datalist id="all">
                @foreach ($collection as $item)                  
                  <option value="{{$item->word}}">{{$item->soft_skill}}</option>
                @endforeach 
            </datalist>

            <datalist id="present_word">
                @foreach ($present as $item)                  
                  <option value="{{$item->word}}">{{$item->soft_skill}}</option>
                @endforeach 
            </datalist>

            <datalist id="past_word">
                @foreach ($past as $item)                  
                  <option value="{{$item->word}}">{{$item->soft_skill}}</option>
                @endforeach 
            </datalist>

            <datalist id="future_word">
                @foreach ($future as $item)                  
                  <option value="{{$item->word}}">{{$item->soft_skill}}</option>
                @endforeach 
            </datalist>
            <select name="tense" id="word_tense" required="" class="form-control" id="form-field-select-1" style="height: 46px; margin-left:20px;">                 
              <option value="all">Select word tense</option>    
              <option value="present_word">Present Word</option>    
              <option value="past_word">Past Word</option>    
              <option value="future_word">Future Word</option>    
            </select>   
        </div>
        <div class="card-header">              
           <p style="display: block">Filter By Soft Skills</p>
            <select name="soft_skill" id="soft_skill" required="" class="form-control" id="form-field-select-1" style="height: 46px; margin-left:20px; float:left; width:60%">                 
              <option value="">Filter By Soft Skills</option>    
            <?php 
              $collection = DB::table('data_experiences')
                            ->select('soft_skill')
                            ->distinct()
                            ->get();
            ?>
             @foreach ($collection as $item)                  
             <option value="{{$item->soft_skill}}">{{$item->soft_skill}}</option>
             @endforeach    
            </select>   
        </div>
        {{-- <p>Total Data : <span id="total_records"></span></p> --}}
        <div class="card-body  d-flex flex-column1 justify-content-center py-2 py-md-3 px-0 px-md-4">            
          <div class="default_task_area" id="task_area" style="width: 100%; height: 400px; overflow-y: scroll;">              
          </div> 
        </div>

      </div>
    </div>

      <div class="col-12 col-lg-6">

        <div class="card border-0 shadow-sm">
          <div class="card-header bgc-default-d2">
            <h3 class="card-title text-white text-130">
              Your selected experiences
            </h3>
          </div>
          <div class="card bcard border-1 brc-dark-l1">
            <div class="card-body p-0">              
              <form action="updateExperienceDescription" id="descForm" method="post">
                @csrf 
                <textarea id="summernote" name="description"></textarea>               
              </form>        
            </div>

            <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
              <div class="offset-md-0 col-md-12 text-nowrap">                 
  
                <button class="btn btn-info btn-bold px-4 task_id>" id="submitBtn" style="float: right" type="submit">
                  <i class="fa fa-check mr-1"></i>
                  Continue
                </button>
                <a href="/add-experience" style="float: right"  class="btn btn-outline-lightgrey btn-bgc-white btn-bold ml-2 px-4">
                  Add New Experience
                </a>             
              </div>
            </div>
          </form>

          </div>
        </div>        
        
      </div>

      {{-- @include('_section') --}}
     
    </div>

  </div>

  <script>
    $(document).ready(function(){
    
     fetch_work_experience();    
    
     function fetch_work_experience(job_title = '', action_word = '', soft_skill = '')
     {
      $.ajax({
       url:"find_experience",
       method:'GET',
       data:{job_title:job_title, action_word:action_word, soft_skill:soft_skill},
       dataType:'json',
       success:function(data)
       {
          $('#task_area').html(data.table_data);
          $('#total_records').text(data.total_data);
          console.log(data.zone);
          console.log(data.total_data);
          console.log(data.job_title);
          console.log(data.action_word);
          console.log(data.soft_skill);
       }
      })
     }    
   
    $("#word_tense").change(function(){
      var val = $(this).val();
        $("#action_word").attr('list',val);
     });

     $("#soft_skill").change(function(){
        var soft_skill = $(this).val();
        var action_word = $('#action_word').val();
        var job_title = $('#job_title').val();
        fetch_work_experience(job_title, action_word, soft_skill);
     });

     $("#action_word").change(function(){
        var action_word = $(this).val();
        var soft_skill = $('#soft_skill').val();
        var job_title = $('#job_title').val();
       
        fetch_work_experience(job_title, action_word, soft_skill);
     });

     $("#job_title").change(function(){
        var job_title = $(this).val();
        var soft_skill = $('#soft_skill').val();
        var action_word = $('#action_word').val();
        fetch_work_experience(job_title, action_word, soft_skill);
     });

         
    });     

    </script> 
@endsection