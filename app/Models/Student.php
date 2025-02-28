<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'student_id';
    protected $fillable = [
        'email', 'password', 'fname', 'lname', 'dob', 
        'phone', 'mobile', 'parent_id', 'date_of_join', 
        'status', 'last_login_date', 'last_login_ip'
    ];
    
    protected $hidden = ['password'];
    
    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'parent_id');
    }
    
    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_student', 'student_id', 'classroom_id');
    }
    
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }
    
    public function examResults()
    {
        return $this->hasMany(ExamResult::class, 'student_id');
    }
}