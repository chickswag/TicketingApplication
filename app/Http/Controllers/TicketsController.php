<?php

namespace App\Http\Controllers;

use App\AuditTrailModel;
use App\Department;
use App\Status;
use App\TicketsLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketScope;


class TicketsController extends Controller
{


    public function __construct()
    {
        $this->domain =env('APP_URL');
        $this->port = env('APP_PORT');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $dataQuery = $request->query();
        if ($request->ajax()) {


            $bookedForMonth = date("Y-m-01");
            $operator='>';
            if(isset($dataQuery['created_at']) )
            {
                $bookedForMonth = date("Y-m-01",strtotime($dataQuery['created_at']));

            }
            switch ($dataQuery['type']){
                case 'firstname':
                    $logs = TicketsLog::whereNull('deleted_at')->orderBy('firstname')->paginate(10);
                    break;
                case 'lastname':
                    $logs = TicketsLog::whereNull('deleted_at')->orderBy('lastname')->paginate(10);
                    break;
                case 'status':
                    $logs = TicketsLog::whereNull('deleted_at')->orderBy('status_id')->paginate(10);
                    break;
                case 'date_logged':
                    $logs = TicketsLog::whereNull('deleted_at')->orderBy('created_at')->paginate(10);
                    break;

            }
            $data =['tickets' => $logs];
            return  view('tickets.logsSorted',$data);

        }
        else{

            //check for user rolesand access

            if(Auth::user()->hasAnyRole(['root'])){
                if(isset($dataQuery['created_at']) && isset($dataQuery['endDate'])){
                    $logs= TicketsLog::where('created_by' ,Auth::user()->id)->whereBetween('created_at', [$dataQuery['startDate'].' 00:00:00', $dataQuery['endDate'].' 23:59:59'])
                        ->OrderBy('created_at','DESC')->paginate(10);
                }
                else {
                    $logs = TicketsLog::whereNull('deleted_at')->paginate(10);
                }
                $logs = TicketsLog::whereNull('deleted_at')->paginate(10);
            }
            if(Auth::user()->hasRole('manager')){
                $logs = TicketsLog::whereNull('deleted_at')->paginate(10);
            }
            if(Auth::user()->hasRole('technician')){
                $logs = TicketsLog::whereNull('deleted_at')->where('department_id', Auth::user()->department_id)->paginate(10);
            }
            if(Auth::user()->hasRole('agent')){
                $logs = TicketsLog::whereNull('deleted_at')->paginate(10);
            }

            $data =['tickets' => $logs];
            return  view('tickets.logs',$data);

        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Log Ticket';
        $departments =  Department::pluck('name', 'id')->sortBy('name');
        return view('tickets.create',compact('title','departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $data =  $request->all();
            $rules = [
                'firstname'     => 'Required',
                'lastname'      => 'Required',
                'department_id' => 'Required',
                'contact'       => 'Required',
            ];

            $validator = Validator::make($data, $rules);
            if ($validator->passes()) {

                $log = new TicketsLog();
                $log->firstname     =  strip_tags($data['firstname']);
                $log->lastname      =  strip_tags($data['lastname']);
                $log->description   =  strip_tags($data['description']);
                $log->contact       =  strip_tags($data['contact']);
                $log->department_id =  $data['department_id'];
                $log->agent_location=  $data['location'];
                $log->email         =  isset($data['email']) ? $data['email']: '';
                $log->status_id     =  Status::NEWLY_LOGGED;
                $log->created_by    =  Auth::user()->id;

                $log->save();

                $log->reference = 'TKT-'.$log->id.ucwords(str_random(rand(3,20))) ;
                $log->save();
                $ticketNo = $log->reference;
                $this->auditTrail('Logged a ticket',$log->created_at,'Newly logged ticket',Status::NEWLY_LOGGED,$log->id);

                if( isset($data['email'])){
                    $hostname =$this->domain;
                    $post = $this->port;;

                    $details = [
                        'title' => "Ticket Number #".$ticketNo,
                        'ticket_number'=>$ticketNo,
                        'fullnames' => $log->firstname .' '.$log->lastname,
                        'link' => $hostname.':'.$post.'/viewTicket/'.$ticketNo,
                    ];
                    Mail::to($data['email'])->send(new TicketScope($details));
                }
                else{
                    return redirect('ticketlogs')->withSuccess('Ticket Logged Successfully!!!');
                }



            } else {
                $messages = $validator->messages();
                return redirect()->back()->withErrors($messages);
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::check()) {
            $ticket = TicketsLog::where('id', $id)->first();
            $title = 'Ticket NO #' . $ticket->reference;
            $output = '
         <div class="row">
         <div class="col-12">
         <div class="card-header"> Client Details</div>
         <div class="border p-4">
         Fullnames: <span>' . $ticket->firstname . ' ' . $ticket->lastname . '</span><br/>
         Contact: <span>' . $ticket->contact . ' ' . $ticket->lastname . '</span><br/>
         Email: <span>' . $ticket->Email . '</span><br/>
         Logged by : <span>' . $ticket->getUser->name . ' ' . $ticket->getUser->surname . '</span><br/>
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

                                        <td>' . $ticket->id . '</td>
                                        <td>' . $ticket->getDepartment->name . '</td>
                                        <td> ' . str_limit($ticket->description, 50) . '</td>
                                        <td><div class="border btn" style="background-color: ' . $ticket->getStatus->color . '; color:#fff0ff">' . $ticket->getStatus->name . '</div></td>
                                        <td>' . $ticket->getUser->name . ' ' . $ticket->getUser->surname . '</td>
                                        <td>' . date_format($ticket->created_at, 'Y M d h:i:s') . '</td>

                                    </tr>


                                </tbody>

                            </table>

                            <hr/>
                        </div>
        ';
            $data = ['page_title' => $title,
                'page_body' => $output];
            return response()->json($data);
        }
        else{
            return Redirect::to('/')->withErrors('message', 'You are not authenticated, please login again!');

        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::check()) {


            $departments = Department::pluck('name', 'id')->sortBy('name');
            $ticket = TicketsLog::where('id', $id)->first();
            $title = 'Edit Ticket ' . $ticket->reference;
            $status = Status::pluck('name', 'id');

            return view('tickets.edit', compact('title', 'departments', 'ticket', 'status'));
        }else{
            return Redirect::to('/')->withErrors('message', 'You are not authenticated, please login again!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::check()) {

            $data =  $request->all();
            $rules = [
                'firstname'     => 'Required',
                'lastname'      => 'Required',
                'department_id' => 'Required',
                'contact'       => 'Required',
                'status_id'     => 'Required',
            ];

            $validator = Validator::make($data, $rules);
            if($validator->passes()){

                $log = TicketsLog::find($id);
                $log->firstname     =  strip_tags($data['firstname']);
                $log->lastname      =  strip_tags($data['lastname']);
                $log->description   =  strip_tags($data['description']);
                $log->contact       =  strip_tags($data['contact']);
                $log->department_id =  $data['department_id'];
                $log->email         =  isset($data['email']) ? $data['email']: '';
                $log->status_id     =  $data['status_id'];
                $log->created_by    =  Auth::user()->id;

                $log->save();
                $this->auditTrail('Updated a ticket',$log->updated_at,'Updated a ticket from '.$log->status_id .' to '. $log->status_id,$log->status_id,$id);
                return redirect('ticketlogs')->withSuccess('Ticket Updated Successfully!!!');

            }
            else {
                $messages = $validator->messages();
                return redirect()->back()->withErrors($messages);
            }

        }
        else
        {
            return Redirect::to('/')->withErrors('message', 'You are not authenticated, please login again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::check()){
            $shop = TicketsLog::find($id);
            $shop->delete();
            return redirect('ticketlogs')->withSuccess('Ticket Deleted Successfully!!!');
        }else{
            return Redirect::to('/')->withErrors('message', 'You are not authenticated, please login again!');
        }

    }

    public function anonymousViewTicketLogged($id)
    {
        $ticket = TicketsLog::where('reference', $id)->first();
        return view('viewTicket',compact('ticket'))->render();
    }

    /**
     * @param $name
     * @param $updated_date
     * @param $action
     */
    public function auditTrail($type,$updated_date,$comment,$status,$ticketNo){
        $trail = new AuditTrailModel();
        $trail->ticket_log_id = $ticketNo;
        $trail->type = $type;
        $trail->created_at = $updated_date;
        $trail->comment = $comment;
        $trail->status_id = $status;
        $trail->created_by = Auth::user()->id;
        //save the trail
        $trail->save();

    }

    public function auditTraiLog(){
        $tickets = AuditTrailModel::paginate(10);
        return view('tickets.trail', compact('tickets'))->render();
    }

}
