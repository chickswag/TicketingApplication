<div>

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
                    <tr>
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
