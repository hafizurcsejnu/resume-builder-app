
@extends('layouts.master')
@section('main_content')
<?php 
$section_name='Header';  
?>
@include('_next_url')
    

  <div class="page-content container container-plus">
    <div class="page-header pb-2">
      <h1 class="page-title text-primary-d2 text-150">
        Resume creation | Done
        <small class="page-info text-secondary-d2 text-nowrap">
          <i class="fa fa-angle-double-right text-80"></i>
          {{-- overview &amp; stats --}}
          Hi {{session('user.name')}}, Download your resume.
        </small>
      </h1>
    </div>


    <div class="row mt-2 mt-lg-4 pt-2">
      <div class="col-12 col-lg-8">
        <div class="card bcard h-100">
          <div class="border-t-3 w-100 brc-info-m1 radius-t-1"></div><!-- the colored line on top of stats -->

          <div class="card-header">
            <h2 class="card-title text-grey-d1 pl-1">
              Your Resume:
            </h2>
          </div>

          <div class="card-body section_detail h-98 d-flex flex-column justify-content-center py-2 py-md-3 px-0 px-md-4">
           
            <h2 style="text-align: center; margin-top: 0px; color:green;">-: Complete Resume Display :-</h2>

           
          </div>

        </div>
      </div>

      @include('_section')
     
    </div>



   

  </div>
 
@endsection