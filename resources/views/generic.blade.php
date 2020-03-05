@extends('layouts.app')
@section('content')
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif


                <div>
                    Details
                </div>

            </div>
        </div>
        <div class="card-footer">
            <div class="btn-toolbar"> <a href="{{URL::previous()}}">
                    <button type="button" class="btn btn-danger">Back</button>
                </a>

            </div>
        </div>


@endsection
