<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'teacher_id';
    protected $fillable = [
        'email', 'password', 'fname', 'lname', 'dob', 
        'phone', 'mobile', 'status', 'last_login_date', 'last_login_ip'
    ];
    
    protected $hidden = ['password'];
    
    public function classrooms()
    {
        return $this->hasMany(Classroom::class, 'teacher_id');
    }
}