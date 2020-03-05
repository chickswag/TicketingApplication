@extends('layouts.app')
@section('content')
        <div class="card">
            <div class="card-header">Persona Interest & Documents</div>

            <div class="card-body">

                @include('personsInterest.interests');

            </div>
        </div>
        <div class="card-footer">
            <div class="btn-toolbar"> <a href="{{URL::previous()}}">
                    <button type="button" class="btn btn-danger">Back</button>
                </a>

            </div>
        </div>


@endsection
