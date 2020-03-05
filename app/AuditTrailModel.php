<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditTrailModel extends Model
{
    protected $table    = 'audit_trail';
    protected $fillable = ['type','comment','status_id'];

    public function getUser(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
}
