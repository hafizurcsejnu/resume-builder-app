
@extends('layouts.master')
@section('main_content')
<?php 
$section_name='Certifications';      	
?>
@include('_next_url')
@include('_prev_url')
    
<style>
  .modal-dialog {
    max-width: 800px!important;
    margin: 1.75rem auto;
}
</style>
  <div class="page-content container container-plus">
    <div class="page-header pb-2">
      <h1 class="page-title text-primary-d2 text-150">
        Certifications
        <small class="page-info text-secondary-d2 text-nowrap">
          <i class="fa fa-angle-double-right text-80"></i>
          List all your relevant Certifications!
        </small>
      </h1>
    </div>

   
    <div class="row mt-2 mt-lg-4 pt-2">
      <div class="col-12 col-lg-8">
        <div class="card bcard">
          <div class="border-t-3 w-100 brc-info-m1 radius-t-1"></div><!-- the colored line on top of stats -->

          <div class="card-header">
            <h2 class="card-title text-grey-d1 pl-1">
              List all your relevant Certifications!
            </h2>
          </div>

          <div class="card-body section_detail h-98 d-flex flex-column justify-content-center py-2 py-md-3 px-0 px-md-4">
          
            
            <form action="storeCertification" method="post"  class="mt-lg-3" autocomplete="off">
              @csrf

              <div class="row"> 
                <div class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1">
                  <span class="floating-label text-grey-m3">
                    Certificate Name
                </span>
                <input type="text" name="certificate_name"  placeholder="John" required="" class="form-control form-control-lg shadow-none" id="id-form-field-2">
                  
                </div>

                <div class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1">
                  <span class="floating-label text-grey-m3">
                    Institute
                </span>
                <input type="text"  name="institute" placeholder="San Francisco" required class="form-control form-control-lg shadow-none" id="id-form-field-2">
                
                </div>
              </div>
              
              <div class="row"> 
                <div class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1">
                  <span class="floating-label text-grey-m3">
                    Start Date
                </span>
                <input type="date" name="start_date" class="form-control form-control-lg shadow-none" id="id-form-field-2">
              </div>
               
                <div class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1">
                  <span class="floating-label text-grey-m3">
                    Finish Date
                </span>
                <input type="date" name="end_date" class="form-control form-control-lg shadow-none" id="id-form-field-2">
              </div> 
                
              </div>

            

              <button class="btn btn-info btn-bold px-4" style="float: right" type="submit">
                <i class="fa fa-check mr-1"></i>
                Add
              </button>

            </form>  

            <hr>
            <hr>
           @isset($data)

            <table id="simple-table" class="mb-0 table table-borderless table-bordered-x brc-secondary-l3 text-dark-m2 radius-1 overflow-hidden">
              <thead class="text-dark-tp3 bgc-grey-l4 text-90 border-b-1 brc-transparent">
                <tr>                  
    
                  <th>SN</th>
                  <th>Certificate_name</th>
                  <th>Institute</th>
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
                    <a href="#" class="text-blue-d1 text-600 text-95">{{ $item->certificate_name }}</a>
                  </td>
    
                  <td class="text-600">
                    {{$item->institute}}
                  </td>                 
                   
                
                  <td>
                    <!-- action buttons -->
                    <div class="d-none d-lg-flex">
                      <a href="" data-toggle="modal" data-target="#item{{$item->id}}" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                        <i class="fa fa-pencil-alt"></i>
                      </a>
    
                      <a href="/certificationDelete/{{$item->id}}" onclick="confirmDelete()" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
                        <i class="fa fa-trash-alt"></i>
                      </a>
                      {{-- <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-warning btn-a-lighter-warning">
                        <i class="fa fa-ellipsis-v mx-1"></i>
                      </a> --}}
                    </div>

                    {{-- edit start --}}

                    <div class="modal fade" id="item{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                              Update Certification
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            
                            <form action="updateCertification" method="post"  class="mt-lg-3" autocomplete="off">
                              @csrf
                
                              <div class="row"> 
                                <div class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1">
                                  <span class="floating-label text-grey-m3">
                                    Certificate Name
                                </span>
                                <input type="text" name="certificate_name"  value="{{ $item->certificate_name }}" required="" class="form-control form-control-lg shadow-none" id="id-form-field-2">
                                  
                                </div>
                
                                <div class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1">
                                  <span class="floating-label text-grey-m3">
                                    Institute
                                </span>
                                <input type="text"  name="institute" value="{{ $item->institute }}" required class="form-control form-control-lg shadow-none" id="id-form-field-2">
                                
                                </div>
                              </div>
                              
                              <div class="row"> 
                                <div class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1">
                                  <span class="floating-label text-grey-m3">
                                    Start Date
                                </span>
                                <input type="date" name="start_date" value="{{ $item->start_date }}" class="form-control form-control-lg shadow-none" id="id-form-field-2">
                              </div>
                               
                                <div class="col-md-6 input-floating-label1 text-blue-d2 brc-blue-m1">
                                  <span class="floating-label text-grey-m3">
                                    Finish Date
                                </span>
                                <input type="date" name="end_date" value="{{ $item->end_date }}" class="form-control form-control-lg shadow-none" id="id-form-field-2">
                              </div> 
                                
                              </div>   
                              
                              <input type="hidden" name="id" value="{{ $item->id }}">

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info btn-bold px-4">Save changes</button>
                          </div>
                        </div>
                      </div>
                      </form>
                    </div>

                    {{-- edit end --}}
    
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
               
           @endisset
           


            <div class="mt-5 border-t-1 bgc-secondary-l4 brc-secondary-l2 py-35 mx-n25">
              <div class="offset-md-0 col-md-12 text-nowrap">                

                <a href="{{session('prev_url')}}" class="btn btn-outline-lightgrey btn-bgc-white btn-bold ml-2 px-4" type="reset">
                  <i class="fa fa-arrow-left mr-1"></i>
                  Back
                </a>

                <a href="{{session('next_url')}}" class="btn btn-info btn-bold px-4" style="float: right" type="submit">
                  <i class="fa fa-check mr-1"></i>
                  Next
                </a>
               
               
              </div>
            </div>                 

          </div>

        </div>
      </div>

      @include('_section')
     
    </div>

   



   

  </div>
 
@endsection