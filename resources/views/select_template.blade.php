
@extends('layouts.master')
@section('main_content')
    

  <div class="page-content container container-plus">
    <div class="page-header pb-2">
      <h1 class="page-title text-primary-d2 text-150">
        Dashboard
        <small class="page-info text-secondary-d2 text-nowrap">
          <i class="fa fa-angle-double-right text-80"></i>
          {{-- overview &amp; stats --}}
          Hi {{session('user.name')}}, welcome to resume builder application.
        </small>
      </h1>
    </div>


    <div class="row">

      <h1 style="text-align: center; margin-top:50px;">Select template to create your own resume.</h1>
      <hr>

      <div class="col-md-6">          
          <div class="" style="">
         <a href="create-resume?temp_id=1">  <h1 style="border:2px solid black; padding:100px">Template one</h1></a> 
          </div>          
      </div>
      <div class="col-md-6">          
        <div class="" style="">
          <a href="create-resume?temp_id=2">  <h1 style="border:2px solid black; padding:100px">Template two</h1></a>
        </div>          
    </div>
    </div>


  </div>
 
@endsection