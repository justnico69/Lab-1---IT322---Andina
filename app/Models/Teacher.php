<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teacher';
    protected $primaryKey = 'teacher_id';
    public $timestamps = false;

    protected $fillable = [
        'email', 'password', 'fname', 'lname', 'dob', 'phone', 'status', 'last_login_date', 'last_login_ip'
    ];

    public function classrooms()
    {
        return $this->hasMany(Classroom::class, 'teacher_id', 'teacher_id');
    }
}
