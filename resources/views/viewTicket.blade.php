@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-header"> Client Details</div>
        <div class="border p-4">
            Fullnames: <span>{{$ticket['firstname']. ' '.$ticket['lastname']}}</span><br/>
            Contact: <span>{{$ticket['contact']}}</span><br/>
            Email: <span>{{$ticket['email']}}</span><br/>
            Logged by : <span>{{ $ticket->getUser->name}} {{$ticket->getUser->surname }}</span><br/>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table table table-bordered table-striped">
        <thead>
        <th>#</th>

        <th>Department</th>
        <th>Description</th>
        <th>Status</th>
        <th>Created by</th>
        <th>Created Date</th>

        </thead>
        <tbody>

        <tr>
            <td>{{$ticket->id}}</td>
            <td>{{$ticket->getDepartment->name}}</td>
            <td> {{str_limit($ticket->description,50)}}</td>
            <td><div class="border btn" style="background-color: {{ $ticket->getStatus->color}}; color:#fff0ff">{{$ticket->getStatus->name}}</div></td>
            <td>{{ $ticket->getUser->name}} {{$ticket->getUser->surname }}</td>
            <td>{{date_format($ticket->created_at,'Y M d h:i:s')}}</td>

        </tr>
        </tbody>

    </table>

    <hr/>
</div>
    @endsection
