<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table    = 'status';
    protected $fillable =['name','color'];


    const NEWLY_LOGGED  = 1;
    const IN_PROGRESS   = 2;
    const RESOLVED      = 3;
    const CLOSED        = 4;
}
