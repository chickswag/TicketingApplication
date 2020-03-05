@extends('layouts.app')
@section('content')
        <div class="card">
            <div class="card-header">{{ $title }}</div>

            <div class="card-body">

                {!!Form::open(array('url' => URL::to('/updateticket/'.$ticket->id), 'method' => 'PUT'))!!}
                <div class="col-12">
                    <div class="card-header">Update Status</div>
                    <div class="card p-2">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="status">Status</label>
                                {!! Form::select('status_id',$status,$ticket->status_id,array('placeholder'=>'Client Name','class'=>'form-control','required'=>'required')) !!}
                            </div>

                        </div>
                    </div>
                </div>
                <div class="m-4"></div>
                    <div class="col-12">
                        <div class="card-header">Capture Log Details</div>
                        <div class="card p-2">
                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label for="ClientName">Department</label>
                                    {!! Form::select('department_id', $departments,$ticket->department_id, array( 'placeholder' => 'Please Select','class'=>'form-control','required'=>'required')) !!}
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="ClientName">Description</label>
                                    {!! Form::textarea('description',$ticket->description,array('placeholder'=>'Client Name','class'=>'form-control','required'=>'required')) !!}
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="m-4"></div>
                    <div class="col-12">
                            <div class="card-header">Clients Details</div>
                            <div class="card p-2">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="firstname">firstname</label>
                                        {!! Form::text('firstname',$ticket->firstname,array('placeholder'=>'Client Name','class'=>'form-control','required'=>'required')) !!}
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="lastname">lastname</label>
                                        {!! Form::text('lastname',$ticket->lastname,array('placeholder'=>'Client Name','class'=>'form-control','required'=>'required')) !!}
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="Contact">Contact</label>
                                        {!! Form::text('contact',$ticket->contact,array('placeholder'=>'Contact','class'=>'form-control','required'=>'required')) !!}
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="Email">Email</label>
                                        {!! Form::email('email',$ticket->email,array('placeholder'=>'Email Address','class'=>'form-control')) !!}
                                    </div>


                                </div>
                            </div>
                        </div>



            </div>
        </div>
        <div class="card-footer d-flex justify-content-start">
           <a href="{{URL::previous()}}">
                    <div class="mr-2 btn btn-danger">Back</div>
            </a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>


        {{ Form::close() }}
@endsection
