<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use Notifiable;

   
    protected $fillable = [
        'user_id', 'group_id', 'permission'
    ];

}
