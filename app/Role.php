<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasPermissions;

class Role extends Model
{
    use HasPermissions;
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
