<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class TicketsLog extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table    = 'ticket_log';
    protected $fillable =['department_id','description','status_id','firstname','lastname','email','contact','agent_location','created_by'];

    public function getUser(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function getDepartment(){
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }

    public function getStatus(){
        return $this->belongsTo('App\Status', 'status_id', 'id');
    }


}
