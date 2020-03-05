<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table    = 'department';
    protected $fillable = ['name'];

    const IT = 1;
    const SALES = 2;
    const ACCOUNTS =3;
}
