@extends('layouts.app')
@section('content')
        <div class="card">
            <div class="card-header">{{ $title }}</div>
            <div class="card-body">
                    {{ Form::open(array('action' => 'TicketsController@store', 'method' =>'POST')) }}
                    <input type="hidden" name="location" value="" id="location"/>
                    <div class="col-12">
                        <div class="card-header">Capture Log Details</div>
                        <div class="card p-2">
                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label for="ClientName">Department</label>
                                    {!! Form::select('department_id', $departments,null, array( 'placeholder' => 'Please Select','class'=>'form-control','required'=>'required')) !!}
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="ClientName">Description</label>
                                    {!! Form::textarea('description',null,array('placeholder'=>'Client Name','class'=>'form-control','required'=>'required')) !!}
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
                                        {!! Form::text('firstname',null,array('placeholder'=>'Client Name','class'=>'form-control','required'=>'required')) !!}
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="lastname">lastname</label>
                                        {!! Form::text('lastname',null,array('placeholder'=>'Client Name','class'=>'form-control','required'=>'required')) !!}
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="Contact">Contact</label>
                                        {!! Form::text('contact',null,array('placeholder'=>'Contact','class'=>'form-control','required'=>'required')) !!}
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="Email">Email</label>
                                        {!! Form::email('email',null,array('placeholder'=>'Email Address','class'=>'form-control')) !!}
                                    </div>


                                </div>
                            </div>
                        </div>

            </div>
        </div>
        <div class="card-footer d-flex justify-content-start">
            <div class="flex-grow-1 "> <a href="{{URL::previous()}}">
                    <div class="btn btn-danger">Back</div>
                </a>

            </div>
            <div class="flex-grow-1 ">
                    <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>

        {{ Form::close() }}
        <script >
            $(document).ready(function(){
                getLocation();
                $("#search-criteria").keyup(function(){

                    // Retrieve the input field text and reset the count to zero
                    var filter = $(this).val(), count = 0;

                    // Loop through the comment list
                    $(".flex-item").each(function(){

                        // If the list item does not contain the text phrase fade it out
                        if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                            $(this).fadeOut();

                            // Show the list item if the phrase matches and increase the count by 1
                        } else {
                            $(this).show();

                        }
                    });

                });
            });
            function getLocation() {

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }


            }

            function showPosition(position) {
                document.getElementById("location").value = position.coords.latitude+','+ position.coords.longitude;
            }

        </script>
@endsection
