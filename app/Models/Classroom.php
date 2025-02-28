<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'classroom_id';
    protected $fillable = ['grade_id', 'year', 'section', 'status', 'remarks', 'teacher_id'];
    
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    
    public function students()
    {
        return $this->belongsToMany(Student::class, 'classroom_student', 'classroom_id', 'student_id');
    }
}