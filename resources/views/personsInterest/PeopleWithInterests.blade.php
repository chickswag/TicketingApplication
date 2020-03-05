@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Logs</div>
        <div class="card-body">
            @include('personsInterest.interests')
            <div class="mt-4" id="">



                <div class="table-responsive">
                    <table class="table table table-bordered table-striped">
                        <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Interests</th>
                        <th>Documents</th>
                        {{--                            <th>Created Date</th>--}}

                        </thead>
                        <tbody>
                        @foreach($dataLoad as $index=>$data)
                            <tr class="flex-item">
                                <td>{!! $index++ !!}</td>
                                <td>{!! $data->name!!}</td>
                                <td>{!! $data->surname!!}</td>
                                <td>{!! $data->interests_id!!}</td>
                                <td>{!! $data->documents_id!!}</td>

                                {{--                                    <td>{!!  date_format($data->created_at,'Y M d h:i:s')!!}</td>--}}

                            </tr>
                        @endforeach

                        </tbody>

                    </table>

                    <hr/>
                </div>

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
