
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
        Resume creation | Experience
       
      </h1>
    </div>


    <div class="row mt-2 mt-lg-4 pt-2">
      <div class="col-12 col-lg-8">
        <div class="card bcard">
          <div class="border-t-3 w-100 brc-info-m1 radius-t-1"></div><!-- the colored line on top of stats -->

          <div class="card-header">
            <h2 class="card-title text-grey-d1 pl-1">
              Review your experience
            </h2>
          </div>

          <div class="card-body  d-flex flex-column1 justify-content-center py-2 py-md-3 px-0 px-md-4">
          
            <table id="simple-table" class="mb-0 table table-borderless table-bordered-x brc-secondary-l3 text-dark-m2 radius-1 overflow-hidden">
                <thead class="text-dark-tp3 bgc-grey-l4 text-90 border-b-1 brc-transparent">
                  <tr>                  

                    <th>SN</th>
                    <th>Job Title</th>
                    <th>Details</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody class="mt-1">
                  @foreach($data as $item)
                  <tr class="bgc-h-yellow-l4 d-style">                

                    <td>
                      <a href="#" class="text-blue-d1 text-600 text-95">{{$loop->iteration}}</a>
                    </td>
                    <td>
                      <a href="#" class="text-blue-d1 text-600 text-95">{{ $item->job_title }}</a>
                      <p class="small_paragraph">{{ $item->city }}, {{ $item->state }} | {{ $item->start_date }} - @if($item->still_working=='on') Current @else {{ $item->end_date }} @endif </p>
                    </td>

                    <td class="text-600">
                      {!! $item->description !!}
                    </td>                 
                     
                  
                    <td>
                      <!-- action buttons -->
                      <div class="d-none d-lg-flex">
                        <a href="/experience-edit/{{$item->id}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                          <i class="fa fa-pencil-alt"></i>
                        </a>

                        <a href="/experienceDelete/{{$item->id}}" onclick="confirmDelete()"  class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                          <i class="fa fa-trash-alt"></i>
                        </a>
                        <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-warning btn-a-lighter-warning">
                          <i class="fa fa-ellipsis-v mx-1"></i>
                        </a>
                      </div>

                      <!-- show a dropdown in mobile -->
                      <div class="dropdown d-inline-block d-lg-none dd-backdrop dd-backdrop-none-lg">
                        <a href="#" class="btn btn-default btn-xs py-15 radius-round dropdown-toggle" data-toggle="dropdown">
                          <i class="fa fa-cog"></i>
                        </a>

                        <div class="dropdown-menu dd-slide-up dd-slide-none-lg">
                          <div class="dropdown-inner">
                            <div class="dropdown-header text-100 text-secondary-d1 border-b-1 brc-secondary-l2 text-600 mb-2">
                              {{$item->name}}
                            </div>
                            <a href="#" class="dropdown-item">
                              <i class="fa fa-pencil-alt text-blue mr-1 p-2 w-4"></i>
                              Edit
                            </a>
                            <a href="#" class="dropdown-item">
                              <i class="fa fa-trash-alt text-danger-m1 mr-1 p-2 w-4"></i>
                              Delete
                            </a>
                            <a href="#" class="dropdown-item">
                              <i class="far fa-flag text-orange-d1 mr-1 p-2 w-4"></i>
                              Flag
                            </a>
                          </div>
                        </div>
                      </div>

                    </td>
                  </tr>

                  @endforeach

                </tbody>
              </table>             

          </div>

          <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
            <div class="offset-md-0 col-md-12 text-nowrap">  
              <a href="{{session('prev_url')}}" class="btn btn-outline-lightgrey btn-bgc-white btn-bold ml-2 px-4" type="reset">
                <i class="fa fa-arrow-left mr-1"></i>
                Back
              </a>               

              <a href="{{session('next_url')}}" class="btn btn-info btn-bold px-4" style="float: right" type="submit">
                <i class="fa fa-check mr-1"></i>
                Continue
              </a>
              <a href="/add-experience" style="float: right"  class="btn btn-outline-lightgrey btn-bgc-white btn-bold ml-2 px-4">
                Add New Experience
              </a>
             
            </div>
          </div>

        </div>
      </div>

      

      @include('_section')
     
    </div>



   

  </div>
 
@endsection