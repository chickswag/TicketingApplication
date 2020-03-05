@extends('layouts.app')
@section('content')
        <div class="card">
            <div class="card-header">Logs</div>
            <div class="card-body">
                <div id="loader" class="loader" style="display: none"></div>
                <div class="d-flex justify-content-between">
                    <div class="w-25">
                        <label for="choose">Select an option</label>
                        {!!Form::select('name',array("0"=>"Custom Selection","1"=>"Current Month","2"=>"last 3 Months","3"=>"last 6 Months"),1,array('class'=>'form-control','onchange'=>'filterSelection(this.value)'))!!}
                    </div>
                    <div  id="customFilterSelection" class="shadow-sm rounded p-3" style="display: none;text-align: center;background-color:#E9ECEF">
                        <div class="">Search by date range</div>
                        <div class="d-inline-flex justify-content-around">
                                        <span>
                                            Start Date:<input type="date" style=" color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;" max="{{date("Y-m-d")}}"  id="daterange1" onchange="dateRange()">
                                        </span>
                                        <span>
                                           &nbsp;&nbsp;&nbsp;End Date:<input type="date" style=" color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;" max="{{date("Y-m-d")}}" id="daterange2" onchange="dateRange()">
                                       </span>

                        </div>

                    </div>
                    <div>
                        <label for="filter">Filter Search</label>
                        <input id="search-criteria" class="form-control" type="text" placeholder="Type here to search..." >

                    </div>
                    <div>
                        <div class="form-group col-md-12">
                            <label for="oredrBy">Order By</label>
                            {!! Form::select('selected_field', ["firstname"=>"Firstname",
                                "lastname"=>"Lastname",
                                "status"=>"Status",
                                "date_logged"=>"Date Logged"],null, array( 'placeholder' => 'Please Select','class'=>'form-control','required'=>'required','onchange'=>'orderBySelected(this.value)')) !!}
                        </div>
                    </div>
                </div>
                <div id="sortedLogs">

                   @if(count($tickets) == 0)
                       <div class="border p-2 mb-2"> No Tickets logged yet </div>
                        @if(Auth::user()->hasAnyRole(array('agent')))
                                <a href="{!! URL::action('TicketsController@create') !!}">
                                    <button class="btn btn-primary mb-4 p-2" type="submit">Add<i class="ml-2 fa fa-plus"></i></button>
                                </a>
                        @endif
                   @else
                        @if(Auth::user()->hasAnyRole(array('agent')))
                        <a href="{!! URL::action('TicketsController@create') !!}">
                            <button class="btn btn-primary mb-4 p-2" type="submit">Add<i class="ml-2 fa fa-plus"></i></button>
                        </a>
                        @endif
                        <div class="count bg-info p-2 text-light mb-4 rounded">Showing {{($tickets->currentpage()-1)*$tickets->perpage()+1}} to {{$tickets->currentpage()*$tickets->perpage()}}
                            of  {{$tickets->total()}} entries
                        </div>

                        <div class="table-responsive">
                            <table class="table table table-bordered table-striped">
                                <thead>
                                <th>#</th>
                                <th>Ticket No.</th>
                                <th>Department</th>
                                <th>Description</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Status</th>
                                <th>Created by</th>
                                <th>Created Date</th>
                                <th>Actions</th>

                                </thead>
                                <tbody>
                                @foreach($tickets as $index=>$ticket)
                                    <tr class="flex-item">
                                        <td>{!! $tickets->firstItem() + $index !!}</td>
                                        <td>{!! $ticket->id!!}</td>
                                        <td>{!! $ticket->getDepartment->name!!}</td>
                                        <td>{!! str_limit($ticket->description,50)!!}</td>
                                        <td>{!! $ticket->firstname !!}</td>
                                        <td>{!! $ticket->lastname !!}</td>
                                        <td><div class="border btn" style="background-color: {!! $ticket->getStatus->color !!}; color:#fff0ff">{!! $ticket->getStatus->name!!}</div></td>
                                        <td>{!! $ticket->getUser->name.' '.$ticket->getUser->surname !!}</td>
                                        <td>{!!  date_format($ticket->created_at,'Y M d h:i:s')!!}</td>
                                        <td>
                                            <a href="{{ URL::action('TicketsController@edit',$ticket->id )}}"  class="btn btn-secondary fa fa fa-plus "> </a>
                                            <button data-toggle="modal" data-target="#loadticket" title='Show More' onclick="view_ticket({{ $ticket->id  }})" class="m-1 btn btn-success fa fa-eye" value="{!! $ticket->id !!}"></button>
                                            @if(Auth::user()->hasAnyRole(array('root')))
                                                <a href="{{ URL::action('TicketsController@destroy',$ticket->id )}}"  class="btn btn-large btn-danger fa fa fa-trash" > </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>

                            </table>

                            <hr/>
                        </div>
                       @endif
                </div>
                    {{--                    add the paginations to this div in every page that has a list content--}}
                    <div class="text-left ">
                        {{ $tickets->onEachSide(1)->links('pagination::bootstrap-4')}}
                    </div>
            </div>

        </div>
        <div class="card-footer">
            <div class="btn-toolbar"> <a href="{{URL::previous()}}">
                    <button type="button" class="btn btn-danger">Back</button>
                </a>

            </div>
        </div>
        <div class="modal fade" id="loadticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 50%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title page-title" ></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="btn btn-secondary" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="client-details"></div>
                        <div class="showmore-body">
                        </div>

                    </div>
                    <div class="modal-footer left">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

@endsection
