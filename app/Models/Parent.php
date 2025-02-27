<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    use HasFactory;

    protected $table = 'parent';
    protected $primaryKey = 'parent_id';
    public $timestamps = false;

    protected $fillable = [
        'email', 'password', 'fname', 'lname', 'dob', 'mobile', 'status', 'last_login_date', 'last_login_ip'
    ];
}
