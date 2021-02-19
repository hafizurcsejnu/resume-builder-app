
@extends('layouts.master')
@section('main_content')
<?php 
$section_name='Education';
?>
@include('_next_url')
@include('_prev_url') 
    
<style>
  .link_area a {
    font-size: 30px;
}
</style>
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
      <div class="col-12 col-lg-8">
        <div class="card bcard h-100">
          <div class="border-t-3 w-100 brc-info-m1 radius-t-1"></div><!-- the colored line on top of stats -->

          <div class="card-header">
            <h2 class="card-title text-grey-d1 pl-1">
              Pick a school to add!
            </h2>
          </div>        

            <div class="card-body section_detail h-98 d-flex flex-column1 justify-content-center py-2 py-md-3 px-0 px-md-4">
              <div class="link_area">
               
                <div class="row">
                  <div class="col-md-4">
                    <a href="/add-school" class="btn btn-default" style="width: 200px;" id="highSchool">High School</a>
                  </div>
                  <div class="col-md-4">
                    <a href="/add-college" class="btn btn-default" style="width: 200px;" id="college">College</a>
                  </div>
                  <div class="col-md-4">
                    <a href="{{session('prev_url')}}" style="width: 100%; width: 100%;
                    height: 60px; font-size: 18px; padding-top: 14px;" class="btn btn-outline-lightgrey btn-bgc-white btn-bold ml-2 px-4" type="reset">
                      <i class="fa fa-arrow-left mr-1"></i>
                      Back
                    </a>
                  </div>
                </div>               

              </div>                                
              

            </div>

            

        </div>       
        
      </div>

      @include('_section')

      
     
    </div>



   

  </div>

  <script>
  $(document).ready(function() {
      $('#degree_program').on("change", function() {
          var degree_program = $(this).val();
          if( degree_program == 'High School Diploma' || degree_program == 'GED' ) {
            $("#field_of_study option").hide();
          }else{
            $("#field_of_study option").show();
          }
      });
  });
  </script>
 
@endsection