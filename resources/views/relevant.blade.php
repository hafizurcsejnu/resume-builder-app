
@extends('layouts.master')
@section('main_content')
<?php 
$section_name='Relevant Courses';
 
?>
@include('_next_url')
    

  <div class="page-content container container-plus">
    <div class="page-header pb-2">
      <h1 class="page-title text-primary-d2 text-150">
        Resume creation | Relevant Courses
        <small class="page-info text-secondary-d2 text-nowrap">
          <i class="fa fa-angle-double-right text-80"></i>
          {{-- overview &amp; stats --}}
          Hi {{session('user.name')}}, enter your information carefully.
        </small>
      </h1>
    </div>

    <div class="flash-message">
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
              <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
      @endforeach
    </div>


    <div class="row mt-2 mt-lg-4 pt-2">
      <div class="col-12 col-lg-8">
        <div class="card bcard h-100">
          <div class="border-t-3 w-100 brc-info-m1 radius-t-1"></div><!-- the colored line on top of stats -->

          <div class="card-header">
            <h2 class="card-title text-grey-d1 pl-1">
              Relevant Courses:
            </h2>
          </div>

          <div class="card-body section_detail h-98 d-flex flex-column justify-content-center py-2 py-md-3 px-0 px-md-4">
           
            <h2 style="text-align: center; margin-top: 0px;">-: Under construction :-</h2>

            <form action="headerStore" method="post"  class="mt-lg-3" autocomplete="off">
              @csrf

              <div class="row"> 
                
                
                
              </div>

            




              <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
                <div class="offset-md-0 col-md-12 text-nowrap">
                 

                  <button class="btn btn-warning btn-bgc-yellow btn-bold ml-2 px-4" type="reset">
                    <i class="fa fa-undo mr-1"></i>
                    Clean
                  </button>

                  {{-- <button class="btn btn-info btn-bold px-4" style="float: right" type="submit">
                    <i class="fa fa-check mr-1"></i>
                    Next
                  </button> --}}

                  <a href="{{session('next_url')}}" class="btn btn-info btn-bold px-4" style="float: right" type="submit"><i class="fa fa-check mr-1"></i> Next</a>
                 
                   <a href="{{ url()->previous() }}" style="float: right; margin-right:5px;"  class="btn btn-outline-lightgrey btn-bgc-white btn-bold ml-2 px-4"><i class="fa fa-arrow-left mr-1"></i> Back</a>  
                  

                 
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