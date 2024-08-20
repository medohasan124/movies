<?php

namespace App\Models;

use Laratrust\Models\Role as RoleModel;

class Role extends RoleModel
{
    public $guarded = [];

    protected $fillable = [
        'id',
        'name',
    ];


       // role
       public function UserRoles()
       {
           return $this->belongsToMany(User::class, 'role_user');
       }
}
