<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalDetails extends Model
{
    protected $table    = 'personal_details';
    public function getInterest(){
        return $this->belongsTo('App\PersonalDetails', 'interests_id', 'id');
    }
    public function getDocument(){
        return $this->belongsTo('App\PersonalDetails', 'documents_id', 'id');
    }
}
