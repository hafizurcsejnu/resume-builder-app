
@extends('layouts.master')
@section('main_content')
<?php 
$section_name='Additional Information';  
?>
@include('_next_url')   
@include('_prev_url')   

  <div class="page-content container container-plus">
    <div class="page-header pb-2">
      <h1 class="page-title text-primary-d2 text-150">
        Resume creation | Additional Information
        <small class="page-info text-secondary-d2 text-nowrap">
          <i class="fa fa-angle-double-right text-80"></i>
          {{-- overview &amp; stats --}}
          Hi {{session('user.name')}}, enter your additional information.
        </small>
      </h1>
    </div>


    <div class="row mt-2 mt-lg-4 pt-2">
      <div class="col-12 col-lg-8">
        <div class="card bcard">
          <div class="border-t-3 w-100 brc-info-m1 radius-t-1"></div><!-- the colored line on top of stats -->

          <div class="card-header">
            <h2 class="card-title text-grey-d1 pl-1">
              Additional Information
            </h2>
          </div>

          <div class="card-body section_detail h-98 d-flex flex-column justify-content-center py-2 py-md-3 px-0 px-md-4">
           
             <form action="@if(isset($description)){{"updateAdditional"}}@else{{"storeAdditional"}}@endif" method="post" id="exp_form">
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
                  <button class="btn btn-info btn-bold px-4" style="float: right" type="submit"><i class="fa fa-check mr-1"></i> Next</button>
                 
                  

                 
                </div>
              </div>
              </div>
            </form>
            

          </div>

        </div>
        
      </div>

      @include('_section')
     
     
    </div>



   

  </div>
 
@endsection