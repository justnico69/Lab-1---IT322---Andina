<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';
    protected $primaryKey = 'student_id';
    public $timestamps = false;

    protected $fillable = [
        'email', 'password', 'fname', 'lname', 'dob', 'mobile', 'status', 'last_login_date', 'last_login_ip'
    ];

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_student', 'student_id', 'classroom_id');
    }

    public function exams()
    {
        return $this->hasMany(ExamResult::class, 'student_id', 'student_id');
    }
}
