
@extends('layouts.master')
@section('main_content')
<?php 
$section_name='Skills';
?>
@include('_next_url') 
@include('_prev_url') 
    

  <div class="page-content container container-plus">
    <div class="page-header pb-2">
      <h1 class="page-title text-primary-d2 text-150">
        Let’s pick your top skills    
      </h1>
    </div>


    <div class="row mt-2 mt-lg-4 pt-2">
      <div class="col-12 col-lg-6">
        <div class="card bcard h-100">
          <div class="border-t-3 w-100 brc-info-m1 radius-t-1"></div><!-- the colored line on top of stats -->

          <div class="card-header">            
            <form action="">           
              <input type="text"  onkeyup="search()" id="searchKeyword"  placeholder="Search by keyword" class="form-control form-control-lg shadow-none"> 
            </form>            
          </div>

          <div class="card-body  d-flex flex-column1 justify-content-center py-2 py-md-3 px-0 px-md-4">
           

            <div id="tasks_area" style="width: 100%; height: 400px; overflow-y: scroll;">
              @foreach($data as $item)
                <a type="button" id="task_id{{ $item->id }}"  class="task_id text-500 text-95"> 
                  <div class="tasks_item">              
                    <button type="button" class="btn-icon btn-icon-primary rounded-circle"><i class="icon-add fas fa-plus"></i></button>
                    <p>                    
                    {{ $item->skills }}                 
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
          <div class="card-header bgc-default-d2">
            

            <h3 class="card-title text-white text-130">
              Your selected skills @include('_section_modal')
            </h3>
          </div>

          <form action="@if(isset($description)){{"updateSkill"}}@else{{"storeSkill"}}@endif" method="post" id="exp_form">
            @csrf

          <div class="card bcard border-1 brc-dark-l1">
            <div class="card-body p-0">             
                <textarea id="summernote" name="description" rows="25"> 
                    @if(isset($description)){{$description}}@endif
                </textarea>             
            </div>

            <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
              <div class="offset-md-0 col-md-12 text-nowrap">      
                
                <a href="{{session('prev_url')}}" class="btn btn-outline-lightgrey btn-bgc-white btn-bold ml-2 px-4" type="reset">
                  <i class="fa fa-arrow-left mr-1"></i>
                  Back
                </a>
  
                <button id="@if(!isset($description)){{"submitBtn"}}@endif" class="btn btn-info btn-bold px-4" style="float: right"  type="submit">
                  <i class="fa fa-check mr-1"></i>
                  Continue
                </button>                
               
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
    // $(document).ready(function() {
    //   $('.summernote').summernote();
    //     $('.task_id').on("click", function(e) {          
    //       e.preventDefault();   
    //         //debugger;           
    //         var task = $(this).text();            
    //         var task_id = $(this).attr("id"); 
    //         $('#'+ task_id).css("cursor", "not-allowed");
    //         $('#'+ task_id).css("color", "grey");            
    //         $('#'+ task_id).off('click');
            
    //         var task = $.trim(task);
    //         var task_li = "<li>"+task+"</li>";
    //         var description = $('#description').append(task_li);
    //     });

    //     $("#submitBtn").click(function(){
    //       var discription = $("#description").html();
    //       $("#exp_form").append("<input type='hidden' name='description' value='"+discription+"'>");
    //       $("#exp_form").submit();
    //     });
    // });
    </script> 
 
@endsection