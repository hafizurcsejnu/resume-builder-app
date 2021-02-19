
@extends('layouts.master')
@section('main_content')
<?php 
$section_name='Education';
?>
{{-- @include('_next_url') --}}
    

  <div class="page-content container container-plus">
    <div class="page-header pb-2">
      <h1 class="page-title text-primary-d2 text-150">
        Resume creation | Education
        <small class="page-info text-secondary-d2 text-nowrap">
          <i class="fa fa-angle-double-right text-80"></i>
          {{-- overview &amp; stats --}}
          Hi {{session('user.name')}}, enter your information carefully.
        </small>
      </h1>
    </div>

 
    <div class="row mt-2 mt-lg-4 pt-2">
      <div class="col-12 col-lg-12">
        <div class="card bcard h-100">
          <div class="border-t-3 w-100 brc-info-m1 radius-t-1"></div><!-- the colored line on top of stats -->
          
          <div class="card-header">
            <h2 class="card-title text-grey-d1 pl-1">
              Update Education:    @include('_section_modal')
            </h2>
          </div>        

            <div class="card-body section_detail h-98 d-flex flex-column1 justify-content-center py-2 py-md-3 px-0 px-md-4">
              <form action="educationUpdate" id="descForm" method="post"  class="mt-lg-3" autocomplete="off">
                @csrf  
                <div class="row"> 
                  <div class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1">

                    <span class="floating-label text-grey-m3">
                      School Name
                  </span>
                  {{-- <input type="text" name="school_name" value="{{$data->school_name}}" required class="form-control form-control-lg shadow-none"> --}}

                  <input type="text" list="schools" name="school_name" placeholder="Homer High School" required class="form-control form-control-lg shadow-none"id="id-form-field-2">
                    
                    <datalist id="schools">
                          <?php 
                          if ($data->education_type=='school') {
                            $collection = DB::table('data_high_schools')->get();
                          }else{
                            $collection = DB::table('data_colleges')->get();
                          }                             
                          ?> 
                        @foreach ($collection as $item)                  
                          <option value="{{$item->name}}">
                          @endforeach
                      </datalist>                


                    
                  </div>
  
                  <div class="col-md-2 input-floating-label1 text-blue-d2 brc-blue-m1">                    
                    <span class="floating-label text-grey-m3">
                      City
                    </span>
                    <input type="text"  id="city" value="{{$data->city}}" name="city" class="form-control form-control-lg shadow-none">                    
                  </div>

                  <div class="col-md-2 input-floating-label1 text-blue-d2 brc-blue-m1">                    
                    <span class="floating-label text-grey-m3">
                      State
                    </span>
                    <input type="text" id="state" name="state" value="{{$data->state}}" class="form-control form-control-lg shadow-none">                    
                  </div>

                  <div class="col-md-2 input-floating-label1 text-blue-d2 brc-blue-m1">                    
                    <span class="floating-label text-grey-m3">
                      Country
                    </span>
                    <input type="text" id="country" value="{{$data->country}}" name="country" class="form-control form-control-lg shadow-none">                    
                  </div>
                </div>

                <div class="row"> 
                  <div class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1">
                    <span class="floating-label text-grey-m3">
                      Start Date
                  </span>
                  <input type="date" name="start_date" value="{{$data->start_date}}" class="form-control form-control-lg shadow-none">
                </div>
                 
                  <div class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1">
                    <span class="floating-label text-grey-m3">
                      Finish Date
                  </span>
                  <input type="date" name="end_date" value="{{$data->end_date}}" class="form-control form-control-lg shadow-none">
                </div> 
                  
                </div>

  
                <div class="row"> 
                  <div class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1">
                    
                    <span class="floating-label text-grey-m3">
                      Degree Program <span style="color:red">@error('degree_program'){{$message}}@enderror</span>
                    </span>
  
                    <select name="degree_program" id="degree_program" required class="select2_class form-control" id="form-field-select-1" style="height: 46px;">
                      <option value="{{$data->degree_program}}">{{$data->degree_program}}</option>
  
                      <?php 
                          $collection = DB::table('data_degree_programs')->select('name')->distinct()->get();
                      ?> 
                      @foreach ($collection as $item)                  
                      <option value="{{$item->name}}">{{$item->name}}</option>
                      @endforeach
                    </select>
                    
                  </div>                
                  @if($data->education_type == 'college')
                  <div class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1">
                    <span class="floating-label text-grey-m3">
                      Field of Study
                    </span>
                    <select name="field_of_study" id="field_of_study" class="form-control select2_class" id="form-field-select-1" style="height: 46px;">
                      <option value="{{$data->field_of_study}}">{{$data->field_of_study}}</option>
                      <?php 
                          $collection = DB::table('field_of_studies')->select('name')->distinct()->get(10);
                      ?> 
                      @foreach ($collection as $item)                  
                      <option value="{{$item->name}}">{{$item->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  @endif
                </div>
  
              
  
                <div class="row"> 
                  <div class="col-md-6 text-blue-d2 brc-blue-m1">
                    <div class="mb-1">
                      <label>                                      
                        <input type="checkbox" name="still_enrolled" class="input-lg bgc-blue" <?php if($data->still_enrolled=='on'){echo "checked";}else{ echo '';}?>>
                        I'm still enrolled
                      </label>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="education_type" id="education_type" value="{{$data->education_type}}">
                <input type="hidden" name="id" value="{{$data->id}}">
  
              
  
                {{-- form btn past --}}
  
  
                          
  
            </div>
  
            <a href="#" id="expandBtn" title="Click to expand award area.">
              <h2>~Any awards or achivements ~</h2>
            </a>
  
            <div class="row mt-2 mt-lg-4 pt-2" id="awards_area" style="display: none">
              <div class="col-12 col-lg-6">
                <div class="card bcard h-100">
                  <div class="border-t-3 w-100 brc-info-m1 radius-t-1"></div>
                  <!-- the colored line on top of stats -->
        
                  <div class="card-header">             
                   
                      <input type="text" onkeyup="search()" id="searchKeyword" placeholder="Search by keyword"  class="form-control form-control-lg shadow-none"> 
                    
                  </div>
        
                  <div class="card-body  d-flex flex-column1 justify-content-center py-2 py-md-3 px-0 px-md-4">
                   
                    <div class="tasks_area" style="width: 100%; height: 400px; overflow-y: scroll;">
                        
                        @foreach($awards as $item)
                          <a type="button" id="task_id{{ $item->id }}"  class="task_id text-500 text-95"> 
                            <div class="tasks_item">              
                              <button type="button" class="btn-icon btn-icon-primary rounded-circle"><i class="icon-add fas fa-plus"></i></button>
                              <p>                    
                              {{ $item->name }}                 
                              </p>              
                            </div>
                        </a>
                        @endforeach  
                      </div> 
                  </div>
        
                </div>
              </div>
        
              <div class="col-12 col-lg-6">
        
                <div class="card border-0 shadow-sm">
                  <div class="card-header bgc-success-d2">
                    <h3 class="card-title text-white text-130">
                      Your selected awards
                    </h3>
                  </div>
                  <div class="card bcard border-1 brc-dark-l1">
                    <div class="card-body p-0">             
                     
                        @csrf 
                        <textarea id="summernote" name="description" rows="25">             
                          {{ $data->awards }}         
                        </textarea>               
                          
                    </div>          
                             
                  </div>
                </div>
                
              </div>
  
            </div> 
            {{-- description section end --}}
            <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
              <div class="offset-md-0 col-md-12 text-nowrap">
               
  
                {{-- <button class="btn btn-warning btn-bgc-yellow btn-bold ml-2 px-4" type="reset">
                  <i class="fa fa-undo mr-1"></i>
                  Clean
                </button> --}}
  
                <button class="btn btn-info btn-bold px-4" id="submitBtn" style="float: right" type="submit">
                  <i class="fa fa-check mr-1"></i>
                  Continue
                </button>
                <button style="float: right"  class="btn btn-outline-lightgrey btn-bgc-white btn-bold ml-2 px-4" type="submit">
                  <i class="fa fa-arrow-left mr-1"></i>
                  Back
                </button>
  
               
              </div>
            </div>
          </form> 
          


          

        </div>
        
      </div>

      {{-- @include('_section') --}}
     
    </div>



   

  </div>

  <script>
  $(document).ready(function() {
      $('#expandBtn').on("click", function() {         
            $("#awards_area").show();
         
      });

      $("#id-form-field-2").change(function(){
        var school = $(this).val();
        var education_type = $('#education_type').val();
        var url_path;
        if(education_type == 'school') url_path='find_school';
        else if(education_type == 'college') url_path='find_college';
        $.ajax({
          url: url_path,
          data: {
            _token: '{{csrf_token()}}',
            name: school
          },
          type: 'POST',
          success: function (response) {
            // console.log(response.data);
              $("#city").val(response.data.city)
              $("#state").val(response.data.state)
              $("#country").val(response.data.country)
          }
        });
      });


  });
  </script>
 
@endsection