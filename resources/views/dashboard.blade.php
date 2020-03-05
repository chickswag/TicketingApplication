@extends('layouts.app')
@section('content')
        <div class="card">
            <div class="card-header">My Profile</div>

            <div class="card-body">
                <div>
                    Fullnames: <label>{{$userData['name'].' '.$userData['surname']}}</label>
                </div>
                <div>
                    Role: <div class="badge badge-success">{{$role['name']}}</div>
                </div>

            </div>
        </div>
        <div class="card-footer">
            <div class="btn btn-danger">Back</div>
        </div>

@endsection

