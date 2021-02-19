
    
@extends('layouts.master')
@section('main_content')
<?php 
$section_name='Work Experience';
?>
 @include('_next_url')
 @include('_prev_url')
    

  <div class="page-content container container-plus">
    <div class="page-header pb-2">
      <h1 class="page-title text-primary-d2 text-150">
        Resume creation | Work Experience
        <small class="page-info text-secondary-d2 text-nowrap">
          <i class="fa fa-angle-double-right text-80"></i>
          {{-- overview &amp; stats --}}
          Hi {{session('user.name')}}, enter your information carefully.
        </small>
      </h1>
    </div>

  
  
    <div class="row mt-2 mt-lg-4 pt-2">
        <div class="col-12 col-lg-8">
          <div class="card bcard">
            <div class="border-t-3 w-100 brc-info-m1 radius-t-1"></div><!-- the colored line on top of stats -->
  
            <div class="card-header">
              <h2 class="card-title text-grey-d1 pl-1">
                Update Experience:
              </h2>
            </div>
  
            <div class="card-body section_detail h-98 flex-column1 justify-content-center py-2 py-md-3 px-0 px-md-4">
             
              
              <form action="experienceUpdate" method="post"  class="mt-lg-3" autocomplete="off">
                @csrf
  
                <div class="row"> 
                  <div class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1">
                      
                    <span class="floating-label text-grey-m3">
                        Job Title
                    </span>
                  
                  
                  <input type="text" list="job_titles" name="job_title" value="{{$data->job_title}}" class="form-control form-control-lg shadow-none" id="id-form-field-2" required>
                  <datalist id="job_titles">
                      <?php 
                          $collection = DB::table('jobs')->select('title')->distinct()->get();
                      ?> 
                     @foreach ($collection as $item)                  
                      <option value="{{$item->title}}">
                      @endforeach
                  </datalist>                                
                    
                                    
                    
                  </div>
  
                  <div class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1">
                    <span class="floating-label text-grey-m3">
                       Employer
                    </span>
                    <input type="text" name="employer" value="{{$data->employer}}" required class="form-control form-control-lg shadow-none" id="id-form-field-2">
                    
                  </div>
                </div>
  
                <div class="row"> 
                  <div class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1">
                    <span class="floating-label text-grey-m3">                   
                        City
                    </span>
                    <input type="text" list="cities" name="city" id="cityId" value="{{$data->city}}" required class="form-control form-control-lg shadow-none">
                    <datalist id="cities">
                      <?php 
                          $collection = DB::table('city_states')->get();
                      ?> 
                    @foreach ($collection as $item)                  
                      <option value="{{$item->state_city}}"> {{$item->state_name}} | {{$item->state_city}}
                      @endforeach
                    </datalist>
                  </div>                
  
                  <div class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1">
                    <span class="floating-label text-grey-m3">                   
                        State
                    </span>
                    <input type="text" name="state" id="state" value="{{$data->state}}"  required class="form-control form-control-lg shadow-none"> 
                  </div>   
                </div>

                <div class="row"> 
                    <div class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1">
                      <span class="floating-label text-grey-m3">                   
                          Start Date
                      </span>
                      <input type="month" name="start_date"  value="{{$data->start_date}}" class="form-control form-control-lg shadow-none" id="id-form-field-2">
                    </div>                
    
                    <div id="end_date" class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1" >
                      <span class="floating-label text-grey-m3">                   
                          End Date
                      </span>
                      <input type="month" name="end_date"  value="{{$data->end_date}}" class="form-control form-control-lg shadow-none" id="id-form-field-2">
                    </div>   
                  </div>
  
                
  
                <div class="row"> 
                  <div class="col-md-6 text-blue-d2 brc-blue-m1">
                    <div class="mb-1">
                      <label>                                      
                        <input type="checkbox" name="still_working" id="still_working" class="input-lg bgc-blue" <?php if($data->still_working=='on'){echo "checked";}else{ echo '';}?>>
                        I currently work here.
                      </label>
                    </div>
                  </div>
                </div>

                <input type="hidden" name="id" value="{{$data->id}}"> 
  
  
                <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                  <div class="offset-md-0 col-md-12 text-nowrap">
                   
  
                    <a href="{{session('prev_url')}}" class="btn btn-outline-lightgrey btn-bgc-white btn-bold ml-2 px-4" type="reset">
                      <i class="fa fa-arrow-left mr-1"></i>
                      Back
                    </a>

                    <button class="btn btn-info btn-bold px-4" style="float: right" type="submit">
                      <i class="fa fa-check mr-1"></i>
                      Continue
                    </button>
                   
  
                   
                  </div>
                </div>
              </form>     
              
  
            </div>
  
          </div>
        </div>
  
        @include('_section')
       
      </div>
  
  
  
     
  
    </div>
  
    <script>
    $(document).ready(function() {
      $("#still_working").change(function() {
          if(this.checked) {
            $("#end_date").hide();
          }
          if(!this.checked) {
            $("#end_date").show();
          }
      });

      $("#word_tense").change(function(){
        var val = $(this).val();
        $("#searchKeyword2").attr('list',val);
     });
       
    });
    </script>
   
  @endsection