@extends('layouts.app')
@section('content')
        <div class="card">
            <div class="card-header">Logs</div>
            <div class="card-body">
                <div id="loader" class="loader" style="display: none"></div>

                <div id="">

                        <div class="count bg-info p-2 text-light mb-4 rounded">Showing {{($tickets->currentpage()-1)*$tickets->perpage()+1}} to {{$tickets->currentpage()*$tickets->perpage()}}
                            of  {{$tickets->total()}} entries
                        </div>

                        <div class="table-responsive">
                            <table class="table table table-bordered table-striped">
                                <thead>
                                <th>#</th>
                                <th>Ticket No.</th>
                                <th>Comment</th>
                                <th>Created by</th>
                                <th>Created Date</th>

                                </thead>
                                <tbody>
                                @foreach($tickets as $index=>$ticket)
                                    <tr class="flex-item">
                                        <td>{!! $tickets->firstItem() + $index !!}</td>
                                        <td>{!! $ticket->id!!}</td>
                                        <td>{!! str_limit($ticket->comment,50)!!}</td>
                                        <td>{!! $ticket->getUser->name!!}</td>
                                        <td>{!!  date_format($ticket->created_at,'Y M d h:i:s')!!}</td>

                                    </tr>
                                    @endforeach

                                </tbody>

                            </table>

                            <hr/>
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
