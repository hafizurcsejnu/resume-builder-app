
@extends('layouts.master')
@section('main_content')
    

  <div class="page-content container container-plus">
    <div class="page-header pb-2">
      <h1 class="page-title text-primary-d2 text-150">
        Templates       
      </h1>
    </div>

    <div class="row mt-3">
      <div class="col-12">
        <div class="card dcard">
          <div class="card-body px-1 px-md-3">

            <form autocomplete="off">
              <div class="d-flex justify-content-between flex-column flex-sm-row mb-3 px-2 px-sm-0">
                <h3 class="text-125 pl-1 mb-3 mb-sm-0 text-secondary-d4">
                 All Templates

                </h3>               

                <div class="mb-2 mb-sm-0">
                  <button type="button" class="btn btn-blue px-3 d-block w-100 text-95 radius-round border-2 brc-black-tp10">
                    <i class="fa fa-plus mr-1"></i>
                    Add <span class="d-sm-none d-md-inline">New</span> Entry
                  </button>
                </div>
              </div>

              <table id="simple-table" class="mb-0 table table-borderless table-bordered-x brc-secondary-l3 text-dark-m2 radius-1 overflow-hidden">
                <thead class="text-dark-tp3 bgc-grey-l4 text-90 border-b-1 brc-transparent">
                  <tr>
                  

                    <th>
                      SN
                    </th>

                    <th>
                      Title
                    </th>

                    <th>
                      Sections
                    </th>                  

                    <th>Action</th>
                  </tr>
                </thead>

                <tbody class="mt-1">
                  <?php 
                  $data = DB::table('templates')
                  ->orderby('id', 'asc')
                  ->get();			
              ?> 
                  @foreach($data as $item)
                  <tr class="bgc-h-yellow-l4 d-style">
                    <td class="text-center pr-0 pos-rel">
                      {{$loop->iteration}}
                    </td>

                    <td>
                      <a href="#" class="text-blue-d1 text-600 text-95">{{$item->name}}</a>
                    </td>

                                  

                    <td class="text-center pr-0">
                      <div>
                        <a href="#" data-toggle="collapse" data-target="#table-detail-{{$loop->iteration}}" class="d-style btn btn-outline-info text-90 text-600 border-0 px-2 collapsed" title="Show Details" aria-expanded="false">
                          <span class="d-none d-md-inline mr-1">
              Section Details
            </span>
                          <i class="fa fa-angle-down toggle-icon opacity-1 text-90"></i>
                        </a>
                      </div>
                    </td>

                    <td>
                      <!-- action buttons -->
                      <div class="d-none d-lg-flex">
                        <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-success btn-a-lighter-success">
                          <i class="fa fa-pencil-alt"></i>
                        </a>

                        <a href="#" class="mx-2px btn radius-1 border-2 btn-xs btn-brc-tp btn-light-secondary btn-h-lighter-danger btn-a-lighter-danger">
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

                  <!-- detail row -->
                  <tr class="border-0 detail-row bgc-white">
                    <td colspan="8" class="p-0 border-none brc-secondary-l2">
                      <div class="table-detail collapse" id="table-detail-{{$loop->iteration}}" style="">
                        <div class="row">
                          <div class="col-12 col-md-10 offset-md-1 p-4">
                            <div class="alert bgc-secondary-l4 text-dark-m2 border-none border-l-4 brc-primary-m1 radius-0 mb-0">
                              <h4 class="text-primary">
                                Sections
                              </h4>
                              List of sections under this template. 
                              <ul>
                                <li>Header</li>
                                <li>Education</li>
                                <li>Relevant Courses</li>
                                <li>Honors & Achievements</li>
                                <li>Extra-Curricular</li>
                                <li>Work Experience</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach    
               

                  
                

                

                </tbody>
              </table>

              <!-- table footer -->
              <div class="d-flex pl-4 pr-3 pt-35 border-t-1 brc-secondary-l3 flex-column flex-sm-row mt-n1px">
               
                <div class="btn-group ml-sm-auto mt-3 mt-sm-0">
                  <a href="#" class="btn btn-lighter-default btn-bgc-white btn-a-secondary radius-l-1 px-3 border-2">
                    <i class="fa fa-caret-left mr-1"></i>
                    Prev
                  </a>
                  <a href="#" class="btn btn-lighter-default btn-bgc-white btn-a-secondary radius-r-1 px-3 border-2 ml-n2px">
                    Next
                    <i class="fa fa-caret-right ml-1"></i>
                  </a>
                </div>
              </div>
            </form>

          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- /.col -->
    </div>

  </div>
 
@endsection