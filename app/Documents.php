<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $table    = 'documents';

    public function getUser(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

}
